<?php
//;==========================================
//; Title:  Back end get_clues requst
//; Author: Justin Van Daalen, Stephan Kubal

//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['building_id'])) {
    die();
}

$building_id = $_GET['building_id'];

$database = new database();
$clues = $database->get_clues($building_id);
$database->close();

echo json_encode($clues, JSON_PRETTY_PRINT);
?>