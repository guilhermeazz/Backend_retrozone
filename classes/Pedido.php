<?php
class Pedido {
    private $conn;
    private $table_name = "Pedido";

    public $id_pedido;
    public $id_usuario;
    public $data_pedido;
    public $status;
    public $valor_total;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            id_usuario=:id_usuario, 
            valor_total=:valor_total";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));

        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":valor_total", $this->valor_total);

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pedido = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pedido);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_usuario = $row['id_usuario'];
        $this->data_pedido = $row['data_pedido'];
        $this->status = $row['status'];
        $this->valor_total = $row['valor_total'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            id_usuario = :id_usuario, 
            status = :status, 
            valor_total = :valor_total 
            WHERE id_pedido = :id_pedido";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));
        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));

        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':id_pedido', $this->id_pedido);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pedido = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));

        $stmt->bindParam(1, $this->id_pedido);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
