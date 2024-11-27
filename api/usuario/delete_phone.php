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

try {
    if ($usuario->deletePhone()) {
        echo json_encode(array("message" => "Telefone apagado com sucesso."));
    } else {
        echo json_encode(array("message" => "Erro ao apagar telefone."));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "Erro: " . $e->getMessage()));
}
?>
