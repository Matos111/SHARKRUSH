<?php
require_once 'models/sessoes.php';

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
        include 'views/Sessoes/sessoes_form.php';
    }

    public function store($dados) {
        $this->model->adicionarSessao($dados);
        header('Location: index.php');
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
