<?php
session_start();
echo "Third page still working on ".$_SESSION["name"];
echo "Here we go ".$_SESSION["logged"];
print_r ($_COOKIE);
if(isset($_COOKIE['logged'])){
    echo "<br> Cookie is still there as: ".$_COOKIE['logged'];
}
?>