# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Visão Geral do Projeto

SHARKRUSH é uma plataforma web de gerenciamento de treinos de academia desenvolvida como TCC para o SENAI. O projeto utiliza PHP puro com arquitetura MVC, sem frameworks externos.

## Comandos de Desenvolvimento

### Servidor Local
```bash
# Iniciar servidor PHP embutido
php -S localhost:8000 -t public/

# OU usar XAMPP/WAMP com DocumentRoot apontando para este diretório
```

### Banco de Dados
```bash
# Criar database
mysql -u root -e "CREATE DATABASE IF NOT EXISTS sharkrush;"

# Importar schema (se existir dump SQL)
mysql -u root sharkrush < schema.sql
```

### Estrutura do Banco
- **Database**: sharkrush
- **User**: root (sem senha - ambiente de desenvolvimento)
- **Tabelas principais**: clientes, exercicios, treinos_usuarios

### Testar Rotas Principais
```bash
# CRUD Clientes
curl http://localhost:8000/list-clientes
curl http://localhost:8000/update-clientes/1

# CRUD Exercícios
curl http://localhost:8000/list-exercicio
curl http://localhost:8000/update-exercicio/1

# CRUD Treinos
curl http://localhost:8000/list-treino
curl http://localhost:8000/update-treino/1
```

## Arquitetura

### Padrão MVC com Front Controller

**Fluxo de Requisição**:
```
Requisição → .htaccess → public/index.php → Controller → Model → Database
                                    ↓
                                  View
```

### Estrutura de Diretórios

```
/config/database.php         # Conexão PDO com MySQL
/models/                     # Classes de dados (Active Record)
  ├── clientes.php          # CRUD de clientes
  ├── exercicio.php         # CRUD de exercícios
  └── treino.php            # CRUD de treinos (com JOINs)
/controllers/               # Lógica de negócio
  ├── clientesController.php
  ├── ExerciciosController.php
  └── TreinosController.php
/views/                     # Templates PHP
  ├── semcadastro/         # Views públicas (sem autenticação)
  ├── comcadastro/         # Views autenticadas
  ├── Clientes/            # CRUD views
  ├── Exercicios/          # CRUD views
  ├── Treinos/             # CRUD views
  └── midia/               # Assets (imagens, ícones)
/public/index.php           # Front Controller (roteador)
```

### Roteamento

O arquivo `public/index.php` gerencia todas as rotas usando switch/case:
- Remove prefixo `/sharkrush` da URL
- Remove query strings
- Suporta rotas dinâmicas com regex: `/update-cliente/{id}`
- Controllers são instanciados diretamente (sem autoloader)

**Padrão de Rota**:
```php
// Rota estática
case 'list-clientes':
    $controller = new ClientesController();
    $controller->listClientes();
    break;

// Rota dinâmica com ID
case (preg_match('/^update-clientes\/(\d+)$/', $route, $matches) ? true : false):
    $id = $matches[1];
    $controller = new ClientesController();
    $controller->showUpdateForm($id);
    break;
```

### Banco de Dados

**Conexão**: PDO configurado em `/config/database.php`

**Tabelas**:
- `clientes`: id, nome_completo, cpf, endereco, email, telefone, senha
- `exercicios`: id, grupo_muscular, nome_exercicio, descricao
- `treinos_usuarios`: id, id_cliente (FK), id_exercicio (FK), series, repeticoes, dia_semana

**Relacionamentos**:
- Cliente 1:N Treinos
- Exercício 1:N Treinos
- Treinos fazem JOIN com clientes e exercícios para exibir dados completos

### Segurança

**Implementado**:
- Prepared statements (PDO) previnem SQL injection
- Senhas hasheadas com `password_hash()` (bcrypt)
- Validação de entrada com `filter_input(INPUT_POST, ...)`

**Não implementado**:
- Sistema de autenticação/sessão (estrutura existe mas não funciona)
- Sanitização de output nas views (risco XSS)
- Proteção CSRF
- Controle de acesso/permissões

### Models (Active Record Pattern)

Cada model contém métodos CRUD padrão:
- `save()`: INSERT
- `getAll()`: SELECT * com ordenação
- `getById($id)`: SELECT WHERE id = ?
- `update()`: UPDATE
- `delete()` ou `deleteById()`: DELETE

