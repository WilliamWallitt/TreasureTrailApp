<?php
//;==========================================
//; Title:  Back end create_faq request
//; Author: William Wallitt, Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$faq = json_decode($json);

$database = new database();
$response = $database->create_faq($faq);
$database->close();

echo json_encode(true);
?>