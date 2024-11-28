<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Avaliacao.php';

$database = new Database();
$db = $database->getConnection();

$avaliacao = new Avaliacao($db);

$data = json_decode(file_get_contents("php://input"));

$avaliacao->id_avaliacao = $data->id_avaliacao;

if($avaliacao->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Avaliação deletada com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao deletar avaliação."));
}
?>
