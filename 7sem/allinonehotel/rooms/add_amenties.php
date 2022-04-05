<?php
include_once "../config.php";
include_once "../dashboard-components/dashboard.php";
?>
<div class=" wrapper">
    <h2>Add Amenties</h2>
    
<div class=" mb-3">
    <form action="" method="post" enctype="multipart/form-data">
            <label for="Amenity" class="form-label">Name</label>
            <input type="text" class="form-control" id="Amenity" name="Amenity" placeholder="Amenity name" required>
            </div>
            <div class="mb-3">
            <label for="image_amenity" class="form-label">Photo</label>
            <input type="file" class="form-control" id="image_amenity" name="image_amenity" required placeholder="Amenity photo">
           <br> <input type="submit" value="Add Amenity" name="submit">
    </form>

</div>
<?php
include_once "../config.php";
if(isset($_POST["submit"])){
    if( is_uploaded_file($_FILES['image_amenity']['tmp_name'])){
        $amenity_name=$_POST["Amenity"];
        $target_dir = "amenity_photo/";
        $target_file = $target_dir . basename($_FILES["image_amenity"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image_amenity"]["tmp_name"]);
        if($check !== false) {
            $ext = pathinfo($target_file, PATHINFO_EXTENSION);
            $stamp=time();
            $filename="amenity_photo/$stamp.$ext";
                $uploadOk = 1;
            } else {
                echo "File is not an image.Please upload again";
                $uploadOk = 0;
            }
        }   
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          } else {
            if (move_uploaded_file($_FILES["image_amenity"]["tmp_name"], $filename)) {
               $sql="Insert into amenities(amenity_name,photo) values('$amenity_name','$filename')";
               $sql2="ALTER TABLE `rooms` ADD `$amenity_name"."_status` VARCHAR(4) NOT NULL DEFAULT '0' ";
               echo $sql2;
                if(mysqli_query($conn,$sql)&&mysqli_query($conn,$sql2)){
                    echo "Amenity added";
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