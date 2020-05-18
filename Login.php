<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');
include('Includes\login.php');

$error = "";
if (isset($_POST["submit"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    try {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $hash = $result["password"];
            if (password_verify($password, $hash)) {
                $_SESSION["ID"] = 1;
                $_SESSION["EMAIL"] = $result["email"];
                $_SESSION["STATUS"] = 1;
                echo "<script>location.href='index.php';</script>";
            } else {
                $error .= "U heeft verkeerde gegevens ingevuld";
            }
        } else {
            $error .= "U heeft verkeerde gegevens ingevuld";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
echo '<script language="javascript">';
echo 'alert("' . $error . '")';
echo '</script>';
//echo "<div id='meldingen'>" . $error . "</div>";
?>