<?php
require_once __DIR__ . "/../models/treino.php";
require_once __DIR__ . "/../models/exercicio.php";
require_once __DIR__ . "/../models/clientes.php";
require_once __DIR__ . "/../config/app.php";

class TreinosController
{
  public function showForm()
  {
    $clientesModel = new Clientes();
    $exerciciosModel = new Exercicio();

    $clientesList = $clientesModel->getAll(); // Corrigido para chamar o método correto
    $exerciciosList = $exerciciosModel->getAll();

    include __DIR__ . "/../views/Treinos/treino_form.php";
  }

  public function saveTreino()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $treino = new Treino();
      // Boa prática: validar e sanitizar os dados de entrada
      $id_cliente = filter_input(INPUT_POST, "id_cliente", FILTER_VALIDATE_INT);
      $id_exercicio = filter_input(INPUT_POST, "id_exercicio", FILTER_VALIDATE_INT);
      $series = filter_input(INPUT_POST, "series", FILTER_SANITIZE_STRING); // Ou FILTER_VALIDATE_INT se for apenas número
      $repeticoes = filter_input(INPUT_POST, "repeticoes", FILTER_SANITIZE_STRING); // Ou FILTER_VALIDATE_INT
      $dia_semana = filter_input(INPUT_POST, "dia_semana", FILTER_SANITIZE_STRING);

      // Verifica se todos os dados essenciais são válidos
      if (
        $id_cliente === false ||
        $id_exercicio === false ||
        !$series ||
        !$repeticoes ||
        !$dia_semana
      ) {
        echo "Dados inválidos para cadastro do treino. Verifique os campos.";
        return;
      }

      // Seu modelo Treino::create espera um array de dados
      $dados = [
        "id_cliente" => $id_cliente,
        "id_exercicio" => $id_exercicio,
        "series" => $series,
        "repeticoes" => $repeticoes,
        "dia_semana" => $dia_semana,
      ];

