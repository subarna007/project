<?php
    include_once "../config.php";
    include_once "../dashboard-components/dashboard.php";
    
    $i=0;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
  window.addEventListener('load', function() {
    modal=document.getElementById('edit_modal');
    // modal.style.display="none";
})
  function edit(room_number){
    console.log(room_number);
    // modal.style.display = "block";
    // document.getElementById('action').value="edit";
    // document.getElementById('room_number').value=room_number;
    // document.getElementById('form1').submit();
  }
  function delete_btn(room_number){
    console.log(room_number);
    document.getElementById('action').value="delete";
    document.getElementById('room_number').value=room_number;
    document.getElementById('form1').submit();
  }
</script>
<div class="wrapper">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assign_room_numbers">
  Assign Room Numbers
</button>

<!-- Modal -->
<div class="modal fade" id="assign_room_numbers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assign_room_numbersLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assign_room_numbersLabel">Assign Room Numbers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="" method="post">
             Room Number:<input type="text" name="Room_Number" id="Room Number" required>
             <br>
              Room Type:
              <select id="room_type" name="room_type">
                    <?php
                       $sql3="Select * from rooms where total_rooms<>rooms_created";
                       $result3=mysqli_query($conn,$sql3);
                       while($row3=mysqli_fetch_assoc($result3)){
                           $room_name=$row3['room_name'];
                           echo $room_name;
                        echo "<option value='".$room_name."'>".$room_name."-".$row3["rooms_created"]."</option>";
                       }
                    ?>
              </select>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="assign_rooms" id="assign_rooms">Assign</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
    if(isset($_POST["assign_rooms"])){
        $room_number=$_POST["Room_Number"];
        $room_type=$_POST["room_type"];
        $price=0;
        $sql4="select price from rooms where room_name='$room_type'";
        if($result4=mysqli_query($conn,$sql4)){
          if($row=mysqli_fetch_assoc($result4)){
            $price=$row["price"];
            
          }
        }
        $sql1="INSERT INTO `room_details`(`room_number`, `room_type`,`price`) VALUES ('$room_number','$room_type','$price');";
        $sql2="Update rooms set `rooms_created`=`rooms_created`+1 where room_name='$room_type';";
        echo $sql2;
        if(mysqli_query($conn,$sql1)&&mysqli_query($conn,$sql2)){
            echo "Room number assigned";
            echo "<script>location.href=location.href</script>";
            
        }
    }

    $sql="Select * from room_details";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        echo "<table class='table'><tr><th>S.N</th><th>Room Number</th><th>Room Type</th><th>Status</th><th>Edit</th></tr>";
      while($row=mysqli_fetch_assoc($result)){
          echo "<tr><td>".++$i."</td>";
          $room_number=$row["room_number"];
              echo "<td>".$row["room_number"]."</td>";
              echo "<td>".$row['room_type']."</td>";
              if($row['status']=="0") echo "<td><i class='fas fa-check' style='color:green;'></i></td>";
              else echo "<td><i class='fas fa-times' style='color:red;'></i></td>";
              ?>
              <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal">
              <i class='fas fa-edit'></i>
              </button>
              <!-- echo "<td><button onclick='edit(\"$room_number\")' data-bs-toggle='modal' data-target='#edit_modal'><i class='fas fa-edit'></i></button>"; -->
             <?php
              echo "<button onclick='delete_btn(\"$room_number\")'><i class='fas fa-trash-alt'></i></td></button>";
              echo "</td></tr>";
      }
    }
    else{
      echo "<br>Create room number first";
    }
?>
<form action="" method="post" id='form1' name='form1'>  
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="room_number" id="room_number">
</form>
</div>
<?php
  if(isset($_POST["action"])&&isset($_POST["room_number"])){
    $room_type_fetched="";
    $room_number=$_POST["room_number"];
    $action=$_POST["action"];
    if($action=='delete'){
        $sql1="Delete from room_details where room_number='$room_number'";
      if($result2=mysqli_query($conn,"Select * from room_details where room_number='$room_number'")){
        while($row2=mysqli_fetch_assoc($result2)){
          $room_type_fetched=$row2["room_type"];
        }
      }
      $sql2="Update rooms set rooms_created=rooms_created-1 where room_name='$room_type_fetched';";
      if(mysqli_query($conn,$sql2)&& mysqli_query($conn,$sql1)){
        echo "$room_number has been deleted";
        echo "<script>location.href=location.href;</script>";
      }
    }
    else{
      ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal">
  
</button>

<!-- Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit_modalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

      <?php
    }
    // echo "<script>alert('".$room_number.$action."');</script>";
  }
?>