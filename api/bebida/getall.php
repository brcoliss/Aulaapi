<?php
// CRIACAO ROTA getall.php - bebidas
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Bebida.php';

$database = new Database();
$db = $database->getConnection();

$bebida = new Bebida($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $bebida->getAll();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $bebidas_arr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $bebida_item = array(
                "id"         => $idBebida,
                "nome"       => $nome,
                "valor"      => $valor,
                "categorias" => $categorias,
                "ativo"      => $ativo
            );

            array_push($bebidas_arr, $bebida_item);
        }

        header("HTTP/1.0 200 OK");
        echo json_encode($bebidas_arr);

    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Nenhuma bebida encontrada."));
    }

} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método não permitido. Use GET."));
}