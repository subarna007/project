<?php
include_once "../navbar.php";
if(session_status()==PHP_SESSION_NONE){
  session_start();
}
if(isset($_COOKIE["logged"])){
  // echo "<script>alert('"." Cookie is still there as: ".print_r($_COOKIE)."')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Rooms</title>
</head>
<body>
    
    
      <div class="banner full-page">   
        <div class="banner-content">
            <h1 class="display-5 text-justify text-white mb-4 text-uppercase">
                Search for Luxury Rooms.
            </h1>
              <form class="form-inline my-2 my-lg-0 search">
                <input class="form-control mr-sm-2 me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
              </form>
        </div>
    </div>
    <div>
      
    </div>
    <div class="block" id="rooms" >
      <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Rooms</h1>
      <div class="blocks full-blocks">
      <div class="card" style="width: 18rem;">
          <img src="../img/rooms/single.jpg" class="card-img-top" alt="single">
          <div class="card-body">
            <h5 class="card-title">Single Bed Room</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1000/Night</span>
            <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-person"></i></p>
            <a href="#" class="btn btn-success">Book Now</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/rooms/double.jpg" class="card-img-top" alt="double">
          <div class="card-body">
            <h5 class="card-title">Double Bed Room</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1200/Night</span>
            <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
            <a href="#" class="btn btn-success">Book Now</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/rooms/king.jpg" class="card-img-top" alt="economy">
          <div class="card-body">
            <h5 class="card-title">Economy Room</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1500/Night</span>
            <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
            <a href="#" class="btn btn-success">Book Now</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="../img/rooms/queen.jpg" class="card-img-top" alt="deluxe">
          <div class="card-body">
            <h5 class="card-title">Deluxe Room</h5>
            <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1300/Night</span>
            <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
            <a href="#" class="btn btn-success">Book Now</a>
          </div>
        </div>
      </div>
      <div class="blocks full-blocks">
        <div class="card" style="width: 18rem;">
            <img src="../img/rooms/singledeluxe.jpg" class="card-img-top" alt="singledeluxe">
            <div class="card-body">
              <h5 class="card-title">Single Deluxe Room</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1250/Night</span>
              <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-person"></i></p>
              <a href="#" class="btn btn-success">Book Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="../img/rooms/doubledeluxe.jpg" class="card-img-top" alt="doubledeluxe">
            <div class="card-body">
              <h5 class="card-title">Double Deluxe Room</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1500/Night</span>
              <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
              <a href="#" class="btn btn-success">Book Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="../img/rooms/balcony.jpg" class="card-img-top" alt="balcony">
            <div class="card-body">
              <h5 class="card-title">Balcony Room</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1250/Night</span>
              <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
              <a href="#" class="btn btn-success">Book Now</a>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="../img/rooms/family.jpg" class="card-img-top" alt="family">
            <div class="card-body">
              <h5 class="card-title">Family Room</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-1450/Night</span>
              <p><i class="bi bi-wifi"></i><i class="bi bi-cup-straw"></i><i class="bi bi-people"></i></p>
              <a href="#" class="btn btn-success">Book Now</a>
            </div>
          </div>
        </div>
  </div>


    <div class="footer bg-light text-black">
      <div class="container">
          <div class="row">
            <div class="col">
              <h5>ABOUT OUR HOTEL</h5>
              <p>we offer great adventure and good foods along with comfortable rooms and services.we are happy to help anytime with our services</p>
            </div>
            <div class="col navbar-light">
              <h5>LINKS</h5>
              <ul class="navbar-nav">
              <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
              </ul>
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


  <!-- modal for rooms addition -->


<div class="modal fade" id="add_rooms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_roomsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_roomsLabel">Add Rooms</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        body
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
 </body>

</html>