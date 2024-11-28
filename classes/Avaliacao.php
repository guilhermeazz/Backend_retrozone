<?php
class Avaliacao {
    private $conn;
    private $table_name = "Avaliacao";

    public $id_avaliacao;
    public $id_usuario;
    public $id_produto;
    public $nota;
    public $comentario;
    public $data_avaliacao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            id_usuario=:id_usuario, 
            id_produto=:id_produto, 
            nota=:nota, 
            comentario=:comentario";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->nota = htmlspecialchars(strip_tags($this->nota));
        $this->comentario = htmlspecialchars(strip_tags($this->comentario));

        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":nota", $this->nota);
        $stmt->bindParam(":comentario", $this->comentario);

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_avaliacao = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_avaliacao);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_usuario = $row['id_usuario'];
        $this->id_produto = $row['id_produto'];
        $this->nota = $row['nota'];
        $this->comentario = $row['comentario'];
        $this->data_avaliacao = $row['data_avaliacao'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            id_usuario = :id_usuario, 
            id_produto = :id_produto, 
            nota = :nota, 
            comentario = :comentario 
            WHERE id_avaliacao = :id_avaliacao";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->nota = htmlspecialchars(strip_tags($this->nota));
        $this->comentario = htmlspecialchars(strip_tags($this->comentario));
        $this->id_avaliacao = htmlspecialchars(strip_tags($this->id_avaliacao));

        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_produto', $this->id_produto);
        $stmt->bindParam(':nota', $this->nota);
        $stmt->bindParam(':comentario', $this->comentario);
        $stmt->bindParam(':id_avaliacao', $this->id_avaliacao);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_avaliacao = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_avaliacao = htmlspecialchars(strip_tags($this->id_avaliacao));

        $stmt->bindParam(1, $this->id_avaliacao);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
