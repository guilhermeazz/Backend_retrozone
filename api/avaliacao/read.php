<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Avaliacao.php';

$database = new Database();
$db = $database->getConnection();

$avaliacao = new Avaliacao($db);

$stmt = $avaliacao->read();
$num = $stmt->rowCount();

if($num > 0) {
    $avaliacoes_arr = array();
    $avaliacoes_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $avaliacao_item = array(
            "id_avaliacao" => $id_avaliacao,
            "id_usuario" => $id_usuario,
            "id_produto" => $id_produto,
            "nota" => $nota,
            "comentario" => html_entity_decode($comentario),
            "data_avaliacao" => $data_avaliacao
        );

        array_push($avaliacoes_arr["records"], $avaliacao_item);
    }

    http_response_code(200);
    echo json_encode($avaliacoes_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Nenhuma avaliação encontrada."));
}
?>