**Exemplo - Treino com JOINs**:
```php
// models/treino.php
public function getAll() {
    $query = "SELECT t.*, c.nome_completo, e.nome_exercicio
              FROM treinos_usuarios t
              JOIN clientes c ON t.id_cliente = c.id
              JOIN exercicios e ON t.id_exercicio = e.id";
}
```

### Controllers

Responsabilidades:
- Instanciar models necessários
- Validar entrada do usuário
- Processar lógica de negócio
- Incluir views com dados preparados

**Padrão**:
```php
class ClientesController {
    public function saveClientes() {
        $model = new clientes();
        $model->nome_completo = filter_input(INPUT_POST, 'nome_completo');
        // ... outros campos
        $model->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $model->save();
        header('Location: /list-clientes');
    }
}
```

### Views

**Organização**:
- Duas versões de páginas: `semcadastro/` (público) e `comcadastro/` (logado)
- CSS e JavaScript inline em cada arquivo PHP
- Sem template engine ou sistema de layouts
- Assets referenciados com caminho absoluto: `/views/midia/...`

**Funcionalidades principais**:
- Homepage com carrossel animado
- Calculadoras de IMC e calorias
- Biblioteca de exercícios com filtros
- Formulários CRUD com validação JavaScript

## Pontos de Atenção

1. **Autenticação não funcional**: Apesar de existir views separadas para usuários logados/não-logados, não há `session_start()` ou verificação de login implementada.

2. **CSS/JS inline**: Todo estilo e script está embutido nos arquivos PHP. Para modificar estilos, edite diretamente nas views.

3. **Credenciais hardcoded**: `database.php` possui credenciais diretas (root sem senha). Em produção, use variáveis de ambiente.

4. **Prefixo na URL**: O roteador remove prefixo `/sharkrush` - ajuste se necessário para deploy.

5. **Sem autoloader**: Controllers e Models são incluídos com `require_once` direto no `index.php`.

6. **Display errors ativado**: `public/index.php` tem `error_reporting(E_ALL)` - desative em produção.

## Adicionando Novas Funcionalidades

### Nova Entidade (CRUD Completo)

1. **Criar Model** (`/models/novaentidade.php`):
```php
class NovaEntidade {
    private $conn;
    public $id;
    public $campo1;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO nova_entidade (campo1) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->campo1]);
    }
}
```

2. **Criar Controller** (`/controllers/NovaEntidadeController.php`):
```php
class NovaEntidadeController {
    public function showForm() {
        include __DIR__ . '/../views/NovaEntidade/form.php';
    }

    public function save() {
        $model = new NovaEntidade();
        $model->campo1 = filter_input(INPUT_POST, 'campo1');
        $model->save();
        header('Location: /list-novaentidade');
    }
}
```

3. **Adicionar Rotas** (`/public/index.php`):
```php
require_once __DIR__ . '/../controllers/NovaEntidadeController.php';

switch ($route) {
    case 'novaentidade-form':
        $controller = new NovaEntidadeController();
        $controller->showForm();
        break;
    case 'save-novaentidade':
        $controller = new NovaEntidadeController();
        $controller->save();
        break;
}
```

4. **Criar Views** em `/views/NovaEntidade/`:
   - `form.php`: Formulário de cadastro
   - `list.php`: Listagem
   - `update_form.php`: Formulário de edição

### Adicionar Validação

Sempre use `filter_input()` nos controllers:
```php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {
    die('Email inválido');
}
```

### Sanitizar Output nas Views

Para prevenir XSS, sempre use:
```php
<?php echo htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8'); ?>
```

## Configuração do Ambiente

### Requisitos
- PHP 7.4+
- MySQL 5.7+
- Apache com mod_rewrite ativado

### Setup Inicial

1. Clone o repositório
2. Configure o servidor Apache com DocumentRoot apontando para este diretório
3. Habilite mod_rewrite:
```bash
# Ubuntu/Debian
sudo a2enmod rewrite
sudo systemctl restart apache2
```

4. Crie o banco de dados:
```sql
CREATE DATABASE sharkrush;
```

5. Execute as migrations/schema (se disponíveis)

6. Ajuste credenciais em `/config/database.php` se necessário

7. Acesse `http://localhost/public/` ou `http://localhost:8000/` (servidor embutido)

## Dependências Externas

- FontAwesome 5.15.4 (CDN) - ícones de interface
- Imagens do Unsplash (URLs diretas)
- HTML5 Geolocation API (navegador)

Não há gerenciador de pacotes (Composer/NPM) neste projeto.
