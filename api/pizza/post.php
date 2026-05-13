<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Pizza.php';

$database = new Database();
$db = $database->getConnection();

$pizza = new Pizza($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->nome) &&
            !empty($data->ingredientes) &&
            !empty($data->valor)
        ) {
            $pizza->nome        = $data->nome;
            $pizza->ingredientes = $data->ingredientes;
            $pizza->valor       = $data->valor;

            if ($pizza->add()) {
                header("HTTP/1.1 201 Created");
                echo json_encode(
                    array("mensagem" => "Pizza criada com sucesso."),
                    128
                );
            } else {
                header("HTTP/1.1 500 Internal Server Error");
                echo json_encode(
                    array("erro" => "Não foi possível criar a pizza."),
                    128
                );
            }

        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(
                array("erro" => "Dados incompletos. Informe nome, ingredientes e valor."),
                128
            );
        }

    } catch (Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(
            array("erro" => $e->getMessage()),
            128
        );
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(
        array("erro" => "Método não permitido. Use POST."),
        128
    );
}