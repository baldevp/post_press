<?php
    include_once('connectvars.php');
	$process_id=$_POST['bp_id'];
	$query="select * from binding_process inner join machine on binding_process.machine=machine.machine_id where bp_id=$process_id";
	$row=$db->prepare($query);
	$row->execute();
	$row=$row->get_result();
	$result=$row->fetch_assoc();
	$main = array('data'=>$result);
	$json=json_encode($main);
	$id=$result['bp_id'];
	$query="select special_options.so_id,so_name from special_options inner join bp_so on bp_so.so_id=special_options.so_id where bp_id=$id";
	$row=$db->prepare($query);
	$row->execute();
	$row=$row->get_result();
	$result['special']=array();
	while($r=$row->fetch_assoc()){
		array_push($result['special'],$r);
	}
	echo json_encode($result);
?>