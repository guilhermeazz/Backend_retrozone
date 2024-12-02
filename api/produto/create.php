<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

try {
    // Verifique se há um arquivo enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $produto->imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        throw new Exception('Erro no upload da imagem.');
    }

    $produto->nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $produto->descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $produto->valor = isset($_POST['valor']) ? $_POST['valor'] : null;
    $produto->qtd_estoque = isset($_POST['qtd_estoque']) ? $_POST['qtd_estoque'] : null;
    $produto->promocao = isset($_POST['promocao']) ? $_POST['promocao'] : false;
    $produto->categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $produto->plataforma = isset($_POST['plataforma']) ? $_POST['plataforma'] : null;

    if ($produto->nome && $produto->descricao && $produto->valor && $produto->qtd_estoque !== null && $produto->categoria && $produto->plataforma) {
        if ($produto->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Produto criado com sucesso."));
        } else {
            throw new Exception('Erro ao criar produto.');
        }
    } else {
        throw new Exception('Dados incompletos.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("message" => $e->getMessage()));
}
?>
