<?php
class ItemPedido {
    private $conn;
    private $table_name = "ItemPedido";

    public $id_item;
    public $id_pedido;
    public $id_produto;
    public $quantidade;
    public $valor;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            id_pedido=:id_pedido, 
            id_produto=:id_produto, 
            quantidade=:quantidade, 
            valor=:valor";

        $stmt = $->conn->prepare($query);

        $->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
        $->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $->valor = htmlspecialchars(strip_tags($this->valor));

        $stmt->bindParam(":id_pedido", $this->id_pedido);
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":valor", $this->valor);

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_item = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_item);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_pedido = $row['id_pedido'];
        $this->id_produto = $row['id_produto'];
        $this->quantidade = $row['quantidade'];
        $this->valor = $row['valor'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            id_pedido = :id_pedido, 
            id_produto = :id_produto, 
            quantidade = :quantidade, 
            valor = :valor 
            WHERE id_item = :id_item";

        $stmt = $this->conn->prepare($query);

        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->id_item = htmlspecialchars(strip_tags($this->id_item));

        $stmt->bindParam(':id_pedido', $this->id_pedido);
        $stmt->bindParam(':id_produto', $this->id_produto);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':id_item', $this->id_item);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_item = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_item = htmlspecialchars(strip_tags($this->id_item));

        $stmt->bindParam(1, $this->id_item);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
