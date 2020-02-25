<!-- ;==========================================
; Title:  Back-end get_all_routes request
; Author: Justin van Daalen, William Wallitt, Stephan Kubal
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$response = $database->get_all_routes();

echo json_encode($response, JSON_PRETTY_PRINT);
?>