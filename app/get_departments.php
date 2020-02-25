<!-- ;==========================================
; Title:  Back-end get_all_deparments request
; Author: Justin van Daalen, William Wallitt
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$departments = $database->get_departments();
$database->close();

echo json_encode($departments, JSON_PRETTY_PRINT);
?>