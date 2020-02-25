<?php
require 'database.php';

if (!isset($_GET['building_id'])) {
    die();
}

$building_id = $_GET['building_id'];

$database = new database();
$response = $database->remove_building($building_id);

echo json_encode(true);
?>