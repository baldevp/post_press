<?php
$title="Verify Users";
include_once('includes/head.php');
include_once('includes/power.php');
power($db);
?>
<div id="login_outer">
<div class="container">
<?php
$query="select * from user where verified=0";
if(isset($_POST['submit'])){
	$id=$_POST['user_id'];
	$query2="update user set verified=1 where user_id=$id";
	mysqli_query($db,$query2);
	$query1="select * from user where user_id=$id";
	$result=mysqli_query($db,$query1);
	$result=mysqli_fetch_assoc($result);
	?>
	<div class="row">
	<div class="col-md-6">
	<?php echo $result['fname'].' '.$result['lname'] ?>
	</div>	
	<div class="col-md-6">
		<?php echo $result['email'] ?>
	</div>
	</div>
	<form method="POST">

	<?php
	$data=functions($db);
	$num=0;

	while($x=mysqli_fetch_array($data)){
		if($num%3==0)
			echo '<div class="row">';
	?>
	<div class="col-md-4">
		<label class="checkbox-inline">
			<input type="checkbox" value="<?php echo $x['function_id'] ?>" name="func[]" >
		</label>
	</div>
	<?php
	if($num%3==2)
		echo '</div>';
	$num++;
    }
    if($num%3!=0)
    	echo '</div>';
     ?>
    <button type="submit" class="btn btn-success" name="submit2">Update</button>
    <button type="submit" class="btn btn-primary" name="submit3">Cancel</button>
    </form>
    <?php
}
$result=mysqli_query($db,$query);

?>
</div>
</div>
<?php
include_once('includes/script.php');
include_once('includes/foot.php'); 
?>

