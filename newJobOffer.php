<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');
include('Includes\newJobOffer.php');

if (isset($_POST["Create"])) {
    createOffer();
}
//This function is for creating a new jobOffer.
//First it checks if a file is uploaded
// if so the file will be placed in the 'Uploads/Vacatures' folder and the insertOffer function will be called
//If a jobDescription is filled manual the insertOffer function will be called
function createOffer()
{
    include('DBconfig.php');
    $message = "";
    $offerName = htmlspecialchars($_POST["offerName"]);
    $offerFunction = htmlspecialchars($_POST["offerFunction"]);
    $offerBranch = htmlspecialchars($_POST["offerBranch"]);
    $offerManual = htmlspecialchars($_POST["offerManual"]);

//    When a file is entered AND a jobOffer is manually typed a message will appear
    if (is_uploaded_file($_FILES['OfferWordFile']['tmp_name']) && $offerManual != "") {
        $message .= "U kunt geen vacature uploaden en de vacature zelf typen. Verwijder er één en probeer het opnieuw";
    } elseif (is_uploaded_file($_FILES['OfferWordFile']['tmp_name'])) {
        $target_dir = 'Uploads/Vacatures/';
        $target_file = $target_dir . basename($_FILES['OfferWordFile']['name']);
        if (move_uploaded_file($_FILES['OfferWordFile']['tmp_name'], $target_file)) {
            $message .= "Vacature geupload";
        }
        insertOffer($offerName, $offerFunction, $offerBranch, $target_file);
    } elseif ($offerManual != "") {
        $message .= "Vacature geupload";
        insertOffer($offerName, $offerFunction, $offerBranch, $offerManual);
//  When no file is uploaded AND the offer is not manually typed a message will appear
    } else {
        $message .= "Upload een bestand of beschrijf de vacature";
    }
    echo '<script language="javascript">';
    echo 'alert("' . $message . '")';
    echo '</script>';

}

//Function that inserts the jobOffer into the database.
//This function is called when a file is uploaded and the upload jobOffer button is clicked
// or the offer is typed manually and the jobOffer button is clicked.
function insertOffer($offerName, $offerFunction, $offerBranch, $description)
{
    include('DBconfig.php');
    $query = "INSERT INTO joboffer (idJobbranch, idJobfunction, status, name, description) VALUES ('$offerBranch', '$offerFunction', '1', '$offerName', '$description')";
    $stmt = $db->prepare($query);
    $stmt->execute();
}
?>