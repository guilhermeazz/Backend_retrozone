<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Avaliacao.php';

$database = new Database();
$db = $database->getConnection();

$avaliacao = new Avaliacao($db);

$avaliacao->id_avaliacao = isset($_GET['id']) ? $_GET['id'] : die();

$avaliacao->read_single();

if($avaliacao->id_usuario != null) {
    $avaliacao_arr = array(
        "id_avaliacao" => $avaliacao->id_avaliacao,
        "id_usuario" => $avaliacao->id_usuario,
        "id_produto" => $avaliacao->id_produto,
        "nota" => $avaliacao->nota,
        "comentario" => $avaliacao->comentario,
        "data_avaliacao" => $avaliacao->data_avaliacao
    );

    http_response_code(200);
    echo json_encode($avaliacao_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Avaliação não encontrada."));
}
?>
