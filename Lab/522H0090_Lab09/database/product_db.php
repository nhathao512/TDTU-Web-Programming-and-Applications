<?php
require_once('db.php');

function add_product($name, $price, $desc)
{
    $conn = get_connection();
    $sql = "INSERT INTO product(name, price, description) VALUES (?, ?, ?)";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    
    // Bind parameters
    $stmt->bind_param("sds", $name, $price, $desc);
    
    // Execute statement
    $result = $stmt->execute();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    return $result;
}

function get_products() {
    $conn = get_connection();
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
    
    $products = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    $conn->close();
    return $products;
}

function get_product($id) {
    $conn = get_connection();
    $sql = "SELECT * FROM product WHERE id = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    
    // Bind parameter
    $stmt->bind_param("i", $id);
    
    // Execute statement
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    return $product;
}

function update_product($id, $name, $price, $desc)
{
    $conn = get_connection();
    $sql = "UPDATE product SET name=?, price=?, description=? WHERE id=?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    
    // Bind parameters
    $stmt->bind_param("sdsi", $name, $price, $desc, $id);
    
    // Execute statement
    $result = $stmt->execute();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    return $result;
}

function delete_product($id)
{
    $conn = get_connection();
    $sql = "DELETE FROM product WHERE id=?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    
    // Bind parameter
    $stmt->bind_param("i", $id);
    
    // Execute statement
    $result = $stmt->execute();
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    return $result;
}
?>
