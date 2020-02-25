<?php
require 'database.php';

if (!isset($_GET['answer_id'])) {
    die();
}

$answer_id = $_GET['answer_id'];

$database = new database();
$response = $database->remove_answer($answer_id);

echo json_encode(true);
?>