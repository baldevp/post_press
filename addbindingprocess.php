<?php
$title="Add Binding Process";
include_once('includes/head.php');
include_once('includes/power.php');
power($db);
include_once('includes/nav.php');
if(isset($_POST['submit'])){
	$name=$_POST['process_name'];
	$process_type=$_POST['process_type'];
	$process_time=$_POST['process_time'];
	$count_mode=$_POST['count_mode'];
	$machine=$_POST['machine'];
	$rate_section=$_POST['rate_section'];
	if($rate_section=="")
		$rate_section=0;
	else
		$rate_section=1;
	$query="insert into binding_process(bp_name,p_type,p_time,count_mode,machine,rate_section) values('$name','$process_type','$process_time','$count_mode',$machine,$rate_section)";
	mysqli_query($db,$query) or die('error querying');
	$query="select bp_id from binding_process where bp_name='$name' and p_type='$process_type' and p_time='$process_time' order by bp_id desc limit 1";
	$result=mysqli_query($db,$query) or die('error fetching data');
	$result=mysqli_fetch_assoc($result);
	$id=$result['bp_id'];
	if(isset($_POST['so1'])){
		$so1=$_POST['so1'];
		$query="insert into bp_so(bp_id,so_id) values($id,$so1)";
		mysqli_query($db,$query);
	}
	if(isset($_POST['so2'])){
		$so2=$_POST['so2'];
		$query="insert into bp_so(bp_id,so_id) values($id,$so2)";
		mysqli_query($db,$query);
	}
	if(isset($_POST['so3'])){
		$so3=$_POST['so3'];
		$query="insert into bp_so(bp_id,so_id) values($id,$so3)";
		mysqli_query($db,$query);
	}
	if(isset($_POST['so4'])){
		$so4=$_POST['so4'];
		$query="insert into bp_so(bp_id,so_id) values($id,$so4)";
		mysqli_query($db,$query);
	}
	$success="Binding process edited";
}
?>
<h1>Add Binding Process</h1>
<hr>
<?php if(isset($success)) echo '<div class="success">'.$success.'</div>'; ?>
<form method="POST" onsubmit="return validate()">
	<div class="form-group">
		<input class="form-control" type="text" name="process_name" placeholder="Process Name" required></input>
	</div>
	<div class="form-group">
		<select class="form-control" id="type" name="process_type">
			<option value="" disabled selected>Process Type</option>
			<option value="section">Section Process</option>
			<option value="book">Book Process</option>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="time" name="process_time">
		<option value="" disabled selected>Process Time</option>
			<option value="final">Final</option>
			<option value="intermediate">Intermediate</option>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="count" name="count_mode">
		<option value="" disabled selected>Count Mode</option>
			<option value="per book">Per Book</option>
			<option value="per 100">Per 100</option>
			<option value="per 1000">Per 1000</option>
		</select>
	</div>
	<div class="form-group">
	<div class="checkbox" >
		<label><input type="checkbox" name="rate_section" id="check">Rate depends on section</label>
	</div>
	</div>
	<div class="form-group">
		<select class="form-control" id="machine" name="machine">
			<option value="" disabled selected>Machine</option>
			<?php
			$query="select machine_id,machine_name from machine order by machine_name";
			$result1=mysqli_query($db,$query);
			while($r=mysqli_fetch_array($result1)){
			?>
			<option value="<?php echo $r['machine_id']; ?>" ><?php echo $r['machine_name'] ?></option>
			<?php
			} 
			?>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="so1" name="so1">
			<option value="" disabled selected>Special Option 1</option>
			<?php
			$query="select so_id,so_name from special_options order by so_name";
			$result1=mysqli_query($db,$query);
			while($r=mysqli_fetch_array($result1)){
			?>
			<option value="<?php echo $r['so_id']; ?>" ><?php echo $r['so_name'] ?></option>
			<?php
			} 
			?>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="so2" name="so2">
			<option value="" disabled selected>Special Option 2</option>
			<?php
			$query="select so_id,so_name from special_options order by so_name";
			$result1=mysqli_query($db,$query);
			while($r=mysqli_fetch_array($result1)){
			?>
			<option value="<?php echo $r['so_id']; ?>" ><?php echo $r['so_name'] ?></option>
			<?php
			} 
			?>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="so3" name="so3">
			<option value="" disabled selected>Special Option 3</option>
			<?php
			$query="select so_id,so_name from special_options order by so_name";
			$result1=mysqli_query($db,$query);
			while($r=mysqli_fetch_array($result1)){
			?>
			<option value="<?php echo $r['so_id']; ?>" ><?php echo $r['so_name'] ?></option>
			<?php
			} 
			?>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" id="so4" name="so4">
			<option value="" disabled selected>Special Option 4</option>
			<?php
			$query="select so_id,so_name from special_options order by so_name";
			$result1=mysqli_query($db,$query);
			while($r=mysqli_fetch_array($result1)){
			?>
			<option value="<?php echo $r['so_id']; ?>" ><?php echo $r['so_name'] ?></option>
			<?php
			} 
			?>
		</select>
	</div>
	<button class="btn btn-primary" type="submit" name="submit">Add Binding Process</button>
</form>
<?php 
include_once('includes/script.php');
?>
<script type="text/javascript">
	function validate(){
		var type=$('#type').val();
		if(type==null){
			alert('Select the process type');
			return false;
		}
		var time=$('#time').val();
		if(time==null){
			alert('Select the process time');
			return false;
		}
		var count=$('#count').val();
		if(count==null){
			alert('Select the count mode');
			return false;
		}
		var machine=$('#machine').val();
		if(machine==null){
			alert('Select machine for binding process');
			return false;
		}
		var so1=$('#so1').val();
		var so2=$('#so2').val();
		var so3=$('#so3').val();
		var so4=$('#so4').val();
		if(so1==null){
			alert("Select the special option");
			return false;
		}
		if(so2!=null&&(so2==so1)){
			alert("An option can only be selected once, duplicate entry detected");
			return false;
		}
		if(so3!=null&&(so3==so1||so3==so2)){
			alert("An option can only be selected once, duplicate entry detected");
			return false;
		}
		if(so4!=null&&(so4==so1||so4==so2||so4==so3)){
			alert("An option can only be selected once, duplicate entry detected");
			return false;
		}
	}
</script>
<?php
include_once('includes/foot.php'); 
?>