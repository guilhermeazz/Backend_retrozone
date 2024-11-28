<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$usuario->id_usuario = isset($_GET['id']) ? $_GET['id'] : die();

$usuario->read_single();

if($usuario->nome_completo != null) {
    $usuario_arr = array(
        "id_usuario" => $usuario->id_usuario,
        "nome_completo" => $usuario->nome_completo,
        "email" => $usuario->email,
        "telefone" => $usuario->telefone,
        "cep" => $usuario->cep,
        "rua" => $usuario->rua,
        "numero" => $usuario->numero,
        "cidade" => $usuario->cidade,
        "estado" => $usuario->estado,
        "data_criacao" => $usuario->data_criacao
    );

    http_response_code(200);
    echo json_encode($usuario_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Usuário não encontrado."));
}
?>
