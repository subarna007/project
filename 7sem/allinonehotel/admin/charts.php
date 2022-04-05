<?php
include_once "../classes/index.php";
$conn=new DBConnect();
$arr1=array();
$arr2=array();
$arr3=array();
$arr4=array();
$result11=$conn->own_query("select check_in_date,sum(price) from bookings group by check_in_date;");
foreach($result11 as $row11){
array_push($arr1,[$row11['check_in_date'],$row11['sum(price)']]);
}
$result11=$conn->own_query("select check_in_date,sum(price) from packages group by check_in_date;");
foreach($result11 as $row11){
array_push($arr2,[$row11['check_in_date'],$row11['sum(price)']]);
}
$result11=$conn->own_query("select date2,sum(price) from food_order group by date2;");
foreach($result11 as $row11){
array_push($arr3,[str_replace("/","-",$row11['date2']),$row11['sum(price)']]);
}
$result11=$conn->own_query("select date2,sum(price) from food_order group by date2;");
foreach($result11 as $row11){
array_push($arr4,[str_replace("/","-",$row11['date2']),$row11['sum(price)']]);
}
$c1=count($arr1);
for($i=0;$i<$c1;$i++){
    for($j=0;$j<count($arr2);$j++){
        $str2=strval($arr1[$i][0]);
        $str3=strval($arr2[$j][0]);
        if($str2==$str3){
            $arr1[$i][1]=(float)$arr1[$i][1]+(float)$arr2[$j][1]; 
            unset($arr2[$j]);
            $arr2=array_values($arr2);
        }
       
    }
}

$arr2=array_values($arr2);
foreach($arr2 as $a){
    array_push($arr1,$a);
}
$c1=count($arr1);
for($i=0;$i<count($arr1);$i++){
    for($j=0;$j<count($arr3);$j++){
        $str2=strval($arr1[$i][0]);
        $str3=strval($arr3[$j][0]);
        if($str2==$str3){
            $arr1[$i][1]=(float)$arr1[$i][1]+(float)$arr3[$j][1]; 
            unset($arr3[$j]);
            $arr3=array_values($arr3);
        }
       
    }
}

$arr3=array_values($arr3);
foreach($arr3 as $a){
    array_push($arr1,$a);
}
for($i=0;$i<count($arr1);$i++){
    for($j=0;$j<count($arr4);$j++){
        $str2=strval($arr1[$i][0]);
        $str3=strval($arr4[$j][0]);
        if($str2==$str3){
            $arr1[$i][1]=(float)$arr1[$i][1]+(float)$arr4[$j][1]; 
            unset($arr4[$j]);
            $arr4=array_values($arr4);
        }       
    }
}
asort($arr1);
$arr1=array_values($arr1);
echo json_encode(($arr1));
?>