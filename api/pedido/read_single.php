<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Pedido.php';

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

$pedido->id_pedido = isset($_GET['id']) ? $_GET['id'] : die();

$pedido->read_single();

if($pedido->id_usuario != null) {
    $pedido_arr = array(
        "id_pedido" => $pedido->id_pedido,
        "id_usuario" => $pedido->id_usuario,
        "data_pedido" => $pedido->data_pedido,
        "status" => $pedido->status,
        "valor_total" => $pedido->valor_total
    );

    http_response_code(200);
    echo json_encode($pedido_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Pedido não encontrado."));
}
?>
