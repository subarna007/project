<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Get recommendation</title>
</head>
<body>
	<div>
		<script>
			window.onload=function(){
				var url="../recommendation/ajax_recommend.php";
				var p;
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                xhr.open('GET', url);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState>3 && xhr.status==200) {
						p=JSON.parse(xhr.responseText);
                     if(p=="error"){
						alert("Error in recommendation")
					 }
					 else{
						if(Array.isArray(p)){
							var str="";
							str+="<div class='block' id='rooms'>";
							str+='<h1 class="display-6"><i class="bi bi-arrow-right display-6"> </i>Rooms</h1>';
								
							for(var j=0;j<p.length;p++){
								str+='<div class="blocks full-blocks">';
								str+=' <div class="card" style="width: 18rem;">';
								str+="<img src='' class='card-img-top' alt='doubledeluxe'>";
								str+="</div>";
							}
						}
					 }
                     
                    }
                };
                xhr.send();
                
			}
		</script>
	</div>
</body>
</html>