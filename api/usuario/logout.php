<?php
include_once '../../cors.php';

session_start();

if(session_destroy()) {
    http_response_code(200);
    echo json_encode(array("message" => "Logout realizado com sucesso."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Erro ao realizar logout."));
}
?>
