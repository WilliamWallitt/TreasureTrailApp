<?php
//;==========================================
//; Title:  Back end remove_faq request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

if (!isset($_GET['faq_id'])) {
    die();
}

$faq_id = $_GET['faq_id'];

$database = new database();
$response = $database->remove_faq($faq_id);
$database->close();

echo json_encode(true);
?>