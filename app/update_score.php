<?php
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$user = json_decode($json);

$database = new database();
$response = $database->update_score($user);
$database->close();

echo json_encode(TRUE);
?>