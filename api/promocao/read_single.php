<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Promocao.php';

$database = new Database();
$db = $database->getConnection();

$promocao = new Promocao($db);

$promocao->id = isset($_GET['id']) ? $_GET['id'] : die();

$promocao->read_single();

if($promocao->descricao != null) {
    $promocao_arr = array(
        "id" => $promocao->id,
        "descricao" => $promocao->descricao,
        "imagem" => base64_encode($promocao->imagem),
        "link" => $promocao->link
    );

    http_response_code(200);
    echo json_encode($promocao_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Promoção não encontrada."));
}
?>
