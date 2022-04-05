<?php
	if(session_status() == PHP_SESSION_NONE){
		//session has not started
		session_start();
		// echo "<script>alert('".$_COOKIE["logged"]."')</script>";
		if(!isset($_SESSION['logged'])||$_COOKIE['logged']=='reset')
		{
			// header("Location:../index.php");
		}
	}
	if(session_status() == PHP_SESSION_ACTIVE){
		if($_COOKIE['logged']=='reset') header("Location: ../login.php");
	}
?>
<!doctype html>

<html lang="en" class="h-100">

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/leaf.svg">
<title>Dashboard</title>
<link rel="stylesheet" type="text/css" href="../dashboard-components/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="overlay-scrollbar">

	<div class="navbar">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link"> <i
					class="fas fa-bars" onclick="collapseSidebar()"></i>
			</a></li>
			<a href="dashboard.php"><li class="nav-item"><img src="../img/logo.png" alt="logo"
				class="logo logo-light"> <img src="../img/logo.png"
				alt="logo" class="logo logo-dark" ></li></a>
				<li class="nav-item">
					<button style='margin-top:20%;background:royalblue;color:white;font-size:22px;border-radius:20%;' onclick="location.href='../index.php'">Home</button>
				</li>
		</ul>

	
	</div>



	<div class="sidebar">
		<ul class="sidebar-nav">
			
			<?php
			if($_COOKIE['logged']=="admin@email.com")
			echo '<li class="sidebar-nav-item"><a href="../admin/index.php"
			class="sidebar-nav-link">
				<div>
					<i class="fas fa-tachometer-alt"></i>
				</div> <span> Dashboard </span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../rooms/new_room_status.php"
			class="sidebar-nav-link active">
				<div>
					<i class="fab fa-accusoft"></i>
				</div> <span>Room Status</span>
		</a></li>

		<li class="sidebar-nav-item"><a href="../admin/booking.php"
			class="sidebar-nav-link active">
				<div>
				<i class="fas fa-calendar-alt"></i>
				</div> <span>Booking</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/admin_assign_rooms.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-door-open"></i>
				</div> <span> Assign Rooms</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../rooms/add_rooms.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-plus-circle"></i>
				</div> <span>Add Rooms</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../rooms/add_amenties.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-laptop-house"></i>
				</div> <span>Add Amenity</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/add_category.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-utensils"></i>
				</div> <span>Add Food Category</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/add_foods.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-pizza-slice"></i>
				</div> <span>Add Foods</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/add_vendor.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-shop"></i>
				</div> <span>Add Vendor</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/add_adventure.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-parachute-box"></i>
				</div> <span>Add Adventure</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/search_customer.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-male"></i>
				</div> <span>Search Customer</span>
		</a></li>
		<li class="sidebar-nav-item"><a href="../admin/see_foods.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-drink"></i>
				</div> <span> View Food Order </span>
		</a></li>';
		else if($_COOKIE["role"]=="vendor"){
			echo '<li class="sidebar-nav-item"><a href="../vendor/index.php"
			class="sidebar-nav-link">
				<div>
					<i class="fas fa-tachometer-alt"></i>
				</div> <span> Dashboard </span>
			</a></li>
			<li class="sidebar-nav-item"><a href="../vendor/see_bookings.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-clipboard"></i>
				</div> <span> View Records </span>
			</a></li>
			<li class="sidebar-nav-item"><a href="../vendor/search_history.php"
			class="sidebar-nav-link">
				<div>
				<i class="fa-solid fa-book"></i>
				</div> <span> Booking History </span>
			</a></li>';
		}
		else if($_COOKIE["role"]=="cook"){
			echo '<li class="sidebar-nav-item"><a href="../kitchen"
			class="sidebar-nav-link">
				<div>
					<i class="fas fa-tachometer-alt"></i>
				</div> <span> Dashboard </span>
			</a></li>';

		}
		else{
			echo '<li class="sidebar-nav-item"><a href="../user/index.php"
			class="sidebar-nav-link">
				<div>
					<i class="fas fa-tachometer-alt"></i>
				</div> <span> Dashboard </span>
		</a></li>';
		echo '<li class="sidebar-nav-item"><a href="../user/see_bills.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-clipboard"></i>
				</div> <span> View Records </span>
		</a></li>';
		echo '<li class="sidebar-nav-item"><a href="../user/see_bookings.php"
			class="sidebar-nav-link">
				<div>
				<i class="fas fa-clipboard"></i>
				</div> <span> View Bookings </span>
		</a></li>';
		}
			?>			
		</ul>
</div>
	<!-- <div class="wrapper">

		
	</div> -->

</body>
<script src="../dashboard-components/dashboard.js"></script>
</html>