<html>
<div class="content">
    <div id="mainPageContent">

        <div id="SideContent">
            <a href="newJobOffer.php">Nieuwe vacature toevoegen</a>
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
