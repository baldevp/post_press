<?php
	if(isset($_POST['submit'])){
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$query="select * from user where email='$email' and password=SHA('$pass')";
		$result=mysqli_query($db,$query) or die('error querying data');
		$result=mysqli_fetch_assoc($result);
		$query="update user set last_login = CURRENT_TIMESTAMP where user_id = ".$result['user_id'];
		mysqli_query($db,$query);
		setcookie('user_id',$result['user_id']);
		setcookie('fname',$result['fname']);
		setcookie('lname',$result['lname']);
		setcookie('email',$result['email']);
		header('Location: .');
	} 
?>