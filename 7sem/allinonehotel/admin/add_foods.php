<?php
include_once "../classes/index.php";
// include_once "../classes/alerts.php";
include_once "../dashboard-components/dashboard.php";
$conn=new DBConnect();

?>

    <div class='wrapper'>
        <span>
            <button>Add Category</button>
        </span>
        <form action="" method="post" enctype="multipart/form-data">
           <div> <label for="food_name">Food Name</label>
            <input type="text" name="food_name" id="food_name" required>
            </div>
           <div> <label for="cost">Cost</label>
            <input type="number" name="cost" id="cost" required>
            </div>
           <div> <label for="category">Category</label>
            <select name="category" id="category" required>
                
                <option value="">Select Category</option>
            <?php
                $result=$conn->select("food_category");
                foreach($result as $row){
                    echo "<option value='".$row['id']."'>".$row['category']."</option>";
                }
            ?>
            </select>
            </div>
           <div> <label for="food_photo"></label>
            <input type="file" name="food_photo" id="food_photo" required>
            </div>
            <input type="submit" value="Add Food Item" name="add_food">
        </form>
    </div>


<?php
if(isset($_POST["add_food"])){
    $food_name=$_POST['food_name'];
    $cost=$_POST['cost'];
    $category=$_POST['category'];
    $food_photo=$_FILES['food_photo'];
    $uploaded=fileUpload("../img/foods/",$food_photo);
    if($uploaded!="0"){
        $result1=$conn->insertion("food",
            ['food_name','cost','food_photo','category'],
            [$food_name,$cost,$uploaded,$category]);
        if($result1=="1"){
            alerts("green","New food named $food_name has been added.");
        }
    }
    else{
       alerts("red","Photo not uploaded.Please do all processing from first.");
    }
}
?>