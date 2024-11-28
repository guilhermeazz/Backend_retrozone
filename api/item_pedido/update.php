<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/ItemPedido.php';

$database = new Database();
$db = $database->getConnection();

$itemPedido = new ItemPedido($db);

$data = json_decode(file_get_contents("php://input"));

$itemPedido->id_item = $data->id_item;
$itemPedido->id_pedido = $data->id_pedido;
$itemPedido->id_produto = $data->id_produto;
$itemPedido->quantidade = $data->quantidade;
$itemPedido->valor = $data->valor;

if($itemPedido->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Item do pedido atualizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao atualizar item do pedido."));
}
?>
