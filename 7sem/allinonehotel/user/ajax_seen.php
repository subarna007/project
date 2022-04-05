<?php
include_once "../classes/index.php";
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(isset($_COOKIE['logged'])&&isset($_GET["id"])){
    if($_COOKIE['logged']!="reset"||$_COOKIE["logged"]!="admin@email.com"){
        $username=$_COOKIE["logged"];
        $id=$_GET["id"];
        $conn=new DBConnect();
        $result=$conn->updation("bookings",
        ['seen'],["1"],
        ['id','seen'],[$id,"0"]);
        $r="0";
        if($result){
            $r="1";
        }
        echo $r;
    }
}
else{
    echo "111";
}
?>