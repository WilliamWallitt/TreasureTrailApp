<?php
//;==========================================
//; Title:  Back end verify_account request
//; Author: Justin Van Daalen
//; Date:   25 Feb 2020
//;==========================================
require 'database.php';

$json = file_get_contents('php://input');
if (!isset($json)) {
    die();
}

$account = json_decode($json);

// if (!isset($_POST['username'], $_POST['password'])) {
//     die();
// }

// $account = new stdClass();
// $account->username = $_POST['username'];
// $account->password = $_POST['password'];

$database = new database();
$response = $database->verify_account($account);
$database->close();

if ($response === FALSE) {
    //header('Location: ../views/LoginPage.php');
    echo json_encode(false);
    die();
}

session_start();
$_SESSION['username'] = $account->username;

//header('Location: ../views/ModifyDataPage.php');
echo json_encode(true);
?>