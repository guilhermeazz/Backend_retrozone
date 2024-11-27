<?php
include_once '../../cors.php'; // Inclui o arquivo de configuração CORS
include_once '../../config.php';
include_once '../../classes/Database.php';
include_once '../../classes/Produto.php';

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

$data = json_decode(file_get_contents("php://input"));

$produto->nome = $data->nome;
$produto->descricao = $data->descricao;
$produto->imagem = $data->imagem;
$produto->valor = $data->valor;
$produto->qtd_estoque = $data->qtd_estoque;
$