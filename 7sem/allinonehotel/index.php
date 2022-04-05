<?php
if(session_status()==PHP_SESSION_NONE){
  session_start();
}
?>
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
<title>All in one Hotel</title>
</head>
<body>
    <script src="js/seeall.js"></script><nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="" width="30" height="24">
              </a>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#rooms">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#foods">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#adventures">Adventures</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Packages
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#packages">Platinum</a></li>
                  <li><a class="dropdown-item" href="#packages">Silver</a></li>
                  <li><a class="dropdown-item" href="#packages">Gold</a></li>
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
                    echo '<li><a class="dropdown-item" href="admin/">Dashboard</a></li>';
                    
                  }
                  else if($_COOKIE["role"]=="vendor"){
                    echo '<li><a class="dropdown-item" href="vendor/">Dashboard</a></li>';
                  }
                  else{
                    echo '<li><a class="dropdown-item" href="user/">Dashboard</a></li>';
                  }
                  echo '<li><a class="dropdown-item" href="logout.php">Log out</a></li>';
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
              include_once "config.php";
              if(isset($_COOKIE['logged'])){
                if($_COOKIE['logged']!='reset' ){
                  if($_COOKIE["logged"]=='admin@email.com'){
                    $sql3="Select * from bookings where room_number=0";   
                    $sql33="Select * from bookings where seen<>1"   ;             
                  }
                  else{
                    $sql3="Select * from bookings where username='".$_COOKIE['logged']."'"."  and room_number<>0;";
                    $sql33="Select * from bookings where username='".$_COOKIE['logged']."'"."  and user_seen=0 and room_number<>0;"; 
                  }
                  echo '<li class="nav-item dropdown" >
                  <a onclick="seeall(\'components/ajax_seeall.php\')" class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 ';
                 echo '<span><img src="img/bell1.png" style="background-color:white;border-radius:40%;width:20px;height:20px;" width=10><span id="num22">';
                 if(mysqli_num_rows(mysqli_query($conn,$sql33))>0) echo mysqli_num_rows(mysqli_query($conn,$sql33));
                 echo '</span></span>
                  </a>
                  <ul class="dropdown-menu p-1"  style = "margin-left:-15vw; max-height:50vh;overflow-y:scroll;overflow-x:hidden;" aria-labelledby="navbarDropdownMenuLink" >
                   ';
                  
                  if($result=mysqli_query($conn,$sql3)){
                    if(mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                        if($_COOKIE["logged"]=='admin@email.com') 
                        {
                          if($row["seen"]==1){
                            echo "<a href='admin'><button class = 'btn btn-secondary mb-2 p-1'> Room Booking Received : <span class='badge badge-dark'>".$row["username"]."</span></button></a>";
                          }
                          else{
                            echo "<a href='admin'><button class = 'btn btn-primary mb-2 p-1'> Room Booking Received : <span class='badge badge-dark'>".$row["username"]."</span></button></a>";
                          }
                        }
                        else{
                         if($row["user_seen"]==0) echo "<a href='user'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-dark'>".$row["room_number"]."</span></button></a>";
                        else{
                          echo "<a href='user'><button class = 'btn btn-secondary mb-2 p-1'> Room number assigned : <span class='badge badge-dark'>".$row["room_number"]."</span></button></a>";
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
    <button class="btn btn-dark rounded-pill up-button " onclick="scrollToTop()"><i class="bi bi-arrow-up "></i></button>
    <div class="banner">   
        <div class="banner-content">
            <h1 class="display-5 text-justify text-white mb-4 text-uppercase">
                Luxury is not a place,<br>it's an experience.
            </h1>
            <div><a class="btn btn-outline-light" href="rooms/card_rooms.php">
            Check Rooms
            </a>
            <a class="btn btn-outline-light" href="components/new_foods.php">
                Check Foods
            </a>
            <a class="btn btn-outline-light" href="packages.php">
                Check Packages
            </a>
          </div>
        </div>
    </div>
    <?php    
      include_once "classes/index.php";
      include_once "rooms/front-end-rooms.php";
    ?>
    <div class="block bg-light" id="foods">
        <h1 class="display-6 "><i class="bi bi-arrow-right display-6"> </i>Most Popular Foods</h1>
        <div class="blocks">
          <?php
          $conn=new DBConnect();
             $result2=$conn->own_query("Select f.id,f.food_name,f.cost,f.food_photo,f.category,sum(qty) from food f inner join food_order fo on fo.food_name=f.food_name group by fo.food_name order by sum(qty) desc limit 4;");
             $i=0;
             if(count($result2)>0){
              //  print_r($result2);
              foreach($result2 as $row2){
                food_card($row2["food_name"],"img/foods/".$row2["food_photo"],$row2["cost"]);
                 if($i++==4) break;
               }
             }
             else{
              $result2=$conn->own_query("Select * from food order by id desc limit 4");
              $i=0;
              if(count($result2)>0){
               foreach($result2 as $row2){
                 food_card($row2["food_name"],"img/foods/".$row2["food_photo"],$row2["cost"]);
                  if($i++==4) break;
                }
              }
             }
          ?>
        <!-- <div class="card" style="width: 18rem;">
            <img src="img/foods/momo.jpeg" class="card-img-top" alt="momo">
            <div class="card-body">
              <h5 class="card-title">Momo</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-200/plate</span>
              <a href="#" class="btn btn-outline-success">Order Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="img/foods/chowmein.jpg" class="card-img-top" alt="chowmein">
            <div class="card-body">
              <h5 class="card-title">Chowmein</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-150/plate</span>
              <a href="#" class="btn btn-outline-success">Order Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="img/foods/pizza.jpg" class="card-img-top" alt="pizza">
            <div class="card-body">
              <h5 class="card-title">Pizza</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-450/plate</span>
              <a href="#" class="btn btn-outline-success">Order Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="img/foods/thakali.jpg" class="card-img-top" alt="thakali">
            <div class="card-body">
              <h5 class="card-title">Thakali</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-550/plate</span>
              <a href="#" class="btn btn-outline-success">Order Now</a>
            </div>
          </div>
        </div> -->
            </div>
        <center><a href="components/new_foods.php" class="btn btn-outline-dark m-4">Check out all the available foods</a></center>
    </div>
    <!-- <div class="block" id="adventures">
        <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Adventures</h1>
        <div class="blocks">
        <div class="card" style="width: 18rem;">
            <img src="img/adventures/bungee.jpg" class="card-img-top" alt="bungee">
            <div class="card-body">
              <h5 class="card-title">Bungee Jumping</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-3500/person</span>
              <p><i class="bi bi-geo-alt"></i> Pokhara </p>
              <a href="adventure-details.php" class="btn btn-success">Check it Out</a>
            </div>
        </div>
          <div class="card" style="width: 18rem;">
            <img src="img/adventures/safari.jpg" class="card-img-top" alt="safari">
            <div class="card-body">
              <h5 class="card-title">Safari</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-2500/person</span>
              <p><i class="bi bi-geo-alt"></i> Chitwan </p>
              <a href="adventure-details.php" class="btn btn-success">Check it Out</a>
            </div>
        </div>
          <div class="card" style="width: 18rem;">
            <img src="img/adventures/para.gif" class="card-img-top" alt="paragliding">
            <div class="card-body">
              <h5 class="card-title">Paragliding</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-4000/person</span>
              <p><i class="bi bi-geo-alt"></i> Pokhara </p>
              <a href="adventure-details.php" class="btn btn-success">Check it Out</a>
            </div>
        </div>
          <div class="card" style="width: 18rem;">
            <img src="img/adventures/rafting.jpg" class="card-img-top" alt="rafting">
            <div class="card-body">
              <h5 class="card-title">Rafting</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-2 w-50">NRs-1200/person</span>
              <p><i class="bi bi-geo-alt"></i> Karnali </p>
              <a href="adventure-details.php" class="btn btn-success">Check it Out</a>
            </div>
          </div>
        </div>
        <center><a href="components/new_adventures.php" class="btn btn-outline-dark m-4">Check out all the available adventures</a></center>
    </div> -->
    <?php
      include_once "components/new_adventure.php";
    ?>
    <div class="block bg-light" style="margin-bottom:10vh;" id="packages">
              <?php
                include_once "packages.php";
              ?>
    </div>
    <?php
    include_once "carts.php";
      include_once "components/footer.php";
    ?>

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/app.js">
</script>
</html>