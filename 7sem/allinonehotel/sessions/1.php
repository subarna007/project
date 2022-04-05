<form action="" method="post">
    <input type="text" name="usr">
    <input type="submit" value="Submit" name="submit">
</form>
<?php
session_start();
$_SESSION["name"]="sadsa";
if(isset($_POST["submit"])){
    $login=$_POST["usr"];
    $_SESSION["logged"]=$login;
    $cookie_name = "logged";
    setcookie($cookie_name, $login, time() + (86400 * 30)); 
}

?>
<a href="2.php">2nd</a>
<a href="3.php">3rd</a>
