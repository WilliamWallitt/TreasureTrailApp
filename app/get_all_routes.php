<?php
//;==========================================
//; Title:  Back end get_all_routes requst
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$response = $database->get_all_routes();
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>