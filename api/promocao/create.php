<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Promocao.php';

$database = new Database();
$db = $database->getConnection();

$promocao = new Promocao($db);

$data = json_decode(file_get_contents("php://input"));

$promocao->descricao = $data->descricao;
$promocao->imagem = file_get_contents($_FILES['imagem']['tmp_name']);
$promocao->link = $data->link;

if($promocao->create()) {
    http_response_code(201);
    echo json_encode(array("message" => "Promoção criada com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao criar promoção."));
}
?>
