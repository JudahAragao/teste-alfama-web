<?php

class UserGet
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserById($userId)
    {
        try {
            $query = 'SELECT * FROM tb_user WHERE id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $user;
            } else {
                throw new Exception('Usuário não encontrado.');
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar usuário: ' . $e->getMessage());
        }
    }
}
