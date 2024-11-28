<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Avaliacao.php';

$database = new Database();
$db = $database->getConnection();

$avaliacao = new Avaliacao($db);

$data = json_decode(file_get_contents("php://input"));

$avaliacao->id_usuario = $data->id_usuario;
$avaliacao->id_produto = $data->id_produto;
$avaliacao->nota = $data->nota;
$avaliacao->comentario = isset($data->comentario) ? $data->comentario : null;

if($avaliacao->create()) {
    http_response_code(201);
    echo json_encode(array("message" => "Avaliação criada com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao criar avaliação."));
}
?>
