<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

try {
    $plataforma = isset($_GET['plataforma']) ? $_GET['plataforma'] : die('Plataforma não fornecida.');

    $stmt = $produto->readByPlatform($plataforma);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $produtos_arr = array();
        $produtos_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $produto_item = array(
                "id_produto" => $id_produto,
                "nome" => $nome,
                "descricao" => html_entity_decode($descricao),
                "valor" => $valor,
                "qtd_estoque" => $qtd_estoque,
                "promocao" => $promocao,
                "categoria" => $categoria,
                "plataforma" => $plataforma,
                "imagem" => base64_encode($imagem)
            );
            array_push($produtos_arr["records"], $produto_item);
        }
        http_response_code(200);
        echo json_encode($produtos_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Nenhum produto encontrado."));
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("message" => $e->getMessage()));
}
?>
