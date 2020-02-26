<?php
//;==========================================
//; Title:  Back end remove_route request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['route_id'])) {
    die();
}

$route_id = $_GET['route_id'];

$database = new database();
$response = $database->remove_route($route_id);
$database->close();

echo json_encode(true);
?>