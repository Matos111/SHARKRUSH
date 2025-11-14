<?php

// Iniciar sessão
session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once "../controllers/AuthController.php";
require_once "../controllers/ClientesController.php";
require_once "../controllers/ExerciciosController.php";
require_once "../controllers/TreinosController.php";
require_once "../controllers/PerfilController.php";

// Pega a URL atual
$request = $_SERVER["REQUEST_URI"];

// Remove query string, se existir
if (strpos($request, "?") !== false) {
  $request = strstr($request, "?", true);
}

// Remove o prefixo /sharkrush da URL
$request = str_replace("/sharkrush", "", $request);

switch ($request) {
  // AUTENTICAÇÃO
  case "/":
  case "/public/":
    $controller = new AuthController();
    $controller->showLoginForm();
    break;

  case "/authenticate":
    $controller = new AuthController();
    $controller->login();
    break;

  case "/logout":
    $controller = new AuthController();
    $controller->logout();
    break;

  case "/dashboard":
    AuthController::checkAuth();
    // Reutiliza a view existente comhomesena.php
    include __DIR__ . "/../views/comcadastro/comhomesena.php";
    break;

  case "/perfil":
    AuthController::checkAuth();
    $controller = new PerfilController();
    $controller->showProfile();
    break;

  case "/update-perfil":
    AuthController::checkAuth();
    $controller = new PerfilController();
    $controller->updateProfile();
    break;

  case "/update-senha":
    AuthController::checkAuth();
    $controller = new PerfilController();
    $controller->updatePassword();
    break;

  case "/calculadora-imc":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/comcalculoimc.php";
    break;

  case "/calculadora-calorias":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/comcalculocalorias.php";
    break;

  // CLIENTES
  case "/cadastro":
    $controller = new ClientesController();
    $controller->showForm();
    break;

  case "/save-clientes":
    $controller = new ClientesController();
    $controller->saveClientes();
    break;

  case "/list-clientes":
    $controller = new ClientesController();
    $controller->listClientes();
    break;

  case "/delete-clientes":
    $controller = new ClientesController();
    $controller->deleteClientesByTitle();
    break;

  case preg_match("/\/update-clientes\/(\d+)/", $request, $matches) ? true : false:
    $id = $matches[1];
    $controller = new ClientesController();
    $controller->showUpdateForm($id);
    break;

  case "/update-clientes":
    $controller = new ClientesController();
    $controller->updateClientes();
    break;

  // EXERCÍCIOS
  case "/public-exercicio":
    $controller = new ExerciciosController();
    $controller->showForm();
    break;

  case "/save-exercicio":
    $controller = new ExerciciosController();
    $controller->saveExercicio();
    break;

  case "/list-exercicio":
    $controller = new ExerciciosController();
    $controller->listExercicios();
    break;

  case "/delete-exercicio":
    $controller = new ExerciciosController();
    $controller->deleteExercicio();
    break;

  case preg_match("/\/update-exercicio\/([A-Za-z0-9]+)/", $request, $matches) ? true : false:
    $id = $matches[1];
    $controller = new ExerciciosController();
    $controller->showUpdateForm($id);
    break;

  case "/update-exercicio":
    $controller = new ExerciciosController();
    $controller->updateExercicio();
    break;

  // TREINOS
  case "/treino-form":
    $controller = new TreinosController();
    $controller->showForm();
    break;

  case "/save-treino":
    $controller = new TreinosController();
    $controller->saveTreino();
    break;

  case "/list-treino":
    $controller = new TreinosController();
    $controller->listTreinos();
    break;

  case "/delete-treino":
    $controller = new TreinosController();
    $controller->deleteTreino();
    break;

  case preg_match("/\/update-treino\/(\d+)/", $request, $matches) ? true : false:
    $id = $matches[1];
    $controller = new TreinosController();
    $controller->showUpdateForm($id);
    break;

  case "/update-treino":
    $controller = new TreinosController();
    $controller->updateTreino();
    break;

  case "/api/save-workout-generator":
    $controller = new TreinosController();
    $controller->saveWorkoutFromGenerator();
    break;

  case "/gerador-treino":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/comgerador.php";
    break;

  case "/sobre":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/comsobresena.php";
    break;

  case "/biblioteca":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/combibliotecasena.php";
    break;

  case "/meus-treinos":
    AuthController::checkAuth();
    include __DIR__ . "/../views/comcadastro/commeustreinossena.php";
    break;

  default:
    http_response_code(404);
    echo "Página não encontrada.";
    break;
}
