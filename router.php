<?php
// Router para simular o .htaccess no servidor embutido do PHP
// Use: php -S localhost:8000 router.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Se for um arquivo real (CSS, JS, imagens), servir diretamente
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Caso contrário, redirecionar para public/index.php
$_SERVER['SCRIPT_NAME'] = '/public/index.php';
require __DIR__ . '/public/index.php';
