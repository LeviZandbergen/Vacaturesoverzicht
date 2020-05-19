<html>
<div class="content">
    <div id="mainPageContent">

        <div id="SideContent">
            <?php if ($sessionID == 2) {
                echo '<a class="newOffer" href="newJobOffer.php">Nieuwe vacature toevoegen</a>';
            }
            ?>
        </div>

        <div id="JobOfferList">
            <?php
            //            shows all joboffers
            foreach ($result as $key => $value) {
                echo '<a class="jobOffer" href="../Examen/jobOffer.php?id= ' . $value["jobofferID"] . ' " class="jobOfferName"><strong>' . ucfirst($value["name"]) . '</strong></a>';
            }
            ?>
        </div>
    </div>
</div>
</html>
