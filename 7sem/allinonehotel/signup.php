<?php
include_once "config.php";
function verification_code(){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $random_string = '';
  for ($i = 0; $i <= 8; $i++) {
      $random_string.= $characters[rand(0, strlen($characters))];
  }
  return $random_string;
}
if(isset($_POST["register_user"]) && $_POST["Password1"]==$_POST["Password2"] ){
$name=$_POST["Name"];
$address=$_POST["Address"];
$number=$_POST["Number"];
$email=$_POST["Email1"];
$password=$_POST["Password1"];
$date=date("Y-m-d");
$verify_code=verification_code();
$sql1="INSERT INTO `user_details`(`username`, `password`, `address`, `contact`,`creation_date`,`verification_code`) VALUES ('$email','$password','$address',$number,'$date','$verify_code')";

$output1=0;
if(mysqli_query($conn,$sql1)){  
      $last_id = mysqli_insert_id($conn);
      // $last_id=mysqli_
      $sql2="Insert into `login`( `id`,`username`, `password`,`role`) VALUES ('".$last_id."','$email','$password','user');";

      $output1=1;
}
include_once "classes/modal.php";
if($output1==1&&mysqli_query($conn,$sql2)){
   mymodal("<b>User inserted</b>");    
  }
  else{
   mymodal("Error in addition");
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
  <script src="../js/seeall.js"></script><nav class="navbar fixed-top navbar-expand-lg navbar-light">
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
            <a class="nav-link " aria-current="page" href="index.php">Home</a>
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
              <li><a class="dropdown-item" href="packages.php">Platinum</a></li>
              <li><a class="dropdown-item" href="packages.php">Silver</a></li>
              <li><a class="dropdown-item" href="packages.php">Gold</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item " href="login.php">Login</a></li>
              <li><a class="dropdown-item active" href="signup.php">Sign Up</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact.php" >Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">About</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
  <main id="login">
      <section id="login-left">
      </section>
      <section id="login-right">
            <form method="post" action="">
                <h1 class="display-5">Register with All in One Hotel</h1>
            </div>
            <div class="form-group">
                <label for="FullName">Full Name</label>
                <input type="text" class="form-control" id="Name"  name="Name"  paceholder="Enter full name"  required >
              </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter address"  required>
              </div>
            <div class="form-group">
                <label for="Number">Mobile Number</label>
                <input type="number" class="form-control" id="Number"  name="Number" placeholder="Enter number"  required>
              </div>
                <div class="form-group">
                  <label for="Email1">Email address</label>
                  <input type="email" class="form-control" id="Email1" name="Email1" ria-describedby="emailHelp" placeholder="Enter email"  required pattern = [Aa-Zz]>
                </div>
                <div class="form-group">           
                  <label for="Password1">Password</label>
                  <input type="password" class="form-control" id="Password1" name="Password1" placeholder="Password"  required>
                </div>
                <div class="form-group">           
                    <label for="Password2">Confirm Password</label>
                    <input type="password" class="form-control" id="Password2" name="Password2" placeholder="Password"  required>
                </div>
                <!-- <div class="form-group">
                  <label for="">Select role</label>
                </div> -->
                <center><button type="submit" class="btn btn-success" name="register_user">Register</button></center>
                <p>Already have an account? <a href="login.php">Login</a></p>
              </form>
              

      </section>
  </main>
    
</body>
</html>

