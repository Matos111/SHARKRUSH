-- ============================================================
-- SCRIPT UNIFICADO DE BANCO DE DADOS - SHARKRUSH
-- Contem: Criacao de tabelas, migrations e dados iniciais
-- ============================================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS sharkrush;
USE sharkrush;

-- ============================================================
-- 1. CRIACAO DAS TABELAS BASE
-- ============================================================

-- Tabela de clientes/usuarios
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(15),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de exercicios
CREATE TABLE IF NOT EXISTS exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grupo_muscular VARCHAR(100) DEFAULT 'Geral',
    nome_exercicio VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de treinos dos usuarios
CREATE TABLE IF NOT EXISTS treinos_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    nome_treino VARCHAR(255) DEFAULT NULL,
    descricao_treino TEXT DEFAULT NULL,
    grupo_treino VARCHAR(100) DEFAULT NULL,
    status_treino ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending',
    id_exercicio INT,
    series INT,
    repeticoes INT,
    concluido BOOLEAN DEFAULT FALSE,
    ordem_exercicio INT DEFAULT 0,
    dia_semana VARCHAR(20) DEFAULT 'Segunda',
    peso DECIMAL(6,2),
    data_treino DATE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_exercicio) REFERENCES exercicios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de medidas corporais
CREATE TABLE IF NOT EXISTS medidas_corporais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    altura DECIMAL(5,2),
    peso DECIMAL(6,2),
    imc DECIMAL(5,2),
    data_medida DATE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de logs de atividades
CREATE TABLE IF NOT EXISTS logs_atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    acao VARCHAR(255),
    data_acao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 2. INDICES PARA PERFORMANCE
-- ============================================================

CREATE INDEX idx_cliente_email ON clientes(email);
CREATE INDEX idx_cliente_cpf ON clientes(cpf);
CREATE INDEX idx_treino_cliente ON treinos_usuarios(id_cliente);
CREATE INDEX idx_treino_data ON treinos_usuarios(data_treino);
CREATE INDEX idx_grupo_treino ON treinos_usuarios(grupo_treino);
CREATE INDEX idx_cliente_grupo ON treinos_usuarios(id_cliente, grupo_treino);
CREATE INDEX idx_medida_cliente ON medidas_corporais(id_cliente);
CREATE INDEX idx_log_cliente ON logs_atividades(id_cliente);

-- ============================================================
-- 3. DADOS INICIAIS - EXERCICIOS
-- ============================================================

INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Peito', 'Supino Reto', 'Exercicio para peitoral maior'),
('Peito', 'Supino Inclinado', 'Exercicio para peitoral superior'),
('Peito', 'Crucifixo', 'Exercicio de isolamento para peitoral'),
('Triceps', 'Triceps Testa', 'Exercicio para triceps'),
('Triceps', 'Triceps Corda', 'Exercicio para triceps com corda'),
('Costas', 'Puxada Frontal', 'Exercicio para dorsais'),
('Costas', 'Remada Curvada', 'Exercicio para costas'),
('Costas', 'Remada Unilateral', 'Exercicio unilateral para costas'),
('Biceps', 'Rosca Direta', 'Exercicio para biceps'),
('Pernas', 'Agachamento Livre', 'Exercicio composto para pernas'),
('Pernas', 'Leg Press', 'Exercicio para quadriceps'),
('Pernas', 'Cadeira Extensora', 'Isolamento para quadriceps'),
('Pernas', 'Cadeira Flexora', 'Isolamento para posterior de coxa'),
('Pernas', 'Panturrilha', 'Exercicio para panturrilhas'),
('Peito', 'Flexao', 'Exercicio com peso corporal para peitoral'),
('Geral', 'Outro', 'Exercicio personalizado');

-- ============================================================
-- 4. USUARIO ADMIN (opcional)
-- ============================================================

-- Inserir usuario administrador padrao
-- Senha: admin123 (texto puro - validacao especial no AuthController)
INSERT INTO clientes (nome_completo, cpf, endereco, email, telefone, senha, ativo)
VALUES (
    'Administrador',
    '00000000000',
    'Admin Office',
    'admin@sharkrush.com',
    '(00) 00000-0000',
    'admin123',
    TRUE
)
ON DUPLICATE KEY UPDATE email=email;

-- ============================================================
-- FIM DO SCRIPT
-- ============================================================
-- Banco de dados sharkrush configurado com sucesso!
-- Tabelas criadas: clientes, exercicios, treinos_usuarios, medidas_corporais, logs_atividades
-- Exercicios pre-cadastrados incluidos
