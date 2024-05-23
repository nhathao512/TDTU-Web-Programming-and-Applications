<?php
require_once('database/product_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $products = get_products();
    if (count($products) > 0) {
        http_response_code(200);
        echo json_encode($products);
    } else {
        http_response_code(404); 
        echo json_encode(array("code" => 3, "message" => "No products found"));
    }

} else {
    http_response_code(405);
    echo json_encode(array("code" => 2, "message" => "GET method is required"));
}
?>