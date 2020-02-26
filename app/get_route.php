<?php
//;==========================================
//; Title:  Back end get_route requst
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['department_id'])) {
    die();
}

$department_id = $_GET['department_id'];

$database = new database();
$route = $database->get_route($department_id);

echo json_encode($route, JSON_PRETTY_PRINT);
?>