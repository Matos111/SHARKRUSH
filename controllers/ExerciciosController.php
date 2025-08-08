<?php
require_once '../models/exercicio.php';

class ExerciciosController {

    public function showForm() {
        include '../views/Exercicios/exercicio_form.php';
    }

    public function saveExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->grupo_muscular = $_POST['grupo_muscular'];
            $exercicio->nome_exercicio = $_POST['nome_exercicio'];
            $exercicio->descricao = $_POST['descricao'];

            if ($exercicio->save()) {
                header('Location: /sharkrush/list-exercicio');
                exit();
            } else {
                echo "Erro ao cadastrar o Exercício.";
            }
        }
    }

    public function listExercicios() {
        $exercicio = new Exercicio();
        $exerciciosList = $exercicio->getAll();
        include '../views/Exercicios/exercicio_list.php';
    }

    public function showUpdateForm($id) {
        $exercicio = new Exercicio();
        $exercicioInfo = $exercicio->getById($id);
        include '../views/Exercicios/exercicio_update_form.php';
    }

    public function updateExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->id = $_POST['id'];
            $exercicio->grupo_muscular = $_POST['grupo_muscular'];
            $exercicio->nome_exercicio = $_POST['nome_exercicio'];
            $exercicio->descricao = $_POST['descricao'];

            if ($exercicio->update()) {
                header('Location: /sharkrush/list-exercicio');
                exit();
            } else {
                echo "Erro ao atualizar o Exercício.";
            }
        }
    }

    public function deleteExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->id = $_POST['id'];

            if ($exercicio->deleteById()) { 
                header('Location: /sharkrush/list-exercicio'); 
                exit();
            } else {
                echo "Erro ao excluir o Exercício.";
            }
        }
    }
}
