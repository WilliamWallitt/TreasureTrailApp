

<?php
//;==========================================
//; Title:  Back end create_clue request
//; Author: William Wallitt, Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$clue = json_decode($json);

$database = new database();
$response = $database->create_clue($clue->building_id, $clue);
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>