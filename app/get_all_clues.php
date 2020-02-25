<!-- ;==========================================
; Title:  Back-end get_all_clues request
; Author: Justin van Daalen, William Wallitt, Stephan Kubal
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$clues = $database->get_all_clues();

echo json_encode($clues, JSON_PRETTY_PRINT);
?>