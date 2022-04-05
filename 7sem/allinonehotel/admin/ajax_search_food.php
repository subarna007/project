<?php
if(isset($_GET["name"])){
    $sql="Select u.username,fo.food_name,fo.date2,fo.price,fo.payment_status from food_order fo inner join user_details u on u.id=fo.user_id where username like '%".$_GET["name"]."%'";
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
        array_push($arr,array("username"=>$row["username"],"name"=>$row["food_name"],"date"=>$row["date2"],"price"=>$row["price"],"payment"=>$pay));
    }
    echo json_encode($arr);
}
else{
    echo json_encode(["Error occured"]);
}
?>
