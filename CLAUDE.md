# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Visao Geral do Projeto

SHARKRUSH e uma plataforma web de gerenciamento de treinos de academia desenvolvida como TCC para o SENAI. O projeto utiliza PHP puro com arquitetura MVC, sem frameworks externos.

## Comandos de Desenvolvimento

### Servidor Local
```bash
# Iniciar servidor PHP embutido (a partir do diretorio raiz)
php -S localhost:8000

# OU usar XAMPP/WAMP com DocumentRoot apontando para este diretorio
```

### Banco de Dados
```bash
# Criar database e importar schema completo
mysql -u root < script_banco.sql

# OU criar manualmente
mysql -u root -e "CREATE DATABASE IF NOT EXISTS sharkrush;"
mysql -u root sharkrush < script_banco.sql
```

### Estrutura do Banco
- **Database**: sharkrush
- **User**: root (sem senha - ambiente de desenvolvimento)
- **Tabelas principais**:
  - `clientes`: usuarios da plataforma
  - `exercicios`: catalogo de exercicios (ID auto-gerado por trigger)
  - `treinos_usuarios`: relaciona clientes com exercicios (series, repeticoes, dia)
  - `sessoes`: historico de treinos realizados

### Rotas Principais
```bash
# Autenticacao
http://localhost:8000/                  # Login
http://localhost:8000/cadastro          # Cadastro de novo usuario
http://localhost:8000/authenticate      # POST - processar login
http://localhost:8000/logout            # Encerrar sessao
http://localhost:8000/dashboard         # Home apos login

# Perfil do usuario logado
http://localhost:8000/perfil            # Ver/editar perfil
http://localhost:8000/update-perfil     # POST - atualizar dados
http://localhost:8000/update-senha      # POST - alterar senha

# Funcionalidades autenticadas
http://localhost:8000/calculadora-imc
http://localhost:8000/calculadora-calorias
http://localhost:8000/gerador-treino
http://localhost:8000/biblioteca
http://localhost:8000/meus-treinos
http://localhost:8000/sobre

# CRUD Clientes (admin)
http://localhost:8000/list-clientes
http://localhost:8000/update-clientes/{id}

# CRUD Exercicios (admin)
http://localhost:8000/list-exercicio
http://localhost:8000/public-exercicio
http://localhost:8000/update-exercicio/{id}

# CRUD Treinos (admin)
http://localhost:8000/list-treino
http://localhost:8000/treino-form
http://localhost:8000/update-treino/{id}

# API
http://localhost:8000/api/save-workout-generator  # POST - salvar treino gerado
```

## Arquitetura

### Padrao MVC com Front Controller

**Fluxo de Requisicao**:
```
Requisicao → .htaccess → public/index.php → Controller → Model → Database
                                    ↓
                                  View
```

### Estrutura de Diretorios

```
/config/database.php         # Conexao PDO com MySQL
/models/                     # Classes de dados (Active Record)
  ├── clientes.php          # CRUD de clientes + autenticacao
  ├── exercicio.php         # CRUD de exercicios
  └── treino.php            # CRUD de treinos (com JOINs)
/controllers/               # Logica de negocio
  ├── AuthController.php    # Login, logout, middlewares de autenticacao
  ├── PerfilController.php  # Gerenciamento de perfil do usuario
  ├── clientesController.php
  ├── ExerciciosController.php
  └── TreinosController.php
/views/                     # Templates PHP
  ├── semcadastro/         # Views publicas (sem autenticacao)
  ├── comcadastro/         # Views autenticadas
  ├── admin/               # Painel administrativo
  ├── Clientes/            # CRUD views
  ├── Exercicios/          # CRUD views
  ├── Treinos/             # CRUD views
  └── midia/               # Assets (imagens, icones)
/public/index.php           # Front Controller (roteador principal)
/script_banco.sql           # Schema completo com triggers e dados de exemplo
```

### Roteamento

O arquivo `public/index.php` gerencia todas as rotas usando switch/case:
- Inicia sessao com `session_start()` no topo do arquivo
- Remove prefixo `/sharkrush` da URL (ajuste conforme deploy)
- Remove query strings
- Suporta rotas dinamicas com regex: `/update-cliente/{id}`
- Controllers sao instanciados diretamente (sem autoloader)

