<?php
include_once "../classes/index.php";
$conn=new DBConnect();
$result=$conn->own_query("Select * from login where role<>'admin'");
$arr22=array();
foreach($result as $row){
        array_push($arr22,array("username"=>$row["username"],"status"=>$row["status"],"role"=>$row["role"]));
}
    echo json_encode($arr22);
?>