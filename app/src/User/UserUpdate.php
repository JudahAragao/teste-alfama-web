<?php

class UserUpdate
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateUser($data)
    {
        $response = [];

        try {
            $query = 'UPDATE tb_user SET nome_completo = :nome_completo, funcao = :funcao, telefone = :telefone, email = :email, empresa = :empresa, cpf = :cpf, endereco = :endereco WHERE id = :id';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':nome_completo', $data['nome_completo']);
            $stmt->bindParam(':funcao', $data['funcao']);
            $stmt->bindParam(':telefone', $data['telefone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':endereco', $data['endereco']);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Dados atualizados com sucesso.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao atualizar os dados.';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = 'Erro: ' . $e->getMessage();
        }

        return $response;
    }
}