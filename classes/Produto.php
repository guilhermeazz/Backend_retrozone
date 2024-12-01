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
    public $data_criacao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            nome=:nome, 
            descricao=:descricao, 
            imagem=:imagem, 
            valor=:valor, 
            qtd_estoque=:qtd_estoque, 
            promocao=:promocao, 
            categoria=:categoria, 
            plataforma=:plataforma";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->qtd_estoque = htmlspecialchars(strip_tags($this->qtd_estoque));
        $this->promocao = htmlspecialchars(strip_tags($this->promocao));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->plataforma = htmlspecialchars(strip_tags($this->plataforma));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem", $this->imagem, PDO::PARAM_LOB);
        $stmt->bindParam(":valor", $this->valor);
        $stmt->bindParam(":qtd_estoque", $this->qtd_estoque);
        $stmt->bindParam(":promocao", $this->promocao);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":plataforma", $this->plataforma);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_produto = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_produto);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $row['nome'];
        $this->descricao = $row['descricao'];
        $this->imagem = $row['imagem'];
        $this->valor = $row['valor'];
        $this->qtd_estoque = $row['qtd_estoque'];
        $this->promocao = $row['promocao'];
        $this->categoria = $row['categoria'];
        $this->plataforma = $row['plataforma'];
        $this->data_criacao = $row['data_criacao'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            nome = :nome, 
            descricao = :descricao, 
            imagem = :imagem, 
            valor = :valor, 
            qtd_estoque = :qtd_estoque, 
            promocao = :promocao, 
            categoria = :categoria, 
            plataforma = :plataforma 
            WHERE id_produto = :id_produto";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->qtd_estoque = htmlspecialchars(strip_tags($this->qtd_estoque));
        $this->promocao = htmlspecialchars(strip_tags($this->promocao));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->plataforma = htmlspecialchars(strip_tags($this->plataforma));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_LOB);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':qtd_estoque', $this->qtd_estoque);
        $stmt->bindParam(':promocao', $this->promocao);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':plataforma', $this->plataforma);
        $stmt->bindParam(':id_produto', $this->id_produto);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_produto = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));

        $stmt->bindParam(1, $this->id_produto);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