      if ($treino->create($dados)) {
        // Passando um array
        redirect("/list-treino");
      } else {
        echo "Erro ao cadastrar o treino.";
      }
    } else {
      http_response_code(405); // Método não permitido
      echo "Erro 405: Método não permitido para salvar treino.";
    }
  }

  public function listTreinos()
  {
    $treino = new Treino();
    // Presumo que getAll() no modelo Treino retorna os dados com nome_cliente e nome_exercicio
    $treinos = $treino->getAll(); // Sua view espera a variável $treinos

    include __DIR__ . "/../views/Treinos/treino_list.php";
  }

  public function showUpdateForm($id_raw)
  {
    $id = filter_var($id_raw, FILTER_VALIDATE_INT); // Valida o ID da URL
    if ($id === false) {
      redirect("/list-treino", ["error" => "id_invalido"]);
    }

    $treino = new Treino();
    $treinoInfo = $treino->getById($id);

    if (!$treinoInfo) {
      redirect("/list-treino", ["error" => "treino_nao_encontrado"]);
    }

    $clientesModel = new Clientes();
    $exerciciosModel = new Exercicio();

    $clientesList = $clientesModel->getAll(); // Corrigido para chamar o método correto
    $exerciciosList = $exerciciosModel->getAll();

    include __DIR__ . "/../views/Treinos/treino_update_form.php";
  }

  public function updateTreino()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $treino = new Treino();
      // Validação e sanitização
      $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
      $id_cliente = filter_input(INPUT_POST, "id_cliente", FILTER_VALIDATE_INT); // Lendo id_cliente do POST
      $id_exercicio = filter_input(INPUT_POST, "id_exercicio", FILTER_VALIDATE_INT);
      $series = filter_input(INPUT_POST, "series", FILTER_SANITIZE_STRING);
      $repeticoes = filter_input(INPUT_POST, "repeticoes", FILTER_SANITIZE_STRING);
      $dia_semana = filter_input(INPUT_POST, "dia_semana", FILTER_SANITIZE_STRING);

      if (
        $id === false ||
        $id_cliente === false ||
        $id_exercicio === false ||
        !$series ||
        !$repeticoes ||
        !$dia_semana
      ) {
        echo "Dados inválidos para atualização do treino.";
        return;
      }

      // Passando id_cliente para o array de dados para o modelo
      $dados = [
        "id" => $id,
        "id_cliente" => $id_cliente,
        "id_exercicio" => $id_exercicio,
        "series" => $series,
        "repeticoes" => $repeticoes,
        "dia_semana" => $dia_semana,
      ];

      if ($treino->update($dados)) {
        redirect("/list-treino");
      } else {
        echo "Erro ao atualizar o treino.";
      }
    } else {
      http_response_code(405);
      echo "Erro 405: Método não permitido para atualizar treino.";
    }
  }

  public function deleteTreino()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $treino = new Treino();
      $id_to_delete = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

      if ($id_to_delete === false) {
        echo "ID do treino inválido para exclusão.";
        return;
      }

      if ($treino->delete($id_to_delete)) {
        redirect("/list-treino");
      } else {
        echo "Erro ao excluir o treino.";
      }
    } else {
      http_response_code(405);
      echo "Erro 405: Método não permitido para deletar treino.";
    }
  }

  private function mapMuscleGroupToDatabase($muscle)
  {
    $mapping = [
      "shoulder" => "Ombros",
      "arm" => "Bíceps",
      "cheast" => "Peito",
      "stomach" => "Abdômen",
      "legs" => "Pernas",
      "head" => "Cardio",
      "hands" => "Tríceps",
    ];

    return isset($mapping[$muscle]) ? $mapping[$muscle] : "Cardio";
  }

  public function saveWorkoutFromGenerator()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Método não permitido"]);
      return;
    }

    session_start();

    if (!isset($_SESSION["cliente_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuário não autenticado"]);
      return;
    }

    $id_cliente = $_SESSION["cliente_id"];

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (!$data || !isset($data["exercises"]) || !is_array($data["exercises"])) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "Dados inválidos"]);
      return;
    }

    $dia_semana = isset($data["dia_semana"]) ? $data["dia_semana"] : "Segunda";
    $exercises = $data["exercises"];

    if (empty($exercises)) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "Nenhum exercício selecionado"]);
      return;
    }

    try {
      $treino = new Treino();
      $exercicioModel = new Exercicio();
      $saved_count = 0;

      foreach ($exercises as $exercise) {
        $nome_exercicio = isset($exercise["name"]) ? trim($exercise["name"]) : "";
        $muscle_frontend = isset($exercise["muscle"]) ? trim($exercise["muscle"]) : "";
        $sets = isset($exercise["sets"]) ? trim($exercise["sets"]) : "3x12";

        if (empty($nome_exercicio) || empty($muscle_frontend)) {
          continue;
        }

        $grupo_muscular = $this->mapMuscleGroupToDatabase($muscle_frontend);
        $descricao = isset($exercise["description"]) ? trim($exercise["description"]) : "";

        $id_exercicio = $exercicioModel->getOrCreate($nome_exercicio, $grupo_muscular, $descricao);

        if (!$id_exercicio) {
          continue;
        }

        preg_match("/(\d+)\s*x\s*(\d+)/", $sets, $matches);
        $series = isset($matches[1]) ? $matches[1] : "3";
        $repeticoes = isset($matches[2]) ? $matches[2] : "12";

        $dados = [
          "id_cliente" => $id_cliente,
          "id_exercicio" => $id_exercicio,
          "series" => $series,
          "repeticoes" => $repeticoes,
          "dia_semana" => $dia_semana,
        ];

        if ($treino->create($dados)) {
          $saved_count++;
        }
      }

      if ($saved_count > 0) {
        echo json_encode([
          "success" => true,
          "message" => "Treino salvo com sucesso! $saved_count exercícios adicionados.",
          "count" => $saved_count,
        ]);
      } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Nenhum exercício foi salvo"]);
      }
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao salvar treino: " . $e->getMessage(),
      ]);
    }
  }
}
