<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Promocao.php';

$database = new Database();
$db = $database->getConnection();

$promocao = new Promocao($db);

$stmt = $promocao->read();
$num = $stmt->rowCount();

if($num > 0) {
    $promocoes_arr = array();
    $promocoes_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $promocao_item = array(
            "id" => $id,
            "descricao" => $descricao,
            "imagem" => base64_encode($imagem),
            "link" => $link
        );

        array_push($promocoes_arr["records"], $promocao_item);
    }

    http_response_code(200);
    echo json_encode($promocoes_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Nenhuma promoção encontrada."));
}
?>
