<?php
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['user_id'])) {
    die();
}

$user_id = $_GET['user_id'];

$database = new database();
$response = $database->get_score($user_id);
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>