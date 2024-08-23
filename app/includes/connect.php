<?php

// Carregar o autoload do Composer
require '../../vendor/autoload.php';

// Carregar as variáveis de ambiente do .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$charset = $_ENV['DB_CHARSET'];

$connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $charset ,$username, $password);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);