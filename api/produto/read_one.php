<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$produto->id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : die();

$produto->readOne();

if ($produto->nome != null) {
    // Criar um array associativo
    $produto_arr = array(
        "id_produto" => $produto->id_produto,
        "nome" => $produto->nome,
        "descricao" => $produto->descricao,
        "imagem" => $produto->imagem,
        "valor" => $produto->valor,
        "qtd_estoque" => $produto->qtd_estoque,
        "promocao" => $produto->promocao,
        "categoria" => $produto->categoria,
        "plataforma" => $produto->plataforma
    );

    // Converter para JSON e exibir
    echo json_encode($produto_arr);
} else {
    echo json_encode(array("message" => "Produto não encontrado."));
}
?>
