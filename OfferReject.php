<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
//checks if logged in user is manager, if not send back to index
if ($_SESSION['ID'] != 2) {
    header('Location: index.php');
    exit;
}
include('Includes\header.php');

try {
//    Gets the mail of the user that wrote the reaction and sends mail to that user
    $offerReactionID = $_GET['reactionId'];
    $sql = "SELECT email FROM offerReaction join user on offerReaction.idUser = user.userID where offerReactionID = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($offerReactionID));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = $result['email'];

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
    $mail->Subject = "Reactie afgekeurd";

    $mail->Body = "Uw reactie is afgekeurd";
    $mail->isHTML(true);  // Set email format to HTML
    $mail->send();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo $e->getMessage();
}