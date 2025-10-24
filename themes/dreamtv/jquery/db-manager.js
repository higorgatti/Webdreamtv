/**
 * DreamTV IndexedDB Manager
 * Gerenciador de cache local usando IndexedDB
 * Armazena catálogo completo de filmes, séries e canais
 */

class DBManager {
    constructor() {
        this.dbName = 'dreamtv-cache';
        this.version = 1;
        this.db = null;
    }

    /**
     * Inicializa o banco de dados IndexedDB
     */
    async init() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open(this.dbName, this.version);

            request.onerror = () => {
                console.error('❌ Erro ao abrir IndexedDB:', request.error);
                reject(request.error);
            };

            request.onsuccess = () => {
                this.db = request.result;
                console.log('✅ IndexedDB inicializado com sucesso');
                resolve(this.db);
            };

            request.onupgradeneeded = (event) => {
                const db = event.target.result;

                // Criar object stores se não existirem
                if (!db.objectStoreNames.contains('movies')) {
                    const moviesStore = db.createObjectStore('movies', { keyPath: 'stream_id' });
                    moviesStore.createIndex('category_id', 'category_id', { unique: false });
                    moviesStore.createIndex('name', 'name', { unique: false });
                    console.log('📦 Object store "movies" criado');
                }

                if (!db.objectStoreNames.contains('series')) {
                    const seriesStore = db.createObjectStore('series', { keyPath: 'series_id' });
                    seriesStore.createIndex('category_id', 'category_id', { unique: false });
                    seriesStore.createIndex('name', 'name', { unique: false });
                    console.log('📦 Object store "series" criado');
                }

                if (!db.objectStoreNames.contains('live')) {
                    const liveStore = db.createObjectStore('live', { keyPath: 'stream_id' });
                    liveStore.createIndex('category_id', 'category_id', { unique: false });
                    liveStore.createIndex('name', 'name', { unique: false });
                    console.log('📦 Object store "live" criado');
                }

                if (!db.objectStoreNames.contains('categories')) {
                    db.createObjectStore('categories', { keyPath: 'category_id' });
                    console.log('📦 Object store "categories" criado');
                }

                if (!db.objectStoreNames.contains('metadata')) {
                    db.createObjectStore('metadata');
                    console.log('📦 Object store "metadata" criado');
                }

                console.log('🎉 Estrutura do IndexedDB criada com sucesso!');
            };
        });
    }

    /**
     * Salva múltiplos itens em uma store
     */
    async bulkPut(storeName, items) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readwrite');
            const store = transaction.objectStore(storeName);

            let count = 0;
            items.forEach(item => {
                store.put(item);
                count++;
            });

            transaction.oncomplete = () => {
                console.log(`✅ ${count} itens salvos em "${storeName}"`);
                resolve(count);
            };

            transaction.onerror = () => {
                console.error(`❌ Erro ao salvar em "${storeName}":`, transaction.error);
                reject(transaction.error);
            };
        });
    }

    /**
     * Busca todos os itens de uma store
     */
    async getAll(storeName) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readonly');
            const store = transaction.objectStore(storeName);
            const request = store.getAll();

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                console.error(`❌ Erro ao buscar "${storeName}":`, request.error);
                reject(request.error);
            };
        });
    }

    /**
     * Busca itens por categoria
     */
    async getByCategory(storeName, categoryId) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readonly');
            const store = transaction.objectStore(storeName);
            const index = store.index('category_id');
            const request = index.getAll(categoryId);

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                console.error(`❌ Erro ao buscar por categoria:`, request.error);
                reject(request.error);
            };
        });
    }

    /**
     * Busca um único item por ID ou chave
     * @param {string} storeName - Nome da store
     * @param {any} key - ID ou chave do item
     */
    async get(storeName, key) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readonly');
            const store = transaction.objectStore(storeName);
            const request = store.get(key);

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    /**
     * Salva um único item
     * @param {string} storeName - Nome da store
     * @param {any} item - Item a salvar
     * @param {any} key - Chave (opcional, necessária para stores sem keyPath como 'metadata')
     */
    async put(storeName, item, key = undefined) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readwrite');
            const store = transaction.objectStore(storeName);

            // Se a store não tem keyPath (como 'metadata'), precisa passar a chave
            const request = key !== undefined ? store.put(item, key) : store.put(item);

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    /**
     * Busca todos os IDs de uma store
     */
    async getAllKeys(storeName) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readonly');
            const store = transaction.objectStore(storeName);
            const request = store.getAllKeys();

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    /**
     * Conta total de itens em uma store
     */
    async count(storeName) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readonly');
            const store = transaction.objectStore(storeName);
            const request = store.count();

            request.onsuccess = () => {
                resolve(request.result);
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    /**
     * Limpa todos os dados de uma store
     */
    async clear(storeName) {
        if (!this.db) await this.init();

        return new Promise((resolve, reject) => {
            const transaction = this.db.transaction([storeName], 'readwrite');
            const store = transaction.objectStore(storeName);
            const request = store.clear();

            request.onsuccess = () => {
                console.log(`🗑️ Store "${storeName}" limpa`);
                resolve();
            };

            request.onerror = () => {
                reject(request.error);
            };
        });
    }

    /**
     * Deleta o banco de dados completo
     */
    async deleteDatabase() {
        if (this.db) {
            this.db.close();
            this.db = null;
        }

        return new Promise((resolve, reject) => {
            const request = indexedDB.deleteDatabase(this.dbName);

            request.onsuccess = () => {
                console.log('🗑️ Database deletado com sucesso');
                resolve();
            };

            request.onerror = () => {
                console.error('❌ Erro ao deletar database:', request.error);
                reject(request.error);
            };
        });
    }

    /**
     * Busca filmes por texto (busca no nome)
     */
    async searchMovies(query) {
        if (!this.db) await this.init();

        const allMovies = await this.getAll('movies');
        const lowerQuery = query.toLowerCase();

        return allMovies.filter(movie =>
            movie.name.toLowerCase().includes(lowerQuery)
        );
    }

    /**
     * Obtém estatísticas do cache
     */
    async getStats() {
        if (!this.db) await this.init();

        const [moviesCount, seriesCount, liveCount] = await Promise.all([
            this.count('movies'),
            this.count('series'),
            this.count('live')
        ]);

        const metadata = await this.get('metadata', 'sync_info');

        return {
            movies: moviesCount,
            series: seriesCount,
            live: liveCount,
            total: moviesCount + seriesCount + liveCount,
            lastSync: metadata?.lastSync || null,
            version: metadata?.version || null
        };
    }
}

// Exportar instância global
window.dbManager = new DBManager();
console.log('📦 DBManager carregado e pronto para uso');
