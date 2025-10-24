<?php
/**
 * Versão RÁPIDA para teste - processa apenas 500 primeiros filmes
 */

require_once __DIR__ . '/config.php';

echo "===========================================\n";
echo "  CONSTRUTOR RÁPIDO DE COLEÇÕES\n";
echo "  (Processando apenas 500 filmes)\n";
echo "===========================================\n\n";

$startTime = microtime(true);

$username = 'testetv22';
$password = 'Heloisa1202eqdeq';
$outputFile = __DIR__ . '/collections.json';
$LIMIT = 500; // LIMITE PARA TESTE RÁPIDO

if (TMDB_API_KEY === 'YOUR_TMDB_API_KEY_HERE' || TMDB_API_KEY === '') {
    die("❌ ERRO: Configure TMDB_API_KEY em config.php\n");
}

echo "[1/6] 📥 Buscando filmes da API...\n";

$url = WEBPLAYER_API_URL . '?' . http_build_query([
    'action' => 'get_vod_streams',
    'username' => $username,
    'password' => $password
]);

$moviesJson = @file_get_contents($url);
if ($moviesJson === false) {
    die("❌ ERRO: Não foi possível conectar à API: $url\n");
}

$allMovies = json_decode($moviesJson, true);
if (!is_array($allMovies)) {
    die("❌ ERRO: Resposta inválida da API\n");
}

// LIMITAR PARA TESTE
$allMovies = array_slice($allMovies, 0, $LIMIT);

echo "✅ " . count($allMovies) . " filmes para processar (limite de teste)\n\n";

echo "[2/6] 🔍 Enriquecendo com TMDB...\n";

$collectionsMap = [];
$processed = 0;
$foundCollections = 0;
$errors = 0;

foreach ($allMovies as $movie) {
    $processed++;

    // Progress a cada 25 filmes
    if ($processed % 25 == 0) {
        $percent = round(($processed / count($allMovies)) * 100);
        echo "  Progresso: $processed/" . count($allMovies) . " ($percent%) | Coleções: $foundCollections | Erros: $errors\n";
        flush();
        ob_flush();
    }

    $movieName = $movie['name'] ?? '';
    if (empty($movieName)) continue;

    // Limpar nome
    $cleanName = preg_replace('/\s*[-–]\s*\d{4}.*$/u', '', $movieName);
    $cleanName = preg_replace('/\s*\((DUAL|LEGENDADO|DUBLADO|4K|HD|720p|1080p).*\)$/i', '', $cleanName);
    $cleanName = trim($cleanName);

    if (strlen($cleanName) < 2) continue;

    try {
        // Buscar no TMDB
        $searchUrl = TMDB_BASE_URL . '/search/movie?' . http_build_query([
            'api_key' => TMDB_API_KEY,
            'language' => 'pt-BR',
            'query' => $cleanName
        ]);

        $searchJson = @file_get_contents($searchUrl);
        if ($searchJson === false) {
            $errors++;
            usleep(300000);
            continue;
        }

        $searchData = json_decode($searchJson, true);
        $results = $searchData['results'] ?? [];

        if (empty($results)) {
            usleep(300000);
            continue;
        }

        $tmdbMovie = $results[0];
        $tmdbId = $tmdbMovie['id'];

        // Buscar detalhes
        $detailsUrl = TMDB_BASE_URL . "/movie/$tmdbId?" . http_build_query([
            'api_key' => TMDB_API_KEY,
            'language' => 'pt-BR'
        ]);

        $detailsJson = @file_get_contents($detailsUrl);
        if ($detailsJson === false) {
            $errors++;
            usleep(300000);
            continue;
        }

        $details = json_decode($detailsJson, true);
        $collection = $details['belongs_to_collection'] ?? null;

        if ($collection && isset($collection['id'])) {
            $collectionId = $collection['id'];
            $foundCollections++;

            if (!isset($collectionsMap[$collectionId])) {
                $collectionsMap[$collectionId] = [
                    'id' => $collectionId,
                    'name' => $collection['name'],
                    'poster_path' => $collection['poster_path'],
                    'backdrop_path' => $collection['backdrop_path'],
                    'overview' => '',
                    'movies' => []
                ];
            }

            $collectionsMap[$collectionId]['movies'][] = [
                'stream_id' => $movie['stream_id'],
                'name' => $movie['name'],
                'tmdb_id' => $tmdbId,
                'category_id' => $movie['category_id'] ?? null,
                'container_extension' => $movie['container_extension'] ?? 'mp4'
            ];
        }

        usleep(300000); // 300ms delay

    } catch (Exception $e) {
        $errors++;
        continue;
    }
}

echo "\n✅ Processamento concluído\n\n";

echo "[3/6] 🎯 Filtrando coleções...\n";

$collections = array_filter($collectionsMap, function($col) {
    return count($col['movies']) >= 2;
});

usort($collections, function($a, $b) {
    return count($b['movies']) - count($a['movies']);
});

echo "✅ " . count($collections) . " coleções encontradas\n\n";

if (count($collections) === 0) {
    die("⚠️ Nenhuma coleção encontrada\n");
}

echo "[4/6] 🎨 Enriquecendo coleções...\n";

$enrichLimit = min(20, count($collections));
for ($i = 0; $i < $enrichLimit; $i++) {
    $collectionId = $collections[$i]['id'];

    $collectionUrl = TMDB_BASE_URL . "/collection/$collectionId?" . http_build_query([
        'api_key' => TMDB_API_KEY,
        'language' => 'pt-BR'
    ]);

    $collectionJson = @file_get_contents($collectionUrl);
    if ($collectionJson !== false) {
        $data = json_decode($collectionJson, true);
        $collections[$i]['overview'] = $data['overview'] ?? '';
    }

    usleep(300000);

    if (($i + 1) % 5 == 0) {
        echo "  Enriquecidas: " . ($i + 1) . "/$enrichLimit\n";
    }
}

echo "✅ Metadados enriquecidos\n\n";

echo "[5/6] 💾 Salvando JSON...\n";

$output = [
    'generated_at' => date('Y-m-d H:i:s'),
    'total_movies_analyzed' => count($allMovies),
    'total_collections' => count($collections),
    'collections' => array_values($collections)
];

$json = json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (file_put_contents($outputFile, $json) === false) {
    die("❌ ERRO: Não foi possível salvar o arquivo\n");
}

$fileSize = filesize($outputFile);
echo "✅ Arquivo salvo: " . round($fileSize / 1024, 2) . " KB\n\n";

echo "[6/6] 📊 Estatísticas:\n";
echo "  • Filmes analisados: " . count($allMovies) . "\n";
echo "  • Coleções encontradas: " . count($collections) . "\n";
echo "  • Erros: $errors\n";
echo "  • Top 10 coleções:\n";

foreach (array_slice($collections, 0, 10) as $i => $col) {
    echo "    " . ($i + 1) . ". " . $col['name'] . " (" . count($col['movies']) . " filmes)\n";
}

$duration = round(microtime(true) - $startTime, 2);
$minutes = floor($duration / 60);
$seconds = $duration % 60;
echo "\n⏱️ Tempo total: {$minutes}m {$seconds}s\n";
echo "✅ Concluído!\n";
?>
