<?php

require_once "../config/database.php";

class Clientes
{
  private $conn;
  private $table_name = "clientes";

  public $id;
  public $nome_completo;
  public $cpf;
  public $endereco;
  public $email;
  public $telefone;
  public $senha;

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
      "(nome_completo, cpf, endereco, email, telefone, senha) VALUES (:nome_completo, :cpf, :endereco, :email, :telefone, :senha)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":nome_completo", $this->nome_completo);
    $stmt->bindParam(":cpf", $this->cpf);
    $stmt->bindParam(":endereco", $this->endereco);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":telefone", $this->telefone);
    $stmt->bindParam(":senha", $this->senha);

    return $stmt->execute();
  }

  public function getAll()
  {
    $query = "SELECT * FROM " . $this->table_name;
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

  public function getByEmail($email)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update()
  {
    $query =
      "UPDATE " .
      $this->table_name .
      " SET nome_completo = :nome_completo, cpf = :cpf, endereco = :endereco, email = :email, telefone = :telefone, senha = :senha WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":nome_completo", $this->nome_completo);
    $stmt->bindParam(":cpf", $this->cpf);
    $stmt->bindParam(":endereco", $this->endereco);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":telefone", $this->telefone);
    $stmt->bindParam(":senha", $this->senha);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }

  public function deleteByTitle()
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE nome_completo = :nome_completo";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":nome_completo", $this->nome_completo);

    return $stmt->execute();
  }
}
