<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Promocao.php';

$database = new Database();
$db = $database->getConnection();

$promocao = new Promocao($db);

$data = json_decode(file_get_contents("php://input"));

$promocao->id = $data->id;

if($promocao->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Promoção deletada com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao deletar promoção."));
}
?>
