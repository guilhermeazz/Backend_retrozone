<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Carrinho.php';

$database = new Database();
$db = $database->getConnection();

$carrinho = new Carrinho($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->id_item) &&
    !empty($data->quantidade)
) {
    $query = "UPDATE " . $carrinho->itens_table_name . " SET quantidade = :quantidade WHERE id_item = :id_item";
    $stmt = $db->prepare($query);

    $data->quantidade = htmlspecialchars(strip_tags($data->quantidade));
    $data->id_item = htmlspecialchars(strip_tags($data->id_item));

    $stmt->bindParam(':quantidade', $data->quantidade);
    $stmt->bindParam(':id_item', $data->id_item);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(array("message" => "Quantidade do item atualizada."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Não foi possível atualizar a quantidade do item."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dados incompletos."));
}
?>
