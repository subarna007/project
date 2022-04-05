<?php
include_once "../classes/index.php";
$status=0;
$conn=new DBConnect();
if(isset($_GET["user_id"])&&isset($_GET["status"])){
    $user_id=$_GET["user_id"];
    if($_GET["status"]=="0"){
        $status=1;
    }
    else{
        $status=0;
    }
  $result1=$conn->generic_func("Update login set status=$status where username='$user_id';");
    echo $result1;
}
?>