-- ============================================================
-- SCRIPT PARA RESETAR SENHA DO ADMIN
-- ============================================================
-- Execute este script no MySQL para corrigir a senha do admin
-- mysql -u root sharkrush < reset_admin.sql
-- ============================================================

USE sharkrush;

-- Atualizar senha do admin para "admin123" em texto puro
UPDATE clientes
SET senha = 'admin123'
WHERE email = 'admin@sharkrush.com';

-- Verificar se foi atualizado
SELECT
    id,
    nome_completo,
    email,
    senha,
    ativo
FROM clientes
WHERE email = 'admin@sharkrush.com';

SELECT 'Senha do admin resetada para: admin123 (texto puro)' as mensagem;
