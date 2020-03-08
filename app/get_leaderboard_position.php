<?php
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['user_id'], $_GET['department_id'])) {
    die();
}

$user_id = $_GET['user_id'];
$department_id = $_GET['department_id'];

$database = new database();
$position = $database->get_leaderboard_position($user_id, $department_id);
$database->close();

echo json_encode($position, JSON_PRETTY_PRINT);
?>