<link rel="stylesheet" type="text/css" href="Css/style.css">
<?php

include('DBconfig.php');
include('Includes\header.php');


echo('test');
$sql = "SELECT email FROM user";
$stmt = $db->prepare($sql);
$stmt->execute(array());
$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump(password_hash('password', PASSWORD_DEFAULT))

?>