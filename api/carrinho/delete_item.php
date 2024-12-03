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

if (!empty($data->id_item)) {
    $carrinho->id_carrinho = $data->id_carrinho;

    if ($carrinho->deleteItem($data->id_item)) {
        http_response_code(200);
        echo json_encode(array("message" => "Item excluído do carrinho."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Não foi possível excluir o item do carrinho."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dados incompletos."));
}
?>
