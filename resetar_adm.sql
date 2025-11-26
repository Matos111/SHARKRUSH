-- Script para resetar senha do administrador
USE sharkrush;

-- Resetar senha do administrador para: admin123
-- Hash gerado com password_hash() em PHP usando bcrypt
UPDATE clientes
SET senha = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
WHERE email = 'admin@sharkrush.com' AND is_admin = 1;

-- Verificar se a senha foi atualizada
SELECT id, nome_completo, email, is_admin,
       CASE WHEN senha = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            THEN 'Senha resetada com sucesso'
            ELSE 'Falha ao resetar senha'
       END AS status
FROM clientes
WHERE email = 'admin@sharkrush.com' AND is_admin = 1;
