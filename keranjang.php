<?php
include 'db.php';

$action = $_GET['action'];

if ($action == 'create') {

    $laptop_id = $_POST['id'];

    if ($laptop_id > 0) {
        $sql = "INSERT INTO keranjangs (laptop_id) VALUES ('$laptop_id')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Recipe added to keranjangs"]);
        } else {
            echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "fail", "message" => "Invalid recipe ID"]);
    }
}

if ($action == 'read') {
    $sql = "SELECT laptops.* FROM laptops JOIN keranjangs ON laptops.id = keranjangs.laptop_id";
    $result = $conn->query($sql);
    $keranjangs = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $keranjangs[] = $row;
        }
        echo json_encode($keranjangs);
    } else {
        echo json_encode([]);
    }
}


if ($action == 'delete') {
    $laptop_id = $_POST['id'];

    if ($laptop_id > 0) {
        $sql = "DELETE FROM keranjangs WHERE laptop_id = '$laptop_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Recipe removed from keranjangs"]);
        } else {
            echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "fail", "message" => "Invalid recipe ID"]);
    }
}

$conn->close();
?>
