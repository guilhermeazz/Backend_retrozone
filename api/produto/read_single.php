<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$produto->id_produto = isset($_GET['id']) ? $_GET['id'] : die();

$produto->read_single();

if($produto->nome != null) {
    $produto_arr = array(
        "id_produto" => $produto->id_produto,
        "nome" => $produto->nome,
        "descricao" => $produto->descricao,
        "imagem" => $produto->imagem,
        "valor" => $produto->valor,
        "qtd_estoque" => $produto->qtd_estoque,
        "promocao" => $produto->promocao,
        "categoria" => $produto->categoria,
        "plataforma" => $produto->plataforma,
        "data_criacao" => $produto->data_criacao
    );

    http_response_code(200);
    echo json_encode($produto_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Produto não encontrado."));
}
?>
