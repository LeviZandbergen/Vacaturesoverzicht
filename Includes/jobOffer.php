<html>
<div class="content">
    <?php
    if ($isFile == true) {
        echo '<a href=" ' . $fileName . '" download> ' . str_replace("Uploads/Vacatures/", "", $fileName) . '</a>';
    } else {
        echo '<div class="description">';
        echo $description;
        echo '</div>';
    }
    ?>
    <form name="JobOfferReaction" id="JobOfferReaction" method="POST" enctype="multipart/form-data" action="">
        <h3>Reageren op de vacature</h3>
        <a>Toevoegen CV </a><input type="file" class="input-text" name="ReactionCV"<br><br><br>
        <a>Motivatie</a><textarea rows="8" cols="50" name="Motivation"></textarea><br><br>
        <button type="submit" class="button reaction-button" name="Reaction">Verstuur</button>
    </form>
</div>
</html>