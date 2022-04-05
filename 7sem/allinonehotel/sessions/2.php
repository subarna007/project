<?php
session_start();
echo "Welcome ";print_r ($_COOKIE);
if(isset($_COOKIE['logged'])){
    echo "<br> Cookie is still there as: ".$_COOKIE['logged'];
}
?>