<?php

class UserRegistration
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($data)
    {
        $response = [];

        try {
            // Hash da senha com bcrypt
            $hashedPassword = password_hash($data['senha'], PASSWORD_BCRYPT);

            $query = 'INSERT INTO tb_user (nome_completo, email, senha) VALUES (:nome_completo, :email, :senha)';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':nome_completo', $data['nome_completo']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':senha', $hashedPassword);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Cadastro realizado com sucesso. Vá para a página de login!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao inserir os dados.';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = 'Erro: ' . $e->getMessage();
        }

        return $response;
    }
}