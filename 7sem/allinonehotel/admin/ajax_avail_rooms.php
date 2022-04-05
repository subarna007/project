<?php
if(isset($_POST["room_name"])&&isset($_POST["check_in"])&&isset($_POST["check_out"])){
    $sql="Select distinct(room_number) from room_details where room_type='".$_POST['room_name']."';";//check_in_date<'".$_POST["check_in"]."' and check_out_date>'".$_POST["check_out"]."' and room_type='".$_POST['room_name']."';";
    include_once "../config.php";
    $array=array();
    
    if($result=mysqli_query($conn,$sql)){
        {
            while($row=mysqli_fetch_assoc($result)){
                array_push($array,$row);
            }
           
        }

       
    }
    echo json_encode($array);
    return $array;
}
?>