<?php
include_once "../dashboard-components/dashboard.php";
?>
<div class="wrapper">
    <h2>Add Rooms</h2>
<form action="" method="post" enctype="multipart/form-data">
           Room Name <input type="text" name="room_name" id="room_name" required>
           <br>Price <input type="number" name="price" id="price" required>
           <br> Total Rooms <input type="number" name="total_rooms" id="total_rooms">
           <br> Room type <select name="people" id="people">
               <option>Select options</option>
               <option value="Single" value="1">Single</option>
               <option value="Double" value="2">Double</option>
           </select>
           <br> Photo <input type="file" name="room_photo" id="room_photo">
           <br>Amenties 
           <?php
                include_once "../config.php";
                $sql="Select * from amenities";
                $result=mysqli_query($conn,$sql);
                echo "<table>";
                echo "<tr><th>Name</th><th>Picture</th><tr>";
                while($row=mysqli_fetch_assoc($result)){
                    $row_name=$row["amenity_name"];
                    $photo_path=$row["photo"];
                   echo "<tr><td><input type='checkbox' name='amenity[]' value='$row_name' id='$row_name'>$row_name</td><td><img height=100px  width=120px src='$photo_path'></td>";
                }
                echo "</table>";
           ?>
           <br>
           <input type="submit" value="Add rooms" name='add_rooms'>
</form>

<?php
if(isset($_POST["add_rooms"])){
    $room_name=$_POST["room_name"];
    $price=$_POST['price'];
    $total_rooms=$_POST["total_rooms"];
    $people=$_POST["people"];          
    $amenity_array=$_POST['amenity'];    
    $sql2=""; 
    $error=0;
    foreach($amenity_array as $value){
        $sql2.="UPDATE `rooms` SET $value"."_status='1' where room_name='$room_name';";
        
    }
    if( is_uploaded_file($_FILES['room_photo']['tmp_name'])){
        $target_dir = "room_photo/";
        $target_file = $target_dir . basename($_FILES["room_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["room_photo"]["tmp_name"]);
        if($check !== false) {
            $ext = pathinfo($target_file, PATHINFO_EXTENSION);
            $stamp=time();
            $filename="$stamp.$ext";
            echo "File is  an image.";
            echo $ext;
                $uploadOk = 1;
            } else {
                echo "File is not an image.Please upload again";
                $uploadOk = 0;
            }
        }   
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          } else {
              $str=basename($_FILES["room_photo"]["name"]);
               $b=explode(".",$str);
               $count= count($b); 
              $destination=$target_dir.time().".".$b[$count-1];
            if (move_uploaded_file($_FILES["room_photo"]["tmp_name"], $destination)) {
                $sql="INSERT INTO `rooms`( `room_name`, `room_pic`, `price`, `total_rooms`, `no_of_people`) VALUES ('$room_name','$destination','$price','$total_rooms','$people')";
               
                if(mysqli_query($conn,$sql) ){
                    echo $sql2;
                    if(mysqli_multi_query($conn,$sql2)){
                    echo "Room added";}
                    else{

                    }
                }
                else{
                    echo "Addition failed";
                }
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
        }
       }

}
    
?>
</div>