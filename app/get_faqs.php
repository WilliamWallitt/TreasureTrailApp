<?php
//;==========================================
//; Title:  Back end get_faqs requst
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$faqs = $database->get_faqs();
$database->close();

echo json_encode($faqs, JSON_PRETTY_PRINT);
?>