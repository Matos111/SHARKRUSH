<?php

// Iniciar sessão
session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Carrega configuracao da aplicacao (BASE_PATH, funcoes helper)
require_once "../config/app.php";

require_once "../controllers/AuthController.php";
require_once "../controllers/ClientesController.php";
require_once "../controllers/ExerciciosController.php";
require_once "../controllers/TreinosController.php";
require_once "../controllers/PerfilController.php";
require_once "../controllers/MeusTreinosController.php";

// Pega o path da requisicao (com deteccao automatica do base path)
$request = getRequestPath();

switch ($request) {
  // HOME PUBLICA
  case "/":
  case "/public/":
  case "/home":
    include __DIR__ . "/../views/semcadastro/semhomesena.php";
    break;

  // AUTENTICAÇÃO
  case "/login":
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
    // Verificar se e admin e redirecionar para lista de clientes
    if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {
      redirect("/list-clientes");
    }
    // Reutiliza a view existente comhomesena.php para usuarios normais
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

  // API ENDPOINTS - MEUS TREINOS
  case "/api/meus-treinos/listar":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->listarTreinos();
    break;

  case "/api/meus-treinos/detalhes":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->detalhesTreino();
    break;

  case "/api/meus-treinos/criar":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->criarTreino();
    break;

  case "/api/meus-treinos/toggle-exercicio":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->toggleExercicio();
    break;

  case "/api/meus-treinos/atualizar-status":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->atualizarStatus();
    break;

  case "/api/meus-treinos/resetar":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->resetarTreino();
    break;

  case "/api/meus-treinos/deletar":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->deletarTreino();
    break;

  case "/api/meus-treinos/atualizar":
    AuthController::checkAuth();
    $controller = new MeusTreinosController();
    $controller->atualizarTreino();
    break;

  default:
    http_response_code(404);
    echo "Página não encontrada.";
    break;
}
