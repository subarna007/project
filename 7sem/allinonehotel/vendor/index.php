<?php
include_once "../dashboard-components/dashboard.php";
include_once "../classes/index.php";
$conn=new DBConnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .cards-container{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            /* background-color: grey; */
        }
        .cards22{
            width:280px;
            height:100px;
            background-color: white;
            /* border: 1px solid black; */
            color:royalblue;
            border-radius: 10px;
            box-shadow: 10px  5px 10px rgba(98, 98, 139, 0.8);
        }
        .cards22 .title{
            font-weight: 700;
            font-size:25px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
       <div class="cards-container">
            <div class="cards22">
                <div class="title">Today's Booking</div>
                <div class="numbers">
                    <?php
                        $result1=$conn->own_query("Select count(*) from adventure_booked where date_booked='".date("Y-m-d")."'");
                        echo $result1[0]["count(*)"];
                    ?>
                </div>
            </div>
            <div class="cards22">
                <div class="title">Total Bookings</div>
                <div class="numbers">
                    <?php
                        $result1=$conn->own_query("Select count(*) from adventure_booked where date_booked>='".date("Y-m-d")."'");
                        echo $result1[0]["count(*)"];
                    ?>
                </div>
            </div>
            <div class="cards22">
                <div class="title">Total turnover</div>
                <div class="numbers">
                    <?php
                        $result1=$conn->own_query("Select sum(price) from adventure_booked ");
                        echo $result1[0]["sum(price)"];
                    ?>
                </div>
            </div>
       </div>
    </div>
</body>
</html>