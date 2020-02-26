<?php
//;==========================================
//; Title:  Back end get_all_clues requst
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$clues = $database->get_all_clues();

echo json_encode($clues, JSON_PRETTY_PRINT);
?>