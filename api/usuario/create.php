<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->nome_completo = $data->nome_completo;
$usuario->email = $data->email;
$usuario->senha = $data->senha;
$usuario->telefone = isset($data->telefone) ? $data->telefone : null;
$usuario->cep = null; // Inicialmente sem endereço
$usuario->rua = null; // Inicialmente sem endereço
$usuario->numero = null; // Inicialmente sem endereço
$usuario->cidade = null; // Inicialmente sem endereço
$usuario->estado = null; // Inicialmente sem endereço

try {
    if ($usuario->create()) {
        echo json_encode(array("message" => "Usuário criado com sucesso."));
    } else {
        echo json_encode(array("message" => "Erro ao criar usuário."));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "Erro: " . $e->getMessage()));
}
?>
