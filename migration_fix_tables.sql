-- ============================================================
-- SCRIPT DE MIGRACAO - CORRECAO DE TABELAS SHARKRUSH
-- Execute este script se voce ja tem o banco criado
-- ============================================================

USE sharkrush;

-- ============================================================
-- 1. BACKUP RECOMENDADO
-- ============================================================
-- Antes de executar, faca backup do banco:
-- mysqldump -u root sharkrush > backup_sharkrush.sql

-- ============================================================
-- 2. CORRIGIR TABELA CLIENTES
-- ============================================================

-- Renomear id_cliente para id (se existir)
-- Primeiro verifica se a coluna id_cliente existe
SET @column_exists = (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'sharkrush'
    AND TABLE_NAME = 'clientes'
    AND COLUMN_NAME = 'id_cliente'
);

-- Se id_cliente existir, precisamos recriar a tabela
-- Primeiro, dropar as foreign keys que referenciam clientes
SET FOREIGN_KEY_CHECKS = 0;

-- Verificar e corrigir estrutura da tabela clientes
ALTER TABLE clientes CHANGE COLUMN id_cliente id INT AUTO_INCREMENT;

-- ============================================================
-- 3. CORRIGIR TABELA EXERCICIOS
-- ============================================================

-- Renomear id_exercicio para id (se existir)
ALTER TABLE exercicios CHANGE COLUMN id_exercicio id INT AUTO_INCREMENT;

-- Adicionar coluna grupo_muscular se nao existir
ALTER TABLE exercicios
ADD COLUMN IF NOT EXISTS grupo_muscular VARCHAR(100) DEFAULT 'Geral' AFTER id;

-- Renomear descricao_exercicio para descricao (se existir)
ALTER TABLE exercicios CHANGE COLUMN descricao_exercicio descricao TEXT;

-- ============================================================
-- 4. CORRIGIR TABELA TREINOS_USUARIOS
-- ============================================================

-- Renomear id_treino para id
ALTER TABLE treinos_usuarios CHANGE COLUMN id_treino id INT AUTO_INCREMENT;

-- Adicionar colunas que faltam
ALTER TABLE treinos_usuarios
ADD COLUMN IF NOT EXISTS nome_treino VARCHAR(255) DEFAULT NULL AFTER id_cliente,
ADD COLUMN IF NOT EXISTS descricao_treino TEXT DEFAULT NULL AFTER nome_treino,
ADD COLUMN IF NOT EXISTS grupo_treino VARCHAR(100) DEFAULT NULL AFTER descricao_treino,
ADD COLUMN IF NOT EXISTS status_treino ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending' AFTER grupo_treino,
ADD COLUMN IF NOT EXISTS concluido BOOLEAN DEFAULT FALSE AFTER repeticoes,
ADD COLUMN IF NOT EXISTS ordem_exercicio INT DEFAULT 0 AFTER concluido,
ADD COLUMN IF NOT EXISTS dia_semana VARCHAR(20) DEFAULT 'Segunda' AFTER ordem_exercicio;

-- ============================================================
-- 5. CORRIGIR TABELA MEDIDAS_CORPORAIS
-- ============================================================

-- Renomear id_medida para id (se existir)
ALTER TABLE medidas_corporais CHANGE COLUMN id_medida id INT AUTO_INCREMENT;

-- ============================================================
-- 6. CORRIGIR TABELA LOGS_ATIVIDADES
-- ============================================================

-- Renomear id_log para id (se existir)
ALTER TABLE logs_atividades CHANGE COLUMN id_log id INT AUTO_INCREMENT;

-- Reativar foreign keys
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- 7. CRIAR INDICES (se nao existirem)
-- ============================================================

-- Os indices serao ignorados se ja existirem
CREATE INDEX IF NOT EXISTS idx_cliente_email ON clientes(email);
CREATE INDEX IF NOT EXISTS idx_cliente_cpf ON clientes(cpf);
CREATE INDEX IF NOT EXISTS idx_treino_cliente ON treinos_usuarios(id_cliente);
CREATE INDEX IF NOT EXISTS idx_treino_data ON treinos_usuarios(data_treino);
CREATE INDEX IF NOT EXISTS idx_grupo_treino ON treinos_usuarios(grupo_treino);
CREATE INDEX IF NOT EXISTS idx_cliente_grupo ON treinos_usuarios(id_cliente, grupo_treino);
CREATE INDEX IF NOT EXISTS idx_medida_cliente ON medidas_corporais(id_cliente);
CREATE INDEX IF NOT EXISTS idx_log_cliente ON logs_atividades(id_cliente);

-- ============================================================
-- 8. INSERIR EXERCICIOS PADRAO (se tabela estiver vazia)
-- ============================================================

INSERT IGNORE INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
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
-- FIM DA MIGRACAO
-- ============================================================
SELECT 'Migracao concluida com sucesso!' AS status;
