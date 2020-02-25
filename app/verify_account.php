<?php
require 'database.php';

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$account = json_decode($json);

$database = new database();
$response = $database->verify_account($account);
$database->close();

if ($response === FALSE) {
    die();
}

session_start();
$_SESSION['username'] = $username;

header('Location: ../views/ModifyDataPage.php');
?>