<?php

require_once '../config/database.php';

class Treino {
    private $conn;
    private $table_name = "treinos_usuarios";

    public $id;
    public $data_criacao;
    public $dia_semana;
    public $grupo_muscular;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para salvar um livro
    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (data_criacao, dia_semana, grupo_muscular) VALUES (:data_criacao, :dia_semana, :grupo_muscular)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':data_criacao', $this->data_criacao);
        $stmt->bindParam(':dia_semana', $this->dia_semana);
        $stmt->bindParam(':grupo_muscular', $this->grupo_muscular);

        return $stmt->execute();
    }

    // Método para listar todos os livros
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um livro pelo ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar um livro
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET data_criacao = :data_criacao, grupo_muscular = :grupo_muscular, dia_semana = :dia_semana";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':data_criacao', $this->data_criacao);
        $stmt->bindParam(':dia_semana', $this->dia_semana);
        $stmt->bindParam(':grupo_muscular', $this->grupo_muscular);

        return $stmt->execute();
    }

    // Método para excluir um livro pelo título
    public function deleteByDia() {
        $query = "DELETE FROM " . $this->table_name . " WHERE dia_semana = :dia_semana";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dia_semana', $this->dia_semana);

        return $stmt->execute();
    }
}
