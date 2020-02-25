<!-- ;==========================================
; Title:  Back-end create_department request
; Author: Justin van Daalen
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$department = json_decode($json);

$database = new database();
$response = $database->create_department($department);
$database->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>