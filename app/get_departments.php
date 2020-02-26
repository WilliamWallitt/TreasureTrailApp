<?php
//;==========================================
//; Title:  Front end Modify Data Page - HTML
//; Author: William Wallitt, Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$departments = $database->get_departments();
$database->close();

echo json_encode($departments, JSON_PRETTY_PRINT);
?>