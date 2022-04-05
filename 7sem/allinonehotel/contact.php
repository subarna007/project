<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Contact Us</title>
</head>
<body>
    <script src="../js/seeall.js"></script><nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
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
                  <li><a class="dropdown-item" href="components/packages.php">Platinum</a></li>
                  <li><a class="dropdown-item" href="components/packages.php">Silver</a></li>
                  <li><a class="dropdown-item" href="components/packages.php">Gold</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Account
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php
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
                <a class="nav-link active" href="contact.php" >Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">About</a>
              </li>
              <?php
              include_once "config.php";
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
                   include_once "classes/index.php";
                  $conn=new DBConnect();
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
                          echo "<a href='user'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-info'>".$row["room_number"]."</span></button></a>";
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
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.4132161960347!2d85.33643785050819!3d27.67362078272145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e8d9058ce3%3A0x5f9f01647e956594!2sKathford%20International%20College%20of%20Engineering%20%26%20Management%2C%20IT%20and%20Management%20Block!5e0!3m2!1sen!2snp!4v1637935142761!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="contact">
      <div class="container">
            <div class="row">
              <div class="col">
                <h5>
                <i class="bi bi-house-door"></i>
                Balkumari,Lalitpur</h5>
                <p style = "margin-left: 6%;">Kathford College</p>
                <h5>
                <i class="bi bi-phone"></i>
                +977-9863397226, +977-9803065366</h5>
                <p style = "margin-left: 6%;">Sun-Sat (9am to 9pm)</p>
                <h5>
                <i class="bi bi-envelope"></i>
                support@allinonehotel.com</h5>
                <p style = "margin-left: 6%;">Send us your queries anytime.</p>
              </div>
              <div class="col">
                <div class="row">
                    <div class="col" >
                      <input type="text" class="form-control" placeholder="Enter Full Name" aria-label="Full name" style="margin-bottom: 2%;">
                      <input type="email" class="form-control" placeholder="Enter Email" aria-label="Email" style="margin-bottom: 2%;">
                      <input type="text" class="form-control" placeholder="Enter Subject" aria-label="Subject" style="margin-bottom: 2%;">
                    </div>
                  </div>
              </div>
              <div class="col">
                <textarea class="form-control" placeholder="Enter your Message" rows="5" style="margin-bottom: 2%;"></textarea>
                <button class="btn btn-dark" style="float: right;">Send Message</button>
            </div>
          </div>
      </div>
    </div>
    <div class="footer bg-light text-black">
        <div class="container">
            <div class="row">
              <div class="col">
                <h5>Our Services</h5>
                    <i class="bi bi-wifi"></i>
                    <i class="bi bi-cup-straw"></i>
                    <i class="bi bi-person"></i>                      
           
              </div>
              <div class="col">
                  <h5>Socials</h5>
                  <a href="facebook.com" class = "text-dark"><i class="bi bi-facebook "></i></a>
                  <a href="facebook.com" class = "text-dark"><i class="bi bi-instagram"></i></a>
                  <a href="facebook.com" class = "text-dark"><i class="bi bi-github"> </i></a>
              </div>                  
              <div class="col">
                <h5>SEND US YOUR QUESTIONS</h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Send</button>
                  </div>
              </div>
            </div>
          </div>
    </div>
 </body>

</html>