<?php
class Sessoes {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTreinos($id_cliente) {
        $sql = "SELECT tu.*, e.grupo_muscular, e.nome_exercicio 
                FROM treinos_usuarios tu
                JOIN exercicios e ON tu.id_exercicio = e.id
                WHERE tu.id_cliente = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarSessao($dados) {
        $sql = "INSERT INTO treinos_usuarios 
                (id_cliente, id_exercicio, series, repeticoes, grupo_muscular, dia_semana) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['id_cliente'],
            $dados['id_exercicio'],
            $dados['series'],
            $dados['repeticoes'],
            $dados['grupo_muscular'],
            $dados['dia_semana']
        ]);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM treinos_usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSessao($dados) {
        $sql = "UPDATE treinos_usuarios 
                SET id_exercicio = ?, series = ?, repeticoes = ?, grupo_muscular = ?, dia_semana = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['id_exercicio'],
            $dados['series'],
            $dados['repeticoes'],
            $dados['grupo_muscular'],
            $dados['dia_semana'],
            $dados['id']
        ]);
    }

    public function excluirSessao($id) {
        $sql = "DELETE FROM treinos_usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
