<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Adventures</title>
</head>
<body>
    <script src="../js/seeall.js"></script><nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.php">
                <img src="../img/logo.png" alt="" width="30" height="24">
              </a>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
              <a class="nav-link " href="../rooms/card_rooms.php">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="foods.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Adventures</a>
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
                  <?php
               if(isset($_COOKIE['logged'])){ if($_COOKIE['logged']=='reset'){
                echo '<li><a class="dropdown-item" href="login.php">Login</a></li>
                              <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>';
              }
              else{
                  if($_COOKIE['logged']=='admin@email.com'){
                    echo '<li><a class="dropdown-item" href="../admin/">Dashboard</a></li>
                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>';
                  }
                  else{
                    echo '<li><a class="dropdown-item" href="../user/">Dashboard</a></li>
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
                <a class="nav-link" href="../contact.php" >Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index.php">About</a>
              </li>
              <?php
              include_once "../config.php";
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
                  include_once "../classes/index.php";
                  $conn=new DBConnect();
                 if($result=$conn->own_query($sql3)){
                    if(count($result)>0){
                      foreach($result as $row){
                        if($_COOKIE["logged"]=='admin@email.com') echo "<a href='../admin'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-info'>".$row["room_number"]."</span></button></a>";
                        else
                        {
                          if($row["seen"]==1){
                            echo "<a href='admin'><button class = 'btn btn-secondary mb-2 p-1'> Room Booking Received : <span class='badge badge-info'>".$row["username"]."</span></button></a>";
                          }
                          else{
                            echo "<a href='admin'><button class = 'btn btn-primary mb-2 p-1'> Room Booking Received : <span class='badge badge-info'>".$row["username"]."</span></button></a>";
                          }
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
    <div class="banner full-page">   
      <div class="banner-content">
          <h1 class="display-5 text-justify text-white mb-4 text-uppercase">
              Search for Thrilling Adventures.
          </h1>
            <form class="form-inline my-2 my-lg-0 search">
              <input class="form-control mr-sm-2 me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
      </div>
  </div>
  <div class="block" id="adventures">
    <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Adventures</h1>
    <div class="blocks full-blocks">
    <div class="card" style="width: 18rem;">
        <img src="../img/adventures/bungee.jpg" class="card-img-top" alt="bungee">
        <div class="card-body">
          <h5 class="card-title">Bungee Jumping</h5>
          <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-3500/person</span>
          <p><i class="bi bi-geo-alt"></i> Pokhara </p>          
              <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="../img/adventures/safari.jpg" class="card-img-top" alt="safari">
        <div class="card-body">
          <h5 class="card-title">Safari</h5>
          <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-2500/person</span>
              <p><i class="bi bi-geo-alt"></i> Chitwan </p>
              <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="../img/adventures/para.gif" class="card-img-top" alt="paragliding">
        <div class="card-body">
          <h5 class="card-title">Paragliding</h5>
          <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-4000/person</span>
          <p><i class="bi bi-geo-alt"></i> Pokhara </p>
              <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="../img/adventures/rafting.jpg" class="card-img-top" alt="rafting">
        <div class="card-body">
          <h5 class="card-title">Rafting</h5>
          <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-1200/person</span>
          <p><i class="bi bi-geo-alt"></i> Karnali </p>
              <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
        </div>
      </div>
    </div>
    <div class="blocks full-blocks">
      <div class="card" style="width: 18rem;">
          <img src="../img/adventures/abctrek.jpg" class="card-img-top" alt="trek">
          <div class="card-body">
            <h5 class="card-title">ABC trekking</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-12000/person</span>
            <p><i class="bi bi-geo-alt"></i> ABC </p>
                <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/adventures/helicopterride.jpg" class="card-img-top" alt="helicopterride">
          <div class="card-body">
            <h5 class="card-title">helicopter Ride</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-10000/person</span>
            <p><i class="bi bi-geo-alt"></i> Nepal </p>
                <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/adventures/rope.jpg" class="card-img-top" alt="rope">
          <div class="card-body">
            <h5 class="card-title">rope climing</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-2500/person</span>
            <p><i class="bi bi-geo-alt"></i> Nepal </p>
                <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/adventures/campfire.jpg" class="card-img-top" alt="campfire">
          <div class="card-body">
            <h5 class="card-title">Camp fire</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-2700/person</span>
            <p><i class="bi bi-geo-alt"></i> Nepal </p>
                <a href="../adventure-details.php" class="btn btn-success">Check it Out</a>
          </div>
        </div>
      </div>
</div>
<!-- <div class="footer bg-light text-black">
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
 -->
 <?php
 include_once "../components/footer.php";
 ?>
 </body>
</html>