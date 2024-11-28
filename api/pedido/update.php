<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Pedido.php';

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

$data = json_decode(file_get_contents("php://input"));

$pedido->id_pedido = $data->id_pedido;
$pedido->id_usuario = $data->id_usuario;
$pedido->status = $data->status;
$pedido->valor_total = $data->valor_total;

if($pedido->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Pedido atualizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao atualizar pedido."));
}
?>
