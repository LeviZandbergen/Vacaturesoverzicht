<html>
<div class="content">
    <div class="accepted-motivation">
        <p> <?php echo $motivation ?></p>
    </div>
    <br>
    <form name="acceptOffer" id="acceptOffer" method="POST" enctype="multipart/form-data" action="">
        <a>Persoonlijk bericht</a><textarea rows="15" cols="200%" name="PersonalMessage"></textarea><br><br>

        <a>Datum en tijd selecteren</a><br>
        <input type="datetime-local" id="offerDate" name="offerDate"><br><br>
        <button type="submit" class="button login-register-button" name="sendOffer">Uitnodiging versturen</button>
    </form>
</div>
</html>