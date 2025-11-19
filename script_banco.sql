-- ============================================================
-- SCRIPT UNIFICADO DE BANCO DE DADOS - SHARKRUSH
-- Contém: Criação de tabelas, migrations e dados iniciais
-- ============================================================
CREATE DATABASE sharkrush;

USE sharkrush;

-- ============================================================
-- 1. CRIAÇÃO DAS TABELAS BASE (script_banco.sql)
-- ============================================================

-- Tabela de clientes/usuários
CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(15),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de exercícios
CREATE TABLE IF NOT EXISTS exercicios (
    id_exercicio INT AUTO_INCREMENT PRIMARY KEY,
    nome_exercicio VARCHAR(255) NOT NULL,
    descricao_exercicio TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de treinos dos usuários
CREATE TABLE IF NOT EXISTS treinos_usuarios (
    id_treino INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_exercicio INT,
    repeticoes INT,
    series INT,
    peso DECIMAL(6,2),
    data_treino DATE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_exercicio) REFERENCES exercicios(id_exercicio) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de medidas corporais
CREATE TABLE IF NOT EXISTS medidas_corporais (
    id_medida INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    altura DECIMAL(5,2),
    peso DECIMAL(6,2),
    imc DECIMAL(5,2),
    data_medida DATE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de logs de atividades
CREATE TABLE IF NOT EXISTS logs_atividades (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    acao VARCHAR(255),
    data_acao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 2. MIGRATIONS - Adicionar suporte a grupos de treino
-- (migration_grupos_treino.sql)
-- ============================================================

-- Adicionar novos campos na tabela treinos_usuarios
ALTER TABLE treinos_usuarios
ADD COLUMN nome_treino VARCHAR(255) DEFAULT NULL AFTER id_cliente,
ADD COLUMN descricao_treino TEXT DEFAULT NULL AFTER nome_treino,
ADD COLUMN grupo_treino VARCHAR(50) DEFAULT NULL AFTER descricao_treino,
ADD COLUMN status_treino ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending' AFTER grupo_treino,
ADD COLUMN concluido BOOLEAN DEFAULT FALSE AFTER repeticoes,
ADD COLUMN ordem_exercicio INT DEFAULT 0 AFTER concluido;

-- Criar índices para melhorar performance nas buscas por grupo
CREATE INDEX idx_grupo_treino ON treinos_usuarios(grupo_treino);
CREATE INDEX idx_cliente_grupo ON treinos_usuarios(id_cliente, grupo_treino);

-- ============================================================
-- 3. INSERÇÃO DE USUÁRIO ADMIN (adicionar_admin.sql)
-- ============================================================

-- Inserir usuário administrador padrão
INSERT INTO clientes (nome_completo, cpf, endereco, email, telefone, senha, ativo)
VALUES (
    'Administrador',
    '00000000000',
    'Admin Office',
    'admin@sharkrush.com',
    '(00) 00000-0000',
    '$2y$10$YourHashedPasswordHere',
    TRUE
)
ON DUPLICATE KEY UPDATE email=email;

-- ============================================================
-- 4. ÍNDICES ADICIONAIS PARA PERFORMANCE
-- ============================================================

CREATE INDEX idx_cliente_email ON clientes(email);
CREATE INDEX idx_cliente_cpf ON clientes(cpf);
CREATE INDEX idx_treino_cliente ON treinos_usuarios(id_cliente);
CREATE INDEX idx_treino_data ON treinos_usuarios(data_treino);
CREATE INDEX idx_medida_cliente ON medidas_corporais(id_cliente);
CREATE INDEX idx_log_cliente ON logs_atividades(id_cliente);

USE sharkrush;
SELECT * FROM clientes;

-- ============================================================
-- FIM DO SCRIPT
-- ============================================================
-- Banco de dados sharkrush configurado com sucesso!
-- Tabelas criadas: clientes, exercicios, treinos_usuarios, medidas_corporais, logs_atividades
-- Migrations aplicadas: Suporte a grupos de treino
-- Usuário admin criado com sucesso
