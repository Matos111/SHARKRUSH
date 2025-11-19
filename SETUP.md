# Comandos para Rodar o Projeto SHARKRUSH no Mac

## 1. Criar o Banco de Dados

```bash
# Se seu MySQL nao tem senha:
mysql -u root -e "CREATE DATABASE IF NOT EXISTS sharkrush;"

# Se seu MySQL tem senha:
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS sharkrush;"
```

## 2. Criar as Tabelas

```bash
# Execute o schema SQL
mysql -u root sharkrush < schema.sql

# Se tiver senha:
mysql -u root -p sharkrush < schema.sql
```

## 3. Verificar se as Tabelas foram Criadas

```bash
mysql -u root sharkrush -e "SHOW TABLES;"

# Deve mostrar:
# - clientes
# - exercicios
# - treinos_usuarios
```

## 4. Iniciar o Servidor PHP

```bash
# A partir do diretorio raiz do projeto:
php -S localhost:8000

# OU se quiser especificar o diretorio public:
php -S localhost:8000 -t public/
```

## 5. Acessar o Projeto

Abra o navegador e acesse:
- http://localhost:8000/

## URLs Importantes

```
# Paginas publicas (sem cadastro)
http://localhost:8000/semhomesena
http://localhost:8000/semlogin
http://localhost:8000/semcadastro
http://localhost:8000/semcalculoimc
http://localhost:8000/semcalculocalorias
http://localhost:8000/sembibliotecasena

# CRUD Clientes
http://localhost:8000/list-clientes
http://localhost:8000/public (formulario de cadastro)

# CRUD Exercicios
http://localhost:8000/list-exercicio
http://localhost:8000/public-exercicio

# CRUD Treinos
http://localhost:8000/list-treino
http://localhost:8000/treino-form
```

## Troubleshooting

### Erro de conexao com MySQL

Se aparecer erro de conexao, verifique as credenciais em:
```
config/database.php
```

Ajuste o usuario/senha conforme sua configuracao do MySQL.

### Erro 404 nas rotas

Certifique-se de estar rodando o servidor a partir do diretorio raiz do projeto, nao do diretorio public/.

### mod_rewrite nao funciona

Como estamos usando o servidor embutido do PHP, o mod_rewrite do Apache nao é necessario. O PHP ja lida com as requisicoes automaticamente.
