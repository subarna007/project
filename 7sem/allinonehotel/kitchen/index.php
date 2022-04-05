<?php
include_once "../dashboard-components/dashboard.php";
include_once "../classes/index.php";
$conn=new DBConnect();
echo "<div class='wrapper'>";
if(isset($_GET["confirm"])){
 echo "Order confirmed";   
}
$sql= "Select fo.id,fo.food_name, fo.user_id, fo.date2, fo.qty, fo.price, fo.payment_status, fo.ack,b.room_number,
b.username 
from food_order fo inner join bookings b on b.user_id=fo.user_id
 where date2>='".date("Y-m-d")."' and date2>=b.check_in_date and  date2<=b.check_out_day";
$result=$conn->own_query($sql." and ack=0");
$result2=$conn->own_query($sql." and ack<>0");
watching($result,"<h3>New Orders received</h3>","No new Orders found");
watching($result2,"<h3>Old Orders</h3>","No old Orders found");
function watching($result,$caption="",$error="0"){
    if(count($result)>0){
        $table="<caption>$caption</caption><table class='table table_striped'><tr>
            <th>S.N.</th>
            <th>Food Name</th>
            <th>Order Date</th>
            <th>Quantity</th>
            <th>Room number</th>
            <th>Username</th>
            <th>Acknowledge</th>
        </tr>";$i=0;
        foreach($result as $row){
            $table.=" <tr>";
                $table.="<td>".++$i."</td>";
                $table.="<td>".$row["food_name"]."</td>";
                $table.="<td>".$row["date2"]."</td>";
                $table.="<td>".$row["qty"]."</td>";
                $table.="<td>".$row["room_number"]."</td>";            
                $table.="<td>".$row["username"]."</td>";
                $table.="<td>";
                if($row["ack"]==0){
                    $table.="<form method='post'><button name='confirm' value='".$row['id']."'>Confirm</button></form>";
                }
                else{
                    $table.="<p style='background:green;border-radius:8px;padding:8px 6px;color:white;font-weight:550;'>Confirmed</p>";
                }
                $table.="</td>";
            $table.="  </tr> ";
        }
        $table.="</table>";
        echo $table;
    }
    else{
        if($error!="0")  echo "<h3>".$error."</h3>";
    }
}
echo '</div>';
if(isset($_POST["confirm"])){
    $btn=$_POST["confirm"];
    $sql="Update food_order set ack=2 where id='$btn'";
    $result=$conn->generic_func($sql);
    if($result==1){
        echo "<script>location.href=location.href;</script>";
    }
}

?>