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
    <title>Foods</title>
    <style>
      #lll{
        background-color: rgba(255,255,255,0.7);
      }
      #price{
        position: fixed;
        bottom:2vh;
        right:3vw;
      }
      #price:hover{
        z-index:100000;
      }
      #carts{
        height:105px;
        width:105px;
        border-radius: 50%;
        padding:13px 20px;
        background-color: red;
        color:white;
        font-size: 18px;
        font-weight: 600;
        position:fixed;
        right:3vw;
        bottom:5vh;
        z-index:10000;        
      }
      #carts:hover{
        cursor: pointer;
      }
    </style>
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
                <a class="nav-link active" href="#">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../components/new_adventures.php">Adventures</a>
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
                              <li><a class="dropdown-item" href="../signup.php">Sign Up</a></li>';
              }
              else{
                  if($_COOKIE['logged']=='admin@email.com'){
                    echo '<li><a class="dropdown-item" href="../admin/">Dashboard</a></li>
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
    <div class="banner full-page">   
      <div class="banner-content">
          <h1 class="display-5 text-justify text-white mb-4 text-uppercase">
              Our Delicious Foods.
          </h1>
         
      </div>
  </div>
  <!-- Nav tabs -->
<ul class="nav nav-tabs container mt-2"  id="myTab" role="tablist">
  
<?php
    if(isset($_COOKIE["role"])){
      if($_COOKIE["role"]=="user"){        
        include_once "../recommendation/ajax_food_recommendation.php";
        // print_r($recommend_arr);
          if(isset($recommend_arr)){
            if(is_array($recommend_arr)){
              if(count($recommend_arr)>0&&$recommend_arr[0]!="no_login")
              {
                echo '<li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#recommended" type="button" role="tab" aria-controls="recommended" aria-selected="true">Recommended</button>
                </li>';
              }
            }
          }
        }      
    }
  ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link <?php if(!isset($_COOKIE["role"])) echo "active";  
     if(isset($_COOKIE["role"])){
        if($_COOKIE["role"]!="user"){
          echo "active";
        }
     }?>" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All Categories</button>
  </li>
  <?php
  include_once "../classes/index.php";
  $conn=new DBConnect();
  $result1=$conn->select("food_category");
  foreach($result1 as $row){
    echo ' <li class="nav-item" role="presentation">';
    echo ' <button class="nav-link" id="drinks-tab" data-bs-toggle="tab" data-bs-target="#'.$row["category"].'" type="button" role="tab" aria-controls="'.$row["category"].'" aria-selected="false">'.ucfirst($row["category"]).'</button>
    </li>';
  }
 
  ?>
</ul>
<div class="tab-content " >
  
            <?php
              if(isset($_COOKIE["role"])){
                if($_COOKIE["role"]=="user"){        
                  include_once "../recommendation/ajax_food_recommendation.php";
                  if(isset($recommend_arr)){
                    if(is_array($recommend_arr)){
                      if(count($recommend_arr)>0&&$recommend_arr[0]!="no_login")
                      {echo ' <div class="tab-pane active" style="padding:0;padding:25px 25px;"  id="recommended" role="tabpanel" aria-labelledby="recommended-tab">
                        <div id="display-grid" class="block">';
                        foreach($recommend_arr as $row22){
                          // print_r($row22);
                          food_card($row22["foodname"],"../img/foods/".$row22["food_photo"],$row22["price"]);
                        }
                        echo '
                        </div>
                     </div>';
                      }
                  } 
                    }
                  }     
              }
              ?>
  <div class="tab-pane <?php 
  if(!isset($_COOKIE["role"])) echo "active";  
    if(isset($recommend_arr)){
      if(!is_array($recommend_arr)){
          echo "active testing";
      }
    }
     if(isset($_COOKIE["role"])){
        if($_COOKIE["role"]!="user"){
          echo "active";
        }
     }?>"  id="all" role="tabpanel" aria-labelledby="all-tab">
    <div id="display-grid" class="block">
          <?php
          $result2=$conn->total_rows("food");
          foreach($result2 as $row2){
            food_card($row2["food_name"],"../img/foods/".$row2["food_photo"],$row2["cost"]);
          }
          ?>
    </div>
  </div>
<?php

foreach($result1 as $row1){
    echo '
           <div class="tab-pane " style="padding:25px 25px;" id="'.$row1['category'].'" role="tabpanel" aria-labelledby="'.$row['category'].'-tab">
            <div id="display-grid">
    ';
    $result2=$conn->select("food",["category"],[$row1['id']]);
   foreach($result2 as $row2)
   {    
     food_card($row2['food_name'],"../img/foods/".$row2['food_photo'],$row2['cost']);
    }
    echo '
          </div>
        </div>
    ';
}
?>

</div>

<form action="checkout.php" method="post" id="checkout_form">
  <input type="hidden" name="item" id="item"> 
</form>
<div id="carts">
  <span>Carts:<i class="fas fa-shopping-cart"></i></span>
  <span id="carts_total">
      0
  </span>

</div>
<div id="price"> 
 <?php
    if(isset($_COOKIE["logged"])&&count($_COOKIE)>2){
      echo '<button id="checkout" onclick="document.getElementById(\'checkout_form\').submit();" disabled>Proceed to Checkout</button>';
    }
    else{
      ?>
      <div class="modal " id='lll' tabindex="-1">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Please Login First</h5>
            </div>
            <div class="modal-body">
              <p><a href='../login.php'>Click here to move to login page</a></p>
            </div>
          </div>
        </div>
      </div>
      
      <script>document.getElementsByClassName("modal")[0].style.display='block';</script>
      <?php
    }
  ?>

</div>  
  <?php include_once "../components/footer.php"; ?>
 </body>
  <script>
    // document.getEleById("checkout")
    // if(document.cookie.split(";")[0].split("=")[1]=="user"){
      if(document.getElementById("carts_total").innerHTML=="0"){
        document.getElementById("checkout").disabled=true;
      }
    // }
    function cart(x,y,z,th){    
      var quantity=th.parentNode.childNodes[5].childNodes[1].innerHTML;
      if(document.getElementById('item').value=="") document.getElementById('item').value=x+"%%"+y+"%%"+z+"%%"+quantity;
      else document.getElementById('item').value+="^^"+x+"%%"+y+"%%"+z+"%%"+quantity;    
    document.getElementById("checkout").disabled=false;
    var carts_total=document.getElementById("carts_total");
    var total=Number(carts_total.innerHTML)+quantity*z;
    carts_total.innerHTML=total;
    th.parentNode.childNodes[5].childNodes[1].innerHTML="0";
    }
    function numbers(operation,th){
      
    var x= th.parentNode.parentNode.childNodes;
    console.log(x);
      var y=Number(x[1].innerHTML);
    if(operation=="add"){
      y++;
      x[1].innerHTML=""+y;
    }
    else{
      if(y!=0){
        y--;     
      } x[1].innerHTML=""+y;
    }
      
    }
 </script>
</html>
