-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sharkrush;
USE sharkrush;

-- Tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de exercícios
CREATE TABLE exercicios (
    id VARCHAR(5) PRIMARY KEY, -- Formato: GXXX (G = grupo muscular, XXX = número sequencial)
    grupo_muscular ENUM(
        'Peito', 
        'Costas', 
        'Pernas', 
        'Ombros', 
        'Bíceps', 
        'Tríceps', 
        'Abdômen', 
        'Cardio'
    ) NOT NULL,
    nome_exercicio VARCHAR(100) NOT NULL,
    descricao TEXT
);

-- Treinos dos usuários
CREATE TABLE treinos_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_exercicio VARCHAR(5) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    series INT NOT NULL,
    repeticoes INT NOT NULL,
    dia_semana ENUM(
        'Segunda', 
        'Terça', 
        'Quarta', 
        'Quinta', 
        'Sexta', 
        'Sábado', 
        'Domingo'
    ) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_exercicio) REFERENCES exercicios(id)
);

-- Criação de trigger para numeração automática dos exercícios
DELIMITER //
CREATE TRIGGER gerar_id_exercicio
BEFORE INSERT ON exercicios
FOR EACH ROW
BEGIN
    DECLARE proximo_num INT;
    SET proximo_num = (
        SELECT COUNT(*) + 1 
        FROM exercicios 
        WHERE grupo_muscular = NEW.grupo_muscular
    );
    
    CASE NEW.grupo_muscular
        WHEN 'Peito' THEN SET NEW.id = CONCAT('1', LPAD(proximo_num, 3, '0'));
        WHEN 'Costas' THEN SET NEW.id = CONCAT('2', LPAD(proximo_num, 3, '0'));
        WHEN 'Pernas' THEN SET NEW.id = CONCAT('3', LPAD(proximo_num, 3, '0'));
        WHEN 'Ombros' THEN SET NEW.id = CONCAT('4', LPAD(proximo_num, 3, '0'));
        WHEN 'Bíceps' THEN SET NEW.id = CONCAT('5', LPAD(proximo_num, 3, '0'));
        WHEN 'Tríceps' THEN SET NEW.id = CONCAT('6', LPAD(proximo_num, 3, '0'));
        WHEN 'Abdômen' THEN SET NEW.id = CONCAT('7', LPAD(proximo_num, 3, '0'));
        WHEN 'Cardio' THEN SET NEW.id = CONCAT('8', LPAD(proximo_num, 3, '0'));
    END CASE;
END//
DELIMITER ;


INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao)
VALUES ('Peito', 'Supino Reto', 'Exercício para peitoral realizado com barra');

INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Peito', 'Supino Inclinado', 'Executado em banco inclinado com halteres'),
('Peito', 'Crucifixo', 'Exercício de abertura peitoral na máquina ou com halteres');

-- Costas (ID começam com 2)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Costas', 'Barra Fixa', 'Exercício de peso corporal para dorsais'),
('Costas', 'Remada Curvada', 'Exercício com barra livre para espessamento dorsal');

-- Pernas (ID começam com 3)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Pernas', 'Agachamento Livre', 'Exercício completo para membros inferiores'),
('Pernas', 'Stiff', 'Exercício focado na cadeia posterior');

-- Ombros (ID começam com 4)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Ombros', 'Desenvolvimento Militar', 'Exercício com barra para deltóides frontais'),
('Ombros', 'Elevação Lateral', 'Exercício com halteres para deltóides laterais');

-- Bíceps (ID começam com 5)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Bíceps', 'Rosca Direta', 'Exercício clássico com barra reta'),
('Bíceps', 'Rosca Scott', 'Exercício com apoio para isolamento muscular');

-- Tríceps (ID começam com 6)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Tríceps', 'Tríceps Testa', 'Exercício com barra na posição deitada'),
('Tríceps', 'Pulley', 'Exercício na polia alta para tríceps');

-- Abdômen (ID começam com 7)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Abdômen', 'Prancha', 'Exercício isométrico para core'),
('Abdômen', 'Crunch', 'Exercício tradicional de abdominal');

-- Cardio (ID começam com 8)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Cardio', 'Esteira', 'Corrida/caminhada em ritmo constante'),
('Cardio', 'Bicicleta Ergométrica', 'Treino cardiovascular de baixo impacto');

select * from exercicios;

-- Segunda: Peito e Tríceps
INSERT INTO treinos_usuarios (id_cliente, id_exercicio, series, repeticoes, dia_semana) VALUES
(1, '1001', 4, 12, 'Segunda'),  -- Supino Reto
(1, '1002', 3, 15, 'Segunda'),  -- Supino Inclinado
(1, '6001', 3, 12, 'Segunda'),  -- Tríceps Testa
(1, '6002', 4, 15, 'Segunda');  -- Pulley

-- Quarta: Costas e Bíceps
INSERT INTO treinos_usuarios (id_cliente, id_exercicio, series, repeticoes, dia_semana) VALUES
(1, '2001', 4, 8,  'Quarta'),   -- Barra Fixa
(1, '2002', 4, 10, 'Quarta'),   -- Remada Curvada
(1, '5001', 3, 12, 'Quarta'),   -- Rosca Direta
(1, '5002', 3, 10, 'Quarta');   -- Rosca Scott

