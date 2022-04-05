<html>
<head>

<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script scr - "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class = "container">

<h2><div class = "well text-container" style="background-color:CadetBlue;border:none;font-size:25px;font-weight:bold;text-align:center">Recommendation For You:</div></h2>

</div>
</head>
</html>
<?php

include("recommend.php");

?>

<div class="panel panel-default">
	
	<div class = "panel-heading">
		<h2>
			<a class = "btn btn-success" href = "adduser.php">Add Users</a>
			<a class = "btn btn-info pull-right" href = "index.php">Back</a>

		</h2>
	</div>
	
	<div class="panel-body">
		<table class="table table-stripped">
			<th> Product Name</th>
			<th> Product Rating</th>

			
			<?php 
			$recommendation=array();
			$recommendation=getRecommendation($matrix,$username);
			
			foreach($recommendation as $product=>$rating)
			{
			?>
			<tr>
				<td><?php echo $product; ?> </td>
				<td><?php echo $rating; ?> </td>
				
				
			</tr>
			<?php } ?>
		</table>
	
	</div>
	
	
</div>
