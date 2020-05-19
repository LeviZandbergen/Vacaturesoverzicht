<?php
include('DBconfig.php');
//Session is destroyed and the user is redirected to the main page
session_destroy();
echo "<script> location.href='../Examen/Index.php'; </script>";
?>