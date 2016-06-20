<?php
$title="Add Production Details";
include_once('includes/head.php');
include_once('includes/power.php');
include_once('includes/nav.php');
power($db);
if(isset($_POST['submit'])){
	$code=$_POST['book-code'];
	$sections=$_POST['sections'];
	$firmas=$_POST['firmas'];
	$csections=$_POST['csections'];
	$edition=$_POST['edition'];
	$curr_edition=$_POST['curr_edition'];
	$query="select * from book_production where book_code=$code and edition=$edition";
	$result=mysqli_query($db,$query);
	if(mysqli_num_rows($result)==0){
		$query="insert into book_production(book_code,edition,section, firma,csection) values($code,$edition,$sections,$firmas,$csections)";
		mysqli_query($db,$query) or die("error inserting");
		if($edition>$curr_edition){
			$query="update books set latest_edition=".$edition." where book_code=$code";
			mysqli_query($db,$query) or die("error updating user");
		}
		$success="Added the book production details";
	}
	else{
		$result=mysqli_fetch_assoc($result);
		$query="update book_production set section=$sections, firma=$firmas, csection=$csections where bp_id=".$result['bp_id'];
		mysqli_query($db,$query);
		$success="Updated the book production details";
	}
}
?>
<h1>Add/Edit Production Details</h1>
<hr>
<?php if(isset($success)) echo '<div class="success">'.$success.'</div>'; ?>
<form method="post" onsubmit="return validate()">
	<div class="form-group">
		<input class="form-control" name="book-code" placeholder="Book Code" required type="number" id="book-code" onchange="check()"></input>
	</div>
	<div id="append"></div>
	<div class="form-group">
		<input class="form-control" name="sections" placeholder="Number of sections" required type="number" id="sections"></input>
	</div>
	<div class="form-group">
		<input class="form-control" name="firmas" placeholder="Number of firmas" required type="number" id="firmas"></input>
	</div>
	<div class="form-group">
		<input class="form-control" name="csections" placeholder="Number of colored sections" required type="number" id="csections"></input>
	</div>
	<button class="btn btn-primary" name="submit" type="submit" disabled id="submit">Add Production Detail</button>
</form>
<?php 
include_once('includes/script.php');
?>
<script type="text/javascript">
function validate(){
	var code=$('#book-code').val();
	var edition=$('#edition').val();
	var section=$('#sections').val();
	var firma=$('#firmas').val();
	var csection=$('#csections').val();
	if(code==null){
		alert('Book code can\'t be null');
		return false;
	}
	if(code==null){
		alert('Book code can\'t be null');
		return false;
	}
	if(section==null){
		alert('Number of sections can\'t be null, enter 0 or greater value');
		return false;
	}
	if(firma==null&&firma>0){
		alert('Number of firmas can\'t be null, enter 1 or greater value');
		return false;
	}
	if(csection==null){
		alert('Number of colored sections can\'t be null, enter 0 or greater value');
		return false;
	}
}

function check(){
	$('#append').empty();
	$('#submit').attr("disabled","disabled");
	var code=$('#book-code').val();
	$.ajax({
	  method: "POST",
	  url: "includes/findbook.php",
	  data: { book_code: code }
	})
	  .done(function( msg ) {
	    if(msg!="null"){
	    	msg=jQuery.parseJSON(msg);
	    	$('#submit').removeAttr("disabled");
	    	$('#append').append('<div class="form-group"><label>Book Name:</label>  '+msg.book_name+'</div>');
	    	$('#append').append('<div class="form-group capital"><label>Book Binding:</label>  '+msg.book_bind+' Bound</div>');
	    	$('#append').append('<div class="form-group capital"><label>Book Language:</label>  '+msg.book_lang+'</div>');
	    	$('#append').append('<div class="form-group"><label>Book Size:</label>  '+msg.bs_name+'</div>');
	    	$('#append').append('<div class="form-group"><label>Edition</label><input class="form-control" name="edition" id="edition" onchange="checkprevedition()" type="number" value="'+(msg.latest_edition+1)+'"><input type="hidden" id="curr_edition" name="curr_edition" value="'+msg.latest_edition+'"></div>');

	    }
	    else{
	    	alert("Book Code not found");
	    }
	  });
}

function checkprevedition(){
	$('#sections').val(null);
	$('#firmas').val(null);
	$('#csections').val(null);
	$('#submit').text("Add Production detail");
	var edition=$('#edition').val();
	var curr_edition=$('#curr_edition').val();
	var code=$('#book-code').val();
	if(edition<=curr_edition){
	$.ajax({
	  method: "POST",
	  url: "includes/findedition.php",
	  data: { book_code: code, edition: edition }
	})
	  .done(function( msg ) {
	    if(msg!="null"){
	    	msg=jQuery.parseJSON(msg);
	    	$('#sections').val(msg.section);
	    	$('#firmas').val(msg.firma);
	    	$('#csections').val(msg.csection);
	    	$('#submit').text("Update Production detail");
	    }
	    else{
	    	$('#sections').val(null);
			$('#firmas').val(null);
			$('#csections').val(null);
	
	    }
	  });
	}
}
</script>
<?php
include_once('includes/foot.php'); 
?>