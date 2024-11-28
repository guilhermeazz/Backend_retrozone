<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Pedido.php';

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

$data = json_decode(file_get_contents("php://input"));

$pedido->id_usuario = $data->id_usuario;
$pedido->valor_total = $data->valor_total;

if($pedido->create()) {
    http_response_code(201);
    echo json_encode(array("message" => "Pedido criado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao criar pedido."));
}
?>
