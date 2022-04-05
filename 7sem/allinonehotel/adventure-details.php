<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/adventures.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<title>Adventure Details</title>

</head>
<script>
          function booking(room_name,price,x,y,z){
              console.log(room_name,price,x,y,z);
              document.getElementById("data").value=room_name+"%%^^"+price+"%%^^"+x+"%%^^"+y+"%%^^"+z;
          }
      </script>
    
<body>
    
   <script src="../js/seeall.js"></script>
   <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="" width="30" height="24">
              </a>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="rooms/card_rooms.php">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="components/new_foods.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="components/new_adventures.php">Adventures</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Packages
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="../packages.php">Platinum</a></li>
                  <li><a class="dropdown-item" href="../packages.php">Silver</a></li>
                  <li><a class="dropdown-item" href="../packages.php">Gold</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Account
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php    
                  include_once "classes/index.php";
                  $conn=new DBConnect();              
                  $adventure_name=$_GET["ad_name"];
                  $location=$_GET["loc"];
               if(isset($_COOKIE['logged'])){ if($_COOKIE['logged']=='reset'){
                echo '<li><a class="dropdown-item" href="login.php">Login</a></li>
                              <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>';
              }
              else{
                  if($_COOKIE['logged']=='admin@email.com'){
                    echo '<li><a class="dropdown-item" href="admin/">Dashboard</a></li>
                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>';
                  }
                  else{
                    echo '<li><a class="dropdown-item" href="user/">Dashboard</a></li>
                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>';
                  }
                }
              }
              else{
                echo '<li><a class="dropdown-item" href="login.php">Login</a></li>
                <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>';

              }
                  ?>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <?php

              if(isset($_COOKIE['logged'])){
                if($_COOKIE['logged']!='reset' ){
                  echo '<li class="nav-item dropdown" >
                  <a onclick="seeall(\'../components/ajax_seeall.php\')" class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  </a>
                  <ul class="dropdown-menu p-1"  style = "margin-left:-15vw; max-height:50vh;overflow-y:scroll;overflow-x:hidden;" aria-labelledby="navbarDropdownMenuLink" >
                   ';
                  if($_COOKIE["logged"]=='admin@email.com'){
                    $sql3="Select * from bookings where room_number=0";
                    
                  }
                  else{
                    $sql3="Select * from bookings where username='".$_COOKIE['logged']."'"."  and room_number<>0;";
                  }
                  
                 if($result=$conn->own_query($sql3)){
                    if(count($result)>0){
                      foreach($result as $row){
                        if($_COOKIE["logged"]=='admin@email.com') 
                        {
                          if($row["seen"]==1){
                            echo "<a href='admin'><button class = 'btn btn-secondary mb-2 p-1'> Room Booking Received : <span class='badge badge-info'>".$row["username"]."</span></button></a>";
                          }
                          else{
                            echo "<a href='admin'><button class = 'btn btn-primary mb-2 p-1'> Room Booking Received : <span class='badge badge-info'>".$row["username"]."</span></button></a>";
                          }
                        }
                        else{
                          echo "<a href='user'>
                          <button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-info'>".$row["room_number"]."</span></button></a>";
                      }
                    }
                    }
                    else{
                      echo "No messages found";
                    }
                  }
                  
                   echo'
                  </ul>
                </li>';
                 }
              }
              ?>
            </ul>
          </div>
        </div>
  </nav>
    <div class="block">
      <div class = "adventure-details">
          <div class ="adventure-left">
              <!-- <img src="img/adventures/safari.jpg" class="shadow-lg">
              <h1 class="mb-2 mt-4 text-uppercase display-6">Safari </h1>
              <p><i class="bi bi-geo-alt"></i> Chitwan </p> -->

            <?php
              $result55=$conn->own_query("Select * from adventure where adventure_name='$adventure_name' and location='$location'");
              if(count($result55)>0){
                echo '<img src="img/adventures/'.$result55[0]["photo"].'" class="shadow-lg">
                <h1 class="mb-2 mt-4 text-uppercase display-6">'.$result55[0]["adventure_name"].' </h1>
                <p><i class="bi bi-geo-alt"></i> '.$result55[0]["location"].' </p>';

              }
            ?>
          </div>
          <div class = "adventure-right">
              <h1 class = "vendor-header mb-4 shadow-lg w-50 p-3 text-center rounded-pill">Choose your Vendors</h1>       
              <div class = "vendors">
              <?php            
              if(isset($_POST['login_button']))
              {
              
                $email=$_POST["Email1"];
                $password=$_POST["Password1"];
                $sql="Select * from login where username='$email' and status<>0";
                $result=$conn->own_query($sql);
                if(count($result)>0){
                  // while($row=mysqli_fetch_assoc($result)){
                    foreach($result as $row){
                    if($password==$row["password"]){
                      include_once "session.php";
                      if($email!="admin@email.com") login($email,$row["role"],$row["id"]);
                      else{
                        login($email,$row["role"]);
                      }
                      if($_COOKIE["logged"]=='admin@email.com'){
                        header('Location: admin/index.php'); 
                        // echo "<script>location.href="admin";</script>";
                      }
                      else if($_COOKIE["role"]=="vendor"){
                        // echo "<script>location.href="vendor/";</script>";
                        header('Location:vendor');
                      } 
                      else {
                        // echo "<script>location.href="index.php";</script>";
                         header('Location: index.php'); 
                        }        
                    }
                  }
                }
                else{
                 include_once "classes/modal.php";
                 mymodal("Username or password failed");
                }
              }
                $query="select v.vendor_name,v.price,v.travel_cost,v.lunch_breakfast,v.stay_cost,a.adventure_name,a.location,a.photo,a.id from vendor v inner join adventure a where a.id=v.adventure_id and a.adventure_name='$adventure_name';";
                $result=$conn->own_query($query);
                foreach($result as $row)
                {
                  echo '
                  <div class="vendor shadow-lg">  
                      <button class="btn btn-dark w-100 mb-2"><h6 class="display-6 ">'.explode("@all",$row["vendor_name"])[0].'</h6></button> 
                  <button type="button" class="btn btn-secondary mb-4 w-100 shadow-lg"><h5 class="mt-1">NRs. '.$row["price"].'/person</h5></button>
                  <h4 class ="text-uppercase" style="margin-bottom:-10%">Details</h4>
                  <p class = "text-justify ">
                  <ul class="list-group list-group-flush w-100">
                    <li class="list-group-item"><i class="bi bi-projector-fill"> </i> Travel Cost ';
                    if($row["travel_cost"]==1){
                      echo '
                      <span style="background-color:skyblue;color:white;padding:2%;border-radius:10px;font-size:14px;">Free</span>';
                    }
                    echo '</li>
                    <li class="list-group-item"><i class="bi bi-egg-fried"> </i> Lunch & Breakfast ';
                    if($row["lunch_breakfast"]==1){
                      echo '
                      <span style="background-color:skyblue;color:white;padding:2%;border-radius:10px;font-size:14px;">Free</span>';
                    }
                    echo '</li>
                    <li class="list-group-item"><i class="bi bi-cash-coin"> </i> Stay Cost';
                    if($row["stay_cost"]==1){
                      echo '
                      <span style="background-color:skyblue;color:white;padding:2%;border-radius:10px;font-size:14px;">Free</span>';
                    }
                    echo '</li>
                  </ul>
                  </p>
                      <a class="w-100 mb-3" data-bs-toggle=\'modal\'
                          data-bs-target=\'#staticBackdrop\' 
                          onclick="booking(\''.$row["id"].'\',\''.$row["price"].'\',\''.$row["vendor_name"].'\',
                          \''.$row["lunch_breakfast"].'\',\''.$row["stay_cost"].'\')">
                            <button class = "btn btn-success w-100">Book Now</button>
                          </a>
                  
                  </div>
                  ';
                }
            ?>
                 
              </div>
          </div>
      </div>
    </div>
   <?php
    include_once "components/footer.php";
   ?>
    
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Book Your Adventure</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php
                if(!isset($_COOKIE["role"])){
                    // if($_COOKIE["role"]=="reset"){
                      echo ' <form action="" method="POST"><div class="alert alert-danger" role="alert">
                      Please login as user first!!
                    </div>
                    <main id="login">
                    <section>
                              <div class="form-group">
                                <label for="Email1">Email address</label>
                                <input type="email" class="form-control" id="Email1"  name="Email1" aria-describedby="emailHelp" placeholder="Enter email"  required>
                              </div>
                              <div class="form-group">
                                <label for="Password1">Password</label>
                                <input type="password" class="form-control" id="Password1" name="Password1" placeholder="Password"  required>
                              </div>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="Check1" name="Check1">
                                <label class="form-check-label" for="Check1">Remember me</label>
                              </div>
                              <center><button type="submit" class="btn btn-success w-100" name="login_button">Login</button></center>
                              <p>Not Registered yet? <a href="../signup.php">Register</a></p>
                          
                    </section>
                </main>  </form>';
                            
                            }
                    else{
                    if($_COOKIE["role"]=="user"){
                    ?>
            <form action="" method="post">
                      <div class = "mb-4">
                        <h5>Date:</h5>
                        <input type="date" name="check_in" id="check_in" class = "form-control">
                      </div>
                        <input type='hidden' name='data' id='data'>
                      </div>
                      <div class="modal-footer">
                          <?php
                                   // }//else bracket
                          ?>
                      <?php
                        // if($_COOKIE["logged"]!="reset")
                         echo '<button type="submit" class="btn btn-success w-100" name="book_room">Book Now</button>';
                        ?>
             </form>
             <?php
                    }
                    else{
                      echo "Must login as User first";
                    }
                 }//isset closing

             ?>
      </div>
    </div>
  </div>
</div>

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/app.js">
</script>
</html>
<?php
include_once "classes/index.php";
if(isset($_POST["book_room"])){
$date=$_POST["check_in"];
$data=$_POST["data"];
$arr=explode("%%^^",$data);
print_r($arr);
$username=$_COOKIE["logged"];
$conn=new DBConnect();
$result=$conn->insertion("adventure_booked",
['vendor_name','adventure_id','date_booked','price','booking_name'],
[$arr[2],$arr[0],$date,$arr[1],$_COOKIE["logged"]]
);
  if($result){
    alerts("green","Adventure has been booked on name $username for $date");
  }
  else{
    alerts("red","Some error occured");
  }
}

?>