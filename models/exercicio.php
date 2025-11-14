<?php

require_once __DIR__ . "/../config/database.php";

class Exercicio
{
  private $conn;
  private $table_name = "exercicios";

  public $id;
  public $grupo_muscular;
  public $nome_exercicio;
  public $descricao;

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function save()
  {
    $query =
      "INSERT INTO " .
      $this->table_name .
      " (grupo_muscular, nome_exercicio, descricao) VALUES (:grupo_muscular, :nome_exercicio, :descricao)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":grupo_muscular", $this->grupo_muscular);
    $stmt->bindParam(":nome_exercicio", $this->nome_exercicio);
    $stmt->bindParam(":descricao", $this->descricao);

    return $stmt->execute();
  }

  public function getAll()
  {
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update()
  {
    $query =
      "UPDATE " .
      $this->table_name .
      " SET grupo_muscular = :grupo_muscular, nome_exercicio = :nome_exercicio, descricao = :descricao WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":grupo_muscular", $this->grupo_muscular);
    $stmt->bindParam(":nome_exercicio", $this->nome_exercicio);
    $stmt->bindParam(":descricao", $this->descricao);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }

  public function deleteById()
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }

  public function getByNomeAndGrupo($nome_exercicio, $grupo_muscular)
  {
    $query =
      "SELECT * FROM " .
      $this->table_name .
      " WHERE nome_exercicio = :nome_exercicio AND grupo_muscular = :grupo_muscular LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":nome_exercicio", $nome_exercicio);
    $stmt->bindParam(":grupo_muscular", $grupo_muscular);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getOrCreate($nome_exercicio, $grupo_muscular, $descricao = "")
  {
    $existing = $this->getByNomeAndGrupo($nome_exercicio, $grupo_muscular);

    if ($existing) {
      return $existing["id"];
    }

    $this->nome_exercicio = $nome_exercicio;
    $this->grupo_muscular = $grupo_muscular;
    $this->descricao = $descricao;

    if ($this->save()) {
      $created = $this->getByNomeAndGrupo($nome_exercicio, $grupo_muscular);
      return $created ? $created["id"] : false;
    }

    return false;
  }
}
