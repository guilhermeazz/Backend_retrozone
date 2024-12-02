<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Promocao.php';

$database = new Database();
$db = $database->getConnection();

$promocao = new Promocao($db);

try {
    // Verifique se há um arquivo enviado
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $promocao->imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        throw new Exception('Erro no upload da imagem.');
    }

    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $link = isset($_POST['link']) ? $_POST['link'] : null;

    if ($descricao && $link && $promocao->imagem) {
        $promocao->descricao = $descricao;
        $promocao->link = $link;

        if($promocao->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Promoção criada com sucesso."));
        } else {
            throw new Exception('Erro ao criar promoção.');
        }
    } else {
        throw new Exception('Dados incompletos.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("message" => $e->getMessage()));
}
?>
