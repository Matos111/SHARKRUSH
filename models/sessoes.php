<?php

require_once '../config/database.php';

class Sessoes {
    private $conn;
    private $table_name = "treinos_usuarios"; 

    public $id_cliente;
    public $id_exercicio;
    public $data_criacao;
    public $series;
    public $repeticoes;
    public $grupo_muscular;
    public $dia_semana;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . "(id_exercicio, data_criacao, series, repeticoes, grupo_muscular, dia_semana, id_cliente) VALUES (:id_exercicio, :data_criacao, :series, :repeticoes, :grupo_muscular, :dia_semana, :id_cliente)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':id_exercicio', $this->id_exercicio);
        $stmt->bindParam(':data_criacao', $this->data_criacao);
        $stmt->bindParam(':series', $this->series);
        $stmt->bindParam(':repeticoes', $this->repeticoes);
        $stmt->bindParam(':grupo_muscular', $this->grupo_muscular);
        $stmt->bindParam(':dia_semana', $this->dia_semana);

        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT id, grupo_muscular, dia_semana, series, repeticoes, data_criacao FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET id_exercicio = :id_exercicio, data_criacao = :data_criacao, series = :series, repeticoes = :repeticoes, grupo_muscular = :grupo_muscular, dia_semana = :dia_semana WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_exercicio', $this->id_exercicio);
        $stmt->bindParam(':data_criacao', $this->data_criacao);
        $stmt->bindParam(':series', $this->series);
        $stmt->bindParam(':repeticoes', $this->repeticoes);
        $stmt->bindParam(':grupo_muscular', $this->grupo_muscular);
        $stmt->bindParam(':dia_semana', $this->dia_semana);

        return $stmt->execute();
    }

    public function deleteByDia() {
        $query = "DELETE FROM " . $this->table_name . " WHERE dia_semana = :dia_semana";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dia_semana', $this->dia_semana);

        return $stmt->execute();
    }
    
}
