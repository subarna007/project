
<script>
    call_func();
    function call_func(){
        var month="02",year="2022",date=Date();        
        var xhr = new XMLHttpRequest();
       
        var room_type="Double Bed Room",month="02",year="2022";
        var url="../components/calendar.php?room_type="+room_type+"&month="+month+"&year="+year;
        xhr.open("GET", url);
                xhr.onload = function () {
                        if (this.status >= 200 && this.status < 300) {
                            data=JSON.parse(xhr.responseText);var j=0;
                            var table="<table border=1px><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thurs</th><th>Fri</th><th>Sat</th></tr>";
                            console.log(data)
                            var arr=[];
                            if(data.length>=2){
                                for(i=0;i<data[0]["gap"];i++){
                                    if(j%7==0) table+="<tr>";
                                    table+="<td style='background-color:whitesmoke;'></td>";
                                    if(++j%7==0) table+="</tr>";
                                }var jk=0;
                                for(i=1;i<=data[1]["end"];i++){
                                    fontcolor="green";
                                    // arr=arr+"&"+data[i];
                                    if(j==0) table+="<tr>";
                                    for(k=2;k<data.length;k++){
                                        console.log(data[k]["checkin_day"])
                                        if(i>=data[k]["checkin_day"]&&i<=data[k]["checkout_day"]){
                                            fontcolor="red";
                                            break;
                                        }
                                }
                            table+="<td style='background-color:"+fontcolor+";color:white;'>"+i+"</td>";
                            j++;
                            if(j==7) table+="</tr>";
                            j=j%7;
                        }
                                table+="</table>";
                        document.write(table);
                    }
                } else {
                    reject({
                    status: this.status,
                    statusText: xhr.statusText
                    });
                }
                };
                xhr.send();
    }
</script>