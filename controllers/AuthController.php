<?php

require_once __DIR__ . "/../models/clientes.php";
require_once __DIR__ . "/../config/app.php";

class AuthController
{
  /**
   * Exibe o formulário de login
   */
  public function showLoginForm()
  {
    // Se já estiver logado, redireciona para o dashboard
    if (isset($_SESSION["user_id"])) {
      redirect("/dashboard");
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
      redirect("/");
    }

    // Pegar dados do formulário
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"] ?? "";

    // Validações básicas
    if (!$email) {
      redirect("/login", ["error" => "email_invalido"]);
    }

    if (empty($senha)) {
      redirect("/login", ["error" => "senha_vazia"]);
    }

    // Buscar usuário no banco
    $clienteModel = new Clientes();
    $usuario = $clienteModel->getByEmail($email);

    // Verificar se usuário existe
    if (!$usuario) {
      redirect("/login", ["error" => "credenciais_invalidas"]);
    }

    // Verificar senha
    if (!password_verify($senha, $usuario["senha"])) {
      redirect("/login", ["error" => "credenciais_invalidas"]);
    }

    // Login bem-sucedido - criar sessão
    $_SESSION["user_id"] = $usuario["id"];
    $_SESSION["user_name"] = $usuario["nome_completo"];
    $_SESSION["user_email"] = $usuario["email"];
    $_SESSION["logged_in"] = true;

    // Verificar se é admin (campo futuro)
    $_SESSION["is_admin"] = isset($usuario["is_admin"]) ? (bool) $usuario["is_admin"] : false;

    // Redirecionar para dashboard
    redirect("/dashboard");
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
    redirect("/");
  }

  /**
   * Middleware: Verifica se o usuário está autenticado
   * Redireciona para login se não estiver
   */
  public static function checkAuth()
  {
    if (!isset($_SESSION["user_id"]) || !isset($_SESSION["logged_in"])) {
      redirect("/login", ["error" => "acesso_negado"]);
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
      redirect("/dashboard", ["error" => "acesso_negado"]);
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
