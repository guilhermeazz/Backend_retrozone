<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->id_usuario = $data->id_usuario;

if($usuario->delete_phone()) {
    http_response_code(200);
    echo json_encode(array("message" => "Telefone deletado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao deletar telefone."));
}
?>
