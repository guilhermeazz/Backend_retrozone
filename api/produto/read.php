<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS

include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$stmt = $produto->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $produtos_arr = array();
    $produtos_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $produto_item = array(
            "id_produto" => $id_produto,
            "nome" => $nome,
            "descricao" => $descricao,
            "imagem" => $imagem,
            "valor" => $valor,
            "qtd_estoque" => $qtd_estoque,
            "promocao" => $promocao,
            "categoria" => $categoria,
            "plataforma" => $plataforma
        );

        array_push($produtos_arr["records"], $produto_item);
    }

    echo json_encode($produtos_arr);
} else {
    echo json_encode(
        array("message" => "Nenhum produto encontrado.")
    );
}
?>
