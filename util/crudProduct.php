<?php
include 'config.php';

function getProducts()
{
    global $conn;
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result : false;
}

function addProduct($name, $quantity, $price, $url_img, $description)
{
    global $conn;
    $sql = "INSERT INTO product (name, quantity, price, url_img, description, ...) VALUES ('$name', $quantity, $price, '$url_img', '$description', ...)";
    return $conn->query($sql);
}

function updateProduct($product_id, $name, $quantity, $price, $url_img, $description)
{
    global $conn;
    $sql = "UPDATE product SET name='$name', quantity=$quantity, price=$price, url_img='$url_img', description='$description', ... WHERE id=$product_id";
    return $conn->query($sql);
}

function deleteProduct($product_id)
{
    global $conn;
    $sql = "DELETE FROM product WHERE id=$product_id";
    return $conn->query($sql);
}
?>