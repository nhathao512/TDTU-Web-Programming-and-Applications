<?php
$_SERVER['REQUEST_METHOD'] = 'POST';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $name = $data['name'];
    $price = $data['price'];
    $desc = $data['desc'];

    require_once 'database/product_db.php'; 

    add_product($name, $price, $desc);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>