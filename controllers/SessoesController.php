<?php
require_once '../models/sessoes.php';

class SessoesController {

    public function showForm() {
        include '../views/Sessões/sessoes_form.php';  
    }

    public function saveSessoes() {

        $sessoes = new Sessoes();
        $sessoes->id_cliente = $_POST['id_cliente'];
        $sessoes->id_exercicio = $_POST['id_exercicio'];
        $sessoes->data_criacao = $_POST['data_criacao'];
        $sessoes->series = $_POST['series'];
        $sessoes->repeticoes = $_POST['repeticoes'];
        $sessoes->grupo_muscular = $_POST['grupo_muscular'];
        $sessoes->dia_semana = $_POST['dia_semana'];

        if ($sessoes->save()) {
            header('Location:/sharkrush/list-sessoes');
            exit();
        } else {
            echo "Erro ao cadastrar o treino.";  
        }
    }
    

    public function listSessoes() {
        $sessoes = new Sessoes();
        $sessoesList = $sessoes->getAll(); 
        include '../views/Sessões/sessoes_list.php'; 
    }

    public function showUpdateForm($id) {
        $sessoes = Sessoes::findById($id);
        require '../views/Sessões/update_sessoes_form.php';
    }

    public function updateSessoes() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sessoes = new Clientes();
            $sessoes->id = $_POST['id'];
            $sessoes->id_exercicio = $_POST['id_exercicio'];
            $sessoes->data_criacao = $_POST['data_criacao'];
            $sessoes->series = $_POST['series'];
            $sessoes->repeticoes = $_POST['repeticoes'];
            $sessoes->grupo_muscular = $_POST['grupo_muscular'];
            $sessoes->dia_semana = $_POST['dia_semana']; 

            if ($sessoes->update()) {
                header('Location: /sharkrush/list-sessoes');
                exit(); // Adicionado para garantir que o script pare após o redirecionamento
            } else {
                echo "Erro ao atualizar o treino."; 
            }
        }
    }

    public function deleteSessaoByDia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sessoes = new Sessoes();
            $sessoes->dia_semana = $_POST['dia_semana'];

            if ($clientes->deleteByDia()) { 
                header('Location: /sharkrush/list-sessoes');
                exit(); 
            } else {
                echo "Erro ao excluir o treino."; 
            }
        }
    }
}
?>