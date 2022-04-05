<?php
if(isset($_GET["name"])){
    $sql="Select ab.booking_name,a.adventure_name,ab.price,ab.date_booked,ab.payment_status from adventure_booked ab inner join adventure a on a.id=ab.adventure_id where booking_name like '%".$_GET["name"]."%'";
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
        array_push($arr,array("username"=>$row["booking_name"],"name"=>$row["adventure_name"],"date"=>$row["date_booked"],"price"=>$row["price"],"payment"=>$pay));
    }
    echo json_encode($arr);
}else{
    echo json_encode(["Error occured"]);
}
?>
