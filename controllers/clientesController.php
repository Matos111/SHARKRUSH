<?php

require_once __DIR__ . "/../models/clientes.php";

class ClientesController
{
  public function showForm()
  {
    // Usa o formulário simples de cadastro de clientes
    include __DIR__ . "/../views/Clientes/clientes_form.php";
  }

  public function saveClientes()
  {
    $clientes = new Clientes();
    $clientes->nome_completo = filter_input(
      INPUT_POST,
      "nome_completo",
      FILTER_SANITIZE_SPECIAL_CHARS,
    );
    $clientes->cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
    $clientes->endereco = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_SPECIAL_CHARS);
    $clientes->email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $clientes->telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $clientes->senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Validações básicas
    if (!$clientes->email) {
      header("Location: /cadastro?error=email_invalido");
      exit();
    }

    if ($clientes->save()) {
      // Redireciona para login com mensagem de sucesso
      header("Location: /?success=cadastro");
      exit();
    } else {
      header("Location: /cadastro?error=erro_cadastro");
      exit();
    }
  }

  public function listClientes()
  {
    $clientes = new Clientes();
    $allClientes = $clientes->getAll();

    // Filtrar para excluir administradores da lista
    $clientesList = array_filter($allClientes, function ($cliente) {
      return !isset($cliente["is_admin"]) || $cliente["is_admin"] == 0;
    });

    include __DIR__ . "/../views/Clientes/clientes_list.php";
  }

  public function showUpdateForm($id)
  {
    $clientes = new Clientes();
    $clientesInfo = $clientes->getById($id);
    include __DIR__ . "/../views/Clientes/clientes_update_form.php";
  }

  public function updateClientes()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $clientes = new Clientes();
      $clientes->id = $_POST["id"];
      $clientes->nome_completo = $_POST["nome_completo"];
      $clientes->cpf = $_POST["cpf"];
      $clientes->endereco = $_POST["endereco"];
      $clientes->email = $_POST["email"];
      $clientes->telefone = $_POST["telefone"];

      // So atualizar a senha se uma nova senha foi fornecida
      if (!empty($_POST["senha"])) {
        $clientes->senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
      } else {
        // Manter a senha atual
        $clienteAtual = $clientes->getById($_POST["id"]);
        $clientes->senha = $clienteAtual["senha"];
      }

      if ($clientes->update()) {
        header("Location: /list-clientes");
        exit();
      } else {
        echo "Erro ao atualizar o Cliente.";
      }
    }
  }

  public function deleteClientesByTitle()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $clientes = new Clientes();
      $clientes->nome_completo = $_POST["nome_completo"];

      if ($clientes->deleteByTitle()) {
        header("Location: /sharkrush/list-clientes");
        exit();
      } else {
        echo "Erro ao excluir o Cliente.";
      }
    }
  }
}
?>
