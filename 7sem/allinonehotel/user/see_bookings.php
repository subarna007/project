<link rel="stylesheet" href="../css/table.css">
<?php
include_once "../classes/index.php";
include_once "../dashboard-components/dashboard.php";
include_once "../classes/modal.php";
$sql="Select * from bookings where username='".$_COOKIE["logged"]."'";
// echo $sql;
$conn=new DBConnect();
$result=$conn->own_query($sql);//mysqli_query($conn,$sql);
echo "<div class='wrapper'>";
echo "<h2>See All Bookings</h2>";
echo "<table class='table'>";
echo "<tr><th>S.N.</th><th>Room Name</th><th>Username</th><th>Check In Date</th><th>Check Out Date</th><th>Price</th><tH>Payment Status</tH><th>Options</th></tr>
";$i=0;
if(count($result)){
    foreach($result as $row){
        echo "<tr><td>".++$i."</td>";
        echo "<td>".$row['room_name']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['check_in_date']."</td>";
        echo "<td>".$row['check_out_day']."</td>";        
        $result2=$conn->own_query("Select * from packages where name='".$row['username']."' and check_in_date='".$row["check_in_date"]."' and check_out_date='".$row["check_out_day"]."'");
       $package=array();
        if(count($result2)>0){
           foreach($result2 as $row2){
           $package=[$row2["package_name"],$row2["price"]];
           }
       }
       if($row["price"]!="0") echo "<td>".$row["price"];
       else echo "<td>".ucfirst($package[0])." Package";
        echo "</td>";
        echo "<td>";
            if($row["payment_date"]=="0"){
                echo "Unpaid";
            }
            else{
                echo "Paid on-".$row["payment_date"];
            }
        echo "</td>";
        if($row["status"]==0 && $row["check_in_date"]>=date("Y-m-d")){
            if(count($package)==0) echo "<td><button onclick='checkout(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Cancel bookings</button>";
            else echo "<td><button onclick='checkout(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\",\"".$package[0]."\",\"".$package[1]."\")'>Cancel bookings</button>";
            // if($row["payment_date"]!="0"){
            //     echo '<button>see Bills</button>';
            // }
            echo "<button onclick='change_details(\"".$row["id"]."\",\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Change Details</button>";
            echo "</td>";
        }
        if($row["check_in_date"]==0||$row["check_in_date"]==""){
            echo "<td><button onclick='check_in(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["id"]."\")'>Check In Date</button></td>";
        }
        else{
            echo "<td></td>";
        }
        echo "</tr>";

    }
}
else{
    echo "No bookings found!";
}
echo "</table>";

