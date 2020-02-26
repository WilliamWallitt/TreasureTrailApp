<?php
//;==========================================
//; Title:  Back end create_building request
//; Author: William Wallitt, Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$building = json_decode($json);
$database = new database();
$response = $database->create_building($building);
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>