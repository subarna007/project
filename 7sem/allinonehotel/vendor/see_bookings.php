<?php
include_once "../dashboard-components/dashboard.php";
include_once "../classes/index.php";
$conn=new DBConnect();
echo "<div class='wrapper'>";
$result=$conn->own_query("Select * from adventure_booked where date_booked>='".date("Y-m-d")."'");
if(count($result)>0){
    $table="<table class='table table_striped'><tr>
        <th>S.N.</th>
        <th>Username</th>
        <th>Upcoming Booking Date</th>
        <th>Price</th>
    </tr>";$i=0;
    foreach($result as $row){
        $table.=" <tr>";
            $table.="<td>".++$i."</td>";
            $table.="<td>".$row["booking_name"]."</td>";
            $table.="<td>".$row["date_booked"]."</td>";
            $table.="<td>".$row["price"]."</td>";
        $table.="  </tr> ";
    }
    $table.="</table>";
    echo $table;
}
else{
    echo "<h3>"."No bookings found."."</h3>";
}
echo '</div>';
?>