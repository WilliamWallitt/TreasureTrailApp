<!-- ;==========================================
; Title:  Back-end get_all_clues request
; Author: Justin van Daalen
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

if (!isset($_GET['building_id'])) {
    die();
}

$building_id = $_GET['building_id'];

$database = new database();
$clues = $database->get_clues($building_id);

echo json_encode($clues, JSON_PRETTY_PRINT);
?>