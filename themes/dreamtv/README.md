# 🎬 DreamTV Theme - WebTV Player

Tema completo estilo Netflix com todas as funcionalidades do DreamTV original.

## ✨ Funcionalidades Incluídas

### 🎨 Visual/Design
- ✅ Background com estrelas animadas
- ✅ Sidebar fixa lateral estilo Netflix
- ✅ Cores gradiente roxo/rosa/azul
- ✅ Cards com efeito hover Netflix
- ✅ Efeito frost/blur em janelas
- ✅ Scrollbar customizada

### 🎬 Player
- ✅ Player HLS.js para streams M3U8
- ✅ Modo Picture-in-Picture
- ✅ Controle remoto via teclado

### 📺 Conteúdo
- ✅ Integração com TMDB (posters, sinopses)
- ✅ Busca automática de trailers
- ✅ Coleções de filmes
- ✅ EPG (Guia de programação)
- ✅ Badges de qualidade (HD, FHD, 4K)
- ✅ Badge "L" para legendado

### 🔍 Navegação
- ✅ Busca global
- ✅ Filtros por categoria
- ✅ Lazy loading de imagens
- ✅ Scroll horizontal de cards

### ⚙️ Técnicas
- ✅ Cache de dados (localStorage)
- ✅ Sistema de favoritos
- ✅ Continuar assistindo
- ✅ Login com múltiplos usuários

## 🚀 Configuração

### 1. Copiar Tema para Produção

O tema já está em: `C:\xampp\htdocs\webplayer_dev\themes\dreamtv\`

Para subir para produção, use:
```batch
upload_tema_dreamtv.bat
```

### 2. Configurar TMDB (Opcional mas Recomendado)

Para habilitar posters, sinopses e trailers:

1. Crie uma conta em: https://www.themoviedb.org/
2. Acesse: https://www.themoviedb.org/settings/api
3. Copie sua **API Key**
4. Edite: `themes/dreamtv/config.php`
5. Substitua:
   ```php
   define('TMDB_API_KEY', 'SUA_CHAVE_AQUI');
   ```

### 3. Configurar Servidor

Edite `config.php` e ajuste:

```php
define('WEBPLAYER_API_URL', 'http://play.fivetv5.com/player_api.php');
```

Troque pela URL da sua API se necessário.

## 📁 Estrutura de Arquivos

```
dreamtv/
├── index.php          ← Tema principal (React SPA)
├── api.php           ← Bridge PHP para backend
├── config.php        ← Configurações
├── cache/            ← Cache de dados (criado automaticamente)
├── css/              ← Estilos extras
├── js/               ← Scripts extras
├── images/           ← Imagens do tema
└── README.md         ← Esta documentação
```

## 🌐 URLs

### Local (desenvolvimento)
```
http://localhost/webplayer_dev/themes/dreamtv/
```

### Produção (após upload)
```
http://play.fivetv5.com/themes/dreamtv/
```

## 🎯 Como Usar

### Login

1. Acesse o tema
2. Digite:
   - **Servidor**: URL do servidor (ex: http://infcsfortal.pro)
   - **Usuário**: seu username
   - **Senha**: sua senha
3. Clique em **ENTRAR**

### Navegação

**Sidebar (esquerda):**
- 🏠 **Home** - Página inicial
- 🎬 **Filmes** - Catálogo de filmes
- 📺 **Séries** - Catálogo de séries
- 📡 **TV** - Canais ao vivo
- 📻 **Rádio** - Rádios
- ⚙️ **Config** - Configurações

**Atalhos de Teclado:**
- **Setas** - Navegar
- **Enter** - Selecionar
- **Backspace** - Voltar
- **Espaço** - Play/Pause
- **F** - Fullscreen
- **P** - Picture-in-Picture

## 🎨 Customização

### Alterar Cores

Edite `index.php` e procure por:
```css
.gradient-text {
  background: linear-gradient(90deg, #a855f7, #ec4899, #3b82f6);
}
```

Troque as cores:
- `#a855f7` - Roxo
- `#ec4899` - Rosa
- `#3b82f6` - Azul

### Alterar Logo

1. Coloque sua logo em: `images/logo.png`
2. Edite `index.php` e procure por `<img src=` no header

### Desativar Estrelas Animadas

Edite `index.php` e procure por:
```css
.star-bg::before {
  display: none; /* Adicione esta linha */
}
```

## 🐛 Troubleshooting

### Tema não carrega / Tela branca

1. Verifique se Apache e PHP estão rodando
2. Abra Console do navegador (F12)
3. Veja erros de JavaScript
4. Verifique permissões da pasta `cache/`

### Imagens/Posters não aparecem

1. Verifique se configurou TMDB_API_KEY em `config.php`
2. Teste a API TMDB manualmente:
   ```
   https://api.themoviedb.org/3/search/movie?api_key=SUA_CHAVE&query=matrix
   ```

### Streams não reproduzem

1. Verifique se HLS.js está carregando (F12 > Network)
2. Teste o stream em: https://hls-js.netlify.app/demo/
3. Verifique CORS do servidor de streams

### Cache ocupando muito espaço

1. Edite `config.php`:
   ```php
   define('CACHE_TIME', 600); // 10 minutos ao invés de 1 hora
   ```
2. Ou limpe manualmente: `rm -rf cache/*`

## 📝 Notas

- **React SPA**: Este tema é uma Single Page Application React
- **Compatibilidade**: Chrome, Firefox, Edge, Safari (modernos)
- **Mobile**: Totalmente responsivo
- **Performance**: Cache agressivo para melhor desempenho

## 🔄 Atualizações

Para atualizar o tema:

1. Faça backup do `config.php`
2. Baixe nova versão
3. Sobrescreva arquivos
4. Restaure `config.php` com suas configurações

## 📞 Suporte

Problemas? Verifique:
1. Logs do Apache: `C:\xampp\apache\logs\error.log`
2. Console do navegador (F12)
3. Arquivo `api.php` retornando JSON válido

## ⚖️ Licença

Tema baseado em DreamTV Streaming (http://72.60.251.112:3000/)
Adaptado para WebTV Player PHP

---

**Desenvolvido para:** WebTV Player
**Versão:** 1.0
**Data:** 2025-10-20
