<?php
 include_once "../classes/index.php";
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
				}
			}
		 }
	 }
	 
	 foreach($total as $key=>$value)
	 {
		 $ranks[$key]=$value/$simsum[$key];
		 
	 }
	 array_multisort($ranks,SORT_DESC);
		 return $ranks;
 }
 
 if(isset($_COOKIE["customer_id"])){
	$product=$conn->own_query("select * from food_order where user_id='".$_COOKIE["customer_id"]."'");
	if(count($product)>=1){
		$product=$conn->own_query("select * from food_order ");
		$matrix=array();
		foreach($product as $p){
			if($p["qty"]>=0||$p["user_id"]==$_COOKIE["customer_id"])
			{
				$users=$conn->own_query("select username from user_details where id='$p[user_id]'");
				$username=$users[0];
				$matrix[$username['username']][$p['food_name']]=$p['qty'];  
			}
            
	   }
	//    print_r($matrix);
	   $users=$conn->own_query("select username from user_details where id=".$_COOKIE['customer_id']);
	   $username=$users[0]["username"];
	   $recommendation=array();
	   $recommendation=getRecommendation($matrix,$username);
    //    print_r($recommendation);
	   $recommend_arr=array();
	   foreach($recommendation as $product=>$rating)
		   {
			   $result3=$conn->select("food_order",["food_name"],[$product]);
			   
			   foreach($result3 as $row3){
				//    print_r($row3);
				//    echo "Select sum(fo.qty),f.food_name,f.cost,f.food_photo from food_order fo inner join food f on f.food_name='".$row3["food_name"]."' group by food_name";
				   $result4=$conn->own_query("Select sum(fo.qty),f.food_name,f.cost,f.food_photo from food_order fo inner join food f where f.food_name='".$row3["food_name"]."'  group by food_name");
				//    print_r($result4);  
				   $arr2=array("foodname"=>$row3["food_name"],"food_photo"=>$result4[0]["food_photo"],"price"=>$result4[0]["cost"],"quantity"=>$result4[0]["sum(fo.qty)"]);
			   }
               array_push($recommend_arr,$arr2);
		   }
		   
	}
}
 else{
	 $recommend_arr=array("no_login");
 }
//  echo json_encode($recommend_arr);
?>
