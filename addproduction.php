<?php
$title="Add Production Details";
include_once('includes/head.php');
include_once('includes/power.php');
include_once('includes/nav.php');
power($db);
?>
<h1>Add/Edit Production Details</h1>
<hr>
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
	    	$('#append').append('<div class="form-group"><label>Book Size:</label>  '+msg.bs_name+'</div>');
	    }
	    else{
	    	alert("Book Code not found");
	    }
	  });
}
</script>
<?php
include_once('includes/foot.php'); 
?>