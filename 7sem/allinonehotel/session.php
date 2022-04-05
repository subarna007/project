<?php
if(session_status() == PHP_SESSION_NONE) session_start();
function login($username,$role,$id=0){
	// session_start();
	$_SESSION["logged"]=$username;
	$_SESSION["role"]=$role;
	setcookie("role",$role,time()+7200);
	if($id!=0){
		$_SESSION["customer_id"]=$id;
		setcookie("customer_id",$id,time()+7200);
	}
	setcookie("logged",$username,time()+7200);
}
{
		if(!isset($_SESSION['logged']))
		{
			header("Location:../index.php");
		}
	}
//   echo "<script>alert('".$_SESSION["role"]."')</script>";
    
?>