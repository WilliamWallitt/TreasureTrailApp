<?php
//;==========================================
//; Title:  Back end remove_clue request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['clue_id'])) {
    die();
}

$clue_id = $_GET['clue_id'];

$database = new database();
$response = $database->remove_clue($clue_id);

echo json_encode(true);
?>