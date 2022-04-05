<style>
  .checkout12{
            min-width:200px;
            text-align:center;
            text-decoration:none;
            padding:8px 10px;
            background: rgb(15,25,25);
            color: white;
            font-size: 22px;
            border-radius: 10px;
}
</style>
<?php
include_once "../dashboard-components/dashboard.php";
include_once "../classes/index.php";
$conn=new DBConnect();
echo "<div class='wrapper'>";
echo "<h2>See Bills</h2>";
  $sql="Select * from bookings where username='".$_COOKIE['logged']."'";
  $result=$conn->own_query($sql);
  if(count($result)>=1){
      foreach($result as $row){
        echo "<table><tr><td><strong><i>Username:</i></strong></td><td>".$row["username"]."</td></tr>";
        echo "<tr><td><strong><i>Room Name</i></strong></td><td>".$row["room_name"]."</td></tr>";
        echo "<tr><td><strong><i>Check in date</i></strong></td><td>".$row["check_in_date"]."</td></tr>";
        echo "<tr><td><strong><i>Check out date</i></strong></td><td>".$row["check_out_day"]."</td></tr>";
        echo "<tr><td><strong><i>Room Number</i></strong></td><td>".$row["room_number"]."</td></tr>";
        echo "<tr><td><strong><i>Price</i></strong></td><td>";
        if($row["price"]=="0"){
          echo "Under Package";
        }
        else{
          echo $row["price"];
        }
        echo "</td></tr></table><br><br>";
        $result2=$conn->own_query("Select * from packages where name='".$row['username']."' and check_in_date='".$row["check_in_date"]."' and check_out_date='".$row["check_out_day"]."'");
       $package=array();
        if(count($result2)>0){
           foreach($result2 as $row2){
           $package=[$row2["package_name"],$row2["price"]];
           }
       }
        if($row["payment_date"]=="0"&&date("Y/m/d")<=str_replace("-","/",$row["check_out_day"])){
          if(count($package)==0)echo "<td><button style='background:green;border:none' class='checkout12' onclick='checkout(\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Pay Bills</button></td>";
        else echo "<td><button class='checkout12'  onclick='checkout(\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\",\"".$package[0]."\",\"".$package[1]."\")'>Pay Bills</button></td>";
        echo "</tr>";
        }
        if($row["ratings"]=="-1"){
            echo "<a style='
            min-width:200px;
            text-align:center;
            text-decoration:none;
            padding:8px 10px;
            background: #4285f4;
            color: white;
            font-size: 22px;
            float:right;
            margin-right:40vw;
            border-radius: 10px;' href='../user/ratings.php?room_name=".$row["room_name"]."&id=".$row["id"]."'>Rate Now</a>";
        }
       echo "</span><hr>";
      }
  }
  else{
    echo "Error occured";
  }
echo "</div>";
$conn=new DBConnect();
// if(isset($_POST["check_out"])){
// $check_out=$_POST["check_out"];
// $result=$conn->updation("room_details",
// ['status'],['1'],
// ['status','id'],['0',$check_out]);
// }
// // if(isset($_POST["rate_now"])){
// // $rate_now=$_POST["rate_now"];
// // $result=$conn->updation("",[],[],[],[]);
// // echo "<script>alert('".$rate_now."')</script>";
// // }
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