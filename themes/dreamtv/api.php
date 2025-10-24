<?php
/**
 * DreamTV API Bridge
 *
 * Ponte entre o frontend React e o backend PHP do webplayer
 */

require_once 'config.php';

header('Content-Type: application/json');

// Pegar ação da requisição
$action = $_GET['action'] ?? $_POST['action'] ?? '';

// Resposta padrão
$response = [
    'success' => false,
    'data' => null,
    'error' => null
];

try {
    switch ($action) {

        // ===== AUTENTICAÇÃO =====
        case 'login':
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $server = $_POST['server'] ?? '';

            // Validar credenciais via API do webplayer
            $result = callWebplayerAPI('get_account_info', [
                'username' => $username,
                'password' => $password
            ]);

            if ($result && isset($result['user_info'])) {
                $response['success'] = true;
                $response['data'] = [
                    'user_info' => $result['user_info'],
                    'server_info' => $result['server_info']
                ];
            } else {
                $response['error'] = 'Credenciais inválidas';
            }
            break;

        // ===== CANAIS AO VIVO =====
        case 'get_live_streams':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $category_id = $_GET['category_id'] ?? '';

            $params = [
                'username' => $username,
                'password' => $password
            ];

            if ($category_id !== '') {
                $params['category_id'] = $category_id;
            }

            $result = callWebplayerAPI('get_live_streams', $params);

            echo json_encode($result ?? []);
            exit;

        // ===== CATEGORIAS DE CANAIS =====
        case 'get_live_categories':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';

            $result = callWebplayerAPI('get_live_categories', [
                'username' => $username,
                'password' => $password
            ]);

            // Retornar dados diretamente (não como objeto {success, data})
            echo json_encode($result ?? []);
            exit;

        // ===== FILMES =====
        case 'get_vod_streams':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $category_id = $_GET['category_id'] ?? '';

            $params = [
                'username' => $username,
                'password' => $password
            ];

            if ($category_id !== '') {
                $params['category_id'] = $category_id;
            }

            $result = callWebplayerAPI('get_vod_streams', $params);

            echo json_encode($result ?? []);
            exit;

        // ===== CATEGORIAS DE FILMES =====
        case 'get_vod_categories':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';

            $result = callWebplayerAPI('get_vod_categories', [
                'username' => $username,
                'password' => $password
            ]);

            echo json_encode($result ?? []);
            exit;

        // ===== CATEGORIAS DE SÉRIES =====
        case 'get_series_categories':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';

            $result = callWebplayerAPI('get_series_categories', [
                'username' => $username,
                'password' => $password
            ]);

            echo json_encode($result ?? []);
            exit;

        // ===== SÉRIES =====
        case 'get_series':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $category_id = $_GET['category_id'] ?? '';

            $params = [
                'username' => $username,
                'password' => $password
            ];

            // Adicionar category_id se fornecido
            if ($category_id !== '') {
                $params['category_id'] = $category_id;
            }

            $result = callWebplayerAPI('get_series', $params);

            echo json_encode($result ?? []);
            exit;

        // ===== INFO DE SÉRIE =====
        case 'get_series_info':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $series_id = $_GET['series_id'] ?? '';

            $result = callWebplayerAPI('get_series_info', [
                'username' => $username,
                'password' => $password,
                'series_id' => $series_id
            ]);

            echo json_encode($result ?? []);
            exit;

        // ===== EPG (Guia de Programação) =====
        case 'get_epg':
        case 'get_simple_data_table':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $stream_id = $_GET['stream_id'] ?? '';

            $result = callWebplayerAPI('get_simple_data_table', [
                'username' => $username,
                'password' => $password,
                'stream_id' => $stream_id
            ]);

            echo json_encode($result ?? []);
            exit;

        // ===== EPG Curto (mais rápido) =====
        case 'get_short_epg':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $stream_id = $_GET['stream_id'] ?? '';
            $limit = $_GET['limit'] ?? 100;

            $result = callWebplayerAPI('get_short_epg', [
                'username' => $username,
                'password' => $password,
                'stream_id' => $stream_id,
                'limit' => $limit
            ]);

            echo json_encode($result ?? []);
            exit;

        // ===== TMDB - BUSCAR FILME/SÉRIE =====
        case 'tmdb_search':
            $query = $_GET['query'] ?? '';
            $type = $_GET['type'] ?? 'movie'; // movie ou tv

            $endpoint = $type === 'tv' ? '/search/tv' : '/search/movie';
            $result = callTMDB($endpoint, ['query' => $query]);

            echo json_encode($result ?? []);
            exit;

        // ===== TMDB - DETALHES =====
        case 'tmdb_details':
            $tmdb_id = $_GET['tmdb_id'] ?? '';
            $type = $_GET['type'] ?? 'movie';

            $endpoint = $type === 'tv' ? "/tv/$tmdb_id" : "/movie/$tmdb_id";
            $result = callTMDB($endpoint);

            echo json_encode($result ?? []);
            exit;

        // ===== TMDB - TRAILER =====
        case 'tmdb_trailer':
            $tmdb_id = $_GET['tmdb_id'] ?? '';
            $type = $_GET['type'] ?? 'movie';

            $endpoint = $type === 'tv' ? "/tv/$tmdb_id/videos" : "/movie/$tmdb_id/videos";
            $result = callTMDB($endpoint);

            echo json_encode($result ?? []);
            exit;

        // ===== CACHE OPTIMIZATION - ÚLTIMOS IDS =====
        case 'get_latest_ids':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $type = $_GET['type'] ?? 'vod'; // vod, series, live
            $limit = (int)($_GET['limit'] ?? 100);

            $params = [
                'username' => $username,
                'password' => $password
            ];

            // Buscar todos os streams do tipo solicitado
            switch ($type) {
                case 'vod':
                    $data = callWebplayerAPI('get_vod_streams', $params);
                    $idField = 'stream_id';
                    break;
                case 'series':
                    $data = callWebplayerAPI('get_series', $params);
                    $idField = 'series_id';
                    break;
                case 'live':
                    $data = callWebplayerAPI('get_live_streams', $params);
                    $idField = 'stream_id';
                    break;
                default:
                    echo json_encode([]);
                    exit;
            }

            // Extrair apenas os IDs (mais leve)
            $ids = [];
            if ($data && is_array($data)) {
                foreach ($data as $item) {
                    if (isset($item[$idField])) {
                        $ids[] = $item[$idField];
                    }
                }
            }

            // Retornar os últimos IDs (ordenados DESC, assumindo que IDs maiores = mais recentes)
            rsort($ids);
            $latestIds = array_slice($ids, 0, $limit);

            echo json_encode($latestIds);
            exit;

        // ===== CACHE OPTIMIZATION - BUSCAR POR IDS =====
        case 'get_movies_by_ids':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';
            $ids = $_GET['ids'] ?? '';

            if (empty($ids)) {
                echo json_encode([]);
                exit;
            }

            $idsArray = explode(',', $ids);

            // Buscar todos os filmes
            $allMovies = callWebplayerAPI('get_vod_streams', [
                'username' => $username,
                'password' => $password
            ]);

            // Filtrar apenas os IDs solicitados
            $filteredMovies = [];
            if ($allMovies && is_array($allMovies)) {
                foreach ($allMovies as $movie) {
                    if (in_array($movie['stream_id'], $idsArray)) {
                        $filteredMovies[] = $movie;
                    }
                }
            }

            echo json_encode($filteredMovies);
            exit;

        // ===== CACHE OPTIMIZATION - ESTATÍSTICAS =====
        case 'get_catalog_stats':
            $username = $_GET['username'] ?? '';
            $password = $_GET['password'] ?? '';

            $params = [
                'username' => $username,
                'password' => $password
            ];

            // Buscar contagens rápidas
            $stats = [
                'movies_count' => 0,
                'series_count' => 0,
                'live_count' => 0,
                'timestamp' => time()
            ];

            $movies = callWebplayerAPI('get_vod_streams', $params);
            $stats['movies_count'] = is_array($movies) ? count($movies) : 0;

            $series = callWebplayerAPI('get_series', $params);
            $stats['series_count'] = is_array($series) ? count($series) : 0;

            $live = callWebplayerAPI('get_live_streams', $params);
            $stats['live_count'] = is_array($live) ? count($live) : 0;

            echo json_encode($stats);
            exit;

        default:
            $response['error'] = 'Ação inválida';
            break;
    }

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>
