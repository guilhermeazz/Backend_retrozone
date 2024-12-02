<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->id_usuario = $data->id_usuario;
$usuario->cep = $data->cep;
$usuario->rua = $data->rua;
$usuario->numero = $data->numero;
$usuario->cidade = $data->cidade;
$usuario->estado = $data->estado;

if ($usuario->update_address()) {
    http_response_code(200);
    echo json_encode(array("message" => "Endereço atualizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao atualizar endereço."));
}
?>
