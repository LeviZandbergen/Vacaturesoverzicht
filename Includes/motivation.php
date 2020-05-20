<?php foreach ($motivations as $motivation) { ?>
    <div class="jobOfferMotivation">
        <a class="motivationDownload" href="<?php echo $motivation['cv'] ?>" download>Download CV</a>
        <div class="motivation-text">
            <p><?php echo $motivation['motivation'] ?></p>
        </div>
        <div class="accept-reject-buttons">
            <a href="../Examen/offerAccept.php?reactionId=<?php echo $motivation['offerReactionID'] ?>"
               class="accept-button">Accepteren</a>
            <a href="../Examen/offerReject.php?reactionId=<?php echo $motivation['offerReactionID'] ?>"
               class="reject-button">Afwijzen</a>
        </div>
    </div>
<?php } ?>