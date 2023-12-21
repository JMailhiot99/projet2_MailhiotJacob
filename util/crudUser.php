<?php
include 'config.php';

function getUsers()
{
    global $conn;
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result : false;
}

function addUser($email, $token, $username, $fname, $lname, $pwd, $billing_address_id, $shipping_address_id, $role_id)
{
    global $conn;
    $sql = "INSERT INTO user (email, token, username, fname, lname, pwd, billing_address_id, shipping_address_id, role_id) VALUES ('$email', '$token', '$username', '$fname', '$lname', '$pwd', $billing_address_id, $shipping_address_id, $role_id)";
    return $conn->query($sql);
}

function updateUser($user_id, $email, $token, $username, $fname, $lname, $pwd, $billing_address_id, $shipping_address_id, $role_id)
{
    global $conn;
    $sql = "UPDATE user SET email='$email', token='$token', username='$username', fname='$fname', lname='$lname', pwd='$pwd', billing_address_id=$billing_address_id, shipping_address_id=$shipping_address_id, role_id=$role_id WHERE id=$user_id";
    return $conn->query($sql);
}

function deleteUser($user_id)
{
    global $conn;
    $sql = "DELETE FROM user WHERE id=$user_id";
    return $conn->query($sql);
}
?>