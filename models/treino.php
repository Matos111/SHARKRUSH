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
}