$sql2="Select * from adventure_booked where booking_name='".$_COOKIE["logged"]."'";
$result2=$conn->own_query($sql2);
if(count($result2)>0){
    echo "<caption><h2>Adventure records</h2></caption><table class='table'>";
    echo "<tr><th>S.n</th><th>Adventure Name</th><th>Booked Date</th><th>Payment Status</th><th>Option</th></tr>";
    $i=0;
    foreach($result2 as $row2){
        echo "<tr>";
        echo "<td>".++$i."</td>";
        echo "<td>".$row2["adventure_id"]."</td>";
        echo "<td>".$row2["date_booked"]."</td>";
        echo "<td>";
            if($row2["payment_status"]=="0"){
                echo "<td>Unpaid</td>";
            }
            else{
                echo "<td></td>";
            }
        echo "</td>";
        echo "<td>"."<form method='post'><button type='submit' name='cancel_adventure1' value='".$row2['id']."%^&".$row2["adventure_id"]."'>Cancel</button>
        <button type='submit' name='edit_adventure' value='".$row2['id']."%^&".$row2['date_booked']."'>Edit</button>
        </form>"."</td>";
        echo "</tr>";
    }
echo "</table>";
}
else{
   
    echo "<h2>No adventure booked yet</h2>";
}
if(isset($_POST["cancel_adventure1"])){
    $f=explode("%^&",$_POST["cancel_adventure1"]);
    $result22=$conn->deletion("adventure_booked",["id"],[$f[0]]);
    if($result22=="1"){
        echo "Adventure with id ". $f[1] ." has been cancelled";
    }
}
if(isset($_POST["edit_adventure"])){
$f=explode("%^&",$_POST["edit_adventure"]);
include_once "../classes/modal.php";
$input="
    <form method='post'>
    Date Booked<input type='date' name='new_dat3e' value='".str_replace("/","-",$f[1])."'>
    <input type='hidden' name='id2' value='$f[0]'>
    <br>
    <input type='submit' value='Edit' name='editingg'>
    <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Close</button>
    </form>
";

mymodal("Edit adventure details",$input);
}
if(isset($_POST["editingg"])){
$new_date=$_POST["new_date"];
$res=$conn->updation("adventure_booked",["date_booked"],[$_POST["new_dat3e"]],['id'],[$_POST["id2"]]);
    if($res=="1"){
        echo "Adventure has been updated";
    }
    
}
$sql2="Select * from food_order where user_id='".$_COOKIE["customer_id"]."'";
$result2=$conn->own_query($sql2);
if(count($result2)>0)
{echo "<br><caption><h2>Food records</h2></caption><table class='table'>";
    echo "<tr><th>S.n</th><th>Food Name</th><th>Booked Date</th><th>Option</th><th>Payment Status</th><th>Order Status</th></tr>";
    $i=0;
    foreach($result2 as $row2){
        echo "<tr>";
        echo "<td>".++$i."</td>";
        echo "<td>".$row2["food_name"]."</td>";
        echo "<td>".$row2["date2"]."</td>";
        echo "<td>"."<form method='post'><button type='submit' name='cancel_food' value='".$row2['id']."%^&".$row2["food_name"]."'>Cancel Order</button></form>"."</td>";
        if($row2["payment_status"]=="0"){
            echo "<td>Unpaid</td>";
        }
        else{
            echo "<TD>Paid</TD>";
        }
        if($row2["ack"]==2) echo "<td>Order Confirmed</td>";
        else echo "<td>Order Pending</td>";
         echo "</tr>";
    }
echo "</table>";}
else{
    echo "<h2>No food booked yet</h2>";
}
if(isset($_POST['cancel_food'])){
    $f=explode("%^&",$_POST["cancel_food"]);
    $result22=$conn->deletion("food_order",["id"],[$f[0]]);
    if($result22=="1"){
        echo "Food order named $f[1] has been cancelled";
    }
}
// $sql="Select * from bookings where username='".$_COOKIE["logged"]."'";
// $result11=$conn->own_query($sql);
// if(count($result11)){
//     foreach($result11 as $row){
//         echo "<tr><td>".++$i.$row2[""]."</td>";
//         echo "<td>".$row['room_name']."</td>";
//         echo "<td>".$row['username']."</td>";
//         echo "<td>".$row['check_in_date']."</td>";
//         echo "<td>".$row['check_out_day']."</td>";        
//         $result2=$conn->own_query("Select * from packages where name='".$row['username']."' and check_in_date='".$row["check_in_date"]."' and check_out_date='".$row["check_out_day"]."'");
//        $package=array();
//         if(count($result2)){
//            foreach($result2 as $row2){
//            $package=[$row2["package_name"],$row2["price"]];
//            }
//        }
//        if($row["price"]!="0") echo "<td>".$row["price"];
//        else echo "<td>".ucfirst($package[0])." Package";
//         echo "</td>";
//         if($row["status"]==0 && $row["check_in_date"]>=date("Y-m-d")){
//             if(count($package)==0) echo "<td><button onclick='checkout(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Cancel bookings</button>";
//             else echo "<td><button onclick='checkout(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\",\"".$package[0]."\",\"".$package[1]."\")'>Cancel bookings</button>";
//             if($row["payment_date"]!="0"){
//                 echo '<button>see Bills</button>';
//             }
//             echo "<button onclick='change_details(\"".$row["id"]."\",\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["check_in_date"]."\",\"".$row["check_out_day"]."\")'>Change Details</button>";
//             echo "</td>";
//         }
//         if($row["check_in_date"]==0||$row["check_in_date"]==""){
//             echo "<td><button onclick='check_in(\"".$row["room_name"]."\",\"".$row['user_id']."\",\"".$row["id"]."\")'>Check In Date</button></td>";
//         }
//         echo "</tr>";

