<?php
//;==========================================
//; Title:  Back end remove_department request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['department_id'])) {
    die();
}

$department_id = $_GET['department_id'];

$database = new database();
$response = $database->remove_department($department_id);
$database->close();

echo json_encode(true);
?>