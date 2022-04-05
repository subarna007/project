<?php
if(count($_GET)=="8"){
// if(($_GET["oid"]&&$_GET["amt"]&&$_GET["refid"]&&$_GET["id"]&&$_GET["cin"]&&$_GET["cout"]&&$_GET["package"]&&$_GET["pkg_price"])){
    $oid=$_GET["oid"];
    $amt=$_GET["amt"];
    $refId=$_GET["refId"];
    $id=$_GET["id"];
    $cin=$_GET["cin"];    
    $cout=$_GET["cout"];
    include_once "../classes/index.php";
    $conn=new DBConnect();
    $package=$_GET["package"];
    $pkg_price=$_GET["pkg_price"];
    $result=$conn->updation("bookings",
    ['payment_date'],
    [date("Y-m-d")],
    ['id','check_in_date','check_out_day'],
    [$id,$cin,$cout]);
    if($package==""||$package=="no"){
        $result2=$conn->generic_func("Update food_order set payment_status='1' where date2>='".$cin."' and date2<='".$cout."' and user_id='$id';");
    }
    else{
        $result2=$conn->generic_func("Update food_order set payment_status='1' and price='0' where date2>='".$cin."' and date2<='".$cout."' and user_id='$id' ;");
    }
    if($result==1&&$result2==1){
        $result4=$conn->own_query("Select count(*) from transactions");
        $iddd=$result4[0]["count(*)"]+1;
        $bill=generate_id("$iddd");
        $result3=$conn->insertion("transactions",["bill_number","user_id","transaction_code"],[$bill,"$id",$refId]);
        if($result4&&$result3) {
            $result7=$conn->own_query("Select username from user_details where id='".$id."'");
            if(count($result7)!="0"){
                $result8=$conn->updation("bookings",['payment_date'],[date("Y-m-d")],['user_id','check_in_date','check_out_day'],[$_GET["id"],$_GET["cin"],$cout]);
                // $result5=$conn->updation("adventure_booked",['payment_status'],[1],['booking_name','payment_status'],[$result7[0]["username"],'0']);
                if($package=="gold"){
                    $result5=$conn->generic_func("Update adventure_booked set payment_status='1' where booking_name='".$result7[0]["username"]."' and date_booked>='".$cin."' and date_booked<='".$cout."';");
                }
                else{
                    $result5=$conn->generic_func("Update adventure_booked set payment_status='1' and price='0' where booking_name='".$result7[0]["username"]."' and date_booked>='".$cin."' and date_booked<='".$cout."';");
                
                }
                $result6=$conn->updation("packages",["payment_status"],[1],["name","check_in_date","check_out_date"],[$result7[0]["username"],$cin,$cout]);
                // print_r($result5);
                // print_r($result6);
                // print_r($result7);
                if($result5&&$result6&&count($result7)==1){
                    echo "Transaction success.this page will automatically refresh in 3 seconds.";
                    header("Refresh:3; url=../index.php");
                }
            }
        }
    }
    else{
        echo "Database updation failed plz contact admin.";
    }
}
?>