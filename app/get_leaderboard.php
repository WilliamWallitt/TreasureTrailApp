<?php
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['department_id'])) {
    die();
}

$department_id = $_GET['department_id'];

$database = new database();
$leaderboard = $database->get_leaderboard($department_id);
$database->close();

echo json_encode($leaderboard, JSON_PRETTY_PRINT);
?>