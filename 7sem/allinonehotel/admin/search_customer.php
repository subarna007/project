<?php
include_once "../dashboard-components/dashboard.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Customer</title>
    <style>
        #data2,#data3,#data4{
            margin-top:10px;
        }
       
    </style>
    <script>
        function data_fetch(keywords1){
            console.log(keywords1);
            var url="ajax_search_booking.php?name="+keywords1;
            ajax_search("ajax_search_booking.php?name="+keywords1,"1");
            ajax_search("ajax_search_package.php?name="+keywords1,"2");
            ajax_search("ajax_search_adventure.php?name="+keywords1,"3");
            ajax_search("ajax_search_food.php?name="+keywords1,"4");

        }
        function ajax_search(url,sign1){
            var str,str2;
            var data,table;
            table="<div><h3>";
                if(sign1=="1"){
                    table+="Rooms table";
                    str2="Rooms";
                }
                else if(sign1=="2"){
                    str2="Packages";
                    table+="Packages";
                }
                else if(sign1=="3"){
                    str2="Adventures";
                    table+="Adventures";
                }
                else{
                    str2="Food";                    
                    table+="Food";
                }
            table+="</h3></div>";
            
            table+="<table id='table'><tr><th>S.N</th><th>Username</th><th>Name</th><th>";
            if(sign1=="1"||sign1=='2'){
                table+="Check In Date & Check Out Date";
            }
            else{
                table+="Date";
            }
            table+="</th><th>Price</th><tH>Payment Status</th></tr>";
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // document.getElementById("demo").innerHTML =
                // this.getAllResponseHeaders();
               data=JSON.parse(this.responseText);               
               str="data"+sign1;
              if(data.length>0){
                for(let i=0;i<data.length;i++){
                   table+="<tr id='tr1'>";
                    table+="<td>"+Number(i+1)+"</td>";                    
                    table+="<td>"+data[i]["username"]+"</td>";
                    table+="<td>"+data[i]["name"]+"</td>";
                    table+="<td>"+data[i]["date"]+"</td>";
                    table+="<td>"+data[i]["price"]+"</td>";
                    table+="<td>"+data[i]["payment"]+"</td>";
                   table+="</tr>";
                }
                table+="</table>";
                document.getElementById(str).innerHTML=table;
              }
              else{
                document.getElementById(str).innerHTML="No data found in "+str2+" for "+document.getElementById("search_users").value;
              }
            }
            xhttp.open("GET", url,true);
            xhttp.send();            
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <input type="text" name="search_users" id="search_users" onkeyup="data_fetch(this.value)">
        <div id="data1">

        </div>
        <div id="data2">
            
        </div>
        <div id="data3">
            
        </div>
        <div id="data4">
            
        </div>
    </div>

</body>
</html>