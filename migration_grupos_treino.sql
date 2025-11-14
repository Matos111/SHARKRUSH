-- Migration para adicionar suporte a grupos de treinos na tabela existente
USE sharkrush;

-- Adicionar novos campos na tabela treinos_usuarios
ALTER TABLE treinos_usuarios
ADD COLUMN nome_treino VARCHAR(255) DEFAULT NULL AFTER id_cliente,
ADD COLUMN descricao_treino TEXT DEFAULT NULL AFTER nome_treino,
ADD COLUMN grupo_treino VARCHAR(50) DEFAULT NULL AFTER descricao_treino,
ADD COLUMN status_treino ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending' AFTER grupo_treino,
ADD COLUMN concluido BOOLEAN DEFAULT FALSE AFTER repeticoes,
ADD COLUMN ordem_exercicio INT DEFAULT 0 AFTER concluido;

-- Criar indice para melhorar performance nas buscas por grupo
CREATE INDEX idx_grupo_treino ON treinos_usuarios(grupo_treino);
CREATE INDEX idx_cliente_grupo ON treinos_usuarios(id_cliente, grupo_treino);

-- Comentarios sobre a nova estrutura:
-- grupo_treino: identificador unico para agrupar exercicios (ex: "treino_1234567890")
-- nome_treino: nome do grupo de treino (ex: "Treino A - Peito e Triceps")
-- descricao_treino: descricao do treino
-- status_treino: status geral do grupo de treino
-- concluido: se o exercicio especifico foi concluido
-- ordem_exercicio: ordem de exibicao dos exercicios no grupo
