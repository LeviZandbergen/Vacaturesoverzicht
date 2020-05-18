<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');
include('Includes\newJobOffer.php');

if (isset($_POST["Create"])) {
    createOffer();
}
function createOffer()
{
    include('DBconfig.php');
    $message = "";
    $offerName = htmlspecialchars($_POST["offerName"]);
    $offerFunction = htmlspecialchars($_POST["offerFunction"]);
    $offerBranch = htmlspecialchars($_POST["offerBranch"]);
    $offerManual = htmlspecialchars($_POST["offerManual"]);

    if (is_uploaded_file($_FILES['OfferWordFile']['tmp_name'])) {
        $target_dir = 'Uploads/Vacatures/';
        $target_file = $target_dir . basename($_FILES['OfferWordFile']['name']);
        if (move_uploaded_file($_FILES['OfferWordFile']['tmp_name'], $target_file)) {
            $message .= "Vacature geupload";
        }
        insertOffer($offerName, $offerFunction, $offerBranch, $target_file);
    } elseif ($offerManual != "") {
        insertOffer($offerName, $offerFunction, $offerBranch, $offerManual);
    } else {
        $message .= "Upload een bestand of beschrijf de vacature";
    }
    echo '<script language="javascript">';
    echo 'alert("' . $message . '")';
    echo '</script>';

}

function insertOffer($offerName, $offerFunction, $offerBranch, $description)
{
    include('DBconfig.php');
    $query = "INSERT INTO joboffer (idJobbranch, idJobfunction, status, name, description) VALUES ('$offerBranch', '$offerFunction', '1', '$offerName', '$description')";
    $stmt = $db->prepare($query);
    $stmt->execute();
}

?>