<?php
require_once __DIR__ . '/../models/sessoes.php';

class SessoesController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Sessoes($pdo);
    }

    public function index($id_cliente) {
        $sessoes = $this->model->listarTreinos($id_cliente);
        include 'views/Sessoes/sessoes_list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sessao = new Sessao();
            $sessao->id_exercicio = $_POST['id_exercicio'];
            $sessao->series = $_POST['series'];
            $sessao->repeticoes = $_POST['repeticoes'];
            $sessao->grupo_muscular = $_POST['grupo_muscular'];
            $sessao->dia_semana = $_POST['dia_semana'];

            if ($book->save()) {
                header('Location: /sharkrush/list-sessoes');
            } else {
                echo "Erro ao cadastrar o treino.";
            }
        }
    }

    public function store($dados) {

        
       if ($this->model->adicionarSessao($dados)){
        header('Location: index.php');
       }
       else{
        echo("erro, sessão não cadastrada");
       }
    }

    public function edit($id) {
        $sessao = $this->model->buscarPorId($id);
        include 'views/Sessoes/update_sessoes_form.php';
    }

    public function update($dados) {
        $this->model->atualizarSessao($dados);
        header('Location: index.php');
    }

    public function delete($id) {
        $this->model->excluirSessao($id);
        header('Location: index.php');
    }
}
?>
