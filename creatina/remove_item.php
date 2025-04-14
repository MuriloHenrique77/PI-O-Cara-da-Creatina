<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    unset($_SESSION['carrinho'][$id]);
    echo json_encode(['status' => 'ok']);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'erro']);
