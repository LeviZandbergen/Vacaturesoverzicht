<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');

if (isset($_POST["Create"])) {
    createOffer();
} elseif (isset($_POST['Save'])) {
    $id = $_GET['id'];
    editOffer($id);
}
$jobBranch = '';
$jobFunction = '';
$jobName = '';
$jobDescription = '';

//When a id is send in the header the code queries for the joboffer with that id and fills in the fields with it's data
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `joboffer` WHERE jobofferID = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $jobBranch = $result['idJobbranch'];
    $jobFunction = $result['idJobfunction'];
    $jobName = $result['name'];

    $isFile = false;
    $variable = 'filename: ' . $result['description'];
//    Checks if description is a file or a manually typed description
//    When it is a file the filename will be send to the html, otherwise the full description
    if (strpos($variable, 'Uploads/Vacatures/')) {
        $isFile = true;
        $fileName = $result['description'];
    } else {
        $jobDescription = $result['description'];
    }
//    When an edit value is send via the url the button changes to a save button instead of creating a new jobOffer
    if (!empty($_GET['edit'])) {
        $edit = true;
    }
}
include('Includes\newJobOffer.php');

//This function is for creating a new jobOffer
//It gets the data from the form and calls the message function and displays the message
function createOffer()
{
    include('DBconfig.php');
    $offerName = htmlspecialchars($_POST["offerName"]);
    $offerFunction = htmlspecialchars($_POST["offerFunction"]);
    $offerBranch = htmlspecialchars($_POST["offerBranch"]);
    $offerManual = htmlspecialchars($_POST["offerManual"]);

    $message = messages($offerName, $offerFunction, $offerBranch, $offerManual);

    echo '<script language="javascript">';
    echo 'alert("' . $message . '")';
    echo '</script>';

}

//Gets the data from the form and calls in the message function and displays the message
function editOffer($id)
{
    $offerName = htmlspecialchars($_POST["offerName"]);
    $offerFunction = htmlspecialchars($_POST["offerFunction"]);
    $offerBranch = htmlspecialchars($_POST["offerBranch"]);
    $offerManual = htmlspecialchars($_POST["offerManual"]);

    $message = messages($offerName, $offerFunction, $offerBranch, $offerManual, true, $id);

    echo '<script language="javascript">';
    echo 'alert("' . $message . '")';
    echo '</script>';
}

//This function checks if the fields are filled in right and creates a message according to the status.
//When the fields are filled correctly the updateOffer or insertOffer function is called
function messages($offerName, $offerFunction, $offerBranch, $offerManual, $edit = false, $id = null)
{
    $message = '';
    //    When a file is entered AND a jobOffer is manually typed a message will appear
    if (is_uploaded_file($_FILES['OfferWordFile']['tmp_name']) && $offerManual != "") {
        $message .= "U kunt geen vacature uploaden en de vacature zelf typen. Verwijder er één en probeer het opnieuw";
    } elseif (is_uploaded_file($_FILES['OfferWordFile']['tmp_name'])) {
        $target_dir = 'Uploads/Vacatures/';
        $target_file = $target_dir . basename($_FILES['OfferWordFile']['name']);
        if (move_uploaded_file($_FILES['OfferWordFile']['tmp_name'], $target_file)) {
            if ($edit) {
                $message .= "Vacature geupdate";
            } else {
                $message .= "Vacature geupload";
            }
        }
        if ($edit) {
            updateOffer($offerName, $offerFunction, $offerBranch, $target_file, $id);
        } else {
            insertOffer($offerName, $offerFunction, $offerBranch, $target_file);
        }
    } elseif ($offerManual != "") {
        if ($edit) {
            $message .= "Vacature geupdate";
        } else {
            $message .= "Vacature geupload";
        }
        if ($edit) {
            updateOffer($offerName, $offerFunction, $offerBranch, $offerManual, $id);
        } else {
            insertOffer($offerName, $offerFunction, $offerBranch, $offerManual);
        }
//  When no file is uploaded AND the offer is not manually typed a message will appear
    } else {
        $message .= "Upload een bestand of beschrijf de vacature";
    }
    return $message;
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

//Function that updates the jobOffers data in the database
//This function is called when a file is uploaded and the save button is clicked
// or the offer is typed manually and the save button is clicked.
function updateOffer($offerName, $offerFunction, $offerBranch, $description, $id)
{
    include('DBconfig.php');
    $sql = "UPDATE joboffer SET idJobbranch = '$offerBranch', idJobfunction = '$offerFunction', name = '$offerName', description = '$description' WHERE jobofferID = $id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}

?>