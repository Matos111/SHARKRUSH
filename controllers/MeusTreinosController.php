<?php
require_once __DIR__ . "/../models/treino.php";
require_once __DIR__ . "/../models/exercicio.php";
require_once __DIR__ . "/AuthController.php";

class MeusTreinosController
{
  /**
   * Lista todos os grupos de treino do cliente logado (JSON)
   */
  public function listarTreinos()
  {
    header("Content-Type: application/json");

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    try {
      $treino = new Treino();
      $grupos = $treino->getGruposTreinoByCliente($_SESSION["user_id"]);

      // Formata os dados para o frontend
      $treinos = array_map(function ($grupo) {
        $total = (int) $grupo["total_exercicios"];
        $concluidos = (int) $grupo["exercicios_concluidos"];
        $progress = $total > 0 ? round(($concluidos / $total) * 100) : 0;

        return [
          "id" => $grupo["grupo_treino"],
          "name" => $grupo["nome_treino"],
          "description" => $grupo["descricao_treino"] ?? "",
          "dia_semana" => $grupo["dia_semana"],
          "status" => $grupo["status_treino"],
          "progress" => $progress,
          "createdAt" => date("d/m/Y", strtotime($grupo["data_criacao"])),
        ];
      }, $grupos);

      echo json_encode(["success" => true, "treinos" => $treinos]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao buscar treinos: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Busca detalhes de um treino especifico (JSON)
   */
  public function detalhesTreino()
  {
    header("Content-Type: application/json");

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $grupo_treino = $_GET["id"] ?? null;
    if (!$grupo_treino) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "ID do treino nao fornecido"]);
      return;
    }

    try {
      $treino = new Treino();
      $exercicios = $treino->getExerciciosByGrupo($grupo_treino);

      // Formata exercicios para o frontend
      $exerciciosFormatados = array_map(function ($ex) {
        return [
          "id" => $ex["id"],
          "name" => $ex["nome_exercicio"] ?? "Exercicio sem nome",
          "sets" => $ex["series"],
          "reps" => $ex["repeticoes"],
          "completed" => (bool) $ex["concluido"],
        ];
      }, $exercicios);

      echo json_encode(["success" => true, "exercises" => $exerciciosFormatados]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao buscar detalhes: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Cria um novo grupo de treino (JSON)
   */
  public function criarTreino()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (
      !$data ||
      !isset($data["name"]) ||
      !isset($data["exercises"]) ||
      empty($data["exercises"])
    ) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "Dados invalidos"]);
      return;
    }

    try {
      $exercicioModel = new Exercicio();
      $treinoModel = new Treino();

      $nome_treino = trim($data["name"]);
      $descricao_treino = isset($data["description"]) ? trim($data["description"]) : "";
      $dia_semana = isset($data["dia_semana"]) ? trim($data["dia_semana"]) : "Segunda";

      // Processa os exercicios
      $exercicios = [];
      foreach ($data["exercises"] as $ex) {
        $nome_exercicio = trim($ex["name"]);
        $series = (int) $ex["sets"];
        $repeticoes = (int) $ex["reps"];

        if (empty($nome_exercicio) || $series <= 0 || $repeticoes <= 0) {
          continue;
        }

        // Tenta buscar o exercicio existente ou cria um novo
        $id_exercicio = $exercicioModel->getOrCreate($nome_exercicio, "Cardio", "");

        if ($id_exercicio) {
          $exercicios[] = [
            "id_exercicio" => $id_exercicio,
            "series" => $series,
            "repeticoes" => $repeticoes,
          ];
        }
      }

      if (empty($exercicios)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Nenhum exercicio valido fornecido"]);
        return;
      }

      // Cria o grupo de treino
      $grupo_treino = $treinoModel->createGrupoTreino(
        $_SESSION["user_id"],
        $nome_treino,
        $descricao_treino,
        $dia_semana,
        $exercicios,
      );

      echo json_encode([
        "success" => true,
        "message" => "Treino criado com sucesso!",
        "id" => $grupo_treino,
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao criar treino: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Toggle exercicio concluido/nao concluido (JSON)
   */
  public function toggleExercicio()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $id_exercicio = $data["id_exercicio"] ?? null;
    if (!$id_exercicio) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "ID do exercicio nao fornecido"]);
      return;
    }

    try {
      $treino = new Treino();
      $treino->toggleExercicioConcluido($id_exercicio);

      echo json_encode(["success" => true, "message" => "Status atualizado"]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao atualizar exercicio: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Atualiza status de um grupo de treino (JSON)
   */
  public function atualizarStatus()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $grupo_treino = $data["grupo_treino"] ?? null;
    $status = $data["status"] ?? null;

    if (!$grupo_treino || !$status) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "Dados invalidos"]);
      return;
    }

    try {
      $treino = new Treino();
      $treino->updateStatusGrupo($grupo_treino, $status);

      echo json_encode(["success" => true, "message" => "Status atualizado"]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao atualizar status: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Reseta um grupo de treino (JSON)
   */
  public function resetarTreino()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $grupo_treino = $data["grupo_treino"] ?? null;
    if (!$grupo_treino) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "ID do treino nao fornecido"]);
      return;
    }

    try {
      $treino = new Treino();
      $treino->resetGrupo($grupo_treino);

      echo json_encode(["success" => true, "message" => "Treino resetado com sucesso"]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao resetar treino: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Deleta um grupo de treino (JSON)
   */
  public function deletarTreino()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $grupo_treino = $data["grupo_treino"] ?? null;
    if (!$grupo_treino) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "ID do treino nao fornecido"]);
      return;
    }

    try {
      $treino = new Treino();
      $treino->deleteGrupo($grupo_treino);

      echo json_encode(["success" => true, "message" => "Treino deletado com sucesso"]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao deletar treino: " . $e->getMessage(),
      ]);
    }
  }

  /**
   * Atualiza informacoes basicas de um treino (JSON)
   */
  public function atualizarTreino()
  {
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405);
      echo json_encode(["success" => false, "message" => "Metodo nao permitido"]);
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      echo json_encode(["success" => false, "message" => "Usuario nao autenticado"]);
      return;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $grupo_treino = $data["grupo_treino"] ?? null;
    $nome_treino = $data["nome_treino"] ?? null;
    $descricao_treino = $data["descricao_treino"] ?? "";
    $dia_semana = $data["dia_semana"] ?? null;

    if (!$grupo_treino || !$nome_treino || !$dia_semana) {
      http_response_code(400);
      echo json_encode(["success" => false, "message" => "Dados incompletos"]);
      return;
    }

    try {
      $treino = new Treino();
      $treino->updateGrupoInfo($grupo_treino, $nome_treino, $descricao_treino, $dia_semana);

      echo json_encode(["success" => true, "message" => "Treino atualizado com sucesso"]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        "success" => false,
        "message" => "Erro ao atualizar treino: " . $e->getMessage(),
      ]);
    }
  }
}
