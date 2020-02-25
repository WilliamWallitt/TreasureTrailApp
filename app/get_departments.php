<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$departments = $database->get_departments();
$database->close();

echo json_encode($departments, JSON_PRETTY_PRINT);
?>