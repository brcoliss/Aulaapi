<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Bebida.php';

$database = new Database();
$db = $database->getConnection();

$bebida = new Bebida($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $bebida->idBebida = isset($_GET['id']) ? $_GET['id'] : null;

    if ($bebida->idBebida) {
        $bebida->get();

        if ($bebida->nome != null) {
            $bebida_arr = array(
                "id"         => $bebida->idBebida,
                "nome"       => $bebida->nome,
                "valor"      => $bebida->valor,
                "categorias" => $bebida->categorias,
                "ativo"      => $bebida->ativo
            );
            echo json_encode($bebida_arr, 128);

        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(
                array(
                    "erro" => "Bebida não encontrada.",
                    "id"   => $bebida->idBebida
                ),
                128
            );
        }

    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(
            array("erro" => "Id não informado."),
            128
        );
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(
        array("erro" => "Método não permitido. Use GET."),
        128
    );
}