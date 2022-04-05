
<?php
include_once "../components/navbar.php";
include_once "../classes/index.php";
$conn=new DBConnect();
echo '
<link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

';

echo '
<div class="banner full-page">   
      <div class="banner-content">
          <h1 class="display-5 text-justify text-white mb-4 text-uppercase">
              Thrilling Adventures.
          </h1>
            
      </div>
  </div>
  ';
  echo '
  <div class="block" id="adventures">
  <h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Adventures</h1>';
  $i=0;
  $result=$conn->select("adventure");
  foreach($result as $row){
      if($i++%4==0||$i==0)  echo'
        <div class="blocks full-blocks">';
        echo '
        <div class="card" style="width: 18rem;">
            <img src="../img/adventures/'.$row["photo"].'" class="card-img-top" alt="bungee">
            <div class="card-body">
            <h5 class="card-title">'.$row["adventure_name"].'</h5>
            <p><i class="bi bi-geo-alt"></i> '.$row["location"].' </p>          
                <a href="../adventure-details.php?loc='.$row["location"].'&ad_name='.$row["adventure_name"].'" class="btn btn-success">Check it Out</a>
            </div>
        </div>
  ';
    if($i%4==0) {  
        echo '
        </div>';
        }
  }
echo "</div>";
?>
<?php
include_once "../components/footer.php";
?>
  