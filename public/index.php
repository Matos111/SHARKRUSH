<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/ClientesController.php'; 
require_once '../controllers/SessoesController.php'; 
require_once '../models/sessoes.php';

$pdo = new PDO('mysql:host=localhost;dbname=sharkrush', 'root', '');

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/sharkrush/public/':
        $controller = new ClientesController();
        $controller->showForm();
        break;

    case '/sharkrush/save-clientes':
        $controller = new ClientesController();
        $controller->saveClientes();
        break;
        
    case '/sharkrush/list-clientes':
        $controller = new ClientesController();
        $controller->listClientes();
        break;

    case '/sharkrush/delete-clientes':
        $controller = new ClientesController();
        $controller->deleteClientesByTitle();
        break;

    case (preg_match('/\/sharkrush\/update-clientes\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new ClientesController();
        $controller->showUpdateForm($id);
        break;

    case '/sharkrush/update-clientes':
        $controller = new ClientesController();
        $controller->updateClientes();
        break;

    case '/sharkrush/create-sessoes':
        $controller = new SessoesController($pdo);
        $controller->create();
        break;

    case '/sharkrush/list-sessoes':
        $controller = new SessoesController($pdo);
        $controller->store($_POST);
        break;

    case '/sharkrush/editar-sessoes':
        $controller = new SessoesController($pdo);
        $controller->edit($_GET['id']);
        break;

    case '/sharkrush/atualizar-sessoes':
        $controller = new SessoesController($pdo);
        $controller->update($_POST);
        break;

    case '/sharkrush/deletar-sessoes':
        $controller = new SessoesController($pdo);
        $controller->delete($_GET['id']);
        break;

    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
}
    