<?php

require_once __DIR__ . "/../models/clientes.php";

class AuthController
{
  /**
   * Exibe o formulário de login
   */
  public function showLoginForm()
  {
    // Se já estiver logado, redireciona para o dashboard
    if (isset($_SESSION["user_id"])) {
      header("Location: " . (defined('BASE_URL') ? BASE_URL : '') . "/dashboard");
      exit();
    }

    include __DIR__ . "/../views/semcadastro/semlogin.php";
  }

  /**
   * Processa o login do usuário
   */
  public function login()
  {
    // Validar se é POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      header("Location: " . (defined('BASE_URL') ? BASE_URL : '') . "/");
      exit();
    }

    // Pegar dados do formulário
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"] ?? "";

    // Validações básicas
    $baseUrl = defined('BASE_URL') ? BASE_URL : '';
    if (!$email) {
      header("Location: " . $baseUrl . "/login?error=email_invalido");
      exit();
    }

    if (empty($senha)) {
      header("Location: " . $baseUrl . "/login?error=senha_vazia");
      exit();
    }

    // Buscar usuário no banco
    $clienteModel = new Clientes();
    $usuario = $clienteModel->getByEmail($email);

    // Debug - ver o que retornou
    error_log("getByEmail retornou: " . print_r($usuario, true));

    // Verificar se usuário existe
    if (!$usuario || empty($usuario)) {
      error_log("Login falhou: usuario nao encontrado - email: " . $email);
      header("Location: " . $baseUrl . "/login?error=credenciais_invalidas");
      exit();
    }

    // Verificar se o campo id existe (suporta tanto 'id' quanto 'id_cliente')
    $userId = $usuario["id"] ?? $usuario["id_cliente"] ?? null;
    if (!$userId) {
      error_log("Login falhou: campo id nao existe no resultado - usuario: " . print_r($usuario, true));
      header("Location: " . $baseUrl . "/login?error=credenciais_invalidas");
      exit();
    }

    // Verificar senha
    if (!password_verify($senha, $usuario["senha"])) {
      error_log("Login falhou: senha incorreta - email: " . $email);
      header("Location: " . $baseUrl . "/login?error=credenciais_invalidas");
      exit();
    }

    // Login bem-sucedido - criar sessão
    $_SESSION["user_id"] = $userId;
    $_SESSION["user_name"] = $usuario["nome_completo"];
    $_SESSION["user_email"] = $usuario["email"];
    $_SESSION["logged_in"] = true;

    // Verificar se é admin (campo futuro)
    $_SESSION["is_admin"] = isset($usuario["is_admin"]) ? (bool) $usuario["is_admin"] : false;

    // Debug - remover depois
    error_log("Login OK - user_id: " . $_SESSION["user_id"] . " - session_id: " . session_id());

    // Redirecionar para dashboard
    header("Location: " . $baseUrl . "/dashboard");
    exit();
  }

  /**
   * Encerra a sessão do usuário
   */
  public function logout()
  {
    // Limpar todas as variáveis de sessão
    $_SESSION = [];

    // Destruir o cookie de sessão
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), "", time() - 42000, "/");
    }

    // Destruir a sessão
    session_destroy();

    // Redirecionar para login
    header("Location: " . (defined('BASE_URL') ? BASE_URL : '') . "/");
    exit();
  }

  /**
   * Middleware: Verifica se o usuário está autenticado
   * Redireciona para login se não estiver
   */
  public static function checkAuth()
  {
    // Debug temporário - remover depois
    error_log("checkAuth - session_id: " . session_id());
    error_log("checkAuth - user_id: " . ($_SESSION["user_id"] ?? "NAO EXISTE"));
    error_log("checkAuth - logged_in: " . ($_SESSION["logged_in"] ?? "NAO EXISTE"));
    error_log("checkAuth - session_status: " . session_status());

    if (!isset($_SESSION["user_id"]) || !isset($_SESSION["logged_in"])) {
      header("Location: " . (defined('BASE_URL') ? BASE_URL : '') . "/login?error=acesso_negado");
      exit();
    }
    return true;
  }

  /**
   * Middleware: Verifica se o usuário é admin
   */
  public static function checkAdmin()
  {
    self::checkAuth();

    if (!isset($_SESSION["is_admin"]) || !$_SESSION["is_admin"]) {
      header("Location: " . (defined('BASE_URL') ? BASE_URL : '') . "/dashboard?error=acesso_negado");
      exit();
    }
    return true;
  }

  /**
   * Retorna os dados do usuário logado
   */
  public static function getCurrentUser()
  {
    if (isset($_SESSION["user_id"])) {
      return [
        "id" => $_SESSION["user_id"],
        "nome" => $_SESSION["user_name"] ?? "",
        "email" => $_SESSION["user_email"] ?? "",
        "is_admin" => $_SESSION["is_admin"] ?? false,
      ];
    }
    return null;
  }
}
