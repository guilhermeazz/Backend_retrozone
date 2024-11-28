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
$produto->nome = $data->nome;
$produto->descricao = isset($data->descricao) ? $data->descricao : null;
$produto->imagem = isset($data->imagem) ? $data->imagem : null;
$produto->valor = $data->valor;
$produto->qtd_estoque = isset($data->qtd_estoque) ? $data->qtd_estoque : 0;
$produto->promocao = isset($data->promocao) ? $data->promocao : false;
$produto->categoria = isset($data->categoria) ? $data->categoria : null;
$produto->plataforma = isset($data->plataforma) ? $data->plataforma : null;

if($produto->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Produto atualizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao atualizar produto."));
}
?>
