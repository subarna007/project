

<?php
include_once "classes/index.php";
$conn1=new DBConnect();
if(isset($_POST["book_room"])){
$check_in=$_POST["check_in"];
$check_out=$_POST["check_out"];
$price1=$_POST["price1"];
$room_name=$_POST["room_name"];
  include_once "classes/index.php";
  $result33=$conn1->insertion("bookings",
  [
    'room_name','username','check_in_date','check_out_day','price','user_id'
  ],[
    $room_name,$_COOKIE["logged"],$check_in,$check_out,$price1,$_COOKIE["customer_id"]
  ]);
  if($result33=="1"){
    $printing="$room_name has been booked for $check_in.We'll confirm the booking and reach out to you shortly.";
    echo '
       <div  class="alert alert-success" style="z-index:9999999;top:20vh;width:90vw;" role="alert">
       <div onclick=\'this.parentNode.style.display="none";\' style="float:right;margin-top:-10px;font-size:20px;color:red;cursor:pointer;font-weight:600;">&times;</div>

       <h3> '.$printing.'</h3>
      
     </div>
   ';
  }
  else{
   $printing="Room booking failed";
   echo '
      <div  class="alert alert-primary" style="z-index:9999999;top:20vh;width:90vw;" role="alert">
      <div onclick=\'this.parentNode.style.display="none";\' style="float:right;margin-top:-10px;font-size:20px;color:green;cursor:pointer;font-weight:600;">&times;</div>
       <h3> '.$printing.'</h3>   
       </div>
  ';
  }
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
<title>Room Details</title>
</head>
<script>
          function booking(room_name,price){
              console.log(room_name,price);
              document.getElementById("room_name").value=room_name;
              document.getElementById("price1").value=price;
          }
      </script>
      <style>
        .details{
    padding-top : 15vh;
    height: 100%;
    margin-bottom:10vh;
    margin-left: 10vh;
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
}

.details-left,.details-right{
    display: flex;
    flex-direction: column;
    justify-self: center;
    align-items: flex-start;
    width: 100%;
}

.details-left img{
    height: 60vh;
    aspect-ratio:1/1;
    object-fit: cover;
    margin: 0 auto;
}

.details-right{
  padding-left:10%;
}

table{
  height:45vh;
  width:25vw;
  font-family:raleway;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  background-color:whitesmoke;

}

table th{
  width:2%;
  background-color:#16161a;
  color:white;
}


table tr{
  text-align:center;
}

table td{
}


        </style>
<body>
    


    <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
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
                  <li><a class="dropdown-item" href="components/packages.php">Silver</a></li>
                  <li><a class="dropdown-item" href="#components/packages.php">Gold</a></li>
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
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <?php
              include_once "config.php";
              if(isset($_COOKIE['logged'])){
                if($_COOKIE['logged']!='reset' ){
                  echo '<li class="nav-item dropdown" >
                  <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  </a>
                  <ul class="dropdown-menu p-1"  style = "margin-left:-80px; " aria-labelledby="navbarDropdownMenuLink" >
                   ';
                  if($_COOKIE["logged"]=='admin@email.com'){
                    $sql3="Select * from bookings where room_number=0";
                    
                  }
                  else{
                    $sql3="Select * from bookings where username='".$_COOKIE['logged']."'"."  and room_number<>0;";
                  }
                  if($result=mysqli_query($conn,$sql3)){
                    if(mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                        if($_COOKIE["logged"]=='admin@email.com') echo "<a href='admin'><button class = 'btn btn-primary mb-2 p-1'> Room number assigned : <span class='badge badge-dark'>".$row["room_number"]."</span></button></a>";
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
     <div class = "details container">

     <?php
      include_once "classes/index.php";
      $conn=new DBConnect();
      $room_name=$_GET["room_name"];//"Balcony Room";
      $result22=$conn->own_query("Select * from rooms where room_name='$room_name'");
      if(count($result22)>0){
        foreach($result22 as $row){
          echo '
          <div class ="details-left">
          <img src="rooms/'.$row["room_pic"].'" class="shadow-lg">
          </div>
          <div class = "details-right">
              <h1 class="mb-4 text-uppercase display-6">'.$row["room_name"].' </h1>
              <button type="button" class="btn btn-dark mb-4 w-50 shadow-lg">
              <h5 class="mt-1">NRs. '.$row["price"].'/night</h5></button>
              <h4 class ="text-uppercase mb-3 ">Details</h4>
              <p class = "text-justify ">
              ';
             $result33=$conn->own_query("Select * from amenities");
              foreach($result33 as $row33){
                if($row[$row33["amenity_name"]."_status"]=="1"){
                  echo ' <p><img src="rooms/'.$row33["photo"].'" height=40 width=40> - 
                  '.ucfirst(str_replace("_"," ",$row33["amenity_name"])).'
                 </p>';
                }
              }
              echo ' </p>
                  <a href="#" class="w-100 mb-3"data-bs-toggle=\'modal\'
                      data-bs-target=\'#staticBackdrop\' 
                      onclick="booking(\''.$row["room_name"].'\',\''.$row["price"].'\')">
                      <button class = "btn btn-success w-50">Book Now</button></a>
                  <a href="comparerooms.php" class="w-100"><button class = "btn btn-primary w-50">Compare Rooms</button></a>
                  </div>
                  <div id="calendar">
                  <h3>Available Dates</h3>
                    <div id="calendars"></div>

                  </div>
          </div>
              ';
        }
      }
     ?>
    <?php
      include_once "components/footer.php";
    ?>
    
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Book Your Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php
                if(count($_COOKIE)<="2"){
                  
                    // if($_COOKIE["logged"]=="reset"||count($_COOKIE)=="1"){
                        echo ' <form action="" method="POST"><div class="alert alert-danger" role="alert">
                        Please login first!!
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
                    else{
                    
                    ?>
            <form action="" method="post">
                      <div class = "mb-4">
                        <h5>Check In Date:</h5>
                        <input type="date" name="check_in" id="check_in" class = "form-control">
                      </div>
                      <div >
                        <h5>Check Out Date:</h5>
                        <input type="date" name="check_out" id="check_out" class = "form-control">
                    </div>
                        <input type='hidden' name='price1' id='price1'>
                        <input type="hidden" name="room_name" id="room_name">
                      </div>
                      <div class="modal-footer">
                          <?php
                                    // }//else bracket
                          ?>
                      <?php
                        if($_COOKIE["logged"]!="reset") echo '<button type="submit" class="btn btn-success w-100" name="book_room">Book Now</button>';
                        ?>
             </form>
             <?php
                }//isset closing
             ?>
      </div>
    </div>
  </div>
</div>
   <input type="hidden" id="rooom_name33" value="<?=$_GET["room_name"]?>">
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/app.js">
</script>


<script>
    window.onload=call_func();
    function call_func(month="",year=""){
      var date=new Date();
      var room_type=document.getElementById("rooom_name33").value;
        var xhr = new XMLHttpRequest();
       if(month==""){
        month=date.getMonth();
        month++;
       }
       else{

       }
       if(year==""){
        year=date.getFullYear();
       }
       else{

       }
       
        var url="components/calendar.php?room_type="+room_type+"&month="+month+"&year="+year;console.log(url);
        xhr.open("GET", url);
                xhr.onload = function () {
                        if (this.status >= 200 && this.status < 300) {
                            data=JSON.parse(xhr.responseText);var j=0;
                            var table="<table><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thur</th><th>Fri</th><th>Sat</th></tr>";
                            console.log(data)
                            var arr=[];
                            if(data.length>=2){
                                for(i=0;i<data[0]["gap"];i++){
                                    if(j%7==0) table+="<tr>";
                                    table+="<td></td>";
                                    if(++j%7==0) table+="</tr>";
                                }
                                var jk=0;
                                for(i=1;i<=data[1]["end"];i++){
                                    fontcolor="#2cb67d";
                                    if(j==0) table+="<tr>";
                                    for(k=2;k<data.length;k++){
                                        if(i>=data[k]["checkin_day"]&&i<=data[k]["checkout_day"]){
                                            fontcolor="#fa5246";
                                            break;
                                        }
                                }
                            table+="<td style='color:"+fontcolor+";font-weight:bolder;background-color:#fff;'>"+i+"</td>";
                            j++;
                            if(j==7) table+="</tr>";
                            j=j%7;
                        }
                                table+="</table>";console.log(table);
                        document.getElementById("calendars").innerHTML=table;
                    }
                } else {
                    reject({
                    status: this.status,
                    statusText: xhr.statusText
                    });
                }
                };
                xhr.send();
    }
</script>
</html>
