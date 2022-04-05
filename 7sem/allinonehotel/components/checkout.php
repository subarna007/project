
<?php
include_once "../classes/index.php";
include_once "navbar.php";
$conn=new DBConnect();
echo '<div style="padding:55px 14px;">';
    echo '<caption><h2>Check Out</h2></caption>';
    if(session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }
if(isset($_POST["item"])||isset($_SESSION["cart"])){
    if(isset($_POST["item"]))
    { $item=explode("^^",$_POST["item"]);    
        $_SESSION['cart']=$item;
    }
    else{
        $item=$_SESSION["cart"];
    }
    // print_r($_SESSION["cart"]);
    if(count($_SESSION["cart"])>0){
        echo "<table class='table' style='text-align:center;'><tr><td>S.N</td><td>Name</td><td>Photo</td><td>Price</td><td>Quantity</td><td>Sub-Total</td><td>Option</td></tr>";
        
        $i=array_key_first($_SESSION["cart"]);
        foreach($item as $row){
            $arr=explode("%%",$row);
            echo "
            <tr>
                <td>
                    ".++$i."
                </td>
                <td>
                    ".$arr[0]."
                </td>
                <td>
                    <img src='".$arr[1]."' height=100px width=100px>
                </td>
                <td>
                    ".$arr[2]."
                </td>
                <td>
                    ".$arr[3]."
                </td>
                <td>
                    ".$arr[2]*$arr[3]."
                </td>
                <td>
                <button onclick='remove(\"$arr[0]\",\"$arr[1]\",\"$arr[2]\",\"$arr[3]\")'>Remove</button>
                </td>
            </tr>
            ";
        }
        echo "</table>";
        echo "<form method='post'>
                <button type='submit' name='checkout' id='checkout22'>Checkout</button>
            </form>
        ";
    }
    else{
        alerts("red","Cart is empty","Please Click here to <a href='../components/new_foods.php'>redirect to food page</a>.");
    }
    }
    if(isset($_POST["checkout"])){
        echo "<pre>";
        $cart=$_SESSION["cart"];
        $result="123";
        foreach($cart as $data){
            $arr=explode("%%",$data);
            $result=$conn->insertion("food_order",
            ['food_name','user_id','date2','qty','price'],
            [$arr[0],$_COOKIE["customer_id"],date("Y-m-d"),$arr[3],$arr[2]]);
            if($result!="1"){
                $result="00";
                break;
            }
        }
        if($result=="00"){
            echo "
            Error occured;
            ";
        }
        else{
            echo "
                Order has been placed.
            ";
            echo "<script>document.getElementById('checkout22').disabled='true';</script>";
        }
    }

    if(array_key_exists("remove_pic",$_POST)){
        $i=array_key_first($_SESSION["cart"]);
    foreach($_SESSION["cart"] as $row)
        {
            if($row==$_POST["remove_pic"]){
                unset($_SESSION["cart"][$i]);
                break;
            }
            $i++;

        }   
        // print_r($_SESSION["cart"]);
        echo "<Script>location.href=location.href;</script>";
    }
    ?>
    <form action="" method="post" id="removal">
        <input type="hidden" name="remove_pic"  id="remove_pic">
    </form>
</div>
<script>
    function remove(u,x,y,z){
        document.getElementById('remove_pic').value=u+"%%"+x+"%%"+y+"%%"+z;
        document.getElementById('removal').submit();
    }
</script>