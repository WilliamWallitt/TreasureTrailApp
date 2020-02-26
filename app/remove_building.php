<?php
//;==========================================
//; Title:  Back end remove_building request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['building_id'])) {
    die();
}

$building_id = $_GET['building_id'];

$database = new database();
$response = $database->remove_building($building_id);
$database->close();

echo json_encode(true);
?>