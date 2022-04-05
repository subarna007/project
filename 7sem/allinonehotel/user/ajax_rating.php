<?php
include_once "../classes/index.php";
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(isset($_COOKIE['logged'])&&isset($_GET["id"])&&isset($_GET["ratings"])){
    if($_COOKIE['logged']!="reset"||$_COOKIE["logged"]!="admin@email.com"){
        $rating=explode("-",$_GET["ratings"]);
        $username=$_COOKIE["logged"];
        $id=$_GET["id"];
        $conn=new DBConnect();
        $result=$conn->updation("bookings",
        ['ratings'],[$rating[1]],
        ['id'],[$id]);
        echo $result;
    }
}
else{
    echo "111";
}
?>