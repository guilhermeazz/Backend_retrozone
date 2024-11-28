<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/ItemPedido.php';

$database = new Database();
$db = $database->getConnection();

$itemPedido = new ItemPedido($db);

$itemPedido->id_item = isset($_GET['id']) ? $_GET['id'] : die();

$itemPedido->read_single();

if($itemPedido->id_pedido != null) {
    $itemPedido_arr = array(
        "id_item" => $itemPedido->id_item,
        "id_pedido" => $itemPedido->id_pedido,
        "id_produto" => $itemPedido->id_produto,
        "quantidade" => $itemPedido->quantidade,
        "valor" => $itemPedido->valor
    );

    http_response_code(200);
    echo json_encode($itemPedido_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Item do pedido não encontrado."));
}
?>
