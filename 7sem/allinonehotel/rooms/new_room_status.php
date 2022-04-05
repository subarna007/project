<?php
    // include_once "../config.php";
    
include_once "../classes/modal.php";
    include_once "../classes/index.php";
    include_once "../dashboard-components/dashboard.php";
    $conn=new DBConnect();
    $i=0;
    if(isset($_POST["type1"])&&isset($_POST["arr1"])){
        include_once "../classes/modal.php";
        $type=$_POST["type1"];
        $arr=explode("^",$_POST["arr1"]);
        if($type=="delete"){
            $input="
                <h5>Are you sure you want to delete room numbered $arr[1] ?</h5>
                <form method='post'>
                <input type='hidden' id='data21' name='data21' value='$arr[0]'>
                    <input type='submit' name='yes' value='Yes'>                
                    <button onclick='this.parentNode.parentNode.style.display=\"none\";'>No</button>
                </form>
            ";
            mymodal("Delete Vendor",$input);
        }   
        // else{
        //     $input="
        //         <form action='' method='post'>
        //            Name: <input type='text' name='data11' value='".$arr[1]."' readonly>
        //             <br>
        //             Location:<input type='text' name='data12' value='".$arr[2]."'>
        //             <br> <input type='submit' name='edit_adventure' value='Edit Room Details'>
        //             <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
        //         </form>
        //     ";
        //     mymodal("Edit Room Details",$input);
        // }
    }       
     if(isset($_POST["edit_adventure"])&&isset($_POST['data11'])&&isset($_POST['data12'])){
        $result=$conn->updation("adventure",["location"],[$_POST["data12"]],["adventure_name"],[$_POST["data11"]]);
        if($result=="1"){
            mymodal("Room data has been successfully edited");
        }   
        else{
            mymodal("Room data deletion failed Please perform operation again");
        }
    }
    if(isset($_POST["yes"])&&isset($_POST["data21"])){
        $result=$conn->deletion("room_details",["id"],[$_POST["data21"]]);
        if($result=="1"){
            mymodal("Room data has been successfully deleted");
        }   
        else{
            mymodal("Room data deletion failed Please perform operation again");
        }
    }
?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
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
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assign_room_numbers">
  Assign Room Numbers
</button> -->
<form action="" method="post">
    <button name='assign_room_number' type='submit'>Assign Room Number</button>
</form>
<?php
if(isset($_POST['assign_room_number'])){
    $input='
    <form action="" method="post">
             Room Number:<input type="text" name="Room_Number" id="Room Number" required>
             <br>
              Room Type:
              <select id="room_type" name="room_type">';
                    
                       $sql3="Select * from rooms where total_rooms<>rooms_created";
                    //    $result3=mysqli_query($conn,$sql3);
                    //    while($row3=mysqli_fetch_assoc($result3)){
                        $result3=$conn->own_query($sql3);
                       foreach($result3 as $row3){
                           $room_name=$row3['room_name'];
                           echo $room_name;
                        $input.="<option value='".$room_name."'>".$room_name."-".$row3["rooms_created"]."</option>";
                       }
                    
              $input.='</select>
         <br>
        <button type="button" onclick="this.parentNode.parentNode.style.display=\'none\';">Close</button>
        <button type="submit" class="btn btn-primary" name="assign_rooms" id="assign_rooms">Assign</button>
        </form>'
    ;
    mymodal("Assign Room Number",$input);
}
?>

<!-- Modal -->
<!-- <div class="modal fade" id="assign_room_numbers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assign_room_numbersLabel" aria-hidden="true">
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
                    //    $result3=mysqli_query($conn,$sql3);
                    //    while($row3=mysqli_fetch_assoc($result3)){
                        $result3=$conn->own_query($sql3);
                       foreach($result3 as $row3){
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
</div> -->
<?php
    if(isset($_POST["assign_rooms"])){
        $room_number=$_POST["Room_Number"];
        $room_type=$_POST["room_type"];
        $price=0;
        $sql4="select price from rooms where room_name='$room_type'";
        if($result4=$conn->own_query($sql4)){
          foreach($result4 as $row){

            $price=$row["price"];
            
          }
        }
        $sql1="INSERT INTO `room_details`(`room_number`, `room_type`,`price`) VALUES ('$room_number','$room_type','$price');";
        $sql2="Update rooms set `rooms_created`=`rooms_created`+1 where room_name='$room_type';";

        if(count($conn->own_query($sql1))>0&&count($conn->own_query($sql2))>0){
            echo "Room number assigned";
            echo "<script>location.href=location.href</script>";
            
        }
    }

    // $sql="Select * from room_details";
    // $result=$conn->own_query($sql);
    // if(count($result)>0){
    //     echo "<table class='table'><tr><th>S.N</th><th>Room Number</th><th>Room Type</th><th>Status</th><th>Edit</th></tr>";
    // foreach($result as $row){
    //       echo "<tr><td>".++$i."</td>";
    //       $room_number=$row["room_number"];
    //           echo "<td>".$row["room_number"]."</td>";
    //           echo "<td>".$row['room_type']."</td>";
    //           if($row['status']=="0") echo "<td><i class='fas fa-check' style='color:green;'></i></td>";
    //           else echo "<td><i class='fas fa-times' style='color:red;'></i></td>";
    //           ?>
    <!-- //           <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal">
    //           <i class='fas fa-edit'></i>
    //           </button> -->
              <!-- echo "<td><button onclick='edit(\"$room_number\")' data-bs-toggle='modal' data-target='#edit_modal'><i class='fas fa-edit'></i></button>"; -->
             <?php
    //           echo "<button onclick='delete_btn(\"$room_number\")'><i class='fas fa-trash-alt'></i></td></button>";
    //           echo "</td></tr>";
    //   }
    // }
    // else{
    //   echo "<br>Create room number first";
    // }
    include_once "../classes/dynamic_table.php";
    table("Room numbers and types",
    ["S.N","Room Number","Room Type","Status","Option"],
    ["id","room_number","room_type","status"],"10","room_details",10);
    
?>
<script>
    var arrayOfElements=document.getElementsByClassName('edit_btn1');
    var lengthOfArray=arrayOfElements.length;

    for (var i=0; i<lengthOfArray;i++){
        arrayOfElements[i].style.display='none';
    }
</script>
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
        $result2=$conn->own_query("Select * from room_details where room_number='$room_number'");
      if(count($result2)>0){
        foreach($result2 as $row2){
          $room_type_fetched=$row2["room_type"];
        }
      }
      $sql2="Update rooms set rooms_created=rooms_created-1 where room_name='$room_type_fetched';";
      if(count($conn->own_query($sql2))>0& count($conn->own_query($sql1))>0){
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
<script>
function option_click(type1,array1){
    console.log(type1,array1);
    document.getElementById("type1").value=type1;
    document.getElementById("arr1").value=array1;
    document.getElementById("optionss").submit();
}
</script>
<form action="" id="optionss" method="post">
<input type="hidden" name="type1" id="type1">
<input type="hidden" name="arr1" id="arr1">
</form>
