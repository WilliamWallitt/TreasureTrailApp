<!-- ;==========================================
; Title:  Back-end remove_department request
; Author: Justin van Daalen
; Date:   25 Feb 2020
;==========================================  -->

<?php
require 'database.php';

if (!isset($_GET['department_id'])) {
    die();
}

$department_id = $_GET['department_id'];

$database = new database();
$response = $database->remove_department($department_id);

echo json_encode(true);
?>