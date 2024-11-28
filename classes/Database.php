<?php
class Database {
    private $host = 'localhost'; // Substitua pelo host do seu banco de dados, se necessário
    private $db_name = 'retrozone'; // Nome do banco de dados
    private $username = 'root'; // Substitua pelo seu nome de usuário do banco de dados
    private $password = ''; // Substitua pela sua senha do banco de dados
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