//     }
// }
echo "</div>";
?>
<script>
    function change_details(id,room_name,user_id,check_in,check_out){
        document.getElementById('change_detail').value=id+"%^&"+room_name+"%^&"+user_id+"%^&"+check_in+"%^&"+check_out;
        document.getElementById("changes1").submit();
    }
    function checkout(room_name,id1,c_in,c_out,package1="",price=""){
        console.log(id1,c_in,c_out,package1,price);
        if(package1==""){
            package1="no";
        }var xy=0;
        var url="../user/cancel_bookings.php?id="+id1+"&cin="+c_in+"&cout="+c_out+"&package="+package1+"&pkg_price="+price+"&room_name="+room_name;
            var xhttp=new XMLHttpRequest();
            xhttp.onload=function(){
                var data=this.responseText;
                console.log(data)
                if(data=="1"){
                    xy=confirm("Booking for "+c_in+" has been cancelled successfully.")
                }
                else if(data=="11"){
                    xy=confirm(package1+" has been cancelled successfully.");
                }
                else{
                    xy=confirm("Some error occured please contact admin");
                }
               if(xy==1) setTimeout(function(){location.href=location.href;},1000);
            }
            console.log(url);
            xhttp.open("GET",url, true);
            xhttp.send();
   }
   function check_in(x,y,z){
    console.log(x,y,z);
    document.getElementById("check_in_date").value=x+"^%"+y+"^%"+z;
    document.getElementById("now_checkin").submit();
   }
</script>
<form action="" method="post" id='now_checkin'>
    <input type="hidden" name="check_in_date" id="check_in_date">
</form>
<?php
if(isset($_POST["check_in_date"])){
    $arr=explode("^%",$_POST["check_in_date"]);
    $input="
        <form method='post'>
        <input type='hidden' name='id2' value='".$arr[2]."'>
            Check In Date<input type='date' id='new_checkin' name='new_checkin' required><br>
            Check Out Date<input type='date' id='new_checkout' name='new_checkout' required><br>
            <input type='submit' name='yes' value='Change Check In'>
            <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
        </form>
    ";
    myModal("Select check in Date",$input);
}
if(isset($_POST["yes"])&&isset($_POST["new_checkin"])&&isset($_POST["new_checkout"])){
    $result21=$conn->updation("bookings",["check_in_date","check_out_day"],[$_POST["new_checkin"],$_POST["new_checkout"]],["id"],[$_POST["id2"]]);
    if($result21=="1"){
        $dat="Booking has been placed for ".$_POST["new_checkin"];
    }
    else{
        $dat="Booking operation failed";
    }
    myModal($dat." This page will automatically refresh in 3 seconds.");
   echo "<script>var ttt=setTimeout(function(){location.href=location.href;},3000);</script>";
}
if(isset($_POST["change_detail"])){
    $arr=$_POST["change_detail"];
    $input='
        <form action="" method="post">
            <input type="hidden" name="change_detail2" id="change_detail2" value="'.$arr.'">
            <div>
                <select name="new_rooms" required>
            
            ';
            $result22=$conn->select("rooms");
            $arr1=explode("%^&",$arr);
            foreach($result22 as $row22){
                if($arr1[1]==$row22["room_name"]){
                    $input.="<option value='".$row22["room_name"]."' selected>".$row22["room_name"]."</option>";
                }
                else{
                    $input.="<option value='".$row22["room_name"]."'>".$row22["room_name"]."</option>";
                }
            }
        $input.='</select>
            </div>
            <div>
                <label for="new_check_in_date">Check In Date</label>
                <input type="date" name="new_check_in_date" value="'.$arr1[3].'" required>
            </div>
            <div>
                <label for="new_check_out_date">Check Out Date</label>
                <input type="date" name="new_check_out_date" value="'.$arr1[4].'" required>
            </div>
            <div>
                <input type="submit" value="Change Details" name="new_date">
                <button onclick="this.parentNode.parentNode.style.display=\'none\';">Close</button>
            </div>
        </form>
    ';
    mymodal("Change Details",$input);
}
if(isset($_POST["new_date"])){
    $change_detail=explode("%^&",$_POST["change_detail2"]);
    $new_rooms=$_POST["new_rooms"];
    $new_check_in_date=$_POST["new_check_in_date"];
    $new_check_out_date=$_POST["new_check_out_date"];
    $result=$conn->updation("bookings",["room_name","check_in_date","check_out_day"],[$new_rooms,$new_check_in_date,$new_check_out_date],["id"],[$change_detail[0]]);
    if($result=="1"){
        mymodal("Updation of details has been successfull. This page will automatically refresh in 3 seconds.");
        echo "<script>var t=setTimeout(function(){location.href=location.href;},3000)</script>";
    }
}
?>


<form action="" id="changes1" method="post">
            <input type="hidden" name="change_detail" id="change_detail">
</form>