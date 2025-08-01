<?php

require_once '../models/Clientes.php';

class ClientesController {

    public function showForm() {
        include '../views/Clientes/clientes_form.php';  
    }

    public function saveClientes() {


            $clientes = new Clientes();
            $clientes->nome_completo = $_POST['nome_completo'];
            $clientes->cpf = $_POST['cpf'];
            $clientes->endereco = $_POST['endereco'];
            $clientes->email = $_POST['email'];
            $clientes->telefone = $_POST['telefone'];
            $clientes->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            if ($clientes->save()) {

                header('Location: /sharkrush/list-clientes');
                exit(); 
            } else {
                echo "Erro ao cadastrar o Cliente.";  
            }
        }
    

    public function listClientes() {
        $clientes = new Clientes();
        $clientesList = $clientes->getAll(); 
        include '../views/Clientes/clientes_list.php'; 
    }

    public function showUpdateForm($id) {
        $clientes = new Clientes();
        $clientesInfo = $clientes->getById($id);  
        include '../views/Clientes/clientes_update_form.php'; 
    }

    public function updateClientes() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientes = new Clientes();
            $clientes->id = $_POST['id'];
            $clientes->nome_completo = $_POST['nome_completo'];
            $clientes->cpf = $_POST['cpf'];
            $clientes->endereco = $_POST['endereco'];
            $clientes->email = $_POST['email'];
            $clientes->telefone = $_POST['telefone'];
            $clientes->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Alterado para usar hashing da senha

            if ($clientes->update()) {
                header('Location: /sharkrush/list-clientes');
                exit(); // Adicionado para garantir que o script pare após o redirecionamento
            } else {
                echo "Erro ao atualizar o Cliente."; 
            }
        }
    }

    public function deleteClientesByTitle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientes = new Clientes();
            $clientes->nome_completo = $_POST['nome_completo'];

            if ($clientes->deleteByTitle()) { 
                header('Location: /sharkrush/list-clientes');
                exit(); 
            } else {
                echo "Erro ao excluir o Cliente."; 
            }
        }
    }
}
?>