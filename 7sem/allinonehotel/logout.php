<?php
    // include_once "dashboard-components/dashboard.php";
    
    //if(isset($_SESSION['logged'])||isset($_COOKIE['logged']))
    {session_start();
        session_destroy();
        if(setcookie("logged", " ", time() - 3600)){
            
        }
        setcookie("customer_id", " ", time() - 3600);
        $cookie_name = "logged";
        $cookie_value ="reset";
        // setcookie($cookie_name,null, time() -(1)); 
        setcookie($cookie_name, $cookie_value, time() + 7600); 
        setcookie("role","sda",time()-3600);       
        // echo "<script>alert('".$_COOKIE["logged"]."')</script>";
         echo "<script>location.href='index.php';</script>";
    }
    // else{
    //     echo "<script>location.href='index.php';</script>";
    // }
?>