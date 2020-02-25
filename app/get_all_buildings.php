<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$response = $database->get_all_buildings();

echo json_encode($response, JSON_PRETTY_PRINT);
?>