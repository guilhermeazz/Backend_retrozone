<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$stmt = $usuario->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $usuarios_arr = array();
    $usuarios_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $usuario_item = array(
            "id_usuario" => $id_usuario,
            "nome_completo" => $nome_completo,
            "email" => $email,
            "telefone" => $telefone,
            "cep" => $cep,
            "rua" => $rua,
            "numero" => $numero,
            "cidade" => $cidade,
            "estado" => $estado
        );

        array_push($usuarios_arr["records"], $usuario_item);
    }

    echo json_encode($usuarios_arr);
} else {
    echo json_encode(
        array("message" => "Nenhum usuário encontrado.")
    );
}
?>
