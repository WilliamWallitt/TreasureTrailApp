<?php
require 'database.php';

$database = new database();
$faqs = $database->get_faqs();

echo json_encode($faqs);
?>