<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->email = isset($data->email) ? $data->email : die();

$stmt = $usuario->read_single_by_email();

if($stmt) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        $usuario_arr = array(
            "id_usuario" => $row['id_usuario'],
            "nome_completo" => $row['nome_completo'],
            "email" => $row['email'],
            "telefone" => $row['telefone'],
            "cep" => $row['cep'],
            "rua" => $row['rua'],
            "numero" => $row['numero'],
            "cidade" => $row['cidade'],
            "estado" => $row['estado'],
            "data_criacao" => $row['data_criacao']
        );

        http_response_code(200);
        echo json_encode($usuario_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Usuário não encontrado."));
    }
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Erro ao buscar usuário."));
}
?>
