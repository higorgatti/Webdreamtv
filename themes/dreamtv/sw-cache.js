// Service Worker para cache de imagens do TMDB
// Cache de imagens no navegador do usuário (persistente)

const CACHE_VERSION = 'dreamtv-cache-v1'
const CACHE_NAMES = {
  images: 'dreamtv-tmdb-images-v1',
  api: 'dreamtv-tmdb-api-v1'
}

const CACHE_EXPIRATION = {
  images: 30 * 24 * 60 * 60 * 1000, // 30 dias em milissegundos
  api: 7 * 24 * 60 * 60 * 1000       // 7 dias para dados da API
}

// Instalar Service Worker
self.addEventListener('install', event => {
  console.log('[SW] 📦 Service Worker instalado - versão:', CACHE_VERSION)
  self.skipWaiting() // Ativar imediatamente
})

// Ativar Service Worker
self.addEventListener('activate', event => {
  console.log('[SW] ✅ Service Worker ativado')

  // Limpar caches antigos
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames
          .filter(name => {
            // Remover caches que não são da versão atual
            return name.startsWith('dreamtv-') && !Object.values(CACHE_NAMES).includes(name)
          })
          .map(name => {
            console.log('[SW] 🗑️ Removendo cache antigo:', name)
            return caches.delete(name)
          })
      )
    })
  )

  return self.clients.claim()
})

// Verificar se o cache expirou
function isCacheExpired(cachedResponse, maxAge) {
  if (!cachedResponse) return true

  const cachedDate = cachedResponse.headers.get('sw-cached-date')
  if (!cachedDate) return true

  const cacheAge = Date.now() - parseInt(cachedDate)
  return cacheAge > maxAge
}

// Adicionar timestamp ao cache
function addCacheTimestamp(response) {
  const headers = new Headers(response.headers)
  headers.set('sw-cached-date', Date.now().toString())

  return new Response(response.body, {
    status: response.status,
    statusText: response.statusText,
    headers: headers
  })
}

// Interceptar requisições
self.addEventListener('fetch', event => {
  const url = new URL(event.request.url)

  // ===== CACHE DE IMAGENS DO TMDB =====
  if (url.hostname === 'image.tmdb.org') {
    event.respondWith(
      caches.open(CACHE_NAMES.images).then(cache => {
        return cache.match(event.request).then(cachedResponse => {

          // Verificar se cache expirou
          if (cachedResponse && !isCacheExpired(cachedResponse, CACHE_EXPIRATION.images)) {
            console.log('[SW] 🖼️ Imagem do cache:', url.pathname.substring(0, 50))
            return cachedResponse
          }

          // Cache expirado ou não existe - buscar do TMDB
          console.log('[SW] 🌐 Baixando imagem do TMDB:', url.pathname.substring(0, 50))

          return fetch(event.request).then(response => {
            // Só cachear respostas válidas
            if (response && response.status === 200) {
              const responseToCache = addCacheTimestamp(response.clone())
              cache.put(event.request, responseToCache)
            }
            return response
          }).catch(error => {
            // Se falhar e tiver cache (mesmo expirado), usar ele
            if (cachedResponse) {
              console.log('[SW] ⚠️ Erro ao buscar, usando cache expirado:', error)
              return cachedResponse
            }
            throw error
          })
        })
      })
    )
    return
  }

  // ===== CACHE DE API TMDB (JSON) =====
  if (url.hostname === 'api.themoviedb.org') {
    event.respondWith(
      caches.open(CACHE_NAMES.api).then(cache => {
        return cache.match(event.request).then(cachedResponse => {

          // Verificar se cache expirou
          if (cachedResponse && !isCacheExpired(cachedResponse, CACHE_EXPIRATION.api)) {
            console.log('[SW] 📊 API TMDB do cache:', url.pathname.substring(0, 50))
            return cachedResponse
          }

          // Cache expirado ou não existe - buscar da API
          console.log('[SW] 🌐 Buscando da API TMDB:', url.pathname.substring(0, 50))

          return fetch(event.request).then(response => {
            // Só cachear respostas válidas
            if (response && response.status === 200) {
              const responseToCache = addCacheTimestamp(response.clone())
              cache.put(event.request, responseToCache)
            }
            return response
          }).catch(error => {
            // Se falhar e tiver cache (mesmo expirado), usar ele
            if (cachedResponse) {
              console.log('[SW] ⚠️ Erro ao buscar API, usando cache expirado:', error)
              return cachedResponse
            }
            throw error
          })
        })
      })
    )
    return
  }

  // ===== OUTRAS REQUISIÇÕES: não cachear =====
  event.respondWith(fetch(event.request))
})

// Mensagens do cliente
self.addEventListener('message', event => {
  if (event.data.action === 'skipWaiting') {
    self.skipWaiting()
  }

  if (event.data.action === 'clearCache') {
    console.log('[SW] 🧹 Limpando todos os caches...')
    event.waitUntil(
      caches.keys().then(cacheNames => {
        return Promise.all(
          cacheNames.map(name => caches.delete(name))
        )
      }).then(() => {
        event.ports[0].postMessage({ success: true })
      })
    )
  }

  if (event.data.action === 'getCacheStats') {
    event.waitUntil(
      Promise.all([
        caches.open(CACHE_NAMES.images).then(cache => cache.keys()),
        caches.open(CACHE_NAMES.api).then(cache => cache.keys())
      ]).then(([imageKeys, apiKeys]) => {
        event.ports[0].postMessage({
          images: imageKeys.length,
          api: apiKeys.length,
          total: imageKeys.length + apiKeys.length
        })
      })
    )
  }
})
