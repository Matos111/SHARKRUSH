<?php
require_once __DIR__ . "/../config/database.php";

class Treino
{
  private $pdo;

  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
  }

  public function getAllByCliente($id_cliente)
  {
    $sql = "SELECT t.*, e.nome_exercicio, e.grupo_muscular, c.nome_completo AS nome_cliente
                FROM treinos_usuarios t
                JOIN exercicios e ON t.id_exercicio = e.id
                JOIN clientes c ON t.id_cliente = c.id
                WHERE t.id_cliente = :id_cliente
                ORDER BY FIELD(dia_semana, 'Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo')";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":id_cliente" => $id_cliente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAll()
  {
    $sql = "SELECT t.*, e.nome_exercicio, e.grupo_muscular, c.nome_completo AS nome_cliente
                FROM treinos_usuarios t
                JOIN exercicios e ON t.id_exercicio = e.id
                JOIN clientes c ON t.id_cliente = c.id
                ORDER BY c.nome_completo, FIELD(t.dia_semana, 'Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo')";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create(array $dados)
  {
    $sql = "INSERT INTO treinos_usuarios (id_cliente, id_exercicio, series, repeticoes, dia_semana)
                VALUES (:id_cliente, :id_exercicio, :series, :repeticoes, :dia_semana)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":id_cliente" => $dados["id_cliente"],
      ":id_exercicio" => $dados["id_exercicio"],
      ":series" => $dados["series"],
      ":repeticoes" => $dados["repeticoes"],
      ":dia_semana" => $dados["dia_semana"],
    ]);
  }

  public function delete(int $id)
  {
    $sql = "DELETE FROM treinos_usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([":id" => $id]);
  }

  public function getById(int $id)
  {
    $sql = "SELECT * FROM treinos_usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update(array $dados)
  {
    $sql = "UPDATE treinos_usuarios
                SET id_cliente = :id_cliente,  -- Adicionado id_cliente aqui
                    id_exercicio = :id_exercicio,
                    series = :series,
                    repeticoes = :repeticoes,
                    dia_semana = :dia_semana
                WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":id_cliente" => $dados["id_cliente"], // Adicionado id_cliente aqui
      ":id_exercicio" => $dados["id_exercicio"],
      ":series" => $dados["series"],
      ":repeticoes" => $dados["repeticoes"],
      ":dia_semana" => $dados["dia_semana"],
      ":id" => $dados["id"],
    ]);
  }

  // ===== METODOS PARA TREINOS COMPLETOS (GRUPOS) =====

  /**
   * Cria um grupo de treino completo com multiplos exercicios
   */
  public function createGrupoTreino(
    $id_cliente,
    $nome_treino,
    $descricao_treino,
    $dia_semana,
    array $exercicios,
  ) {
    try {
      $this->pdo->beginTransaction();

      // Gera identificador unico para o grupo
      $grupo_treino = "treino_" . time() . "_" . uniqid();

      // Insere cada exercicio do grupo
      $ordem = 1;
      foreach ($exercicios as $exercicio) {
        $sql = "INSERT INTO treinos_usuarios
                (id_cliente, nome_treino, descricao_treino, grupo_treino, status_treino,
                 id_exercicio, series, repeticoes, dia_semana, concluido, ordem_exercicio, data_criacao)
                VALUES
                (:id_cliente, :nome_treino, :descricao_treino, :grupo_treino, 'pending',
                 :id_exercicio, :series, :repeticoes, :dia_semana, FALSE, :ordem_exercicio, NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
          ":id_cliente" => $id_cliente,
          ":nome_treino" => $nome_treino,
          ":descricao_treino" => $descricao_treino,
          ":grupo_treino" => $grupo_treino,
          ":id_exercicio" => $exercicio["id_exercicio"],
          ":series" => $exercicio["series"],
          ":repeticoes" => $exercicio["repeticoes"],
          ":dia_semana" => $dia_semana,
          ":ordem_exercicio" => $ordem++,
        ]);
      }

      $this->pdo->commit();
      return $grupo_treino;
    } catch (Exception $e) {
      $this->pdo->rollBack();
      throw $e;
    }
  }

  /**
   * Busca todos os grupos de treino de um cliente
   */
  public function getGruposTreinoByCliente($id_cliente)
  {
    $sql = "SELECT
              grupo_treino,
              nome_treino,
              descricao_treino,
              dia_semana,
              status_treino,
              MIN(data_criacao) as data_criacao,
              COUNT(*) as total_exercicios,
              SUM(CASE WHEN concluido = TRUE THEN 1 ELSE 0 END) as exercicios_concluidos
            FROM treinos_usuarios
            WHERE id_cliente = :id_cliente
              AND grupo_treino IS NOT NULL
            GROUP BY grupo_treino, nome_treino, descricao_treino, dia_semana, status_treino
            ORDER BY data_criacao DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":id_cliente" => $id_cliente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Busca exercicios de um grupo de treino especifico
   */
  public function getExerciciosByGrupo($grupo_treino)
  {
    $sql = "SELECT
              t.id,
              t.id_exercicio,
              t.series,
              t.repeticoes,
              t.concluido,
              t.ordem_exercicio,
              e.nome_exercicio,
              e.grupo_muscular
            FROM treinos_usuarios t
            LEFT JOIN exercicios e ON t.id_exercicio = e.id
            WHERE t.grupo_treino = :grupo_treino
            ORDER BY t.ordem_exercicio ASC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":grupo_treino" => $grupo_treino]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Atualiza status de conclusao de um exercicio
   */
  public function toggleExercicioConcluido($id_exercicio)
  {
    $sql = "UPDATE treinos_usuarios
            SET concluido = NOT concluido
            WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([":id" => $id_exercicio]);
  }

  /**
   * Atualiza status de um grupo de treino
   */
  public function updateStatusGrupo($grupo_treino, $status)
  {
    $sql = "UPDATE treinos_usuarios
            SET status_treino = :status
            WHERE grupo_treino = :grupo_treino";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":status" => $status,
      ":grupo_treino" => $grupo_treino,
    ]);
  }

  /**
   * Reseta todos exercicios de um grupo (marca como nao concluidos)
   */
  public function resetGrupo($grupo_treino)
  {
    $sql = "UPDATE treinos_usuarios
            SET concluido = FALSE,
                status_treino = 'pending'
            WHERE grupo_treino = :grupo_treino";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([":grupo_treino" => $grupo_treino]);
  }

  /**
   * Deleta um grupo de treino completo
   */
  public function deleteGrupo($grupo_treino)
  {
    $sql = "DELETE FROM treinos_usuarios WHERE grupo_treino = :grupo_treino";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([":grupo_treino" => $grupo_treino]);
  }

  /**
   * Atualiza informacoes basicas de um grupo de treino
   */
  public function updateGrupoInfo($grupo_treino, $nome_treino, $descricao_treino, $dia_semana)
  {
    $sql = "UPDATE treinos_usuarios
            SET nome_treino = :nome_treino,
                descricao_treino = :descricao_treino,
                dia_semana = :dia_semana
            WHERE grupo_treino = :grupo_treino";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":nome_treino" => $nome_treino,
      ":descricao_treino" => $descricao_treino,
      ":dia_semana" => $dia_semana,
      ":grupo_treino" => $grupo_treino,
    ]);
  }

  /**
   * Atualiza um exercicio especifico
   */
  public function updateExercicio($id_exercicio, $id_exercicio_novo, $series, $repeticoes)
  {
    $sql = "UPDATE treinos_usuarios
            SET id_exercicio = :id_exercicio_novo,
                series = :series,
                repeticoes = :repeticoes
            WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":id_exercicio_novo" => $id_exercicio_novo,
      ":series" => $series,
      ":repeticoes" => $repeticoes,
      ":id" => $id_exercicio,
    ]);
  }

  /**
   * Deleta um exercicio especifico
   */
  public function deleteExercicio($id_exercicio)
  {
    $sql = "DELETE FROM treinos_usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([":id" => $id_exercicio]);
  }

  /**
   * Adiciona um novo exercicio a um grupo existente
   */
  public function addExercicioToGrupo($grupo_treino, $id_exercicio, $series, $repeticoes, $ordem)
  {
    $sql = "SELECT nome_treino, descricao_treino, dia_semana, id_cliente, status_treino
            FROM treinos_usuarios
            WHERE grupo_treino = :grupo_treino
            LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":grupo_treino" => $grupo_treino]);
    $grupo_info = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$grupo_info) {
      return false;
    }

    $sql = "INSERT INTO treinos_usuarios
            (id_cliente, nome_treino, descricao_treino, grupo_treino, status_treino,
             id_exercicio, series, repeticoes, dia_semana, concluido, ordem_exercicio, data_criacao)
            VALUES
            (:id_cliente, :nome_treino, :descricao_treino, :grupo_treino, :status_treino,
             :id_exercicio, :series, :repeticoes, :dia_semana, FALSE, :ordem_exercicio, NOW())";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ":id_cliente" => $grupo_info["id_cliente"],
      ":nome_treino" => $grupo_info["nome_treino"],
      ":descricao_treino" => $grupo_info["descricao_treino"],
      ":grupo_treino" => $grupo_treino,
      ":status_treino" => $grupo_info["status_treino"],
      ":id_exercicio" => $id_exercicio,
      ":series" => $series,
      ":repeticoes" => $repeticoes,
      ":dia_semana" => $grupo_info["dia_semana"],
      ":ordem_exercicio" => $ordem,
    ]);
  }
}
