<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
          function booking(room_name,price){
            $(".modal").modal('show');
            if(document.getElementById("price1")!=null) document.getElementById("price1").value=price;
            if(document.getElementById("reg_email")!=null) document.getElementById("reg_email").value=room_name;
          }
          function checking(room_name){
            location.href="../room-details.php?room_name="+room_name;
          }
      </script>
      <style>
        .checked{
          color:orange;
        }
        .empty{
          color:rgb(205,205,205);
        }
      </style>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
        <?php
        if(session_status() == PHP_SESSION_NONE){
          //session has not started
          session_start();$id = session_id();  
          $_SESSION["logged"]="";
        }
      ?>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="../js/seeall.js"></script><nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">
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
                <a class="nav-link active" href="../card_rooms.php">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../components/new_foods.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../components/new_adventures.php">Adventures</a>
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
                 
        include_once "../classes/index.php";
        $conn=new DBConnect();if($result=$conn->own_query($sql3)){
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


         

      <div class="block">
        <div id="recommendation">
        </div>
        <?php
        
        include_once "../classes/index.php";
        include_once "../session.php";
        $conn=new DBConnect();
            if(isset($_POST['book_room'])){
              $idd=$_COOKIE["customer_id"];
                $room_name3=$_POST["reg_email"];
                $booking_name=$_COOKIE['logged'];
                $check_in=$_POST["check_in"];
                $price1=$_POST['price1'];
                $check_out=$_POST["check_out"];
                $sql="Insert into bookings(room_name,username,check_in_date,check_out_day,price,user_id) values('$room_name3','$booking_name','$check_in','$check_out','$price1','$idd')";
                $result22=$conn->generic_func($sql);
                if($result22=="1"){
                    echo '<div class="alert alert-success wrapper w-50 m-auto mt-5 alert-dismissible fade show" role="alert" function=>
                    Booking Placed. Please wait until we reach out to you for the final confirmation.
                    <span style="color:white;float:right;"  onclick="this.parentNode.style.display=\'none\';" >&times;</span>
                    </div>';
                }
                else{
                  echo '<div class="alert alert-warning wrapper w-50 m-auto mt-5 alert-dismissible fade show" role="alert" function=>
                    Booking Failed Please try again. 
                      <span style="color:red;float:right;"  onclick="this.parentNode.style.display=\'none\';" >&times;</span>
                    </div>';
                }
            }
        $sql="Select * from rooms ";
        $result22=$conn->select("rooms");
        echo "<div class='block' id='rooms'>";
        echo '<h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Rooms</h1>';
        $i=0;
        // while($row=mysqli_fetch_assoc($result)){ 
          foreach($result22 as $row){           
            if($i++%4==0 ){
                echo '
                
                <div class="blocks full-blocks">';}
        ?>
        <div class="card" style="width: 18rem;">
           <?php echo "<img  src='".$row['room_pic']."' class='card-img-top' alt='doubledeluxe'>"; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["room_name"]; ?></h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-<?php echo $row["price"]; ?>/Night</span>
            <?php
            $star="<div style='display:inline;padding:5px 8px;'>";
            //  $result3=mysqli_query($conn,"select ratings from bookings where room_name='".$row["room_name"]."' and ratings<>'-1' group by ratings;");
            $result3=$conn->own_query("select avg(ratings) from bookings where room_name='".$row["room_name"]."' and ratings<>'-1';");
            if(count($result3)==0){
              for($j=0;$j<5;$j++){
                $star.='<span class="fa fa-star empty"></span>';
              }
             }
             else{
               $sum=0;
               foreach($result3 as $row3){
                 $sum+=(int)$row3["avg(ratings)"];
               }
              for($j=0;$j<$sum;$j++){
                $star.= '<span class="fa fa-star checked"></span>';                
              }
              while($j!=5){$j++;                
                $star.= '<span class="fa fa-star empty"></span>';
              }
             }
             echo $star."</div>";
            ?>
            <p>
                <?php
                  $result44=$conn->select("amenities");
                  $img="";
                  // print_r($result44);
                  if(count($result44)>0){
                    foreach($result44 as $row44){
                      // echo $row[$row44["amenity_name"]."_status"];
                      // print_r($row);
                      if($row[$row44["amenity_name"]."_status"]=="1"){
                        echo "<img style='height:30px;width:30px;' class='amenity-photo' style='margin-right:10px;margin-top:7px;' height=20 width=20 src='../rooms/".$row44["photo"]."'>";
                      }
                    }
                    echo $img;
                  }
                ?>
            </p>
              <!-- <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-person"></i></p> -->
              <!-- <span>Available Rooms : <?php 
              // $total_rooms=$row["total_rooms"];
              // $occupied_rooms=$row["occupied_rooms"];
              // $empty_rooms=$total_rooms-$occupied_rooms;
              $room_name1=$row["room_name"];
              $price=$row['price'];
              // echo $empty_rooms;
              ?></span> -->
              <p>
                <?php
               
            
                   echo "</p>";
                  // if($empty_rooms!=0)
                   echo "<button class='btn btn-success mb-2' data-bs-toggle='modal'
                    data-bs-target='#staticBackdrop' 
                    onclick=\"booking('$room_name1','$price')\">Book Now</button>";
                    // else{
                    //   echo '<button class="btn btn-secondary disabled mb-2">Book Now</button>';
                    // }
                    echo '
                    <button onclick="checking(\''.$room_name1.'\')" class="btn btn-primary mb-2">Check Details</button>
                    ';
                   ?>
            </div>
        </div>
            <?php
             if($i%4==0 ){
                echo '</div>';}
               }
                echo "</h1></div>";
            ?>
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

<!-- Modal -->

<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
  
        <h5 class="modal-title" id="staticBackdropLabel">Book Your Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php
                if(isset($_COOKIE['role'])&&count($_COOKIE)>2){
                    if($_COOKIE["role"]=="user"&&count($_COOKIE)>=2){
                        ?>
                          <form action="" method="post">
                                <div class = "mb-4">
                                  <h5>Check In Date:</h5>
                                  <input type="date" name="check_in" id="check_in" class = "form-control" required>
                                </div>
                                <div >
                                  <h5>Check Out Date:</h5>
                                  <input type="date" name="check_out" id="check_out" class = "form-control" required>
                              </div>
                                  <input type='hidden' name='reg_email' id='reg_email' >
                                  <input type='hidden' name='price1' id='price1'>
                                </div>
                                <div class="modal-footer">
                                <?php
                                  if($_COOKIE["logged"]!="reset") echo '<button type="submit" class="btn btn-success w-100" name="book_room">Book Now</button>';
                                  }//if bracket 
                                  else if($_COOKIE["role"]=="admin"){
                                    echo "Admin cannot book rooms";
                                  }
                                  else{
                                    echo "Vendor cannot book rooms";
                                  }
                                  ?>
                            </form>
                        <?php
                    }
                  
                    else{
                      echo ' <form action="" method="POST"><div class="alert alert-danger" role="alert">
                        Please login as user first!!
                      </div>';
                      echo '<main id="login">
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
                    ?>
          
             <?php
                // }//isset closing
             ?>
      </div>
    
    </div>
  </div>
</div>
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
          if($_COOKIE["logged"]=='admin@email.com') header('Location: admin/index.php'); 
          else if($_COOKIE["role"]=="vendor"){
            header('Location:vendor');
          } 
          else {
              header('Location: index.php'); 
            }        
        }
      }
    }
    else{
     include_once "../classes/modal.php";
     mymodal("Username or password failed");
    }
  }
   ?>
