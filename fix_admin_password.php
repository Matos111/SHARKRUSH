<?php
/**
 * Script para resetar a senha do admin para texto puro
 * Execute via navegador: http://localhost:8000/fix_admin_password.php
 * OU via CLI: php fix_admin_password.php
 */

require_once __DIR__ . '/config/database.php';

// Senha em texto puro (sem hash)
$senha_texto_puro = 'admin123';

echo "=== RESETAR SENHA DO ADMIN ===\n\n";
echo "Email: admin@sharkrush.com\n";
echo "Nova senha: admin123 (texto puro)\n\n";

try {
    $database = new Database();
    $conn = $database->getConnection();

    // Atualizar senha do admin para texto puro
    $query = "UPDATE clientes SET senha = :senha WHERE email = 'admin@sharkrush.com'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':senha', $senha_texto_puro);

    if ($stmt->execute()) {
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            echo "✓ Senha atualizada com sucesso!\n";
            echo "Linhas afetadas: $rowCount\n\n";
            echo "Agora voce pode fazer login com:\n";
            echo "Email: admin@sharkrush.com\n";
            echo "Senha: admin123\n";
        } else {
            echo "✗ Nenhum usuario encontrado com email admin@sharkrush.com\n";
            echo "Verifique se o usuario existe no banco de dados.\n";
        }
    } else {
        echo "✗ Erro ao executar query\n";
    }

} catch (Exception $e) {
    echo "✗ ERRO: " . $e->getMessage() . "\n";
}

echo "\n=== FIM ===\n";
