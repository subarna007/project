<?php
include_once "../classes/index.php";
$conn=new DBConnect();
if(count($_GET)>4){
    $id=$_GET["id"];
    $cin=$_GET["cin"];
    $cout=$_GET["cout"];
    $package=$_GET["package"];
    $pkg_price=$_GET["pkg_price"];
    $room_name=$_GET["room_name"];
    $error=1;
    if($package=="no"){
        // $sql="Delete from bookings where username='".$_COOKIE["logged"]."' and check_in_date='$cin' and check_in_date>'".date("Y-m-d")."' and check_out_day='$cout';";
        $sql="Delete from bookings where username='".$_COOKIE["logged"]."' and check_in_date='$cin' and check_out_day='$cout';";
        $result1=$conn->generic_func($sql);
        if($result1=="1"){
            $result2=$conn->insertion("cancelled_bookings",
            ["username","room_name","check_in_date","check_out_date","cancelled_on"],
            [$_COOKIE["logged"],$room_name,$cin,$cout,time()]);
            if($result2=="1"){
                // echo "Booking placed on date $cin has been cancelled.";
            }
            else{
                $error=0;
            }
        }
        else{
            $error=0;
        }
        // $sql="Delete from food_order where user_id='".$_COOKIE["customer_id"]."' and date2='".$cin."' and date2<='".$cout."'";
    }
    else{
        $sql="Delete from bookings where username='".$_COOKIE["logged"]."' and check_in_date='$cin' and check_out_day='$cout';";
        $result1=$conn->generic_func($sql);
        $sql="Delete from packages where package_name='".$package."' and check_in_date='$cin' and check_out_date='$cout'";
        $result2=$conn->generic_func($sql);  
        if($result1=="1"&&$result2=="1"){
             $result3=$conn->insertion("cancelled_bookings",
            ["username","room_name","check_in_date","check_out_date","cancelled_on"],
            [$_COOKIE["logged"],$package,$cin,$cout,date("Y-m-d")]);
            if($result3=="1"){
                // echo "Package booked on date $cin has been cancelled";
                $error=11;
            }
            else{
                $error=0;
            }
        }
        else{
            $error=0;
        }
    }
    echo $error;
}
?>