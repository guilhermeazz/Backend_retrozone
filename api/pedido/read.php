<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Pedido.php';

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

$stmt = $pedido->read();
$num = $stmt->rowCount();

if($num > 0) {
    $pedidos_arr = array();
    $pedidos_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $pedido_item = array(
            "id_pedido" => $id_pedido,
            "id_usuario" => $id_usuario,
            "data_pedido" => $data_pedido,
            "status" => $status,
            "valor_total" => $valor_total
        );

        array_push($pedidos_arr["records"], $pedido_item);
    }

    http_response_code(200);
    echo json_encode($pedidos_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Nenhum pedido encontrado."));
}
?>
