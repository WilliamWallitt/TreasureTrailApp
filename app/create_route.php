<?php
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$route = json_decode($json);

$database = new database();
$response = $database->create_route($route);
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>