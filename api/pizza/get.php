<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Pizza.php';

$database = new Database();
$db = $database->getConnection();

$pizza = new Pizza($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $pizza->idPizza = isset($_GET['id']) ? $_GET['id'] : null;

    if ($pizza->idPizza) {
        $pizza->get();

        if ($pizza->nome != null) {
            $pizza_arr = array(
                "id"           => $pizza->idPizza,
                "nome"         => $pizza->nome,
                "ingredientes" => $pizza->ingredientes,
                "valor"        => $pizza->valor
            );
            echo json_encode($pizza_arr, 128);

        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(
                array(
                    "erro" => "Pizza não encontrada.",
                    "id"   => $pizza->idPizza
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