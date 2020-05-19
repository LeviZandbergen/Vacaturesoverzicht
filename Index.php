<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php
include('DBconfig.php');
include('Includes\header.php');

//Selects all joboffers to show in the main page
$sql = "SELECT * FROM jobOffer";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

include('Includes\Main.php');
?>