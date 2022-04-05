<?php
$hostname="localhost";
$username="root";
$password="";
$db_name="7sem_project";
$conn=mysqli_connect($hostname,$username,$password,$db_name);
if(!$conn){
    echo "Database connection failed.Contact administrator";
}
?>