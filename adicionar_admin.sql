-- Script para adicionar campo is_admin e criar usuario administrador
USE sharkrush;

-- Adicionar campo is_admin na tabela clientes
ALTER TABLE clientes
ADD COLUMN is_admin TINYINT(1) DEFAULT 0 AFTER senha;

-- Criar usuario administrador
-- Senha: admin123 (hash gerado com password_hash em PHP)
INSERT INTO clientes (nome_completo, cpf, endereco, email, telefone, senha, is_admin)
VALUES (
    'Administrador',
    '00000000000',
    'Sistema',
    'admin@sharkrush.com',
    '00000000000',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: admin123
    1
);

-- Verificar se o usuario foi criado
SELECT id, nome_completo, email, is_admin FROM clientes WHERE is_admin = 1;
