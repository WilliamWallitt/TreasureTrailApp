<?php
require 'database.php';

if (!isset($_GET['route_id'])) {
    die();
}

$route_id = $_GET['route_id'];

$database = new database();
$response = $database->remove_route($route_id);

echo json_encode(true);
?>