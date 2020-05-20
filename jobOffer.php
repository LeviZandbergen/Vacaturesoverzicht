<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php
include('DBconfig.php');
include('Includes\header.php');

$sessionID = $_SESSION['ID'];
$id = $_GET['id'];
//Runs query with the id send from the url
$sql = "SELECT * FROM jobOffer where jobofferID = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($id));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$jobOfferID = $result[0]['jobofferID'];
$jobOfferStatus = $result[0]['status'];

foreach ($result as $key => $value) {
    $isFile = false;
    $variable = 'filename: ' . $value['description'];
//    Checks if description is a file or a manually typed description
//    When it is a file the filename will be send to the html, otherwise the full description
    if (strpos($variable, 'Uploads/Vacatures/')) {
        $isFile = true;
        $fileName = $value['description'];
    } else {
        $description = $value['description'];
    }
}

include('Includes\jobOffer.php');

if (isset($_POST["Reaction"])) {
    JobOfferReaction($id);
}
if ($sessionID == 2) {
    motivations($id);
}
if (isset($_POST['delete'])) {
    deleteoffer($id);
}

//This function first checks if the user is logged in, If not it will show a alert when the user tries to send his offer reaction
//When the user is logged in and sends the OfferReaction the information will be stored with the user id and offer id
function JobOfferReaction($jobOfferId)
{
    include('DBconfig.php');
    if ($_SESSION['EMAIL'] != '') {
        $userEmail = $_SESSION['EMAIL'];
        $sql = "SELECT userID FROM user where email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($userEmail));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $result['userID'];
    } else {
        echo '<script language="javascript">';
        echo 'alert("U moet inloggen")';
        echo '</script>';
        exit();
    }
    $target_dir = 'Uploads/CV/';
    $target_file = $target_dir . basename($_FILES['ReactionCV']['name']);
    move_uploaded_file($_FILES['ReactionCV']['tmp_name'], $target_file);

    $motivation = htmlspecialchars($_POST["Motivation"]);

    $query = "INSERT INTO offerreaction (idUser, idJoboffer, motivation, cv) VALUES ('$userID', '$jobOfferId', '$motivation', '$target_file')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    header("Refresh:0");
}

//This function get all the reactions for the jobOffer and includes the file for the manager
function motivations($jobOfferId)
{
    include('DBconfig.php');
    $motivationQuery = "SELECT * FROM offerreaction where idJoboffer = $jobOfferId";
    $stmt = $db->prepare($motivationQuery);
    $stmt->execute();
    $motivations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include('Includes\motivation.php');
}

function deleteOffer()
{

}

?>