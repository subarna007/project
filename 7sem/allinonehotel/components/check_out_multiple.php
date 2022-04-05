
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
    if(count($_SESSION["cart"])>0){
        echo "<table class='table' style='text-align:center;'><tr><td>S.N</td><td>Name</td><td>Photo</td><td>Price</td><td>Quantity</td><td>Sub-Total</td></tr>";
        echo "<pre>";
        $i=array_key_first($_SESSION["cart"]);
        foreach($item as $row){
            $arr=explode("%%",$row);
            echo "
            <tr>
                <td>
                    ".++$i."
                </td>
                <td>
                    ".$arr[1]."
                </td>
                <td>";
                if($arr[0]=="food") echo "<img src='".$arr[2]."' height=100px width=100px>";
                else echo "<img src='../rooms/".$arr[2]."' height=100px width=100px style='object-fit:cover;'>";
                echo "
                </td>
                <td>
                    ".$arr[3]."
                </td>
                <td>
                    ".$arr[4]."
                </td>
                <td>
                    ".$arr[4]*$arr[3]."
                </td>
                <td>
                <button 
                style='
                background-color:#d32f2f;
                color:white;
                border:none;
                padding:5%;
                border-radius:10px;'
                onclick='remove(\"$arr[0]\",\"$arr[1]\",\"$arr[2]\",\"$arr[3]\",\"$arr[4]\")'>Remove</button>
                </td>
            </tr>
            ";
        }
        echo "</table>";
        echo "<form method='post'>
                <button 
                style='
                background-color:green;
                color:white;
                border:none;
                padding:10px;
                border-radius:10px;'
                type='submit' name='checkout'>Checkout</button>
            </form>
        ";
    }
    else{
        alerts("red","Cart is empty","Please Click here to <a href='../index.php'>redirect to food page</a>.");
    }
    }
    if(isset($_POST["checkout"])){
        echo "<pre>";
        $cart=$_SESSION["cart"];
        $result="123";
        foreach($cart as $data){
            $arr=explode("%%",$data);
            if($arr[0]=="food"){
                $result1=$conn->insertion("food_order",
                    ['food_name','user_id','date2','qty','price'],
                    [$arr[1],$_COOKIE["customer_id"],date("Y-m-d"),$arr[4],$arr[3]]);
                    if($result1!="1"){
                        $result="00";
                        break;
                }
            }
            if($arr[0]=="room"){
                $result1=$conn->insertion("bookings",
                ['room_name','user_id','price','username','check_in_date','check_out_day'],
                [$arr[1],$_COOKIE["customer_id"],$arr[3],$_COOKIE["logged"],"0","0"]);
                if($result1!="1"){
                    $result="00";
                    break;
                }
            }
        }
        if($result=="00"){
            echo "
            Error occured
            ";
        }
        else{
            echo "
                Order has been placed.
            ";
        }
    }

    if(array_key_exists("remove_pic",$_POST)){
        $i=array_key_first($_SESSION["cart"]);
        // print_r($_POST["remove_pic"]);
    foreach($_SESSION["cart"] as $row)
        {//print_r($row);
           // echo "<br>".$_POST["remove_pic"];
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
    function remove(t,u,x,y,z){
        document.getElementById('remove_pic').value=t+"%%"+u+"%%"+x+"%%"+y+"%%"+z;
        document.getElementById('removal').submit();
    }
</script>