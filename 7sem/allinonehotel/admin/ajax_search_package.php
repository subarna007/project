<?php
if(isset($_GET["name"])){
    $sql="Select * from packages where name like '%".$_GET["name"]."%'";
    include_once "../classes/index.php";
    $conn=new DBConnect();
    $arr=array();
    $result=$conn->own_query($sql);
    foreach($result as $row){
        if($row["payment_status"]==0){
            $pay="Unpaid";
        }
        else{
            $pay="paid";
        }
        array_push($arr,array("username"=>$row["name"],"name"=>$row["package_name"],"date"=>$row["check_in_date"]." & ".$row["check_out_date"],"price"=>$row["price"],"payment"=>$pay));
    }
    echo json_encode($arr);
}
else{
    echo json_encode(["Error occured"]);
}
?>