**Padrao de Rota**:
```php
// Rota estatica
case '/list-clientes':
    $controller = new ClientesController();
    $controller->listClientes();
    break;

// Rota dinamica com ID
case (preg_match('/^\/update-clientes\/(\d+)$/', $request, $matches) ? true : false):
    $id = $matches[1];
    $controller = new ClientesController();
    $controller->showUpdateForm($id);
    break;

// Rota protegida (requer autenticacao)
case '/dashboard':
    AuthController::checkAuth();  // Middleware
    include __DIR__ . '/../views/comcadastro/comhomesena.php';
    break;
```

### Sistema de Autenticacao

**Implementado e Funcional**:
- Login completo com sessoes em `AuthController.php`
- Middleware `AuthController::checkAuth()` protege rotas autenticadas
- Middleware `AuthController::checkAdmin()` para funcoes administrativas
- Senhas hasheadas com `password_hash()` (bcrypt)
- Validacao de credenciais com `password_verify()`
- Gerenciamento de perfil em `PerfilController.php`

**Estrutura de Sessao**:
```php
$_SESSION['user_id']      // ID do cliente logado
$_SESSION['user_name']    // Nome completo
$_SESSION['user_email']   // Email
$_SESSION['logged_in']    // Boolean
$_SESSION['is_admin']     // Boolean (campo futuro na tabela)
```

### Banco de Dados

**Conexao**: PDO configurado em `/config/database.php`

**Tabelas**:
- `clientes`: id, nome_completo, cpf, endereco, email, telefone, senha
- `exercicios`: id (VARCHAR auto-gerado), grupo_muscular (ENUM), nome_exercicio, descricao
- `treinos_usuarios`: id, id_cliente (FK), id_exercicio (FK), series, repeticoes, dia_semana (ENUM), data_criacao
- `sessoes`: id, id_cliente (FK), id_treino (FK), data_hora (historico de treinos realizados)

**Sistema de IDs de Exercicios**:
- IDs sao gerados automaticamente por trigger MySQL
- Formato: `GXXX` (G = codigo do grupo, XXX = numero sequencial)
- Exemplos: `1001` (Peito), `2001` (Costas), `3001` (Pernas)
- Codigo dos grupos: 1=Peito, 2=Costas, 3=Pernas, 4=Ombros, 5=Biceps, 6=Triceps, 7=Abdomen, 8=Cardio

**Relacionamentos**:
- Cliente 1:N Treinos
- Exercicio 1:N Treinos
- Treinos fazem JOIN com clientes e exercicios para exibir dados completos

### Seguranca

**Implementado**:
- Sistema de autenticacao completo com sessoes
- Prepared statements (PDO) previnem SQL injection
- Senhas hasheadas com `password_hash()` (bcrypt)
- Validacao de entrada com `filter_input(INPUT_POST, ...)`
- Middlewares de autenticacao (`checkAuth()`, `checkAdmin()`)

**Nao implementado**:
- Sanitizacao de output nas views (risco XSS - sempre use `htmlspecialchars()`)
- Protecao CSRF
- Rate limiting para login
- Verificacao de email (campo is_admin existe mas nao e usado)

### Models (Active Record Pattern)

Cada model contem metodos CRUD padrao:
- `save()`: INSERT
- `getAll()`: SELECT * com ordenacao
- `getById($id)`: SELECT WHERE id = ?
- `update()`: UPDATE
- `delete()` ou `deleteByTitle()`: DELETE

**Exemplo - Treino com JOINs**:
```php
// models/treino.php
public function getAll() {
    $sql = "SELECT t.*, e.nome_exercicio, e.grupo_muscular, c.nome_completo AS nome_cliente
            FROM treinos_usuarios t
            JOIN exercicios e ON t.id_exercicio = e.id
            JOIN clientes c ON t.id_cliente = c.id
            ORDER BY c.nome_completo, FIELD(t.dia_semana, 'Segunda','Terca','Quarta','Quinta','Sexta','Sabado','Domingo')";
}

public function getAllByCliente($id_cliente) {
    // Retorna apenas treinos do cliente especificado
}
```

### Controllers

Responsabilidades:
- Instanciar models necessarios
- Validar entrada do usuario
- Processar logica de negocio
- Incluir views com dados preparados
- Gerenciar sessoes e autenticacao

**Padrao**:
```php
class ClientesController {
    public function saveClientes() {
        $model = new Clientes();
        $model->nome_completo = filter_input(INPUT_POST, 'nome_completo');
        // ... outros campos
        $model->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $model->save();
        header('Location: /list-clientes');
    }
}
```

### Views

**Organizacao**:
- `semcadastro/`: Paginas publicas (nao requerem login)
- `comcadastro/`: Paginas autenticadas (requerem `AuthController::checkAuth()`)
- `admin/`: Painel administrativo
- CSS e JavaScript inline em cada arquivo PHP
- Sem template engine ou sistema de layouts
- Assets referenciados com caminho absoluto: `/views/midia/...`

