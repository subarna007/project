<?php
include_once "navbar.php";
?>
    <div class="block bg-light wrapper" id="packages">
        <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Packages</h1>
        <div class="blocks">
            <div class="card" style="width:23rem;">
                <div class="card-body ">
                  <h3 class="card-title bg-light text-black ">Platinum Package <i class="bi-patch-check-fill text-secondary h4"></i></h3>
                  <img src="../img/foods/pizza.jpg" class="card-img-top" alt="pizza">
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="bi bi-person"> </i>Single Bed Room <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-egg-fried"> </i>Lunch & Breakfast <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-bicycle"> </i>Rope Climbing </li>
                </ul>
                <div class="card-body ">
                <a onclick="bought(this,'platinum')" class="btn btn-dark">Buy Now for <span class="badge rounded-pill bg-light text-dark">NRs-2500</span></a>
                </div>
            </div>
            <div class="card" style="width:23rem;">
                <div class="card-body ">
                  <h3 class="card-title bg-secondary text-white">Silver Package <i class="bi-patch-check-fill text-light h4"></i></h3>
                  <img src="../img/rooms/double.jpg" class="card-img-top" alt="double">
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="bi bi-people"> </i>Double Bed Room <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-egg-fried"> </i>Lunch & Breakfast <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-bicycle"> </i>Rope Climbing </li>
                </ul>
                <div class="card-body">
                <a onclick="bought(this,'silver')" class="btn btn-dark">Buy Now for <span class="badge rounded-pill bg-secondary">NRs-2000</span></a>
                </div>
            </div>
            <div class="card " style="width: 23rem;">
                <div class="card-body ">
                  <h3 class="card-title bg-warning text-white">Gold Package <i class="bi-patch-check text-light h4"></i></h5>
                    <img src="../img/adventures/bungee.jpg" class="card-img-top" alt="bungee">
                  </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="bi bi-person"> </i>Double Bed Room <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-egg-fried"> </i>Lunch & Breakfast<span class="badge rounded-pill bg-primary text-light">Free</span></li>
                  <li class="list-group-item"><i class="bi bi-bicycle"> </i>Rope Climbing <span class="badge rounded-pill bg-primary text-light">Free</span></li>
                </ul>
                <div class="card-body">
                <a onclick="bought(this,'gold')" class="btn btn-dark">Buy Now for <span class="badge rounded-pill bg-warning ">NRs-7500</span></a>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post" id="packagesForm">
      <input type="hidden" name="data11" id="data11">
      <input type="hidden" name="price22" id="price22">
    </form>
    <script>
      function bought(x,getData){
        document.getElementById("price22").value=x.childNodes[1].innerHTML;
        document.getElementById("data11").value=getData;
        document.getElementById("packagesForm").submit();
      }
    </script>
<?php
include_once "../classes/modal.php";
include_once "../classes/index.php";
if(isset($_POST["data11"])&&$_COOKIE["logged"]!="admin@email.com"){
  echo $_POST["data11"];
  $price2=$_POST["price22"];
  $data=$_POST["data11"];
  echo "<table>";
  if($data=="platinum"){
    $input="
    <table>
  <form action='' method='post'>
    <tr>
      <td>
        Package Name
      </td>
      <td>
        <input type='text' id='package_name' name='package_name' value='".$data."' readonly>
      </td>
    </tr>
    <tr>
      <td>Room type</td>
      <td><input type='text' id='room_type' name='room_type' value='Single Bed Room' readonly></td>
    </tr>
    <tr>
      <td>
        Check In Date
      </td>
      <td>
        <input type='date' name='check_in_date' id='check_in_date' required>
      </td>
    </tr>
    <tr>
      <td>
        Check Out Date
      </td>
      <td>
        <input type='date' name='check_out_date' id='check_out_date' required>
      </td>      
    </tr>
    <tr>
      <td>
        <input type='hidden' name='price2' id='price2' value='".$price2."' required>
      </td>
    </tr>
    <tr>
     <td>
      <button type='submit' name='book'>Book Now</button>
      <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
    </td>
    </tr>
  </form>
</table>
    ";
  }
  else if($data=="silver"){    
    $input="
    <table>
    <form action='' method='post'>
      <tr>
        <td>
          Package Name
        </td>
        <td>
          <input type='text' id='package_name' name='package_name' value='".$data."' readonly>
        </td>
      </tr>
      <tr>
        <td>Room type</td>
        <td><input type='text' id='room_type' name='room_type' value='Double Bed Room' readonly></td>
      </tr>
    <tr>
      <td>
        Check In Date
      </td>
      <td>
        <input type='date' name='check_in_date' id='check_in_date' required>
      </td>
    </tr>
    <tr>
      <td>
        Check Out Date
      </td>
      <td>
        <input type='date' name='check_out_date' id='check_out_date' required>
      </td>      
    </tr>
    <tr>
      <td>
        <input type='hidden' name='price2' id='price2' value='".$price2."' required>
      </td>
    </tr>
      <tr>
      <td>
        <button type='submit' name='book'>Book Now</button>
        <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
      </td>
      </tr>
    </form>
  </table>
    ";
  }
  else{
    $input="
    <table>
  <form action='' method='post'>
    <tr>
      <td>
        Package Name
      </td>
      <td>
        <input type='text' id='package_name' value='".$data."' name='package_name' readonly>
      </td>
    </tr>
    <tr>
      <td>Room type</td>
      <td><input type='text' id='room_type' name='room_type' value='Double Bed Room'  readonly></td>
    </tr>
    <tr>
      <td>
        Check In Date
      </td>
      <td>
        <input type='date' name='check_in_date' id='check_in_date' required>
      </td>
    </tr>
    <tr>
      <td>
        Check Out Date
      </td>
      <td>
        <input type='date' name='check_out_date' id='check_out_date' required>
      </td>      
    </tr>
    <tr>
      <td>
        <input type='hidden' name='price2' id='price2' value='".$price2."' required>
      </td>
    </tr>
    <tr>
     <td>
      <button type='submit' name='book'>Book Now</button>
      <button onclick='this.parentNode.parentNode.style.display=\"none\";'>Cancel</button>
    </td>
    </tr>
  </form>
</table>
    ";
  }
  echo "</table>";
  mymodal("Book Package",$input);
}

if(isset($_POST['book'])&&$_COOKIE["logged"]!="admin@email.com"){
$room_type=$_POST["room_type"];
$check_in=$_POST["check_in_date"];
$check_out=$_POST["check_out_date"];
$package_name=$_POST["package_name"];
$price2=explode("-",$_POST['price2']);
$conn=new DBConnect();
$result=$conn->insertion("packages",
      ['name','package_name','check_in_date','check_out_date','price'],
      [$_COOKIE['logged'],$package_name,$check_in,$check_out,(float)$price2[1]]
      );
  if($result){
    $result2=$conn->select("login",["username"],[$_COOKIE["logged"]]);
    $user_id=$result2[0]["id"];
    $result1=$conn->insertion("bookings",
    ["room_name","username","check_in_date","check_out_day","price","user_id"]
    ,[$room_type,$_COOKIE["logged"],$check_in,$check_out,"0",$user_id]
     );
    mymodal("Package named $package_name has been booked under name ".$_COOKIE["logged"]);
  }
}

?>
<?php
include_once "../components/footer.php";
?>