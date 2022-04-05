<?php
include_once "../dashboard-components/dashboard.php";

?>
<div class="wrapper">
    <?php
        include_once "../classes/index.php";
                include_once "../classes/dynamic_table.php";
                $conn=new DBConnect();
                include_once "../classes/modal.php";
        if(isset($_POST["add_cat11"])){
            $input='
                <form action="" method="post">
                    <div>
                        <label for="">Category Name</label>
                        <input type="text" name="cat_name">
                    </div>
                    <div>
                       <input type="submit" name="add_cat12">
                       <button onclick="this.parentNode.parentNode.style.display=\'none\'">Cancel</button>
                    </div>
                </form>
           ';
            mymodal("Add category",$input);
        }
        if(isset($_POST["cat_name"])){
            $cat_name=$_POST["cat_name"];
            $result=$conn->insertion("food_category",["category"],[$cat_name]);
            if($result=="1"){
                mymodal("Category has been added successfully");
            }
        }
    ?>
    <div id="add_category" >
        <form action="" method="post">
            <br><input type="submit" name="add_cat11" value="Add category">
        </form>
    </div>
    <div id="view_category">
        <!-- <table>
            <tr>
                <td>
                    S.N
                </td>
                <td>
                    Category Name
                </td>
                <td>
                    Option
                </td>
            </tr> -->
            <?php
                
                $caption="View Category";
                $title=["S.N","Category Name","Option"];
                $values=["id","category"];
                $total_rows=$conn->total_rows("food_category","count(*)","");
                table($caption,$title,$values,$total_rows,"food_category");
            ?>
        <!-- </table> -->
    </div>
    <script>

        function option_click(x,y){
            document.getElementById('operation').value=x;
            document.getElementById('values').value=y;        
            document.getElementById('options').submit();
        }
    </script>
    <form action="" method="post" id="options">
        <input type="hidden" name="operation" id="operation">
        <input type="hidden" name="values" id="values">
    </form>
<?php
include_once "../classes/index.php";
if(isset($_POST["values"])&&isset($_POST["operation"])){
    $values=explode("^",$_POST["values"]);
    $operation=$_POST["operation"];    
    include_once "../classes/modal.php";
    if($operation=='edit'){
        $input="
            <form method='post' action='' >
                <div>
                    <label for=''>Category Name</label>
                    <input type='text' value='".$values[1]."' name='category_name'>                    
                   <input type='hidden' value='".$values[1]."' name='old_category_name'>
                </div>
                <div>                   
                    <input type='submit' value='Edit' name='edit_category'>
                    <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
                </div>
            </form>
        ";
       $heading="Edit Modal";
    }
    else{
        $input="
            <form method='post' action='' >
                <div>
                   Are you sure you want to delete category named $values[1]?
                   <input type='hidden' value='".$values[1]."' name='category_name'>
                </div>
                <div>                   
                    <input type='submit' value='delete' name='delete_category'>
                    <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
                </div>
            </form>
        ";
       $heading="Delete Modal";
    }
    mymodal($heading,$input);
}
if(isset($_POST["delete_category"])&&isset($_POST["category_name"])){
$category_name=$_POST["category_name"];
$result=$conn->deletion('food_category',['category'],[$category_name]);
    if($result){
        echo "Category named $category_name has been deleted.";    
    }
}
if(isset($_POST["edit_category"])&&isset($_POST["category_name"])){
    $category_name=$_POST["category_name"];
    $result=$conn->updation('food_category',['category'],[$category_name],['category'],[$_POST["old_category_name"]]);
        if($result){
            echo "Category named $category_name has been edited.";    
        }
    }
?>
</div>