-- Sexta: Pernas e Ombros
INSERT INTO treinos_usuarios (id_cliente, id_exercicio, series, repeticoes, dia_semana) VALUES
(1, '3001', 5, 8,  'Sexta'),    -- Agachamento Livre
(1, '3002', 4, 10, 'Sexta'),    -- Stiff
(1, '4001', 4, 10, 'Sexta'),    -- Desenvolvimento Militar
(1, '4002', 4, 15, 'Sexta');    -- Elevação Lateral

-- Sábado: Abdômen
INSERT INTO treinos_usuarios (id_cliente, id_exercicio, series, repeticoes, dia_semana) VALUES
(1, '7001', 3, 60, 'Sábado'),   -- Prancha (segundos)
(1, '7002', 4, 20, 'Sábado');   -- Crunch

DROP TRIGGER IF EXISTS gerar_id_exercicio;

DELIMITER //
CREATE TRIGGER gerar_id_exercicio
BEFORE INSERT ON exercicios
FOR EACH ROW
BEGIN
    DECLARE ultimo_id VARCHAR(5);
    DECLARE proximo_num INT;
    
    -- Pega o maior ID existente para o grupo muscular
    SELECT MAX(id) INTO ultimo_id 
    FROM exercicios 
    WHERE grupo_muscular = NEW.grupo_muscular;
    
    -- Se não houver registros, começa em 1
    IF ultimo_id IS NULL THEN
        SET proximo_num = 1;
    ELSE
        SET proximo_num = CAST(SUBSTRING(ultimo_id, 2) AS UNSIGNED) + 1;
    END IF;
    
    -- Gera o novo ID
    CASE NEW.grupo_muscular
        WHEN 'Peito'    THEN SET NEW.id = CONCAT('1', LPAD(proximo_num, 3, '0'));
        WHEN 'Costas'   THEN SET NEW.id = CONCAT('2', LPAD(proximo_num, 3, '0'));
        WHEN 'Pernas'   THEN SET NEW.id = CONCAT('3', LPAD(proximo_num, 3, '0'));
        WHEN 'Ombros'   THEN SET NEW.id = CONCAT('4', LPAD(proximo_num, 3, '0'));
        WHEN 'Bíceps'  THEN SET NEW.id = CONCAT('5', LPAD(proximo_num, 3, '0'));
        WHEN 'Tríceps' THEN SET NEW.id = CONCAT('6', LPAD(proximo_num, 3, '0'));
        WHEN 'Abdômen' THEN SET NEW.id = CONCAT('7', LPAD(proximo_num, 3, '0'));
        WHEN 'Cardio'   THEN SET NEW.id = CONCAT('8', LPAD(proximo_num, 3, '0'));
    END CASE;
END//
DELIMITER ;

DELETE FROM exercicios; -- Apaga todos os exercícios existentes

INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao)
VALUES ('Peito', 'Supino Reto', 'Exercício para peitoral realizado com barra');

INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Peito', 'Supino Inclinado', 'Executado em banco inclinado com halteres'),
('Peito', 'Crucifixo', 'Exercício de abertura peitoral na máquina ou com halteres');

-- Costas (ID começam com 2)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Costas', 'Barra Fixa', 'Exercício de peso corporal para dorsais'),
('Costas', 'Remada Curvada', 'Exercício com barra livre para espessamento dorsal');

-- Pernas (ID começam com 3)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Pernas', 'Agachamento Livre', 'Exercício completo para membros inferiores'),
('Pernas', 'Stiff', 'Exercício focado na cadeia posterior');

-- Ombros (ID começam com 4)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Ombros', 'Desenvolvimento Militar', 'Exercício com barra para deltóides frontais'),
('Ombros', 'Elevação Lateral', 'Exercício com halteres para deltóides laterais');

-- Bíceps (ID começam com 5)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Bíceps', 'Rosca Direta', 'Exercício clássico com barra reta'),
('Bíceps', 'Rosca Scott', 'Exercício com apoio para isolamento muscular');

-- Tríceps (ID começam com 6)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Tríceps', 'Tríceps Testa', 'Exercício com barra na posição deitada'),
('Tríceps', 'Pulley', 'Exercício na polia alta para tríceps');

-- Abdômen (ID começam com 7)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Abdômen', 'Prancha', 'Exercício isométrico para core'),
('Abdômen', 'Crunch', 'Exercício tradicional de abdominal');

-- Cardio (ID começam com 8)
INSERT INTO exercicios (grupo_muscular, nome_exercicio, descricao) VALUES
('Cardio', 'Esteira', 'Corrida/caminhada em ritmo constante'),
('Cardio', 'Bicicleta Ergométrica', 'Treino cardiovascular de baixo impacto');


SELECT * FROM exercicios ORDER BY id;
select * from clientes;
select * from exercicios;

CREATE TABLE sessoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_treino INT NOT NULL, -- referência ao treino realizado
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_treino) REFERENCES treinos_usuarios(id)
);