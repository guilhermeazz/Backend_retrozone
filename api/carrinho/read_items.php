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

if (!empty($data->id_carrinho)) {
    $carrinho->id_carrinho = $data->id_carrinho;

    $stmt = $carrinho->readItems();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $itens_arr = array();
        $itens_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $item = array(
                "id_item" => $id_item,
                "id_produto" => $id_produto,
                "quantidade" => $quantidade,
                "preco_unitario" => $preco_unitario
            );
            array_push($itens_arr["records"], $item);
        }

        http_response_code(200);
        echo json_encode($itens_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Nenhum item encontrado no carrinho."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dados incompletos."));
}
?>