**Funcionalidades principais**:
- Homepage com carrossel animado
- Sistema de login e cadastro
- Calculadoras de IMC e calorias
- Gerador de treinos automatico
- Biblioteca de exercicios com filtros
- Perfil de usuario editavel
- Formularios CRUD com validacao JavaScript

## Pontos de Atencao

1. **Autenticacao funcional**: Sistema completo implementado com sessoes. Use `AuthController::checkAuth()` em todas as rotas protegidas.

2. **CSS/JS inline**: Todo estilo e script esta embutido nos arquivos PHP. Para modificar estilos, edite diretamente nas views.

3. **Credenciais hardcoded**: `database.php` possui credenciais diretas (root sem senha). Em producao, use variaveis de ambiente.

4. **Prefixo na URL**: O roteador remove prefixo `/sharkrush` - ajuste se necessario para deploy.

5. **Sem autoloader**: Controllers e Models sao incluidos com `require_once` direto no `index.php`.

6. **Display errors ativado**: `public/index.php` tem `error_reporting(E_ALL)` - desative em producao.

7. **Trigger MySQL**: A geracao automatica de IDs de exercicios depende do trigger `gerar_id_exercicio`. Nao insira IDs manualmente.

8. **Enum dia_semana**: Dias da semana sao ENUM no banco. Valores validos: 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'.

## Adicionando Novas Funcionalidades

### Nova Entidade (CRUD Completo)

1. **Criar Model** (`/models/novaentidade.php`):
```php
<?php
require_once __DIR__ . '/../config/database.php';

class NovaEntidade {
    private $conn;
    private $table_name = 'nova_entidade';

    public $id;
    public $campo1;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO {$this->table_name} (campo1) VALUES (:campo1)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':campo1', $this->campo1);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

2. **Criar Controller** (`/controllers/NovaEntidadeController.php`):
```php
<?php
require_once __DIR__ . '/../models/novaentidade.php';

class NovaEntidadeController {
    public function showForm() {
        include __DIR__ . '/../views/NovaEntidade/form.php';
    }

    public function save() {
        $model = new NovaEntidade();
        $model->campo1 = filter_input(INPUT_POST, 'campo1', FILTER_SANITIZE_STRING);
        $model->save();
        header('Location: /list-novaentidade');
        exit();
    }
}
```

3. **Adicionar Rotas** (`/public/index.php`):
```php
require_once __DIR__ . '/../controllers/NovaEntidadeController.php';

// Dentro do switch:
case '/novaentidade-form':
    AuthController::checkAuth();  // Se rota protegida
    $controller = new NovaEntidadeController();
    $controller->showForm();
    break;

case '/save-novaentidade':
    AuthController::checkAuth();
    $controller = new NovaEntidadeController();
    $controller->save();
    break;
```

4. **Criar Views** em `/views/NovaEntidade/`:
   - `form.php`: Formulario de cadastro
   - `list.php`: Listagem
   - `update_form.php`: Formulario de edicao

### Adicionar Validacao

Sempre use `filter_input()` nos controllers:
```php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {
    header('Location: /form?error=email_invalido');
    exit();
}
```

### Sanitizar Output nas Views

Para prevenir XSS, sempre use:
```php
<?php echo htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8'); ?>
```

### Proteger Rotas

Para rotas que requerem autenticacao:
```php
case '/rota-protegida':
    AuthController::checkAuth();
    // ... resto do codigo
    break;
```

Para rotas administrativas:
```php
case '/admin/painel':
    AuthController::checkAdmin();
    // ... resto do codigo
    break;
```

## Configuracao do Ambiente

### Requisitos
- PHP 7.4+
- MySQL 5.7+ (com suporte a triggers)
- Apache com mod_rewrite ativado (se nao usar servidor embutido)

### Setup Inicial

1. Clone o repositorio
2. Importe o schema completo:
```bash
mysql -u root < script_banco.sql
```

3. Configure credenciais em `/config/database.php` se necessario

4. Inicie o servidor:
```bash
php -S localhost:8000
```

5. Acesse `http://localhost:8000/` e crie um usuario

### Dependencias Externas

- FontAwesome 5.15.4 (CDN) - icones de interface
- Imagens do Unsplash (URLs diretas)
- HTML5 Geolocation API (navegador)

Nao ha gerenciador de pacotes (Composer/NPM) neste projeto.
