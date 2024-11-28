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
$usuario->nome_completo = $data->nome_completo;
$usuario->email = $data->email;
$usuario->telefone = $data->telefone;
$usuario->cep = isset($data->cep) ? $data->cep : null;
$usuario->rua = isset($data->rua) ? $data->rua : null;
$usuario->numero = isset($data->numero) ? $data->numero : null;
$usuario->cidade = isset($data->cidade) ? $data->cidade : null;
$usuario->estado = isset($data->estado) ? $data->estado : null;

if($usuario->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Usuário atualizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao atualizar usuário."));
}
?>
