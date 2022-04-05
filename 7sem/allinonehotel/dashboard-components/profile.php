<?php
include_once "../config.php";
include_once "../dashboard-components/dashboard.php";
echo "<div class='wrapper'>";
if(session_status() == PHP_SESSION_NONE){
session_start();
}
if(session_status() == PHP_SESSION_ACTIVE){
    $username=$_COOKIE["logged"];
    $sql="Select * from user_details where username='$username'";
    if($result=mysqli_query($conn,$sql)){
        while($row=mysqli_fetch_assoc($result)){
            echo "Username:".$row['username']."<br>";
            echo "Address:".$row['address']."<br>";
            echo "Contact:".$row['contact']."<br>";
            echo "Creation Date:".$row['creation_date']."<br>";
            echo "Verification Status:";
            if($row['verification_status']==1) echo"Verified";
            else echo "Not verified";
        }
    }
}
else{
    // header("Location:../index.php");
}
echo "</div>";
?>