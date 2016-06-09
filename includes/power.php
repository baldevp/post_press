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

function power($db){
	$link=$_SERVER['REQUEST_URI'];
	$link=basename($link).PHP_EOL;
	$link=trim($link);
	$query="select * from user_power inner join functions on user_power.function_id=functions.function_id where function_link='$link' and user_id=".$_COOKIE['user_id'];
	$result=mysqli_query($db,$query)or die('Error querying db');
	// echo $query;
	// echo mysqli_num_rows($result);
	if(mysqli_num_rows($result)==0)
		header('Location: .');
}

function functions($db){
	$query="select * from func_category inner join functions on func_category.fc_id=functions.func_category order by func_category";
	$result=mysqli_query($db,$query);
	return $result;
}

?>