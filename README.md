# DreamTV - IPTV Player

Sistema de streaming IPTV com interface estilo Netflix, suporte a filmes, séries, canais ao vivo, EPG e muito mais.

## 📦 Estrutura do Projeto

```
Webdreamtv/
├── themes/
│   └── dreamtv/           # Tema principal do DreamTV
│       ├── index.php      # Aplicação React principal
│       ├── api.php        # Bridge PHP para Xtream Codes API
│       ├── config.php     # Configurações do servidor
│       ├── jquery/        # Scripts auxiliares
│       │   ├── db-manager.js      # Gerenciador IndexedDB
│       │   └── sync-manager.js    # Sincronização automática
│       └── test-cache.html # Interface de teste do cache
├── upload_vps.ps1         # Script de deploy para VPS
└── README.md              # Esta documentação
```

## 🚀 Últimas Atualizações

### v2025.01.24 - Correções e Melhorias

#### ✅ Correções Implementadas:
1. **Removida animação Netflix "N"**
   - Substituída por spinner roxo limpo (#a855f7)
   - Reduzido tamanho de 200px para 60px

2. **Substituídos Lucide Icons por Emoji**
   - Removida dependência da biblioteca Lucide
   - Ícones agora usam emoji nativos (🏠 📺 🎬 🎭 etc.)
   - Zero erros no console
   - Carregamento mais rápido

3. **EPG Funcionando**
   - Adicionados endpoints `get_short_epg` e `get_simple_data_table` no api.php
   - Guia de programação exibindo corretamente

4. **Sistema de Cache IndexedDB**
   - db-manager.js: Gerenciamento de cache local
   - sync-manager.js: Sincronização automática a cada 30 minutos
   - Armazenamento de 26,670+ itens (filmes, séries, canais)
   - Detecção automática de novos conteúdos

## 🛠️ Tecnologias

- **Frontend**: React 18 (via UMD)
- **Styling**: Tailwind CSS
- **Video Player**: HLS.js
- **Backend**: PHP 7.4+
- **Cache**: IndexedDB
- **API**: Xtream Codes compatible

## 📋 Pré-requisitos

- PHP 7.4 ou superior
- Servidor web (Apache/Nginx)
- Xtream Codes API ou servidor compatível

## 🔧 Instalação

### Desenvolvimento Local (XAMPP)

1. Clone o repositório:
```bash
git clone https://github.com/[seu-usuario]/Webdreamtv.git
cd Webdreamtv
```

2. Copie para a pasta do XAMPP:
```bash
cp -r themes/dreamtv C:/xampp/htdocs/webplayer_dev/themes/
```

3. Configure o `config.php`:
```php
define('WEBPLAYER_API_URL', 'http://cdn4k.cloud:80/player_api.php');
define('TMDB_API_KEY', 'sua-chave-tmdb');
```

4. Acesse: `http://localhost/webplayer_dev/themes/dreamtv/`

### Deploy para VPS

Use o script PowerShell automatizado:

```powershell
.\upload_vps.ps1
```

Ou manualmente via SSH:

```bash
git clone https://github.com/[seu-usuario]/Webdreamtv.git /var/www/html/dreamtv
cd /var/www/html/dreamtv
chmod -R 755 themes/
```

## 📝 Workflow Git → VPS

1. **Desenvolvimento Local**: Teste todas as funcionalidades
2. **Commit para Git**: Versione as mudanças
3. **Push para GitHub**: Centralize o código
4. **Deploy na VPS**: Pull do GitHub

```bash
# Local
git add themes/dreamtv
git commit -m "feat: descrição da mudança"
git push origin main

# VPS
ssh root@209.14.84.36
cd /var/www/html/dreamtv
git pull origin main
```

## 🎨 Funcionalidades

- ✅ Interface estilo Netflix
- ✅ Filmes com metadados TMDB
- ✅ Séries com episódios
- ✅ Canais ao vivo
- ✅ EPG (Guia de Programação)
- ✅ Sistema de coleções
- ✅ Cache IndexedDB
- ✅ Sincronização automática
- ✅ Busca inteligente
- ✅ Controle remoto (teclado)
- ✅ Fullscreen
- ✅ Emoji icons (sem dependências)

## 🧪 Testes

### Testar Cache IndexedDB

Acesse: `http://localhost/webplayer_dev/themes/dreamtv/test-cache.html`

1. Configure credenciais
2. Clique em "Sincronizar Agora"
3. Aguarde sincronização completa
4. Teste busca e filtros

## 📊 Performance

- **Primeira carga**: ~6.9s (sincronização completa)
- **Cargas subsequentes**: <1s (usando cache)
- **Items em cache**: 26,670+
- **Auto-sync**: A cada 30 minutos

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'feat: Minha nova feature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto é privado.

## 👤 Autor

Desenvolvido para DreamTV

## 🔗 Links Úteis

- VPS: http://play.fivetv5.com
- API: http://cdn4k.cloud
- TMDB: https://www.themoviedb.org