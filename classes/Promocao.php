<?php
class Promocao {
    private $conn;
    private $table_name = "Promocao";

    public $id;
    public $descricao;
    public $imagem;
    public $link;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            descricao=:descricao, 
            imagem=:imagem, 
            link=:link";

        $stmt = $this->conn->prepare($query);

        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->link = htmlspecialchars(strip_tags($this->link));

        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem", $this->imagem, PDO::PARAM_LOB);
        $stmt->bindParam(":link", $this->link);

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->descricao = $row['descricao'];
        $this->imagem = $row['imagem'];
        $this->link = $row['link'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            descricao = :descricao, 
            imagem = :imagem, 
            link = :link 
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->link = htmlspecialchars(strip_tags($this->link));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_LOB);
        $stmt->bindParam(':link', $this->link);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
