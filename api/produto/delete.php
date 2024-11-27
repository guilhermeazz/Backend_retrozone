<?php
include_once '../../cors.php';

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$data = json_decode(file_get_contents("php://input"));

$produto->id_produto = $data->id_produto;

if ($produto->delete()) {
    echo json_encode(array("message" => "Produto excluído com sucesso."));
} else {
    echo json_encode(array("message" => "Erro ao excluir produto."));
}
?>
