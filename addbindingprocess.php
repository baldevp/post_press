<?php
$title="Add Binding Process";
include_once('includes/head.php');
include_once('includes/power.php');
include_once('includes/nav.php');
power($db);
?>
<h1>Add Binding Process</h1>
<hr>
<form method="POST">
	<div class="form-group">
		<input class="form-control" type="text" name="process_name" placeholder="Process Name" required></input>
	</div>
	<div class="form-group">
		<select class="form-control">
			<option value="" disabled selected>Process Type</option>
			<option value="section">Section Process</option>
			<option value="book">Book Process</option>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control">
		<option value="" disabled selected>Process Time</option>
			<option value="final">Final</option>
			<option value="intermediate">Intermediate</option>
		</select>
	</div>
	<div class="form-group">
		<select class="form-control">
		<option value="" disabled selected>Count Mode</option>
			<option value="per book">Per Book</option>
			<option value="per 100">Per 100</option>
			<option value="per 1000">Per 1000</option>
		</select>
	</div>
	<div class="form-group">
	<div class="checkbox">
		<label><input type="checkbox" name="">Rate depends on section</label>
	</div>
	</div>
</form>
<?php 
include_once('includes/script.php');
include_once('includes/foot.php'); 
?>