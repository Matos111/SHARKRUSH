<?php
/**
 * Front controller alternativo para ambientes sem mod_rewrite
 * Redireciona todas as requisicoes para public/index.php
 */

// Inclui o front controller principal
require_once __DIR__ . '/public/index.php';
