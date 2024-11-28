<?php
include_once '../../cors.php';
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Usuario.php';

session_start();

if(isset($_SESSION['id_usuario'])) {
    http_response_code(200);
    echo json_encode(array("message" => "Usuário logado."));
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Usuário não logado."));
}
?>
