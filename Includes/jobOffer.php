<html>
<div class="content">
    <!--    checks the status of the offer and displays it-->
    <?php
    if ($sessionID == 2) {
        echo 'Vacature staat ';
        if ($jobOfferStatus == 0) {
            echo 'uit <br><br>';
        } elseif ($jobOfferStatus == 1) {
            echo 'aan <br><br>';
        }
        //    send status and offer id to jobofferstatus
        echo '<a href="../Examen/jobOfferStatus.php?id=' . $jobOfferID . '&status=' . $jobOfferStatus . '" class="Activate-JobOffer">Vacature aan of uit zetten</a>';
    }
    if ($isFile == true) {
        echo '<div class="description">';
        echo '<a href=" ' . $fileName . '" download> ' . str_replace("Uploads/Vacatures/", "", $fileName) . '</a>';
        echo '</div>';
    } else {
        echo '<div class="description">';
        echo '<p>' . $description . '</p>';
        echo '</div>';
    }
    if ($sessionID != 2) {
        ?>
        <form name="JobOfferReaction" id="JobOfferReaction" method="POST" enctype="multipart/form-data" action="">
            <h3>Reageren op de vacature</h3>
            <a>Toevoegen CV </a><input type="file" class="input-text" name="ReactionCV"<br><br><br>
            <a>Motivatie</a><textarea rows="8" cols="50" name="Motivation"></textarea><br><br>
            <button type="submit" class="button reaction-button" name="Reaction">Verstuur</button>
        </form>
    <?php } ?>
</div>
</html>