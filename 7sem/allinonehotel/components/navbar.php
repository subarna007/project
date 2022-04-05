<?php
include_once "../classes/index.php";
$conn=new DBConnect();
if(session_status() == PHP_SESSION_NONE){
  //session has not started
  session_start();$id = session_id();  
  $_SESSION["logged"]="";
}
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
                <a class="nav-link " href="../components/new_foods.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../components/new_adventures.php">Adventures</a>
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
              //  if(isset($_COOKIE['logged'])){ if($_COOKIE['logged']=='reset'){
              //   echo '<li><a class="dropdown-item" href="login.php">Login</a></li>
              //                 <li><a class="dropdown-item" href="../signup.php">Sign Up</a></li>';
              // }
              // else{
              //     if($_COOKIE['logged']=='admin@email.com'){
              //       echo '<li><a class="dropdown-item" href="../admin/">Dashboard</a></li>
              //       <li><a class="dropdown-item" href="../logout.php">Log out</a></li>';
              //     }
              //     else{
              //       echo '<li><a class="dropdown-item" href="../user/">Dashboard</a></li>
              //       <li><a class="dropdown-item" href="../logout.php">Log out</a></li>';
              //     }
              //   }
              // }
              // else{
              //   echo '<li><a class="dropdown-item" href="../login.php">Login</a></li>
              //   <li><a class="dropdown-item" href="../signup.php">Sign Up</a></li>';

              // }
              //     ?>
              //   </ul>
              // </li>
              // <li class="nav-item">
              //   <a class="nav-link" href="../contact.php" >Contact</a>
              // </li>
              // <li class="nav-item">
              //   <a class="nav-link" href="../index.php">About</a>
              // </li>
              // <?php
              // if(isset($_COOKIE['logged'])){
              //   if($_COOKIE['logged']!='reset' ){
              //     echo '<li class="nav-item dropdown" >
              //     <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              //     <i class="fa fa-bell"></i>
              //     </a>
              //     <ul class="dropdown-menu p-1"  style = "margin-left:-15vw; max-height:50vh;overflow-y:scroll;overflow-x:hidden;" aria-labelledby="navbarDropdownMenuLink" >
              //      ';
              //     if($_COOKIE["logged"]=='admin@email.com'){
              //       $sql3="Select * from bookings where room_number=0";
                    
              //     }
              //     else{
              //       $sql3="Select * from bookings where username='".$_COOKIE['logged']."'"."  and room_number<>0;";
              //     }
              //     // if($result=mysqli_query($conn,$sql3)){
              //       // if(mysqli_num_rows($result)>0){
              //         // while($row=mysqli_fetch_assoc($result)){
              //           if($result=$conn->own_query($sql3)){
              //             if(count($result)>0){
              //               foreach($result as $row){
              //                 if($_COOKIE["logged"]=='admin@email.com') echo "<a href='../admin'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-info'>".$row["room_number"]."</span></button></a>";
              //                 else{
              //                   echo "<a href='../user'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-info'>".$row["room_number"]."</span></button></a>";
              //               }
              //             }
              //          }
              //       else{
              //         echo "No messages found";
              //       }
              //     }
                  
              //      echo'
              //     </ul>
              //   </li>';
              //    }
              // }
              ?>
            </ul>
          </div>
        </div>
    </nav>
     -->

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
                <a class="nav-link" href="../components/new_foods.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../components/new_adventures.php">Adventures</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Packages
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="../components/packages.php">Platinum</a></li>
                  <li><a class="dropdown-item" href="../components/packages.php">Silver</a></li>
                  <li><a class="dropdown-item" href="../components/packages.php">Gold</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Account
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php
                  if(isset($_COOKIE['logged'])){
                    if($_COOKIE['logged']=='reset'){
                      echo '<li><a class="dropdown-item" href="../login.php">Login</a></li>
                                    <li><a class="dropdown-item" href="../signup.php">Sign Up</a></li>';
                    }
                    else{
                        if($_COOKIE['logged']=='admin@email.com'){
                          echo '<li><a class="dropdown-item" href="../admin/">Dashboard</a></li>
                          <li><a class="dropdown-item" href="../logout.php">Log out</a></li>';
                        }
                        else if($_COOKIE["role"]=="vendor"){
                          echo '<li><a class="dropdown-item" href="../vendor/">Dashboard</a></li>
                          <li><a class="dropdown-item" href="../logout.php">Log out</a></li>';
                        }
                        else{
                          echo '<li><a class="dropdown-item" href="../user/">Dashboard</a></li>
                          <li><a class="dropdown-item" href="../logout.php">Log out</a></li>';
                        }
                      }
                  }
                  else{
                    echo '<li><a class="dropdown-item" href="../login.php">Login</a></li>
                    <li><a class="dropdown-item" href="../signup.php">Sign Up</a></li>';
   
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
              if(isset($_COOKIE['logged'])){
                if($_COOKIE['logged']!='reset' ){
                  echo '<li class="nav-item dropdown" >
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            echo "<a href='admin'><button class = 'btn btn-secondary mb-2 p-1'> Room Booking Received : <span class='badge badge-dark'>".$row["username"]."</span></button></a>";
                          }
                          else{
                            echo "<a href='admin'><button class = 'btn btn-primary mb-2 p-1'> Room Booking Received : <span class='badge badge-dark'>".$row["username"]."</span></button></a>";
                          }
                        }
                        else{
                          echo "<a href='user'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-dark'>".$row["room_number"]."</span></button></a>";
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