# Instrucoes para Migracao - Meus Treinos

## O que foi implementado

Foi criado um sistema completo de gerenciamento de treinos que permite:
- Criar treinos com multiplos exercicios
- Acompanhar progresso de cada treino
- Marcar exercicios como concluidos
- Resetar treinos
- Excluir treinos
- Definir dia da semana para cada treino

## Passos para executar a migracao

### 1. Executar a migration no banco de dados

Abra o terminal e execute:

```bash
mysql -u root sharkrush < migration_grupos_treino.sql
```

OU acesse o MySQL diretamente:

```bash
mysql -u root
```

E execute os comandos do arquivo `migration_grupos_treino.sql`:

```sql
USE sharkrush;

ALTER TABLE treinos_usuarios
ADD COLUMN nome_treino VARCHAR(255) DEFAULT NULL AFTER id_cliente,
ADD COLUMN descricao_treino TEXT DEFAULT NULL AFTER nome_treino,
ADD COLUMN grupo_treino VARCHAR(50) DEFAULT NULL AFTER descricao_treino,
ADD COLUMN status_treino ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending' AFTER grupo_treino,
ADD COLUMN concluido BOOLEAN DEFAULT FALSE AFTER repeticoes,
ADD COLUMN ordem_exercicio INT DEFAULT 0 AFTER concluido;

CREATE INDEX idx_grupo_treino ON treinos_usuarios(grupo_treino);
CREATE INDEX idx_cliente_grupo ON treinos_usuarios(id_cliente, grupo_treino);
```

### 2. Verificar se a migration foi aplicada

Execute no MySQL:

```sql
DESCRIBE treinos_usuarios;
```

Voce deve ver as novas colunas:
- nome_treino
- descricao_treino
- grupo_treino
- status_treino
- concluido
- ordem_exercicio

### 3. Testar a funcionalidade

1. Acesse: http://localhost:8000/meus-treinos
2. Clique em "Adicionar Novo Treino"
3. Preencha os dados:
   - Nome do treino
   - Descricao
   - Adicione exercicios
4. Salve e verifique se o treino aparece na lista

## Estrutura de arquivos criados/modificados

### Novos arquivos:
- `/migration_grupos_treino.sql` - Script de migracao do banco
- `/controllers/MeusTreinosController.php` - Controller com endpoints de API
- `/INSTRUCOES_MIGRACAO.md` - Este arquivo

### Arquivos modificados:
- `/models/treino.php` - Adicionados metodos para grupos de treino
- `/public/index.php` - Adicionadas rotas de API
- `/views/comcadastro/commeustreinossena.php` - Refatorado para usar API

## API Endpoints criados

Todos os endpoints estao protegidos por autenticacao:

- `GET /api/meus-treinos/listar` - Lista todos os treinos do usuario
- `GET /api/meus-treinos/detalhes?id={grupo_treino}` - Detalhes de um treino
- `POST /api/meus-treinos/criar` - Cria novo treino
- `POST /api/meus-treinos/toggle-exercicio` - Marca/desmarca exercicio
- `POST /api/meus-treinos/atualizar-status` - Atualiza status do treino
- `POST /api/meus-treinos/resetar` - Reseta progresso do treino
- `POST /api/meus-treinos/deletar` - Deleta treino completo

## Estrutura do banco de dados

### Tabela: treinos_usuarios (modificada)

```
id (INT, PK)
id_cliente (INT, FK)
nome_treino (VARCHAR 255) - NOVO
descricao_treino (TEXT) - NOVO
grupo_treino (VARCHAR 50) - NOVO - Identificador unico do grupo
status_treino (ENUM) - NOVO - pending/in-progress/completed
id_exercicio (VARCHAR 5, FK)
series (INT)
repeticoes (INT)
concluido (BOOLEAN) - NOVO - Status individual do exercicio
dia_semana (ENUM)
ordem_exercicio (INT) - NOVO - Ordem de exibicao
data_criacao (TIMESTAMP)
```

### Como funciona o agrupamento:

- Todos os exercicios de um mesmo treino compartilham o mesmo `grupo_treino`
- O `grupo_treino` e um identificador unico gerado no formato: `treino_{timestamp}_{uniqid}`
- Exemplo: `treino_1699887654_6547abc123def`

## Problemas conhecidos e solucoes

### Se a pagina nao carregar treinos:

1. Verifique se a migration foi executada
2. Verifique se o usuario esta logado (sessao ativa)
3. Abra o console do navegador (F12) e veja se ha erros
4. Verifique os logs de erro do PHP

### Se nao conseguir criar treinos:

1. Verifique se os exercicios estao sendo cadastrados corretamente
2. Confirme que a tabela `exercicios` tem dados
3. Verifique as permissoes do banco de dados

## Proximos passos (opcional)

Melhorias que podem ser implementadas:

1. Adicionar campo para selecionar dia da semana ao criar treino
2. Implementar filtro por dia da semana
3. Adicionar historico de treinos realizados
4. Criar graficos de progresso
5. Adicionar notificacoes push para lembrar de treinar
