<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$clues = $database->get_all_buildings();

echo json_encode($clues, JSON_PRETTY_PRINT);
?>