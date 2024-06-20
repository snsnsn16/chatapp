<?php
require 'db.php';

$conn = connectDB();

if (!$conn) {
    $response['success'] = false;
    $response['error'] = 'Failed to connect to database';
    echo json_encode($response);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username =?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $response['success'] = false;
    $response['error'] = 'Failed to prepare statement';
    echo json_encode($response);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if (!$result) {
    $response['success'] = false;
    $response['error'] = 'Failed to execute query';
    echo json_encode($response);
    exit;
}

$response = array();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($password == $user['password']) {
        $response['success'] = true;
        $response['user_id'] = $user['id'];
    } else {
        $response['success'] = false;
        $response['error'] = 'Incorrect password';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Username not found';
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>