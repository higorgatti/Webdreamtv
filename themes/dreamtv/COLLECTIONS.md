# 🎬 Sistema de Coleções - DreamTV

## Como Funciona

O sistema de coleções identifica automaticamente franquias de filmes (ex: "Harry Potter", "Velozes e Furiosos") usando a API do TMDB.

## 📦 Arquitetura

```
┌─────────────────────┐
│  build-collections  │  Script PHP (roda 1x por dia)
│       .php          │  → Busca filmes da API
└──────────┬──────────┘  → Identifica coleções TMDB
           │             → Enriquece metadados
           ↓
┌─────────────────────┐
│  collections.json   │  Arquivo gerado (~100-500 KB)
└──────────┬──────────┘  → Cache estático
           │             → Rápido para carregar
           ↓
┌─────────────────────┐
│   index.php         │  Frontend React
│  (loadCollections)  │  → Carrega JSON instantaneamente
└─────────────────────┘  → Mostra coleções ao usuário
```

## 🚀 Setup Inicial

### 1. Configurar credenciais

Edite `build-collections.php` e altere:

```php
$username = 'SEU_USERNAME';  // ← Seu usuário Xtream
$password = 'SUA_SENHA';      // ← Sua senha Xtream
```

### 2. Configurar TMDB API Key

Edite `config.php` e adicione sua chave:

```php
define('TMDB_API_KEY', 'SUA_CHAVE_AQUI');
```

Obtenha uma chave gratuita em: https://www.themoviedb.org/settings/api

### 3. Testar manualmente

```bash
cd C:\xampp\htdocs\webplayer_dev\themes\dreamtv
php build-collections.php
```

Isso vai:
- Buscar todos os filmes da API
- Identificar coleções no TMDB
- Gerar `collections.json`
- Levar cerca de 5-15 minutos (depende da quantidade de filmes)

### 4. Agendar execução automática (Cron)

**No servidor Linux/VPS:**

```bash
# Editar crontab
crontab -e

# Adicionar linha (roda todo dia às 3h da manhã)
0 3 * * * cd /var/www/html/themes/dreamtv && php build-collections.php >> /var/log/collections-build.log 2>&1
```

**No Windows (Task Scheduler):**

1. Abra "Agendador de Tarefas"
2. Criar Tarefa Básica
3. Nome: "Build Collections DreamTV"
4. Gatilho: Diariamente às 3:00 AM
5. Ação: Iniciar programa
   - Programa: `C:\xampp\php\php.exe`
   - Argumentos: `C:\xampp\htdocs\webplayer_dev\themes\dreamtv\build-collections.php`

## 📊 Formato do collections.json

```json
{
  "generated_at": "2025-01-22 03:00:00",
  "total_movies": 1500,
  "total_collections": 45,
  "collections": [
    {
      "id": 1241,
      "name": "Harry Potter",
      "poster_path": "/path.jpg",
      "backdrop_path": "/path.jpg",
      "overview": "A saga completa de Harry Potter...",
      "movies": [
        {
          "stream_id": 12345,
          "name": "Harry Potter e a Pedra Filosofal",
          "tmdb_id": 671,
          "category_id": 174
        }
      ]
    }
  ]
}
```

## ⚡ Performance

### Antes (Client-Side):
- ❌ 5-10 segundos de processamento
- ❌ 100+ requisições TMDB por usuário
- ❌ Pesado no navegador
- ❌ Custo alto na API

### Depois (Server-Side):
- ✅ ~50ms para carregar JSON
- ✅ 1 build por dia (não por usuário)
- ✅ Zero processamento no navegador
- ✅ Economia de 99% nas requisições TMDB

## 🔧 Troubleshooting

### Erro: "Não foi possível conectar à API"
- Verifique as credenciais em `build-collections.php`
- Teste manualmente: `http://seu-servidor/player_api.php?action=get_vod_streams&username=X&password=Y`

### Erro: "TMDB API inválida"
- Verifique `TMDB_API_KEY` em `config.php`
- Teste: https://api.themoviedb.org/3/movie/550?api_key=SUA_CHAVE

### JSON não está atualizando
- Verifique se o cron está rodando: `grep CRON /var/log/syslog`
- Verifique logs: `cat /var/log/collections-build.log`
- Rode manualmente para debug

## 📝 Logs

Os logs ficam em `/var/log/collections-build.log`:

```bash
# Ver últimas execuções
tail -100 /var/log/collections-build.log

# Monitorar em tempo real
tail -f /var/log/collections-build.log
```

## 🎯 Próximos Passos

1. ✅ Criar script de build
2. ✅ Documentar processo
3. ⏳ Testar em produção
4. ⏳ Configurar cron no servidor
5. ⏳ Monitorar logs por 1 semana

## 💡 Melhorias Futuras

- [ ] Cache incremental (apenas filmes novos)
- [ ] Compressão gzip do JSON
- [ ] CDN para distribuição
- [ ] Webhook para rebuild on-demand
- [ ] Dashboard de estatísticas
