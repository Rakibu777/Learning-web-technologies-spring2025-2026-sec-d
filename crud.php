<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "user_management");

if ($conn->connect_error) {
    echo json_encode(["error" => "DB connection failed"]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // CREATE
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $email = $data['email'];

        $conn->query("INSERT INTO users (name,email) VALUES ('$name','$email')");
        echo json_encode(["status" => "created"]);
        break;

    // READ
    case 'GET':
        $result = $conn->query("SELECT * FROM users");
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode($users);
        break;

    // UPDATE
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];

        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
        echo json_encode(["status" => "updated"]);
        break;

    // DELETE
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];

        $conn->query("DELETE FROM users WHERE id=$id");
        echo json_encode(["status" => "deleted"]);
        break;
}
?>
