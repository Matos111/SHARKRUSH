<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/ClientesController.php'; 
require_once '../controllers/SessoesController.php'; 
require_once '../controllers/ExerciciosController.php';
require_once '../models/sessoes.php';

$pdo = new PDO('mysql:host=localhost;dbname=sharkrush', 'root', '');

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    //CLIENTES
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


    //EXERCÍCIOS
    case '/sharkrush/public-exercicio': 
        $controller = new ExerciciosController();
        $controller->showForm();
        break;

    case '/sharkrush/save-exercicio': 
        $controller = new ExerciciosController();
        $controller->saveExercicio();
        break;

    case '/sharkrush/list-exercicio': 
        $controller = new ExerciciosController();
        $controller->listExercicios();
        break;

    case '/sharkrush/delete-exercicio':
        $controller = new ExerciciosController();
        $controller->deleteExercicio(); 
        break;

    case (preg_match('/\/sharkrush\/update-exercicio\/([A-Za-z0-9]+)/', $request, $matches) ? true : false): 
        $id = $matches[1];
        $controller = new ExerciciosController();
        $controller->showUpdateForm($id);
        break;

    case '/sharkrush/update-exercicio': 
        $controller = new ExerciciosController();
        $controller->updateExercicio();
        break;

    //SESSÕES
    case '/sharkrush/save-sessoes':
        $controller = new SessoesController();
        $controller->saveSessoes();
        break;
            
    case '/sharkrush/list-sessoes':
        $controller = new SessoesController();
        $controller->listSessoes();
        break;
    
    case '/sharkrush/delete-sessoes':
        $controller = new SessoesController();
        $controller->deleteSessaoByID();
        break;
    
    case (preg_match('/\/sharkrush\/update-sessoes\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new SessoesController();
        $controller->showUpdateForm($id);
        break;

    
    case '/sharkrush/update-sessoes':
        $controller = new SessoesController();
        $controller->updateSessoes();
        break;

    case '/sharkrush/sessoes':
        $controller = new SessoesController();
        $controller->showForm();
        break;

    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
}
    