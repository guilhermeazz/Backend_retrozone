<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/ItemPedido.php';

$database = new Database();
$db = $database->getConnection();

$itemPedido = new ItemPedido($db);

$stmt = $itemPedido->read();
$num = $stmt->rowCount();

if($num > 0) {
    $itensPedido_arr = array();
    $itensPedido_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $itemPedido_item = array(
            "id_item" => $id_item,
            "id_pedido" => $id_pedido,
            "id_produto" => $id_produto,
            "quantidade" => $quantidade,
            "valor" => $valor
        );

        array_push($itensPedido_arr["records"], $itemPedido_item);
    }

    http_response_code(200);
    echo json_encode($itensPedido_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Nenhum item de pedido encontrado."));
}
?>
