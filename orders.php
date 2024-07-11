<?php
include 'db.php';

$action = $_GET['action'];

if ($action == 'create') {

    $laptop_id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $subtotal = $_POST['subtotal'];

    if ($laptop_id > 0) {
        $sql = "INSERT INTO orders (laptop_id, quantity, subtotal, date) VALUES ('$laptop_id','$quantity','$subtotal','$date')";
        if ($conn->query($sql) === TRUE) {
            $delete_sql = "DELETE FROM keranjangs WHERE laptop_id = '$laptop_id'";
            $conn->query($delete_sql);
            echo json_encode(["status" => "success", "message" => "laptop added to orders"]);
        } else {
            echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "fail", "message" => "Invalid recipe ID"]);
    }
}

if ($action == 'read') {
    $sql = "SELECT laptops.* FROM laptops JOIN orders ON laptops.id = orders.laptop_id";
    $result = $conn->query($sql);
    $orders = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        echo json_encode($orders);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
