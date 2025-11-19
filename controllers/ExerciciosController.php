<?php
require_once __DIR__ . '/../models/exercicio.php';
require_once __DIR__ . '/../config/app.php';

class ExerciciosController {

    public function showForm() {
        include __DIR__ . '/../views/Exercicios/exercicio_form.php';
    }

    public function saveExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->grupo_muscular = $_POST['grupo_muscular'];
            $exercicio->nome_exercicio = $_POST['nome_exercicio'];
            $exercicio->descricao = $_POST['descricao'];

            if ($exercicio->save()) {
                redirect('/list-exercicio');
            } else {
                echo "Erro ao cadastrar o Exercicio.";
            }
        }
    }

    public function listExercicios() {
        $exercicio = new Exercicio();
        $exerciciosList = $exercicio->getAll();
        include __DIR__ . '/../views/Exercicios/exercicio_list.php';
    }

    public function showUpdateForm($id) {
        $exercicio = new Exercicio();
        $exercicioInfo = $exercicio->getById($id);
        include __DIR__ . '/../views/Exercicios/exercicio_update_form.php';
    }

    public function updateExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->id = $_POST['id'];
            $exercicio->grupo_muscular = $_POST['grupo_muscular'];
            $exercicio->nome_exercicio = $_POST['nome_exercicio'];
            $exercicio->descricao = $_POST['descricao'];

            if ($exercicio->update()) {
                redirect('/list-exercicio');
            } else {
                echo "Erro ao atualizar o Exercicio.";
            }
        }
    }

    public function deleteExercicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercicio = new Exercicio();
            $exercicio->id = $_POST['id'];

            if ($exercicio->deleteById()) {
                redirect('/list-exercicio');
            } else {
                echo "Erro ao excluir o Exercicio.";
            }
        }
    }
}
