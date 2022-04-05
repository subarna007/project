<?php
include_once "../classes/index.php";
include_once "../dashboard-components/dashboard.php";
$sql="Select * from bookings where status=0 and check_in_date>='".date("Y-m-d")."' ";
echo $sql;
$conn=new DBConnect();
$result=$conn->own_query($sql);//mysqli_query($conn,$sql);
echo "<div class='wrapper'>";
$table= "<table class='table'>";
$table.= "<tr><th>S.N.</th><th>Room Name</th><th>Username</th><th>Check In Date</th><th>Check Out Date</th><th>Price</th><th>Options</th></tr>";
$i=0;
if(count($result)>0){
    // while($row=mysqli_fetch_assoc($result)){
        foreach($result as $row){
            $table.= "<tr><td>".++$i."</td>";
            $table.= "<td>".$row['room_name']."</td>";
            $table.= "<td>".$row['username']."</td>";
            $table.= "<td>".$row['check_in_date']."</td>";
            $table.= "<td>".$row['check_out_day']."</td>";        
            $table.= "<td>".$row["price"];
            $result2=$conn->own_query("Select * from packages where name='".$row['username']."' and check_in_date='".$row["check_in_date"]."' and check_out_date='".$row["check_out_day"]."'");
            $package=array();
            if(count($result2)){
                    foreach($result2 as $row2){
                    $package=[$row2["package_name"],$row2["price"]];
                    }
            }
            $table.= "</td>";
            if($row["payment_date"]==0){
                if(count($package)==0)$table.= "<td><button onclick='checkout(\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Checkout</button></td>";
                else $table.= "<td><button onclick='checkout(\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\",\"".$package[0]."\",\"".$package[1]."\")'>Checkout</button></td>";
        
            }
            $table.= "</tr>";
        
       
        }
        echo $table."</table>";
}
else{
    echo "No bookings found after ".date("Y-m-d")."!";
}
echo "</div>";
?>
<script>
    function checkout(id1,c_in,c_out,package1="",price=""){
        console.log(id1,c_in,c_out,package1,price);
        if(package1==""){
            package1="no";
        }
        location.href="../payment/bill.php?id="+id1+"&cin="+c_in+"&cout="+c_out+"&package="+package1+"&pkg_price="+price;
    }
</script>