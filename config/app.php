<?php

/**
 * Configuracao da aplicacao
 * Detecta automaticamente o base path para funcionar em diferentes ambientes
 * (servidor PHP embutido, XAMPP, WAMP, etc)
 */

// Detecta automaticamente o base path da aplicacao
function detectBasePath() {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

    // Remove o nome do arquivo (index.php)
    $scriptDir = dirname($scriptName);

    // Se termina com /public, remove
    if (substr($scriptDir, -7) === '/public') {
        $basePath = substr($scriptDir, 0, -7);
    } else {
        $basePath = $scriptDir;
    }

    // Se estiver na raiz, retorna vazio
    if ($basePath === '/' || $basePath === '\\' || $basePath === '.') {
        return '';
    }

    // Garante que comeca com / e nao termina com /
    $basePath = '/' . trim($basePath, '/');

    return $basePath;
}

// Define a constante BASE_PATH se ainda nao foi definida
if (!defined('BASE_PATH')) {
    define('BASE_PATH', detectBasePath());
}

/**
 * Funcao helper para gerar URLs com o base path correto
 *
 * @param string $path Caminho relativo (ex: '/dashboard', '/login')
 * @return string URL completa com base path
 *
 * Exemplos:
 *   url('/dashboard')     -> '/SHARKRUSH/dashboard' (XAMPP)
 *   url('/dashboard')     -> '/dashboard' (servidor embutido)
 *   url('/')              -> '/SHARKRUSH/' ou '/'
 */
function url($path = '/') {
    // Se o path ja comeca com http, retorna como esta
    if (strpos($path, 'http') === 0) {
        return $path;
    }

    // Garante que o path comeca com /
    if (strpos($path, '/') !== 0) {
        $path = '/' . $path;
    }

    // Concatena base path com o path
    $fullPath = BASE_PATH . $path;

    // Evita barra dupla
    $fullPath = str_replace('//', '/', $fullPath);

    // Se ficou vazio, retorna /
    if (empty($fullPath)) {
        return '/';
    }

    return $fullPath;
}

/**
 * Funcao helper para redirect com URL correta
 *
 * @param string $path Caminho relativo
 * @param array $params Parametros de query string (opcional)
 */
function redirect($path, $params = []) {
    $url = url($path);

    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    header("Location: " . $url);
    exit();
}

/**
 * Extrai o path da requisicao removendo o base path
 *
 * @return string Path limpo para roteamento
 */
function getRequestPath() {
    $request = $_SERVER["REQUEST_URI"] ?? '/';

    // Remove query string
    if (strpos($request, "?") !== false) {
        $request = strstr($request, "?", true);
    }

    // Remove o base path (case-insensitive)
    if (BASE_PATH !== '') {
        $pattern = '/^' . preg_quote(BASE_PATH, '/') . '/i';
        $request = preg_replace($pattern, '', $request);
    }

    // Remove /index.php do inicio (para acesso direto sem mod_rewrite)
    if (strpos($request, '/index.php') === 0) {
        $request = substr($request, 10); // Remove '/index.php'
    }

    // Garante que comeca com /
    if (empty($request) || $request[0] !== '/') {
        $request = '/' . $request;
    }

    // Remove trailing slash (exceto se for apenas /)
    if (strlen($request) > 1) {
        $request = rtrim($request, '/');
    }

    return $request;
}
