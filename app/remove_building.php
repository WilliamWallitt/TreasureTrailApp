<!-- ;==========================================
; Title:  Back-end remove_building request
; Author: Justin van Daalen
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';

if (!isset($_GET['building_id'])) {
    die();
}

$building_id = $_GET['building_id'];

$database = new database();
$response = $database->remove_building($building_id);

echo json_encode(true);
?>