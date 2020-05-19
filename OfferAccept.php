<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php
include('DBconfig.php');
//checks if logged in user is manager, if not send back to index
if ($_SESSION['ID'] != 2) {
    header('Location: index.php');
    exit;
}
include('Includes\header.php');
//Gets the offerReaction to show
$reactionID = $_GET['reactionId'];
$sql = "SELECT * FROM offerReaction WHERE offerReactionID = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($reactionID));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$motivation = $result['motivation'];

include('Includes\offerAccept.php');

//get the message and datetime from the form and sends them to the sendAcceptMail function
if (isset($_POST['sendOffer'])) {
    $message = htmlspecialchars($_POST['PersonalMessage']);
    $dateTime = htmlspecialchars($_POST['offerDate']);
    sendAcceptMail($message, $dateTime);
}

//This function first gets the mail of the person that wrote the offerReaction, Then creates the mail with the message and date
//When the message is send it shows an alert
//When the message is not send it also shows an alert
function sendAcceptMail($message, $dateTime)
{
    include('DBconfig.php');
    try {
        $reactionID = $_GET['reactionId'];
        $sql = "SELECT email FROM offerReaction join user on offerReaction.idUser = user.userID where offerReactionID = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($reactionID));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $result['email'];
        $dateTime = new DateTime($dateTime);

        require 'libraries/phpmailerautoload.php';
        $mail = new PHPMailer();

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = ' smtp.mailtrap.io';          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'e1d8900377c5c3';         // SMTP username
        $mail->Password = '9795fa3af2523d';         // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                           // TCP port to connect to

        $mail->setFrom('ad558a8c2f-350ab9@inbox.mailtrap.io', 'Webshop');
        $mail->addReplyTo('ad558a8c2f-350ab9@inbox.mailtrap.io', 'Webshop');
        $mail->addAddress($email);   // Add a recipient
        $mail->Subject = "Reactie Vacature";

        $mail->Body = $message . '<br><br>' . 'Wij verwachten u op: ' . $dateTime->format("d-m-Y") . ' om: ' . $dateTime->format('H:i');
        $mail->isHTML(true);  // Set email format to HTML
        $mail->send();

        echo '<script language="javascript">';
        echo 'alert("Uw uitnodiging is verstuurd")';
        echo '</script>';

    } catch (PDOException $e) {
        echo $e->getMessage();

        echo '<script language="javascript">';
        echo 'alert("De uitnodiging kon niet verzonden worden, probeer het opnieuw")';
        echo '</script>';

    }
}
