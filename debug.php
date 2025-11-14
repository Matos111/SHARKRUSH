<?php
// Debug para verificar as rotas
$request = $_SERVER['REQUEST_URI'];

echo "REQUEST_URI original: " . $request . "\n";

// Remove query string, se existir
if (strpos($request, '?') !== false) {
    $request = strstr($request, '?', true);
}

echo "Após remover query string: " . $request . "\n";

// Remove o prefixo /sharkrush da URL
$request = str_replace('/sharkrush', '', $request);

echo "Após remover /sharkrush: " . $request . "\n";
