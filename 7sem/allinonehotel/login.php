<?php
// include_once "config.php";
include_once "classes/index.php";
$conn=new DBConnect();
$login_failed=0;
if(isset($_POST['login_button']))
{

  $email=$_POST["Email1"];
  $password=$_POST["Password1"];
  $sql="Select * from login where username='$email' and status<>0";
  $result=$conn->own_query($sql);
  // print_r($result);
  // echo $sql;
  if(count($result)>0){
    // while($row=mysqli_fetch_assoc($result)){
      foreach($result as $row){
      if($password==$row["password"]){
        include_once "session.php";
        if($email!="admin@email.com") login($email,$row["role"],$row["id"]);
        else{
          login($email,$row["role"]);
        }
        if($_COOKIE["logged"]=='admin@email.com') header('Location: admin/index.php'); 
        else if($_COOKIE["role"]=="vendor"){
          header('Location:vendor');
        } 
        else if($_COOKIE["role"]=="cook"){
          header("Location:kitchen");
        }
        else {
            header('Location: index.php'); 
          }        
      }
    }
  }
  else{
    $login_failed=1;
  }
}
if(isset($_COOKIE["role"])){
  // if($_COOKIE["logged"]!='reset'){
  //  if($_COOKIE["logged"]!='admin@email.com'||
   if($_COOKIE["role"]=="admin") header('Location: admin'); 
   else if($_COOKIE["role"]=="vendor"){
    header("Location:vendor");
   }
   else {
    header('Location: user'); 
   }
  } 
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
          <a class="nav-link " href="rooms/card_rooms.php">Rooms</a>
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
              <li><a class="dropdown-item active" href="login.php">Login</a></li>
              <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
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
            <form method="POST" action="">
                <h1 class="display-5">Login to All in One Hotel</h1>
                <p>Enter your credentials</p>
               </div>
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
                <center><button type="submit" class="btn btn-success" name='login_button'>Login</button></center>
                <p>Not Registered yet? <a href="signup.php">Register</a></p>
              </form>
              <?php
                if($login_failed==1){
                  echo '<h2 style="color:red;">Username or password failed</h2>';
                }
              ?>

      </section>
  </main>
 
</body>
</html>
