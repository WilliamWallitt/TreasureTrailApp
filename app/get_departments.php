<?php
require 'database.php';

$database = new database();
$departments = $database->get_departments();
$database->close();

echo json_encode($departments);

?>