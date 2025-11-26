<?php

require_once __DIR__ . "/../models/clientes.php";

class AuthController
{
  /**
   * Exibe o formulário de login
   */
  public function login() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = $_POST["email"] ?? "";
      $senha = $_POST["senha"] ?? "";

      // Validação básica
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . BASE_URL . "/login?error=email_invalido");
        exit();
      }
      if (empty($senha)) {
        header("Location: " . BASE_URL . "/login?error=senha_vazia");
        exit();
      }

      // Login admin hardcoded
      if ($email === "admin@sharkrush.com" && $senha === "admin123") {
        $_SESSION["user_id"] = 0;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_nome"] = "Administrador";
        $_SESSION["is_admin"] = 1;
        header("Location: " . BASE_URL . "/list-clientes");
        exit();
      }

      // Aqui você faria a consulta ao banco de dados para autenticar o usuário
      // Exemplo simplificado:
      $user = $this->findUserByEmail($email);
      if ($user && password_verify($senha, $user["senha_hash"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_email"] = $user["email"];
        $_SESSION["user_nome"] = $user["nome"];
        $_SESSION["is_admin"] = $user["is_admin"] ?? 0;
        header("Location: " . BASE_URL . "/dashboard");
        exit();
      } else {
        header("Location: " . BASE_URL . "/login?error=credenciais_invalidas");
        exit();
      }
    } else {
      header("Location: " . BASE_URL . "/login");
      exit();
    }
  }
// ...código removido pois estava fora de qualquer função e duplicado...

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
