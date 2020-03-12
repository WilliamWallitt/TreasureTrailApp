<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$response = $database->get_user($_GET['user_id']);
$database->close();

echo json_encode($response);
?>