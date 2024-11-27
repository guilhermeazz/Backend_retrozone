<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->id_usuario = $data->id_usuario;
$usuario->cep = isset($data->cep) ? $data->cep : null;
$usuario->rua = isset($data->rua) ? $data->rua : null;
$usuario->numero = isset($data->numero) ? $data->numero : null;
$usuario->cidade = isset($data->cidade) ? $data->cidade : null;
$usuario->estado = isset($data->estado) ? $data->estado : null;

try {
    if ($usuario->updateAddress()) {
        echo json_encode(array("message" => "Endereço atualizado com sucesso."));
    } else {
        echo json_encode(array("message" => "Erro ao atualizar endereço."));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "Erro: " . $e->getMessage()));
}
?>
