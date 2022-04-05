<?php
print_r($_GET);
if(isset($_GET["other"])){
    if($_GET["other"]==0) {
        include_once "../classes/index.php";        
    }
    else{
        include_once "../classes/index.php";       
    }
    $conn=new DBConnect();
    $result1=0;
    $result2=0;
    if($_GET["user"]=="admin"||$_GET["user"]=="admin?1"||$_COOKIE["role"]=="admin") $result1=$conn->generic_func("Update bookings set seen=1");
    
    else $result2=$conn->generic_func("Update bookings set user_seen=1");
    $r=0;
    if($result1==1||$result2==1){
        $r=1;
    }
    echo $r;
}
?>