<!-- ;==========================================
; Title:  Back-end get_all_faqs request
; Author: Justin van Daalen
; Date:   25 Feb 2020
;==========================================  -->
<?php
require 'database.php';
header('Content-type: text/javascript');

$database = new database();
$faqs = $database->get_faqs();

echo json_encode($faqs, JSON_PRETTY_PRINT);
?>