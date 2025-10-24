<?php
/**
 * DreamTV Theme Configuration
 *
 * Arquivo de configuração para conectar o tema DreamTV
 * com o backend PHP do webplayer
 */

// Configurações da API do webplayer
define('WEBPLAYER_API_URL', 'http://cdn4k.cloud:80/player_api.php');

// Configurações TMDB (The Movie Database)
// Obtenha sua chave em: https://www.themoviedb.org/settings/api
define('TMDB_API_KEY', '7e61dfdf698b31e14082e80a0ca9f9fa');
define('TMDB_BASE_URL', 'https://api.themoviedb.org/3');

// Configurações de Cache
define('CACHE_ENABLED', true);
define('CACHE_DIR', __DIR__ . '/cache');
define('CACHE_TIME', 3600); // 1 hora

// Criar diretório de cache se não existir
if (CACHE_ENABLED && !file_exists(CACHE_DIR)) {
    mkdir(CACHE_DIR, 0755, true);
}

// Headers CORS para permitir requisições do frontend
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Função helper para cache
function getFromCache($key) {
    if (!CACHE_ENABLED) return null;

    $file = CACHE_DIR . '/' . md5($key) . '.cache';
    if (file_exists($file) && (time() - filemtime($file)) < CACHE_TIME) {
        return unserialize(file_get_contents($file));
    }
    return null;
}

function saveToCache($key, $data) {
    if (!CACHE_ENABLED) return;

    $file = CACHE_DIR . '/' . md5($key) . '.cache';
    file_put_contents($file, serialize($data));
}

// Função para fazer requisições à API do webplayer
function callWebplayerAPI($action, $params = []) {
    $url = WEBPLAYER_API_URL . '?' . http_build_query(array_merge(['action' => $action], $params));

    $cached = getFromCache($url);
    if ($cached !== null) {
        return $cached;
    }

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    saveToCache($url, $data);
    return $data;
}

// Função para requisições TMDB
function callTMDB($endpoint, $params = []) {
    if (TMDB_API_KEY === 'YOUR_TMDB_API_KEY_HERE') {
        return null; // TMDB não configurado
    }

    $params['api_key'] = TMDB_API_KEY;
    $params['language'] = 'pt-BR';

    $url = TMDB_BASE_URL . $endpoint . '?' . http_build_query($params);

    $cached = getFromCache($url);
    if ($cached !== null) {
        return $cached;
    }

    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);
    saveToCache($url, $data);

    return $data;
}
?>
