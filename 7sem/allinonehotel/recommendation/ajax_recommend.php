<?php
 include_once "../classes/index.php";//
 $conn=new DBConnect();
 function similarity_distance($matrix,$person1,$person2)
 {
	 $similar=array();
	 $sum=0;
	 foreach($matrix[$person1] as $key=> $value)
	 {
		 if(array_key_exists($key,$matrix[$person2]))
		 {
			 $similar[$key]=1;
		 }
	 }  
		 if($similar==0)
		 {
			 return 0;
		 }
	 foreach($matrix[$person1] as $key=> $value)
	 {
		 
		  if(array_key_exists($key,$matrix[$person2]))
		  {
			  $sum=$sum+pow($value-$matrix[$person2][$key],2);
		  }
	  }  
	  return 1/(1+sqrt($sum));
  }  
   
  
  
  
//  echo "<pre>";
 
 function getRecommendation($matrix,$person)
 {
	 $total=array();
	 $simsum=array();
	 $ranks=array();
	 
	 foreach($matrix as $otherperson=>$value)
	 {
		 if($otherperson!=$person)
		 {
			$sim=similarity_distance($matrix,$person,$otherperson);
			// print_r($sim);
			
			foreach($matrix[$otherperson] as $key=>$value)
			{
				if(!array_key_exists($key,$matrix[$person]))
				{
					if(!array_key_exists($key,$total))
					{
						$total[$key]=0;
					}
					$total[$key]+=$matrix[$otherperson][$key]*$sim;
					
					if(!array_key_exists($key,$simsum))
					{
						$simsum[$key]=0;
					}
					$simsum[$key]+=$sim;
					// print_r($simsum);
				}
			}
		 }
	 }
	 
	 foreach($total as $key=>$value)
	 {
		 $ranks[$key]=$value/$simsum[$key];
		 
	 }
	 array_multisort($ranks,SORT_DESC);
	//  print_r($simsum);//correlation coefficient
	//  print_r($ranks);//rank
		 return $ranks;
		 
 }
 
 if(isset($_COOKIE["customer_id"])){
	$product=$conn->own_query("select * from bookings where user_id='".$_COOKIE["customer_id"]."'");
	if(count($product)>=1){
		$product=$conn->own_query("select  * from bookings ");
		$matrix=array();
		foreach($product as $p){
			if($p["ratings"]>=0||$p["user_id"]==$_COOKIE["customer_id"])
			{
				$users=$conn->own_query("select username from user_details where id='$p[user_id]'");
				$username=$users[0];
				$ratingss=$conn->own_query("Select avg(ratings) from bookings where username='".$users[0]["username"]."' and room_name='".$p["room_name"]."' and ratings>-1");

				$matrix[$username['username']][$p['room_name']]=$ratingss[0]["avg(ratings)"];//$p['avg(ratings)'];  
			}
	   
	   }
	   $users=$conn->own_query("select username from user_details where id=".$_COOKIE['customer_id']);
	   $username=$users[0]["username"];
	   $recommendation=array();
	   $recommendation=getRecommendation($matrix,$username);
	   $arr=array();
	   foreach($recommendation as $product=>$rating)
		   {
			//    $arr2=array("roomname"=>$product,"rating"=>$rating);
			   $result3=$conn->select("rooms",["room_name"],[$product]);
			//    print_r($product);
			   foreach($result3 as $row3){
				//    print_r($row3);

				//    echo "Select avg(ratings) from bookings where ratings<>'-1' and room_name='".$row3["room_name"]."'";
				   $result4=$conn->own_query("Select avg(ratings) from bookings where ratings>'-1' and room_name='".$row3["room_name"]."' ");
				//    print_r($result4);
				   $arr2=array("roomname"=>$row3["room_name"],"room_pic"=>$row3["room_pic"],"price"=>$row3["price"],"ratings"=>round($result4[0]["avg(ratings)"]));
				   $result5=$conn->select("amenities");
				   $arr3=array();
				   foreach($result5 as $row5){
					   if($row3[$row5["amenity_name"]."_status"]=="1"){
						$arr3=array_merge($arr3,array($row5["amenity_name"]."_status"=>$row3[$row5["amenity_name"]."_status"]));
						
						array_merge($arr2,$arr3);
					   }
				   }
				//    print_r($arr3);
				   array_push($arr,$arr2);
			   }
		   }
		   
	}
}
 else{
	 $arr=array("no_login");
 }
 echo json_encode($arr);
?>
