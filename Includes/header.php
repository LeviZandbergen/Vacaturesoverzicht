<?php

include('DBconfig.php');
?>

<html>
<div class="header">
    <?php
    if ($_SESSION['STATUS'] == 1) {
        ?>
        <a href="../examen/Logout.php" class="nav-item">
            Logout
        </a>
        <?php
    } else {
        ?>
        <a href="../examen/Login.php" class="nav-item">
            Log in
        </a>
        <?php
    }
    ?>
    <a href="../examen/index.php" class="nav-item">
        Hoofdpagina
    </a>
</div>
</html>
