<?php

require_once '../models/sessoes.php';

class TreinoController {
    // Método para exibir o formulário de cadastro
    public function showForm() {
        include '../views/sessoes_form.php'; // Inclua o arquivo do formulário
    }

    // Método para salvar um livro
    public function saveTreino() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            $treino->data_criacao = $_POST['data_criacao'];
            $treino->dia_semana = $_POST['dia_semana'];
            $treino->grupo_muscular = $_POST['grupo_muscular'];

            if ($treino->save()) {
                header('Location: /SHARKRUSH/list-treino');
            } else {
                echo "Erro ao cadastrar o treino.";
            }
        }
    }

    // Método para listar todos os livros
    public function listTreinos() {
        $treino = new Treino();
        $treinos = $treino->getAll();
        include '../views/sessoes_list.php'; // Inclua o arquivo para exibir a lista de livros
    }

    // Método para exibir o formulário de atualização
    public function showUpdateForm($id) {
        $treino = new Treino();
        $treinoInfo = $treino->getById($id);
        include '../views/update_sessoes_form.php'; // Inclua o arquivo do formulário de atualização
    }

    // Método para atualizar um livro
    public function updateTreino() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            $treino->data_criacao = $_POST['data_criacao'];
            $treino->dia_semana = $_POST['dia_semana'];
            $treino->grupo_muscular = $_POST['grupo_muscular'];

            if ($treino->update()) {
                header('Location: /SHARKRUSH/list-treinos');
            } else {
                echo "Erro ao atualizar o treino.";
            }
        }
    }

    // Método para excluir um treino pelo dia da semana
    public function deleteTreinoByDia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            $treino->dia_semana = $_POST['dia_semana'];

            if ($treino->deleteByDia()) {
                header('Location: /SHARKRUSH/list-treinos');
            } else {
                echo "Erro ao excluir o treino.";
            }
        }
    }
}
