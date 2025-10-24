/**
 * DreamTV Sync Manager
 * Gerenciador de sincronização inteligente com cache IndexedDB
 * Sincroniza catálogo completo e detecta novos conteúdos automaticamente
 */

class SyncManager {
    constructor(dbManager) {
        this.db = dbManager;
        this.syncInterval = 30 * 60 * 1000; // 30 minutos
        this.syncTimer = null;
        this.isSyncing = false;
        this.onProgressCallback = null;
        this.onCompleteCallback = null;
    }

    /**
     * Define callback de progresso
     */
    onProgress(callback) {
        this.onProgressCallback = callback;
    }

    /**
     * Define callback de conclusão
     */
    onComplete(callback) {
        this.onCompleteCallback = callback;
    }

    /**
     * Reporta progresso da sincronização
     */
    reportProgress(message, current, total) {
        console.log(`📊 ${message} (${current}/${total})`);
        if (this.onProgressCallback) {
            this.onProgressCallback({ message, current, total, percentage: (current / total) * 100 });
        }
    }

    /**
     * Verifica se precisa sincronizar
     */
    async needsSync() {
        const metadata = await this.db.get('metadata', 'sync_info');

        if (!metadata) {
            console.log('🆕 Primeira sincronização necessária');
            return true;
        }

        const lastSync = metadata.lastSync || 0;
        const timeSinceSync = Date.now() - lastSync;
        const needsSync = timeSinceSync > this.syncInterval;

        if (needsSync) {
            console.log(`⏰ Última sync: ${new Date(lastSync).toLocaleString()}`);
            console.log(`   Tempo decorrido: ${Math.floor(timeSinceSync / 60000)} minutos`);
        }

        return needsSync;
    }

    /**
     * Sincronização completa do catálogo
     */
    async fullSync() {
        if (this.isSyncing) {
            console.log('⚠️ Sincronização já em andamento');
            return;
        }

        this.isSyncing = true;
        const startTime = Date.now();

        try {
            console.log('🚀 Iniciando sincronização completa...');

            // Obter credenciais do usuário
            const credentials = this.getCredentials();
            if (!credentials) {
                throw new Error('Credenciais não encontradas. Faça login primeiro.');
            }

            // Passo 1: Sincronizar categorias (6/6 passos)
            this.reportProgress('Sincronizando categorias...', 1, 6);
            await this.syncCategories(credentials);

            // Passo 2: Sincronizar canais ao vivo (6/6 passos)
            this.reportProgress('Sincronizando canais ao vivo...', 2, 6);
            const liveStreams = await this.syncLiveStreams(credentials);

            // Passo 3: Sincronizar filmes (6/6 passos)
            this.reportProgress('Sincronizando filmes...', 3, 6);
            const movies = await this.syncMovies(credentials);

            // Passo 4: Sincronizar séries (6/6 passos)
            this.reportProgress('Sincronizando séries...', 4, 6);
            const series = await this.syncSeries(credentials);

            // Passo 5: Salvar metadados
            this.reportProgress('Salvando metadados...', 5, 6);
            await this.db.put('metadata', {
                lastSync: Date.now(),
                version: Date.now(),
                totalMovies: movies.length,
                totalSeries: series.length,
                totalLive: liveStreams.length,
                username: credentials.username
            }, 'sync_info');

            // Passo 6: Finalizar
            this.reportProgress('Sincronização concluída!', 6, 6);

            const duration = ((Date.now() - startTime) / 1000).toFixed(2);
            const stats = await this.db.getStats();

            console.log('✅ Sincronização completa!');
            console.log(`   Tempo total: ${duration}s`);
            console.log(`   Filmes: ${stats.movies}`);
            console.log(`   Séries: ${stats.series}`);
            console.log(`   Canais: ${stats.live}`);

            if (this.onCompleteCallback) {
                this.onCompleteCallback({
                    success: true,
                    duration,
                    stats
                });
            }

        } catch (error) {
            console.error('❌ Erro na sincronização:', error);
            if (this.onCompleteCallback) {
                this.onCompleteCallback({
                    success: false,
                    error: error.message
                });
            }
            throw error;
        } finally {
            this.isSyncing = false;
        }
    }

    /**
     * Sincroniza categorias
     */
    async syncCategories(credentials) {
        const [liveCategories, vodCategories, seriesCategories] = await Promise.all([
            this.fetchAPI('get_live_categories', credentials),
            this.fetchAPI('get_vod_categories', credentials),
            this.fetchAPI('get_series_categories', credentials)
        ]);

        const allCategories = [
            ...(liveCategories || []).map(c => ({ ...c, type: 'live' })),
            ...(vodCategories || []).map(c => ({ ...c, type: 'vod' })),
            ...(seriesCategories || []).map(c => ({ ...c, type: 'series' }))
        ];

        await this.db.bulkPut('categories', allCategories);
        console.log(`✅ ${allCategories.length} categorias sincronizadas`);
        return allCategories;
    }

    /**
     * Sincroniza canais ao vivo
     */
    async syncLiveStreams(credentials) {
        const streams = await this.fetchAPI('get_live_streams', credentials);
        if (streams && streams.length > 0) {
            await this.db.bulkPut('live', streams);
            console.log(`✅ ${streams.length} canais sincronizados`);
        }
        return streams || [];
    }

