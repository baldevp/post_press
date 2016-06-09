<?php
function power(){
	$link=$_SERVER['REQUEST_URI'];
	$link=basename($link).PHP_EOL;
	echo '<alert>'.$link.'</alert>';
	$query="select * from user_power inner join functions on user_power.function_id=functions.function_id where function_link=$link and user_id=".$_COOKIE['user_id'];
	$result=mysqli_query($db,$pow);
	if(mysqli_num_rows($result)>0)
		return true;
	else
		return false;
}
?>