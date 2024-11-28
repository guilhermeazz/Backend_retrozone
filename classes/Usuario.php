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
    public $data_criacao;

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

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome_completo = $row['nome_completo'];
        $this->email = $row['email'];
        $this->telefone = $row['telefone'];
        $this->cep = $row['cep'];
        $this->rua = $row['rua'];
        $this->numero = $row['numero'];
        $this->cidade = $row['cidade'];
        $this->estado = $row['estado'];
        $this->data_criacao = $row['data_criacao'];
    }

    public function read_single_by_email() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
    
        return $stmt;
    }
    

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            nome_completo = :nome_completo, 
            email = :email, 
            telefone = :telefone, 
            cep = :cep, 
            rua = :rua, 
            numero = :numero, 
            cidade = :cidade, 
            estado = :estado 
            WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $this->nome_completo = htmlspecialchars(strip_tags($this->nome_completo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));

        $stmt->bindParam(':nome_completo', $this->nome_completo);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id_usuario', $this->id_usuario);

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

    public function update_address() {
        $query = "UPDATE " . $this->table_name . " SET 
            cep = :cep, 
            rua = :rua, 
            numero = :numero, 
            cidade = :cidade, 
            estado = :estado 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function update_email() {
        $query = "UPDATE " . $this->table_name . " SET 
            email = :email 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function update_password() {
        $query = "UPDATE " . $this->table_name . " SET 
            senha = :senha 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function update_name() {
        $query = "UPDATE " . $this->table_name . " SET 
            nome_completo = :nome_completo 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->nome_completo = htmlspecialchars(strip_tags($this->nome_completo));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':nome_completo', $this->nome_completo);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function delete_address() {
        $query = "UPDATE " . $this->table_name . " SET 
            cep = NULL, 
            rua = NULL, 
            numero = NULL, 
            cidade = NULL, 
            estado = NULL 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function delete_phone() {
        $query = "UPDATE " . $this->table_name . " SET 
            telefone = NULL 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function update_phone() {
        $query = "UPDATE " . $this->table_name . " SET 
            telefone = :telefone 
            WHERE id_usuario = :id_usuario";
    
        $stmt = $this->conn->prepare($query);
    
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
    
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    
}
?>
