<?php
include_once "../classes/index.php";
include_once "../dashboard-components/dashboard.php";
include_once "../classes/modal.php";
// include_once "../classes/alerts.php";
$conn=new DBConnect();

?>
  <?php
            if(isset($_POST["add_adventure"])){
                $adventure_name=$_POST['adventure_name'];
                $location=$_POST['location'];
                $adventure_photo=$_FILES['adventure_photo'];
                $uploaded=fileUpload("../img/adventures/",$adventure_photo);
                if($uploaded!="0"){
                    $result1=$conn->insertion("adventure",
                ['adventure_name','photo','location'],
                [$adventure_name,$uploaded,$location]);
                echo "<div class='wrapper'>";
                    if($result1){
                        alerts("green","New adventure named $adventure_name has been added.");
                    }
                }
                else{
                alerts("red","Photo not uploaded.Please do all processing from first.");
                }
                echo "</div>";
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <span>
          <form action="" method="get">
          <button type="submit" name="add_adv">Add Adventure</button>
          </form>
        </span>
        <?php
        if(isset($_GET["add_adv"])){
            $data="<h2>Add adventure</h2>";
            $data.= '<form action="" method="post" enctype="multipart/form-data">
            <div> <label for="adventure_name">Adventure Name</label>
             <input type="text" name="adventure_name" id="adventure_name" required>
             </div>
             <div> <label for="location">Location</label>
             <input type="text" name="location" id="location" required>
             </div>
            <div> <label for="adventure_photo"></label>
             <input type="file" name="adventure_photo" id="adventure_photo" required>
             </div>
             <input type="submit" value="Add Adventure" name="add_adventure2">
         </form>';
         myModal($data);
        }
        include_once "../classes/dynamic_table.php";
        table("Adventure List",
        ["id", "adventure_name", "location","options"]
        ,["id", "adventure_name", "location"]
        ,"2","adventure");
        if(isset($_POST["type1"])&&isset($_POST["arr1"])){
            include_once "../classes/modal.php";
            $type=$_POST["type1"];
            $arr=explode("^",$_POST["arr1"]);
            if($type=="delete"){
                $input="
                    <h5>Are you sure you want to delete adventure named $arr[1] ?</h5>
                    <form method='post'>
                    <input type='hidden' id='data21' name='data21' value='$arr[0]'>
                        <input type='submit' name='yes' value='Yes'>                
                        <button onclick='this.parentNode.parentNode.style.display=\"none\";'>No</button>
                    </form>
                ";
                mymodal("Delete Vendor",$input);
            }   
            else{
                $input="
                    <form action='' method='post'>
                       Name: <input type='text' name='data11' value='".$arr[1]."' readonly>
                        <br>
                        Location:<input type='text' name='data12' value='".$arr[2]."'>
                        <br> <input type='submit' name='edit_adventure' value='Edit Adventure'>
                        <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
                    </form>
                ";
                mymodal("Edit Adventure",$input);
            }
        }
        if(isset($_POST["edit_adventure"])&&isset($_POST['data11'])&&isset($_POST['data12'])){
            $result=$conn->updation("adventure",["location"],[$_POST["data12"]],["adventure_name"],[$_POST["data11"]]);
            if($result=="1"){
                mymodal("Adventure data has been successfully edited");
            }   
            else{
                mymodal("Adventure data deletion failed Please perform operation again");
            }
        }
        if(isset($_POST["yes"])&&isset($_POST["data21"])){
            $result=$conn->deletion("adventure",["id"],[$_POST["data21"]]);
            if($result=="1"){
                mymodal("Adventure data has been successfully deleted");
            }   
            else{
                mymodal("Adventure data deletion failed Please perform operation again");
            }
        }
        ?>
      
    </div>
</body>
</html>

<?php
if(isset($_POST["add_adventure2"])){
    $adventure_name=$_POST['adventure_name'];
    $location=$_POST['location'];
    $adventure_photo=$_FILES['adventure_photo'];
    $uploaded=fileUpload("../img/adventures/",$adventure_photo);
    echo "<div class='wrapper'>";
    echo $uploaded;
    if($uploaded!="0"){
        $result1=$conn->insertion("adventure",
    ['adventure_name','photo','location'],
    [$adventure_name,$uploaded,$location]);
        if($result1=="1"){
            alerts("green","New adventure named $adventure_name has been added.");
        }
    }
    else{
       alerts("red","Photo not uploaded.Please do all processing from first.");
    }
    echo "</div>";
}
?>
<script>
function option_click(type1,array1){
    document.getElementById("type1").value=type1;
    document.getElementById("arr1").value=array1;
    document.getElementById("optionss").submit();
}
</script>
<form action="" id="optionss" method="post">
<input type="hidden" name="type1" id="type1">
<input type="hidden" name="arr1" id="arr1">
</form>
