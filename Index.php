<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');

$sessionID = $_SESSION['ID'];
//Selects all joboffers to show in the main page
if ($_SESSION['ID'] == 2) {
    $sql = "SELECT * FROM jobOffer";
} else {
    $sql = "SELECT * FROM jobOffer where status = 1";
}

$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    $sql = "SELECT * FROM jobfunction";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $functions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        $sql = "SELECT * FROM jobbranch";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $branches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
include('Includes\Main.php');
?>