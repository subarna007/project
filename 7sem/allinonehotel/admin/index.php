<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
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
    include_once "../classes/index.php";
    $conn=new DBConnect();
    $result1=$conn->own_query("Select count(*) from bookings where payment_date=0");
    $result2=$conn->own_query("Select count(*) from bookings where payment_date=0 and check_in_date='".date("Y-m-d")."';");
    $result3=$conn->own_query("Select sum(price) from bookings ");
    $result4=$conn->own_query("Select sum(p.price),sum(b.price),sum(fo.price) from bookings b inner join packages p inner join food_order fo on b.check_in_date=fo.date2 and fo.date2=p.check_in_date and fo.date2='".date("Y-m-d")."'");
    $result5=$conn->own_query("Select sum(price) from packages");
    $result6=$conn->own_query("Select sum(price) from food_order");    
    $result7=$conn->own_query("Select sum(price) from adventure_booked");
    // $sql="Select * from bookings where room_number=0 ;";
    // echo '';
    //  if($result=$conn->own_query($sql)){
           
    //     if(count($result)>0){
    //         $row=$conn->own_query($result);
    //         echo '<div><h2>Notifications<i
    //         class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i><h2>'.count($result).'</div>';
       
    //        foreach($result as $row){
    //             echo ' <div class="alert green" >
    //             <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
    //              '.'New booking from email :<strong>'.$row['username'].'</strong> has been received.<a href="../admin/admin_assign_rooms.php">Please assign room.</a>
    //            </div>';
    //         }
    //     }
    //     else{
           ?>
           <div>
                 <!-- <h2> -->
                     <!-- Notifications<i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>  0 -->
                 <!-- </h2> -->
             <!-- </div> -->
            <!-- <div class="alert " > -->
            <!-- <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> -->
             <!-- No Notifications yet -->
           <!-- </div>  -->
        <?php
    //     }
    // }
    ?>
--> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        .card2-container{
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr
        }
        .card2{
            background-color: azure;
            box-shadow: 2px 0px 16px rgb(70, 60, 60);
            width:200px;
            margin-top: 20px;
            margin-bottom: 20px;
            /* border-radius: 6px; */
            border-radius:3px;
            border-bottom-right-radius: 5px;
            border-top-left-radius: 6px;
        }
        .card2{
            display:grid;
            grid-template-columns: 30% 70%;
        }
       .card2-log img{
           height:50px;
           width:50px;
       }
        
        @media screen and (max-width:900px) {
            .card2-container{
                grid-template-columns: 1fr 1fr 1fr;
            }
        }

        @media screen and (max-width:700px) and (min-width:460px) {
            .card2-container{
                grid-template-columns: 1fr 1fr ;
            }
        }
        @media screen and (max-width:460px) {
            .card2-container{
                grid-template-columns: 1fr ;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card2-container">
            <div class="card2 ">
                <div class="card2-logo">
                    <!-- <img height=50 width=50 src="data:image/png;base64,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" alt=""> -->
                </div>
                <div class="card2-body">
                    <div class="card2-heading"><h4>Total Bookings</h4></div>
                    <div class="card2-data"><?=$result1[0]["count(*)"]?></div>
                </div>
            </div>
            <div class="card2 ">
                <div class="card2-logo">
                    <!-- <img height=50 width=50 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANwAAADlCAMAAAAP8WnWAAAAh1BMVEX///8AvwAAvAAAugDv++/8//z5/vnp+enI7sjy/PL2/faz6LO9673Z9Nl413jN8M3D7cMoxShWzlbk9+Tc9dx+2X45yDmU35SI24im5Ka46biv56+f4p8SwhIjxCNDykNUzlRi0WKY4JhMzEyF24Vx1XEzxzNm02Zu1W541XiO3Y6j5KPe9N4v98d5AAAHW0lEQVR4nN2d61biShCF04HITUdBRUcJCCpexvd/voN4vCCEfBVYqd7sXzNrObOqTHdX1a5bkhwIOq2T29HsYTrpj/MFJi+jlrdIe8F573owzNMlwicWfz7zFmxXdI4f88YPnX5i7C3cbmhPQ4FiS3iLtwOy0XibZiHce0tYGd3Zds0Wt67nLWNV9PIS1ULIj7yFrIaTSalqIb3ylrISOn/KVVug6y1nFfQC0S299ZazApoD9NnCxFvQCjhGn23x4U68JTUje24g1UJ67S2qGRd99tlC6HuLasZfqprgoWQGYKnbyFtWIzL4Sr7rJvdSAp/kC2ph6jHXTc98D7luU29ZrRgZDqWaT3luOJSn3sIa0R1z3f55C2uFwQrIXbhXrtsw8xbWCIMVyJvewhpxjlUL6YW3sEYcGR4TOYp5yi/czFtWKx64bo/eslrR47rdectqxYnhoVTzuppYNb0wxxDDpW1vWa14PlxeIZkdsEfZhhTlAn01j7KFVRN8TIb8UB57y2qFgaR89ZbViluu28BbVisuDHyQWnI4y7luaiGcIcxpyFUsXPELd+ktqxVtrptcGY0lFFDjgyyhgFyK8ZLrJkcu32B3WY8zMZCUc29Zzehz5eRCAYO7LMcrGIg8uZK8twPmFZI51S3M1UKB5JHHOXKeCY9Pg5xnwnP6jRtvWa3IsIXTI2D5hdPzuviF0wvhDBYuVyOXLRbu3FtUM57woVSrfbJcODmPksdwehWwlgsnF8Jx0kTPM+GkSfrsLaoZPMc4lgtzeI5Rj6RMrrFucilGQ1pg6C2qGR2qmqLbdYcP5V9vUc3AeTi9vHdyii9cX84KHFHVQvrmLasZOPGtV0ST/DtgC4crTdInb1HNwExeqme9OZMn1+OxiHPwodR7KHE1hl6HJq/GSP94S2oHbhnTy+knp5hY0AsFurTeMNUjhDC9rFeRx6dHpIIXjidQ9RhY3KnfkOti5PSy4CQa3MKimPLgRbB67jJmuwRjbxx8py/ektqBs/qC8Sm2AoIuJbcCck0enIIVJIR4LCCYY8QUrGCOEVcv6w2PSJIW1U0vnWPoz+l4S2oHTcTpNQvw2RiKcQ7OCyi6XTgvIEgsnB2w29WFn02ROsc0peJyAZqsUnS7aI2QYBUN9pcl3S5amq24WqBJL5xeRT0euilYaYITOor0Mi9fFnS7aBCnN5UywS+lYgIVJz0EE6jcp9QrEcL1GJJuV8bG3Eq6XZQSygXZLlqz0BBku6jflT54y1kFsItFb7/MO+BromgF4FoIwTEECY3iXFv1s26zdd7sVAiR79mNcys1Ob0czMNyb2n+bKWl2BDfhk+pSXb8tLKMtWHrPGdZDx8Ktru+39Pm/7Gsh0fmu3m5ab+nZYEDm9zlQMFmV5vX8hkeNpb1cMh8F68ubVDqjfXE1c8IdbeRw1QaSDDXzQi1t26chSQOK8iofcjta0ngjBJM0DWpu/6pdDMAamBgh7LmfRcZqGAFyXiWiqs7L0Cqc8tLRFgqru68AFt9U2rr2NKLmmnKHiThSpyKM/bf1FsFi6sNtj9ybP9d3TQln0u19ZeOfMratx5NoW7boxRGMNdOU/INaNtiZxTo1N98xPcebCmqQw+uQ7LKsNQhFP0fLPp2oCkNx7KwaxvNXPPYWXjHlSvywVDWw4WmxMOpQpFfiAZk+JQs4LkkoSidxighF5rSsJxvsyFnh9JnyIJlJccma4B+OW4ZVD5e8h1rfCP7514ZVMPI8g3HC71HfpMpDauDw5olRoGO42TKjkm51V5ZeGEdt4TSdssPrBhyNJ3StbjLYsZXyRT0L31r6vmQySW+Px28ra4DwSnR8PklPp1EmIlzLvGdGLX7oPrZbGn3ikNWffCN5UTGJgsE3afUm9zL969xnyWtPjuU7mWwR5ZofCny/AX+YAT7c/iG5C+p4c9FMPoDj76z/gpiKBW1eWAccfRpGo0BhAcltAFWY8B08zZx/4NP47LAMRhYgS0yQIjiNVnCFhkgxFMHy6dhU8TUhLp33WJagmqiiYBuUXVD2GiiUsTVDWHiZkvhHaH+xv0+dYutCZVODCW6RdeESscEEUQQ6PzC3pyUGNc64dHRJYhyrZOVSSlCzSWHEPvRLdKeuL04z7EOpNmL8xzrfAy+pLYYsbkm33jZ+dNF3KhpTPdsQMxTknb+cNEeymTnoC7iQ5nsfC7jYU02wlDCt+HDRcSabMIudjy6IO43+OrrdcSRGNiG6kkDgZb2yvF4VFReAegYsjXd7rwlJ4BzyNaUi4rKK0K10EBlqmiVJ0VmmHuV/HisQdw6Knw492ITDLM1iCU9TGDYpvyBuXcFlAVs5scXGpH7y79gig1S20QRd1gezPiSHmWw2Dq5yZucWVdc7MRGtsTOmhQA7vp2HW9VHXAbi0QssA4U+ggurVqiPIuc9rWs90+079N00yipD8XSdBBhctiAo7PRdBh+qbj86/y5J3rbVtF8680eBvNxvoja8vFwej27uZCx2/8BkcRl5R0mEb4AAAAASUVORK5CYII=" alt=""> -->
                </div>
                <div class="card2-body">
                    <div class="card2-heading"><h4>Today's Bookings</h4></div>
                    <div class="card2-data"><?=$result2[0]["count(*)"]?></div>
                </div>
            </div>
            <div class="card2 ">
                <div class="card2-logo">
                    <!-- <img height=50 width=50 src="data:image/png;base64,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" alt=""> -->
                </div>
                <div class="card2-body">
                    <div class="card2-heading"><h4>Total Revenue</h4></div>
                    <div class="card2-data">Rs-<?=(float)$result3[0]["sum(price)"]+(float)$result5[0]["sum(price)"]+(float)$result6[0]["sum(price)"]+(float)$result7[0]["sum(price)"]?></div>
                </div>
            </div>
            <div class="card2 ">
                <div class="card2-logo">
                    <!-- <img height=50 width=50 src="data:image/png;base64,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" alt=""> -->
                </div>
                <div class="card2-body">
                    <div class="card2-heading"><h4>Today's Revenue</h4></div>
                    <div class="card2-data">Rs-<?=$result4[0]["sum(b.price)"]+$result4[0]["sum(p.price)"]+$result4[0]["sum(fo.price)"]?></div>
                </div>
            </div>
           
        </div>
        <div class="chart1" id="chart1">

        </div>
        <div id="users1" class="users1">

        </div>
    </div>      
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    
   function chart2(data1,data2){
          
    var options = {
          series: [{
            name: "Daily transaction",
            data: data1
        }],
          chart: {
          height: 400,
          width:650,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'TotalPaid Revenue generated',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.9
          },
        },
        xaxis: {
          categories: data2,
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
   }  
   
</script>
<script>
    function chart1(x=0){
        var xhr = new XMLHttpRequest();
        if(x==0) var url='charts.php';
        xhr.open('GET', url);
        xhr.send();
        xhr.onreadystatechange = function () {
                var DONE = 4; // readyState 4 means the request is done.
                var OK = 200; // status 200 is a successful return.
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        var data=JSON.parse(xhr.responseText);
                        var arr1=[],arr2=[];
                     console.log(data); // 'This is the returned text.'
                        for(i=0;i<data.length;i++){
                            arr1.push(data[i][0]);
                            arr2.push(data[i][1]);
                        }
                        chart2(arr2,arr1);
                    } else {
                        console.log('Error: ' + xhr.status); // An error occurred during the request.
                    }
                }
        };
    }
    chart1();
    user("0");
   function user(x){
    var xhr = new XMLHttpRequest();
    var url;
        if(x=="0")  url='users.php';
        else url=x;
        console.log(url);
        xhr.open('GET', url);
        xhr.send();
        xhr.onreadystatechange = function () {
                var DONE = 4; // readyState 4 means the request is done.
                var OK = 200; // status 200 is a successful return.
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        var data;
                        if(x==0) data=JSON.parse(xhr.responseText);
                        else data=xhr.responseText;
                        var data1;
                        console.log(data); // 'This is the returned text.'
                        if(data.length>0){
                           if(x==0){
                                data1="<table><tr><th>S.N</th><th>Username</th><th>Role</th><th>Status</th></tr>";
                                for(let j=0;j<data.length;j++){
                                    data1+="<tr>";
                                    data1+="<td>"+Number(j+1)+"</td>";
                                    data1+="<td>"+data[j]["username"]+"</td>";
                                    data1+="<td>"+data[j]["role"]+"</td>";
                                    data1+="<td>";
                                    if(data[j]["status"]==1){
                                        data1+="<button style='background-color:red;color:white;' onclick=\"user('change_status.php?user_id="+data[j]['username']+"&status="+data[j]["status"]+"')\">Active</button>";
                                    }
                                    else{
                                        data1+="<button style='background-color:royalblue;color:white;' onclick=\"user('change_status.php?user_id="+data[j]['username']+"&status="+data[j]["status"]+"')\">Inactive</button>";
                                    }
                                    data1+="</td>";
                                    data1+="</tr>";
                                }
                           }
                           else{
                               user("0");
                           }
                        }
                        else{
                            data1="No users found Please add it first";
                        }
                        document.getElementById("users1").innerHTML=data1;
                    } else {
                        console.log('Error: ' + xhr.status); // An error occurred during the request.
                    }
                }
        };
   }
</script>