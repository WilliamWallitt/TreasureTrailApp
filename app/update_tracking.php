<?php
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$tracking = json_decode($json);

$database = new database();
$response = $database->update_tracking($tracking);
$database->close();

echo json_encode(TRUE);
?>