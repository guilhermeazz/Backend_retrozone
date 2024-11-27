<?php
class Produto {
    private $conn;
    private $table_name = "Produto";

    public $id_produto;
    public $nome;
    public $descricao;
    public $imagem;
    public $valor;
    public $qtd_estoque;
    public $promocao;
    public $categoria;
    public $plataforma;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Adicionar método read()
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Métodos create, update, delete...
}
?>
