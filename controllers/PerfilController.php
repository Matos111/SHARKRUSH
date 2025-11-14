<?php

require_once __DIR__ . "/../models/clientes.php";

class PerfilController
{
  /**
   * Exibe a página de perfil do usuário logado
   */
  public function showProfile()
  {
    // Verificar se há usuário logado
    if (!isset($_SESSION["user_id"])) {
      header("Location: /?error=acesso_negado");
      exit();
    }

    // Buscar dados do usuário no banco
    $clienteModel = new Clientes();
    $usuario = $clienteModel->getById($_SESSION["user_id"]);

    // Se não encontrar o usuário, desloga
    if (!$usuario) {
      header("Location: /logout");
      exit();
    }

    // Disponibilizar dados para a view
    $userData = [
      "id" => $usuario["id"],
      "nome_completo" => $usuario["nome_completo"],
      "email" => $usuario["email"],
      "telefone" => $usuario["telefone"] ?? "",
      "cpf" => $usuario["cpf"] ?? "",
      "endereco" => $usuario["endereco"] ?? "",
    ];

    // Incluir a view de perfil
    include __DIR__ . "/../views/comcadastro/comperfil.php";
  }

  /**
   * Atualiza os dados pessoais do usuário
   */
  public function updateProfile()
  {
    // Verificar se é POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      header("Location: /perfil");
      exit();
    }

    // Verificar se há usuário logado
    if (!isset($_SESSION["user_id"])) {
      header("Location: /?error=acesso_negado");
      exit();
    }

    // Pegar dados do formulário
    $nome_completo = filter_input(INPUT_POST, "nome_completo", FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    // Buscar cliente
    $clienteModel = new Clientes();
    $usuario = $clienteModel->getById($_SESSION["user_id"]);

    if (!$usuario) {
      header("Location: /logout");
      exit();
    }

    // Se email foi fornecido e é diferente, verificar se já existe
    if ($email && $email !== $usuario["email"]) {
      $emailExistente = $clienteModel->getByEmail($email);
      if ($emailExistente && $emailExistente["id"] != $_SESSION["user_id"]) {
        header("Location: /perfil?error=email_ja_existe");
        exit();
      }
    }

    // Atualizar dados
    $clienteModel->id = $_SESSION["user_id"];
    $clienteModel->nome_completo = $nome_completo ?: $usuario["nome_completo"];
    $clienteModel->telefone = $telefone ?: $usuario["telefone"];
    $clienteModel->cpf = $cpf ?: $usuario["cpf"];
    $clienteModel->endereco = $endereco ?: $usuario["endereco"];
    $clienteModel->email = $email ?: $usuario["email"];
    $clienteModel->senha = $usuario["senha"]; // Senha não muda nesta ação

    if ($clienteModel->update()) {
      // Atualizar sessão
      $_SESSION["user_name"] = $nome_completo ?: $usuario["nome_completo"];
      $_SESSION["user_email"] = $email ?: $usuario["email"];
      header("Location: /perfil?success=atualizado");
    } else {
      header("Location: /perfil?error=falha_atualizacao");
    }
    exit();
  }

  /**
   * Atualiza a senha do usuário
   */
  public function updatePassword()
  {
    // Verificar se é POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      header("Location: /perfil");
      exit();
    }

    // Verificar se há usuário logado
    if (!isset($_SESSION["user_id"])) {
      header("Location: /?error=acesso_negado");
      exit();
    }

    // Pegar dados do formulário
    $senhaAtual = $_POST["senha_atual"] ?? "";
    $novaSenha = $_POST["nova_senha"] ?? "";
    $confirmaSenha = $_POST["confirma_senha"] ?? "";

    // Validações
    if (empty($senhaAtual) || empty($novaSenha) || empty($confirmaSenha)) {
      header("Location: /perfil?error=campos_vazios");
      exit();
    }

    if ($novaSenha !== $confirmaSenha) {
      header("Location: /perfil?error=senhas_nao_conferem");
      exit();
    }

    if (strlen($novaSenha) < 8) {
      header("Location: /perfil?error=senha_curta");
      exit();
    }

    // Buscar cliente
    $clienteModel = new Clientes();
    $usuario = $clienteModel->getById($_SESSION["user_id"]);

    if (!$usuario) {
      header("Location: /logout");
      exit();
    }

    // Verificar senha atual
    if (!password_verify($senhaAtual, $usuario["senha"])) {
      header("Location: /perfil?error=senha_incorreta");
      exit();
    }

    // Atualizar senha
    $clienteModel->id = $_SESSION["user_id"];
    $clienteModel->nome_completo = $usuario["nome_completo"];
    $clienteModel->cpf = $usuario["cpf"];
    $clienteModel->endereco = $usuario["endereco"];
    $clienteModel->email = $usuario["email"];
    $clienteModel->telefone = $usuario["telefone"];
    $clienteModel->senha = password_hash($novaSenha, PASSWORD_DEFAULT);

    if ($clienteModel->update()) {
      // Encerrar sessão após troca de senha
      session_destroy();
      header("Location: /?success=senha_alterada");
    } else {
      header("Location: /perfil?error=falha_atualizacao");
    }
    exit();
  }
}
