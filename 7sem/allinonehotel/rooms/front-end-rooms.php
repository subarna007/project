<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
    .margin_top{
        margin-top:70px;
    }
    .empty{
      color:grey;
    }
    .checked{
      color:orange;
    }
</style>
<script>
    function other_carts(room_name,room_pic,price){
      if(document.getElementById('item').value=="") document.getElementById('item').value="room%%"+room_name+"%%"+room_pic+"%%"+price+"%%1";
      else document.getElementById('item').value+="^^"+"room%%"+room_name+"%%"+room_pic+"%%"+price+"%%1";    
      var total=document.getElementById('carts_total').innerHTML;
      document.getElementById('carts_total').innerHTML=Number(total)+Number(price);
    }
</script>
    <?php
    // include_once "config.php";
    include_once "classes/index.php";
    $conn=new DBConnect();
    $sql="select r.id, r.room_pic, r.price, r.total_rooms, r.occupied_rooms, r.no_of_people, r.rooms_created, r.wifi_status, r.room_service_status, r.single_person_room_status, r.Double_person_room_status,r.room_name,avg(ratings) from bookings b inner join rooms r where b.room_name=r.room_name group by b.room_name order by avg(ratings) desc limit 4";
    // $sql="select `id, `room_pic`, `price`, `total_rooms`, `occupied_rooms`, `no_of_people`, `rooms_created`, `wifi_status`, `room_service_status`, `single_person_room_status`, `Double_person_room_status`,r.room_name,r.,avg(ratings) from bookings b inner join rooms r where b.room_name=r.room_name group by b.room_name order by avg(ratings) desc";
    // $sql="select `id`, `room_name`, `username`, `check_in_date`, `check_out_day`, `room_number`, `price`, `seen`, `user_id`, `status`, `payment_date`,`avg(ratings)` from bookings group by room_name limit 4";
    echo '    <div class="block" id="rooms">
    <h1 class="display-6 "><i class="bi bi-arrow-right display-6"> </i>Most Rated Rooms</h1><div class="blocks">';
    $result=$conn->own_query($sql);
    if(count($result)>0){
       foreach($result as $row){
            echo ' 
            <div class="card" style="width: 18rem;">
            <img src="rooms/'.$row["room_pic"].'" class="card-img-top" alt="single">
            <div class="card-body">
              <h5 class="card-title text-uppercase">'.$row["room_name"].'</h5>
              <span class="badge bg-success rounded-pill text-light p-2 mb-1 w-50">NRs-'.$row["price"].'/Night</span>';
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
              // 
              
              echo '<a href="room-details.php?room_name='.$row["room_name"].'" class="btn btn-success">Check Details</a>
              <button onclick="other_carts(\''.$row["room_name"].'\',\''.$row["room_pic"].'\',\''.$row["price"].'\')" style="margin-top:10px;" class="btn btn-secondary mb-2">Add to cart</button>
            </div>
          </div>';
        }
    }
    echo '</div> <center><a href="rooms/card_rooms.php" class="btn btn-outline-dark m-4">Check out all the available rooms</a></center>
    ';
    ?>
</div>