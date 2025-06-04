<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/ClientesController.php'; 
require_once '../controllers/SessoesController.php'; 

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/sharkrush/public/':
        $controller = new ClientesController();
        $controller->showForm();
        break;

    case '/sharkrush/save-clientes':
      
        $controller = new ClientesController(); // 
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
        $id = $matches[1];  // Captura o ID da URL
        $controller = new ClientesController();  
        $controller->showUpdateForm($id);  // Passa o ID para a função de exibir o formulário
        break;
            
    case '/sharkrush/update-clientes':
        $controller = new ClientesController();  
        $controller->updateClientes(); 
        break;

        default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;

    
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST);
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_POST);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
}
    