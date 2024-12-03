<?php
class Carrinho {
    private $conn;
    private $table_name = "carrinho";
    private $itens_table_name = "itens_carrinho";

    public $id_carrinho;
    public $id_usuario;
    public $data_criacao;
    public $status;
    public $itens = array();

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar um novo carrinho
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, status=:status";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // bind values
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            $this->id_carrinho = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // Adicionar um item ao carrinho
    public function addItem($id_produto, $quantidade, $preco_unitario) {
        $query = "INSERT INTO " . $this->itens_table_name . " SET id_carrinho=:id_carrinho, id_produto=:id_produto, quantidade=:quantidade, preco_unitario=:preco_unitario";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $id_carrinho = htmlspecialchars(strip_tags($this->id_carrinho));
        $id_produto = htmlspecialchars(strip_tags($id_produto));
        $quantidade = htmlspecialchars(strip_tags($quantidade));
        $preco_unitario = htmlspecialchars(strip_tags($preco_unitario));

        // bind values
        $stmt->bindParam(":id_carrinho", $id_carrinho);
        $stmt->bindParam(":id_produto", $id_produto);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":preco_unitario", $preco_unitario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Ler os itens de um carrinho
    public function readItems() {
        $query = "SELECT * FROM " . $this->itens_table_name . " WHERE id_carrinho = :id_carrinho";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $id_carrinho = htmlspecialchars(strip_tags($this->id_carrinho));

        // bind value
        $stmt->bindParam(":id_carrinho", $id_carrinho);

        $stmt->execute();

        return $stmt;
    }

    // Atualizar o status do carrinho
    public function updateStatus($new_status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id_carrinho = :id_carrinho";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $new_status = htmlspecialchars(strip_tags($new_status));
        $id_carrinho = htmlspecialchars(strip_tags($this->id_carrinho));

        // bind values
        $stmt->bindParam(":status", $new_status);
        $stmt->bindParam(":id_carrinho", $id_carrinho);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Excluir um item do carrinho
    public function deleteItem($id_item) {
        $query = "DELETE FROM " . $this->itens_table_name . " WHERE id_item = :id_item";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $id_item = htmlspecialchars(strip_tags($id_item));

        // bind value
        $stmt->bindParam(":id_item", $id_item);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Excluir o carrinho
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_carrinho = :id_carrinho";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $id_carrinho = htmlspecialchars(strip_tags($this->id_carrinho));

        // bind value
        $stmt->bindParam(":id_carrinho", $id_carrinho);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
