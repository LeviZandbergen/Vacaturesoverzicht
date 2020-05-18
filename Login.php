<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('Includes\header.php');
include('Includes\login.php');

if (isset($_POST["login"])) {
    login();
} elseif (isset($_POST["register"])) {
    register();
}

function login()
{
    include('DBconfig.php');
    $error = "";
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $manager = false;
    try {
        $sql = "SELECT managerID, manEmail as email, manPassword as password, isManager FROM manager WHERE manEmail = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($email));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $manager = true;
        }
        if ($result) {
            $hash = $result["password"];
            if (password_verify($password, $hash)) {
                if ($manager == true) {
                    $_SESSION['ID'] = 2;
                } else {
                    $_SESSION["ID"] = 1;
                }
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
    echo '<script language="javascript">';
    echo 'alert("' . $error . '")';
    echo '</script>';
}

function register()
{
    include('DBconfig.php');
    $error = "";

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $validatedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result > 0) {
        $error .= "Dit emailadres is al in gebruik";
    } else {
        $query = "INSERT INTO user (email, password) VALUES ('$validatedEmail', '$hashedPassword')";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $error .= "gebruiker succesvol aangemaakt";
    }

    echo '<script language="javascript">';
    echo 'alert("' . $error . '")';
    echo '</script>';
}

?>
