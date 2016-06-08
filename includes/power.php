<?php
//User's power in json
$query="select function_name,functions.function_id,function_link,fc_name from user_power inner join functions on user_power.function_id=functions.function_id inner join func_category on  functions.func_category=func_category.fc_id  where user_id=".$_COOKIE['user_id'];
		$result1=mysqli_query($db,$query);
		$json='[';
		while($r=mysqli_fetch_array($result1)){
			$json=$json.'{"fn":"'.$r['function_name'].'","fi":"'.$r['function_id'].'","fl":"'.$r['function_link'].'","fc":"'.$r['fc_name'].'"},';
		}
		$json=substr($json, 0, -1);
		$json=$json.']'; 
?>