<html>
<div class="content">
    <form name="creatJobOffer" id="newJobOffer" method="POST" enctype="multipart/form-data" action="">
        <a>Vacature naam</a><input type="text" class="input-text" name="offerName"
                                   value="<?php echo $jobName ?>"><br><br>
        <a>Vacature functie</a><select name="offerFunction">
            <?php
            //            selects all jobfunctions and shows them in a select with the id as value
            $sql = "SELECT * FROM jobfunction";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) {
                if ($value['jobfunctionID'] == $id) {
                    echo '<option selected="selected" value="' . $value['jobfunctionID'] . '"';
                }
                echo '<option value="' . $value['jobfunctionID'] . '">';
                echo $value['functionName'];
                echo '</option>';
            }
            ?>
        </select><br><br>
        <a>Vacature branch</a><select name="offerBranch">
            <?php
            //            selects all jobbranches and shows them in a select with the id as value
            $sql = "SELECT * FROM jobbranch";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) {
                if ($value['jobbranchID'] == $id) {
                    echo '<option selected="selected" value="' . $value['jobbranchID'] . '"';
                }
                echo '<option value="' . $value['jobbranchID'] . '">';
                echo $value['branchName'];
                echo '</option>';
            }
            ?>
        </select><br><br>
        <a>Word bestand uploaden</a><input type="file" class="input-text" name="OfferWordFile"<br><br>
        <a>Of typ zelf een vacature</a><textarea rows="15" cols="100%" name="offerManual">
            <?php if (!$isFile) {
                echo $jobDescription;
            } ?>
        </textarea><br><br>
        <?php if ($edit) {
            echo '<button type="submit" class="button login-register-button" name="Save">opslaan</button>';
        } else {
            echo '<button type="submit" class="button login-register-button" name="Create">Vacature online zetten</button>';
        } ?>
    </form>
</div>
</html>