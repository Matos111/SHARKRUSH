<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/ClientesController.php';
require_once '../controllers/ExerciciosController.php';
require_once '../controllers/TreinosController.php';

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    // CLIENTES
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

    // EXERCÍCIOS
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

// TREINOS
    case '/sharkrush/treino-form': 
        $controller = new TreinosController();
        $controller->showForm();
        break;

    case '/sharkrush/save-treino':
        $controller = new TreinosController();
        $controller->saveTreino();
        break;

    case '/sharkrush/list-treino':
        $controller = new TreinosController();
        $controller->listTreinos();
        break;

    case '/sharkrush/delete-treino':
        $controller = new TreinosController();
        $controller->deleteTreino();
        break;

    case (preg_match('/\/sharkrush\/update-treino\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new TreinosController();
        $controller->showUpdateForm($id);
        break;

    case '/sharkrush/update-treino':
        $controller = new TreinosController();
        $controller->updateTreino();
        break;


    default:
        http_response_code(404);
        echo "Página não encontrada.";
        break;
}
