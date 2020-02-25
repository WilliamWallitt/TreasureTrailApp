<?php
require 'database.php';

if (!isset($_POST['username'], $_POST['password'])) {
    die();
}

$account = new stdClass();
$account->username = $_POST['username'];
$account->password = $_POST['password'];

$database = new database();
$response = $database->verify_account($account);
$database->close();

if ($response === FALSE) {
    header('Location: ../views/LoginPage.php');
    die();
}

session_start();
$_SESSION['username'] = "test";

header('Location: ../views/ModifyDataPage.php');
?>