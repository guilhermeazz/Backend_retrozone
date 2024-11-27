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
$usuario->nome_completo = $data->nome_completo;
$usuario->email = $data->email;
$usuario->senha = $data->senha;
$usuario->telefone = isset($data->telefone) ? $data->telefone : null;
$usuario->cep = isset($data->cep) ? $data->cep : null;
$usuario->rua = isset($data->rua) ? $data->rua : null;
$usuario->numero = isset($data->numero) ? $data->numero : null;
$usuario->cidade = isset($data->cidade) ? $data->cidade : null;
$usuario->estado = isset($data->estado) ? $data->estado : null;

try {
    if ($usuario->update()) {
        echo json_encode(array("message" => "Usuário atualizado com sucesso."));
    } else {
        echo json_encode(array("message" => "Erro ao atualizar usuário."));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "Erro: " . $e->getMessage()));
}
?>
