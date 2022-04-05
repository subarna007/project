<?php
include_once "../classes/index.php";
include_once "../dashboard-components/dashboard.php";
include_once "../classes/modal.php";
// include_once "../classes/alerts.php";
$conn=new DBConnect();

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
          <button type='submit' name='add_ven'>Add Vendor</button>
          </form>
        </span>
       <?php if(isset($_GET["add_ven"])){
           $data="<h2>Add Vendor</h2>";
           $data.=' <form action="" method="post" enctype="multipart/form-data">
                        <div> <label for="vendor_name">Vendor Name</label>
                        <input type="text" name="vendor_name" id="vendor_name" required>
                        <input type="text" value="@allinonehotel.com" readonly>
                        </div>
                        <div> <label for="cost">Cost</label>
                        <input type="number" name="cost" id="cost" required>
                        </div>
                        <div> <label for="adventure_name">Adventure Name</label>
                        <select name="adventure_name" id="adventure_name" required>
                            
                            <option value="">Select Adventure</option>';                        
                            $result=$conn->select("adventure");
                            foreach($result as $row){
                                $data.= "<option value='".$row['id']."'>".$row['adventure_name']." - ".$row["location"]."</option>";
                            }
                        $data.= ' </select>
                        </div>
                        <fieldset>      
                            <legend>What do vendor offer?</legend>      
                            <input type="checkbox" name="vendor_offer[]" value="lunch">Lunch And Breakfast<br>      
                            <input type="checkbox" name="vendor_offer[]" value="Travel">Travel Cost<br>      
                            <input type="checkbox" name="vendor_offer[]" value="Stay">Stay Cost<br>      
                            <br>      
                               
                        </fieldset>
                        <input type="submit" value="Add Vendor" name="add_vendor">
                    </form>';
                    myModal($data);
            }
                include_once "../classes/dynamic_table.php";
                table("Vendors List",
                ["id","vendor_name","price","Options"]
                ,["id","vendor_name","price"]
                ,"2","vendor","10");
        ?>
    </div>
</body>
</html>

<?php
if(isset($_POST["add_vendor"])){
    $vendor_name=$_POST['vendor_name']."@allinonehotel.com";
    $cost=$_POST['cost'];
    $arr2=$_POST["vendor_offer"];
    $lunch="0";
    $stay="0";
    $travel="0";
    foreach($arr2 as $a){
        if($a=="lunch"){
            $lunch="1";
        }
        if($a=="Stay"){
            $stay="1";
        }

        if($a=="Travel"){
            $travel="1";
        }
    }
    $adventure_name=$_POST['adventure_name'];
        $result1=$conn->insertion("vendor",
    ['vendor_name','price','adventure_id','lunch_breakfast','travel_cost','stay_cost'],
    [$vendor_name,$cost,$adventure_name,$lunch,$travel,$stay]);
    $result2=$conn->insertion("login",["username","password","role"],[str_replace(" ","_",$vendor_name),"first@11","vendor"]);
        if($result1&&$result2){
            echo "<script>document.getElementsByClassName('modal1')[0].style.display='none';</script>";            
            mymodal("New vendor named $vendor_name has been added.Username has been set to ".str_replace(" ","_",$vendor_name)." and password is initialized to <i>first@11</i>");
        }
   
}
if(isset($_POST["type1"])&&isset($_POST["arr1"])){
    include_once "../classes/modal.php";
    $type=$_POST["type1"];
    $arr=explode("^",$_POST["arr1"]);
    if($type=="delete"){
        $input="
            <h5>Are you sure you want to delete vendor named $arr[1] ?</h5>
            <form method='post'>
            <input type='hidden' id='data21' name='data21' value='$arr[0]'>
                <br><input type='submit' name='yes' value='Yes'>                
                <button onclick='this.parentNode.parentNode.style.display=\"none\";'>No</button>
            </form>
        ";
        mymodal("Delete Vendor",$input);
    }   
    else{
        $input="
            <form action='' method='post'>
                Name:<input type='text' name='data11' value='".$arr[1]."' readonly required>
                <br>Cost:<input type='text' name='data12' value='".$arr[2]."' required>
                <br> <input type='submit' name='edit_vendor' value='Edit Vendor'>
                <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
            </form>
        ";
        mymodal("Edit Vendor",$input);
    }
}
if(isset($_POST["edit_vendor"])&&isset($_POST['data11'])&&isset($_POST['data12'])){
    $result=$conn->updation("vendor",["price"],[$_POST["data12"]],["vendor_name"],[$_POST["data11"]]);
    if($result=="1"){
        mymodal("Vendor data has been successfully deleted");
    }   
    else{
        mymodal("Vendor deletion failed Please perform operation again");
    }
}
if(isset($_POST["yes"])&&isset($_POST["data21"])){
    $result=$conn->deletion("vendor",["id"],[$_POST["data21"]]);
    if($result=="1"){
        mymodal("Vendor data has been successfully deleted");
    }   
    else{
        mymodal("Vendor deletion failed Please perform operation again");
    }
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
