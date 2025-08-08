<?php
require_once '../models/treino.php';
require_once '../models/exercicio.php';
require_once '../models/clientes.php';

class TreinosController {

    public function showForm() {
        $clientesModel = new Clientes();
        $exerciciosModel = new Exercicio();

        $clientesList = $clientesModel->getAll(); // Corrigido para chamar o método correto
        $exerciciosList = $exerciciosModel->getAll();

        include '../views/Treinos/treino_form.php';
    }

    public function saveTreino() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            // Boa prática: validar e sanitizar os dados de entrada
            $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_VALIDATE_INT);
            $id_exercicio = filter_input(INPUT_POST, 'id_exercicio', FILTER_VALIDATE_INT);
            $series = filter_input(INPUT_POST, 'series', FILTER_SANITIZE_STRING); // Ou FILTER_VALIDATE_INT se for apenas número
            $repeticoes = filter_input(INPUT_POST, 'repeticoes', FILTER_SANITIZE_STRING); // Ou FILTER_VALIDATE_INT
            $dia_semana = filter_input(INPUT_POST, 'dia_semana', FILTER_SANITIZE_STRING);

            // Verifica se todos os dados essenciais são válidos
            if ($id_cliente === false || $id_exercicio === false || !$series || !$repeticoes || !$dia_semana) {
                echo "Dados inválidos para cadastro do treino. Verifique os campos.";
                return;
            }

            // Seu modelo Treino::create espera um array de dados
            $dados = [
                'id_cliente' => $id_cliente,
                'id_exercicio' => $id_exercicio,
                'series' => $series,
                'repeticoes' => $repeticoes,
                'dia_semana' => $dia_semana
            ];

            if ($treino->create($dados)) { // Passando um array
                header('Location: /sharkrush/list-treino'); // Redireciona para a lista geral de treinos
                exit();
            } else {
                echo "Erro ao cadastrar o treino.";
            }
        } else {
             http_response_code(405); // Método não permitido
             echo "Erro 405: Método não permitido para salvar treino.";
        }
    }

    public function listTreinos() {
        $treino = new Treino();
        // Presumo que getAll() no modelo Treino retorna os dados com nome_cliente e nome_exercicio
        $treinos = $treino->getAll(); // Sua view espera a variável $treinos
        
        include '../views/Treinos/treino_list.php';
    }

    public function showUpdateForm($id_raw) {
        $id = filter_var($id_raw, FILTER_VALIDATE_INT); // Valida o ID da URL
        if ($id === false) {
            header('Location: /sharkrush/error?msg=ID do treino inválido para edição'); // Assumindo rota de erro
            exit();
        }

        $treino = new Treino();
        $treinoInfo = $treino->getById($id);

        if (!$treinoInfo) {
            header('Location: /sharkrush/error?msg=Treino não encontrado para edição'); // Assumindo rota de erro
            exit();
        }

        $clientesModel = new Clientes();
        $exerciciosModel = new Exercicio();

        $clientesList = $clientesModel->getAll(); // Corrigido para chamar o método correto
        $exerciciosList = $exerciciosModel->getAll();

        include '../views/Treinos/treino_update_form.php';
    }

    public function updateTreino() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            // Validação e sanitização
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_VALIDATE_INT); // Lendo id_cliente do POST
            $id_exercicio = filter_input(INPUT_POST, 'id_exercicio', FILTER_VALIDATE_INT);
            $series = filter_input(INPUT_POST, 'series', FILTER_SANITIZE_STRING);
            $repeticoes = filter_input(INPUT_POST, 'repeticoes', FILTER_SANITIZE_STRING);
            $dia_semana = filter_input(INPUT_POST, 'dia_semana', FILTER_SANITIZE_STRING);

            if ($id === false || $id_cliente === false || $id_exercicio === false ||
                !$series || !$repeticoes || !$dia_semana) {
                echo "Dados inválidos para atualização do treino.";
                return;
            }
            
            // Passando id_cliente para o array de dados para o modelo
            $dados = [
                'id' => $id,
                'id_cliente' => $id_cliente, 
                'id_exercicio' => $id_exercicio,
                'series' => $series,
                'repeticoes' => $repeticoes,
                'dia_semana' => $dia_semana
            ];

            if ($treino->update($dados)) {
                header('Location: /sharkrush/list-treino');
                exit();
            } else {
                echo "Erro ao atualizar o treino.";
            }
        } else {
            http_response_code(405);
            echo "Erro 405: Método não permitido para atualizar treino.";
        }
    }

    public function deleteTreino() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $treino = new Treino();
            $id_to_delete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if ($id_to_delete === false) {
                echo "ID do treino inválido para exclusão.";
                return;
            }

            if ($treino->delete($id_to_delete)) {
                header('Location: /sharkrush/list-treino');
                exit();
            } else {
                echo "Erro ao excluir o treino.";
            }
        } else {
            http_response_code(405);
            echo "Erro 405: Método não permitido para deletar treino.";
        }
    }
}