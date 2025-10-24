<?php
require_once __DIR__ . '/config.php';

echo "=== TESTE DE CONEXÃO API ===\n\n";
echo "URL: " . WEBPLAYER_API_URL . "\n\n";

$url = WEBPLAYER_API_URL . '?' . http_build_query([
    'action' => 'get_vod_streams',
    'username' => 'testetv22',
    'password' => 'Heloisa1202eqdeq'
]);

echo "[1] Buscando filmes da API...\n";
$json = @file_get_contents($url);

if ($json === false) {
    die("❌ ERRO: Não foi possível conectar\n");
}

$movies = json_decode($json, true);
if (!is_array($movies)) {
    die("❌ ERRO: Resposta inválida\n");
}

echo "✅ Total de filmes: " . count($movies) . "\n\n";

echo "[2] Primeiros 5 filmes:\n";
foreach (array_slice($movies, 0, 5) as $i => $movie) {
    echo "  " . ($i + 1) . ". " . $movie['name'] . " (ID: " . $movie['stream_id'] . ")\n";
}

echo "\n[3] Testando TMDB API Key...\n";
if (TMDB_API_KEY === 'YOUR_TMDB_API_KEY_HERE' || TMDB_API_KEY === '') {
    die("❌ ERRO: TMDB_API_KEY não configurada\n");
}

echo "✅ TMDB_API_KEY configurada\n";

echo "\n[4] Testando busca TMDB...\n";
$testMovie = $movies[0]['name'];
echo "Buscando: $testMovie\n";

// Limpar nome
$cleanName = preg_replace('/\s*[-–]\s*\d{4}.*$/u', '', $testMovie);
$cleanName = preg_replace('/\s*\((DUAL|LEGENDADO|DUBLADO|4K|HD|720p|1080p).*\)$/i', '', $cleanName);
$cleanName = trim($cleanName);
echo "Nome limpo: $cleanName\n";

$searchUrl = TMDB_BASE_URL . '/search/movie?' . http_build_query([
    'api_key' => TMDB_API_KEY,
    'language' => 'pt-BR',
    'query' => $cleanName
]);

$searchJson = @file_get_contents($searchUrl);
if ($searchJson === false) {
    die("❌ ERRO: Não foi possível conectar ao TMDB\n");
}

$searchData = json_decode($searchJson, true);
$results = $searchData['results'] ?? [];

if (empty($results)) {
    echo "⚠️ Nenhum resultado encontrado\n";
} else {
    echo "✅ Encontrados " . count($results) . " resultados\n";
    echo "Primeiro resultado: " . $results[0]['title'] . " (" . ($results[0]['release_date'] ?? 'N/A') . ")\n";
}

echo "\n✅ TODOS OS TESTES PASSARAM!\n";
echo "Agora pode rodar build-collections.php\n";
?>
