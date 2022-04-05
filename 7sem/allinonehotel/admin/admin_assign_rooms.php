<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php
// 
include_once "../classes/index.php";
$conn=new DBConnect();
if(isset($_POST["submit"])){
$id=$_POST["id33"];
$room_type=$_POST["room_type"];
$full_name=$_POST["full_name"];
$check_in=$_POST["check_in"];
$check_out=$_POST["check_out"];
$room_num=$_POST["room_num"];
$sql11="Select * from room_details where room_type='$room_type'";
$rrrr=array();
$error=1;
$result11=$conn->own_query($sql11);
foreach($result11 as $row11){
  if($check_in>=$row11["check_in_date"]&&$check_out<=$row11["check_out_date"]){
    array_push($rrrr,$row11["room_number"]);
    break;
  }
}
    if(count($rrrr)==0){
      $sql1="UPDATE `bookings` SET room_number='$room_num' where id='$id'";
      $sql2="INSERT INTO `room_details`( `room_number`, `room_type`, `status`, `check_in_date`, `check_out_date`, `price`) 
                                VALUES ('$room_num','$room_type','1','$check_in','$check_out','0')";
      // $sql2="Update room_details set status=1 , check_in_date='$check_in' , check_out_date='$check_out' where room_number='$room_num'";
      $sql3="Update rooms set `occupied_rooms`=`occupied_rooms`+1 where room_name='$room_type'";
      $result1=$conn->generic_func($sql1);
      $result2=$conn->generic_func($sql2);
      print_r($result2);
      $result3=$conn->generic_func($sql3);
      if($result2!="0"){
        if($result1!="0"&&$result3!="0")
          echo "<br><div class='block wrapper alert alert-primary' role='alert'>Room assigned successfully</div>";
          else $error=0;
      }
      else{
           $error=0;
        }
    }
    else{      
      $rrrr=array_unique($rrrr);
      foreach($rrrr as $a){
        if($a==$room_num){
          $error=0;break;
        }
      }
      if($error!=0){
          $sql1="UPDATE `bookings` SET room_number='$room_num' where id='$id'";
        $sql2="INSERT INTO `room_details`( `room_number`, `room_type`, `status`, `check_in_date`, `check_out_date`, `price`) 
                                  VALUES ('$room_num','$room_type','1','$check_in','$check_out','0')";
        // $sql2="Update room_details set status=1 , check_in_date='$check_in' , check_out_date='$check_out' where room_number='$room_num'";
        $sql3="Update rooms set `occupied_rooms`=`occupied_rooms`+1 where room_name='$room_type'";
        $result1=$conn->generic_func($sql1);
        $result2=$conn->generic_func($sql2);
        print_r($result2);
        $result3=$conn->generic_func($sql3);
        if($result2!="0"){
          if($result1!="0"&&$result3!="0")
            echo "<br><div class='block wrapper alert alert-primary' role='alert'>Room assigned successfully</div>";
            
        }
      }
    }
    if($error==0){
      echo "<br><div class='block wrapper alert alert-primary' role='alert'>Room already booked in that date please change room type/date to proceed</div>";    
    }
}

?>
<script>
    function assign_rooms(a,b,c,d,e){
        document.getElementById("room_type").value=b;
        document.getElementById("full_name").value=a;
        document.getElementById("check_in").value=c;
        document.getElementById("check_out").value=d;
        document.getElementById("id33").value=e;
        $.ajax({
            url:"ajax_avail_rooms.php",
            method:"post",
            data:{room_name:b,check_in:c,check_out:d},
            success:function(data){
               data=$.parseJSON(data);               
               var button=document.getElementById('assign');
                var x="<select name='room_num' required>";                  
                   if(data.length>0){
                    for(var i=0;i<data.length;i++){
                      x+="<option value='"+data[i]['room_number']+"'>"+data[i]['room_number']+"</option>";
                       
                    }    
                    button.disabled=false;
                   } 
                   else{
                     x+="<option>No Rooms avialable at that date/No rooms plz add it first</option>";
                     button.disabled=true;
                   }
                x+="</select>";
              document.getElementById("select_opt").innerHTML=x;
            },
            error:function(){
                console.log("error");
            }

        });
    }
</script>
<!-- Modal -->

    <?php
    include_once "../dashboard-components/dashboard.php";
    
    $sql="Select `id`, `room_name`, `username`, `check_in_date`, `check_out_day`, `room_number`,
    DATEDIFF(check_out_day,check_in_date) as day_diff,price from bookings";
    $result=$conn->own_query($sql);
    {
        if(count($result)>0){
            $i=0;
            echo '<div class="wrapper block"><br>';
            echo "<table class='table'>";
            
            echo "<tr><th>S.N.</th><th>Username</th><th>Room Type</th><th>Check In Date</th><th>Check Out Date</th><th>Stays</th><th>Price</th><th>Sub-Total</th><th>Room_Number</th></tr>";
            foreach($result as $row){
                ++$i;
                echo "<tr><td>".$i."</td>";
                $user=$row['username'];
                $room_name=$row['room_name'];
                $check_in=$row['check_in_date'];
                $check_out=$row['check_out_day'];
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['room_name']."</td>";
                echo "<td>".$row['check_in_date']."</td>";
                echo "<td>".$row['check_out_day']."</td>";
                echo "<td>".$row['day_diff']."</td>";
                echo "<td>".$row['price']."</td>";
                echo "<td>".$row['day_diff']*$row['price']."</td>";
                if($row['room_number']==0) {
                    echo "<td>";
                     echo '<button onclick=\'assign_rooms("'.$user.'","'.$room_name.'","'.$check_in.'","'.$check_out.'","'.$row["id"].'")\' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Assign Rooms
                  </button>';
                  
                }
                else echo "<td>".$row['room_number']."</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo '<div class="alert alert-info" role="alert">
            No Bookings Found!
          </div>';
         
        }
    }
    ?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" name="id33" id="id33">
            Room-type<input type="text" name="room_type" id="room_type" >
            <br>Full Name<input type="text" name="full_name" id="full_name"  >
            <br>Check in Date<input type="text" name="check_in" id="check_in"  >
            <br>Check Out Date<input type="text" name="check_out" id="check_out" >
           <br> Available room numbers: <p id='select_opt'></p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name='submit' class="btn btn-primary" id='assign'>Assign</button>
        </form>
      </div>
    </div>
  </div>
</div>


</div>
<!-- wrapper div close -->