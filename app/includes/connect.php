<?php

// Carregar o autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Carregar as variáveis de ambiente do .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    private $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->charset = $_ENV['DB_CHARSET'];
    }

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro de Conexão: ' . $e->getMessage();
            // É melhor lançar uma exceção aqui para que o erro possa ser tratado apropriadamente.
            throw $e;
        }

        // Retorne a conexão PDO
        return $this->conn;
    }
}
