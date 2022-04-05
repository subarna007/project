<form method="post" action="">      
    <fieldset>      
        <legend>What is Your Favorite Pet?</legend>      
        <input type="checkbox" name="favorite_pet[]" value="Cats">Cats<br>      
        <input type="checkbox" name="favorite_pet[]" value="Dogs">Dogs<br>      
        <input type="checkbox" name="favorite_pet[]" value="Birds">Birds<br>      
        <br>      
        <input type="submit" name="submit" value="Submit now" />      
</fieldset>
</form>
<?php
if(isset($_POST["submit"])){
    print_r($_POST['favorite_pet']);
}
?>