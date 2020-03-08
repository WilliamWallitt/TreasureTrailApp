<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$response = $database->get_all_tracking();
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>