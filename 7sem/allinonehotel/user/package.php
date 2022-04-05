<?php
include_once "../classes/index.php";
include_once "../dashboard-components/dashboard.php";
$conn=new DBConnect();
$result=$conn->select("packages",["name"],[$_COOKIE["logged"]]);
$table="<table><tr>
        <th>S.N</th>
        <th>Package Name</th>
        <th>Check In Date</th>
        <th>Check Out Date</th>
        <th>Options</th>
    </tr>";
$i=0;
if(count($result)>0){
    foreach($result as $row){
       $table.= "<tr>";
           $table.= "<td>".++$i."</td>";
           $table.= "<td>".$row["package_name"]."</td>";
           $table.= "<td>".$row["check_in_date"]."</td>";
           $table.= "<td>".$row["check_out_date"]."</td><td>";
            // if($row["payment_status"]=="1") {
                $result1=$conn->own_query("Select * from bookings where  check_in_date='".$row["check_in_date"]."' and check_out_day='".$row["check_out_date"]."'");
            $table.=count($result1);
                if(count($result1)==0){
                    // foreach($result1 as $row1){
                    //     if(count($row1)==1){
                    //         if($row1["payment_date"]=="0"&&date("Y/m/d")<=str_replace("-","/",$row1["check_out_day"])){
                    //         $table.= "<button class='checkout12' onclick='checkout(\"".$row1['user_id']."\",\"".$row1["check_in_date"]."\",\"".$row1["check_out_day"]."\")'>Pay Bills</button>";
                    //             }
                        
                    //     }
                    // }
                    $table.="<button>Select room</button>";
                }
            // }
            $table.="<button>Edit</button><button>Delete</button>";
            
            $table.="</td>";
       $table.= "</tr>";
    }
}
$table.="</table>";
echo $table;
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