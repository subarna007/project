<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  margin-bottom:14px;
}
.red{
    background-color:red;
}
.green{
    background-color: green;
    color:white;
}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
a{
    color:ivory;
    
}

.closebtn:hover {
  color: black;
}
.card{
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;    
    border: none !important;
}

.card img{
    height: 25vh;
    object-fit: cover;
}

.card-body{
    display: flex;
    flex-direction: column;
}
.card-body h5{
    text-transform: uppercase;
    font-weight: bold;
    font-family: raleway;
}
</style>

    <?php
    include_once "../dashboard-components/dashboard.php";
    include_once "../config.php";
    $sql="Select * from bookings where username='".$_COOKIE['logged']."' and seen='0';";
    echo '<div class="wrapper">';
    $result=mysqli_query($conn,$sql);
     if($result){           
        if(mysqli_num_rows($result)>0){
            echo '<div class="notifications"><h2>Notifications<i
            class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i><span id="number_notify">'.mysqli_num_rows($result).'</span></h2></div>';
       
            while($row=mysqli_fetch_assoc($result)){
                if($row['room_number']=="0") echo ' <div class="alert red" >
                <span id="'.$row["id"].'" class="closebtn" onclick="seen(this)">&times;</span>
                 '.'Your booking is under consideration by admin.Please wait sometime.</div>';
               else
               {
                   echo '<div class="alert green" >
                   <span id="'.$row["id"].'" class="closebtn" onclick="seen(this)">&times;</span>
                    Your booking has been confirmed by admin.You have been assigned <strong>room number:'.$row["room_number"].'</strong> 
                  </div>';
               }
            }
        }
        else{
            echo '
            <div>
                <h2>Notifications
                <i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
                 0</h2>
                
            </div>
            ';
        }
       
    }
    ?>

</div>
<script>
    function seen(x){
        var y=Number(document.getElementById("number_notify").innerHTML);
            var url="../user/ajax_seen.php?&id="+x.id;
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                xhr.open('GET', url);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState>3 && xhr.status==200) {
                     if(xhr.responseText=="111"){
                      alert("Operation failed");
                     }
                     if(xhr.responseText=="1"){                       
                         x.parentElement.style.display='none';                   
                          if(y>0) document.getElementById("number_notify").innerHTML=y-1;
                     }
                     if(xhr.responseText=="0"){
                         alert("Some problem in DB operation.Contact admin");
                     }
                    }
                };
                xhr.send();
    }
</script>