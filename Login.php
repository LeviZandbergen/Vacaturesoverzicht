<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('Includes\header.php');
include('Includes\login.php');

if (isset($_POST["login"])) {
    login();
} elseif (isset($_POST["register"])) {
    register();
}

//This function processes the login of the user. When the email and password are filled in the email is checked in the user and manager table.
//If they are not present a alert will appear.
//When the email is present in one of those tables a session will be set.
//The session id will stands for if the user is a manager or just a regular user
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

//In this function a new user can be made. First the email will be validated and the password will be hashed.
//Then the function checks if the email is already present in the user or manager table.
//If so a alert will appear.
//If not, a new user will be created in the user table
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

//    When there is no result from the user table it will check the manager table if the email is already present there
    if (!$result) {
        $sql = "SELECT * FROM manager WHERE manEmail = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
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
