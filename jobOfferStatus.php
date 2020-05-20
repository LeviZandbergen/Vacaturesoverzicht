<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
//checks if logged in user is manager, if not send back to index
if ($_SESSION['ID'] != 2) {
    header('Location: index.php');
    exit;
}
include('Includes\header.php');
//gets the id and status of the offer
$id = $_GET['id'];
$status = $_GET['status'];

//sets variable with new status
if ($status == 0) {
    $setStatus = 1;
} elseif ($status == 1) {
    $setStatus = 0;
}
//updates the offer with a new status
$sql = "UPDATE joboffer SET status = $setStatus WHERE jobofferID = $id";
$stmt = $db->prepare($sql);
$stmt->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);