<?php
//;==========================================
//; Title:  Back end get_departments requst
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$departments = $database->get_departments();
$database->close();

echo json_encode($departments, JSON_PRETTY_PRINT);
?>