    /**
     * Sincroniza filmes
     */
    async syncMovies(credentials) {
        const movies = await this.fetchAPI('get_vod_streams', credentials);
        if (movies && movies.length > 0) {
            await this.db.bulkPut('movies', movies);
            console.log(`✅ ${movies.length} filmes sincronizados`);
        }
        return movies || [];
    }

    /**
     * Sincroniza séries
     */
    async syncSeries(credentials) {
        const series = await this.fetchAPI('get_series', credentials);
        if (series && series.length > 0) {
            await this.db.bulkPut('series', series);
            console.log(`✅ ${series.length} séries sincronizadas`);
        }
        return series || [];
    }

    /**
     * Verifica e sincroniza apenas conteúdo novo
     */
    async checkForNewContent() {
        if (this.isSyncing) return;

        try {
            console.log('🔍 Verificando novos conteúdos...');

            const credentials = this.getCredentials();
            if (!credentials) return;

            // Buscar os últimos 100 IDs de cada tipo
            const [latestMovies, latestSeries, latestLive] = await Promise.all([
                this.fetchAPI('get_latest_ids', { ...credentials, type: 'vod', limit: 100 }),
                this.fetchAPI('get_latest_ids', { ...credentials, type: 'series', limit: 100 }),
                this.fetchAPI('get_latest_ids', { ...credentials, type: 'live', limit: 100 })
            ]);

            // Verificar novos filmes
            const newMovies = await this.findNewItems('movies', latestMovies || []);
            if (newMovies.length > 0) {
                const movieDetails = await this.fetchAPI('get_vod_streams', credentials);
                const newMovieDetails = movieDetails.filter(m => newMovies.includes(m.stream_id));
                await this.db.bulkPut('movies', newMovieDetails);
                console.log(`🎬 ${newMovies.length} novos filmes adicionados!`);
                this.showNotification(`${newMovies.length} novos filmes disponíveis!`);
            }

            // Verificar novas séries
            const newSeries = await this.findNewItems('series', latestSeries || []);
            if (newSeries.length > 0) {
                const seriesDetails = await this.fetchAPI('get_series', credentials);
                const newSeriesDetails = seriesDetails.filter(s => newSeries.includes(s.series_id));
                await this.db.bulkPut('series', newSeriesDetails);
                console.log(`📺 ${newSeries.length} novas séries adicionadas!`);
            }

            // Verificar novos canais
            const newLive = await this.findNewItems('live', latestLive || []);
            if (newLive.length > 0) {
                const liveDetails = await this.fetchAPI('get_live_streams', credentials);
                const newLiveDetails = liveDetails.filter(l => newLive.includes(l.stream_id));
                await this.db.bulkPut('live', newLiveDetails);
                console.log(`📡 ${newLive.length} novos canais adicionados!`);
            }

            const totalNew = newMovies.length + newSeries.length + newLive.length;
            if (totalNew === 0) {
                console.log('✅ Nenhum conteúdo novo encontrado');
            }

        } catch (error) {
            console.error('❌ Erro ao verificar novos conteúdos:', error);
        }
    }

    /**
     * Encontra IDs novos que não estão no cache
     */
    async findNewItems(storeName, latestIds) {
        const cachedIds = await this.db.getAllKeys(storeName);
        return latestIds.filter(id => !cachedIds.includes(id));
    }

    /**
     * Faz requisição à API
     */
    async fetchAPI(action, params = {}) {
        const queryString = new URLSearchParams({ action, ...params }).toString();
        const response = await fetch(`api.php?${queryString}`);
        return await response.json();
    }

    /**
     * Obtém credenciais do localStorage
     */
    getCredentials() {
        const credsStr = localStorage.getItem('user_credentials');
        if (!credsStr) return null;
        return JSON.parse(credsStr);
    }

    /**
     * Salva credenciais no localStorage
     */
    saveCredentials(username, password) {
        localStorage.setItem('user_credentials', JSON.stringify({
            username,
            password,
            savedAt: Date.now()
        }));
        console.log('✅ Credenciais salvas');
    }

    /**
     * Inicia sincronização automática periódica
     */
    startAutoSync() {
        if (this.syncTimer) {
            console.log('⚠️ Auto-sync já está ativo');
            return;
        }

        console.log(`🔄 Auto-sync ativado (intervalo: ${this.syncInterval / 60000} minutos)`);

        this.syncTimer = setInterval(() => {
            this.checkForNewContent();
        }, this.syncInterval);

        // Verificar ao ativar
        setTimeout(() => this.checkForNewContent(), 5000);
    }

    /**
     * Para sincronização automática
     */
    stopAutoSync() {
        if (this.syncTimer) {
            clearInterval(this.syncTimer);
            this.syncTimer = null;
            console.log('⏸️ Auto-sync desativado');
        }
    }

    /**
     * Mostra notificação para o usuário
     */
    showNotification(message) {
        // Tentar usar notificação nativa do navegador
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification('DreamTV', {
                body: message,
                icon: 'favicon.ico'
            });
        } else {
            // Fallback: console
            console.log(`🔔 ${message}`);
        }
    }

    /**
     * Limpa todo o cache
     */
    async clearCache() {
        await Promise.all([
            this.db.clear('movies'),
            this.db.clear('series'),
            this.db.clear('live'),
            this.db.clear('categories'),
            this.db.clear('metadata')
        ]);
        console.log('🗑️ Cache limpo completamente');
    }
}

// Exportar instância global
window.syncManager = new SyncManager(window.dbManager);
console.log('🔄 SyncManager carregado e pronto para uso');
