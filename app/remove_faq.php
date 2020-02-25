<?php
require 'database.php';

if (!isset($_GET['faq_id'])) {
    die();
}

$faq_id = $_GET['faq_id'];

$database = new database();
$response = $database->remove_faq($faq_id);

echo json_encode(true);
?>