</div>

<form action="../room-details.php" method="GET" id="check-details-form">
  <input type="hidden" name="room_name" id="room_name">
</form>

<script>
  recommend();
  function recommend(){
				var url="../recommendation/ajax_recommend.php";
				var p;
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                xhr.open('GET', url);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState>3 && xhr.status==200) {
					          	p=JSON.parse(xhr.responseText);
                     if(p=="no_login"){
                      }
                      else{
                        if(Array.isArray(p)){
                          var str="";
                          str+="<div class='block' id='rooms'>";
                          str+='<h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Recommended Rooms</h1>'; 
                          str+='<div class="blocks full-blocks">';
                          for(var j=0;j<p.length;j++){
                            // str+='<div>';
                            str+=' <div class="card" style="width: 18rem;">';
                            str+="<img src='../rooms/"+p[j]["room_pic"]+"' class='card-img-top' alt='doubledeluxe'>";
                            str+='<div class="card-body">';
                            str+='<h5 class="card-title">'+p[j]["roomname"]+'</h5>';
                            str+='<span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-'+p[j]["price"]+'/Night</span>';
                            str+="<div style='padding-left:14px;padding-bottom:10px;'>";
                            for(var pa=0;pa<p[j]["ratings"];pa++){
                              str+='<span class="fa fa-star " style="color:orange;"></span>';
                            }
                            console.log(pa)
                            while(pa<5){
                              str+='<span class="fa fa-star " style="color:rgb(195,195,195);"></span>';
                              pa++;
                            }
                            str+="<div><button class='btn btn-success mb-2' data-bs-toggle='modal' onclick=\"booking('"+p[j]["roomname"]+"','"+p[j]["price"]+"')\">Book Now</button>";
                            str+='<button onclick="checking(\''+p[j]["roomname"]+'\')" class="btn btn-primary mb-2">Check Details</button>';
                            str+="</div></div></div></div>";
                             }
                          str+="</div></div>";
                          console.log(p);
                          if(p.length>0) {
                            document.getElementById('recommendation').innerHTML=str;
                            console.log(str);
                          }
                        }
                      }
                     
                    }
                };
                xhr.send();
                
			}
</script>