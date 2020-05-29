<html>
<div class="content">
    <div id="mainPageContent">

        <div id="SideContent">
            <?php if ($sessionID == 2) {
                echo '<a class="newOffer" href="newJobOffer.php">Nieuwe vacature toevoegen</a>';
            }
            ?>
            <form name="filter" id="filter" method="POST" enctype="multipart/form-data" action="">
                Zoeken: <input type="search"><br>

                Catagoriseer<select>
                    <option></option>
                </select><br>

                Filter<select>
                    <?php
                    foreach ($branches as $branch) {
                        echo '<option>';
                        echo $branch['branchName'];
                        echo '</option>';
                    }
                    ?>
                    <option></option>
                </select>
            </form>
        </div>

        <div id="JobOfferList">
            <?php
            //            shows all joboffers
            foreach ($result as $key => $value) {
                echo '
                <div class="jobOffer">
                    <a href="../Examen/jobOffer.php?id= ' . $value["jobofferID"] . ' " class="jobOfferName">
                    <strong>' . ucfirst($value["name"]) . '</strong></a>
                    <a href="../Examen/newJobOffer.php?id= ' . $value["jobofferID"] . ' ">dupliceer</a>
                </div>  
                ';
            }
            ?>
        </div>
    </div>
</div>
</html>
