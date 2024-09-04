<?php

class UserImageUpdate
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateUserImage($fileData)
    {
        $response = [];

        try {
            $query = 'UPDATE tb_user SET foto_perfil = :foto_perfil, updated_at = CURRENT_TIMESTAMP WHERE id = :user_id';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':foto_perfil', $fileData, PDO::PARAM_LOB);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Imagem atualizada com sucesso.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao atualizar a imagem.';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = 'Erro: ' . $e->getMessage();
        }

        return $response;
    }
}
