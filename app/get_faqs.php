<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$faqs = $database->get_faqs();

echo json_encode($faqs, JSON_PRETTY_PRINT);
?>