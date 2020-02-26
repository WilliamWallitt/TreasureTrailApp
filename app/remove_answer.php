<?php
//;==========================================
//; Title:  Back end remove_answer request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['answer_id'])) {
    die();
}

$answer_id = $_GET['answer_id'];

$database = new database();
$response = $database->remove_answer($answer_id);

echo json_encode(true);
?>