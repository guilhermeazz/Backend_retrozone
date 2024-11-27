<?php
class Usuario {
    private $conn;
    private $table_name = "Usuario";

    public $id_usuario;
    public $nome_completo;
    public $email;
    public $senha;
    public $telefone;
    public $cep;
    public $rua;
    public $numero;
    public $cidade;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
            nome_completo=:nome_completo, 
            email=:email, 
            senha=:senha, 
            telefone=:telefone, 
            cep=:cep, 
            rua=:rua, 
            numero=:numero, 
            cidade=:cidade, 
            estado=:estado";

        $stmt = $this->conn->prepare($query);

        $this->nome_completo = htmlspecialchars(strip_tags($this->nome_completo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(":nome_completo", $this->nome_completo);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":rua", $this->rua);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            nome_completo=:nome_completo, 
            email=:email, 
            senha=:senha, 
            telefone=:telefone, 
            cep=:cep, 
            rua=:rua, 
            numero=:numero, 
            cidade=:cidade, 
            estado=:estado 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->nome_completo = htmlspecialchars(strip_tags($this->nome_completo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":nome_completo", $this->nome_completo);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":rua", $this->rua);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

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

    public function updateName() {
        $query = "UPDATE " . $this->table_name . " SET 
            nome_completo=:nome_completo 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->nome_completo = htmlspecialchars(strip_tags($this->nome_completo));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":nome_completo", $this->nome_completo);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updatePassword() {
        $query = "UPDATE " . $this->table_name . " SET 
            senha=:senha 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateEmail() {
        $query = "UPDATE " . $this->table_name . " SET 
            email=:email 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updatePhone() {
        $query = "UPDATE " . $this->table_name . " SET 
            telefone=:telefone 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateAddress() {
        $query = "UPDATE " . $this->table_name . " SET 
            cep=:cep, 
            rua=:rua, 
            numero=:numero, 
            cidade=:cidade, 
            estado=:estado 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":rua", $this->rua);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deletePhone() {
        $query = "UPDATE " . $this->table_name . " SET 
            telefone=NULL 
            WHERE id_usuario=:id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteAddress() {
        $query = "UPDATE " . $this->table_name . " SET 
            cep=NULL, 
            rua=NULL, 
            numero=NULL, 
            cidade=NULL, 
            estado=NULL 
            WHERE id_usuario=:id_usuario";

        $stmt = $->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(1, $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
