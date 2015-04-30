<?php
$act = $_GET['act'];

if($act == 'save'){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$title = $_POST['title'];
	$sql = $_POST['sql'];
	$db_conn = $_POST['db_conn'];	
	$desc = $_POST['desc'];

	
}elseif($act == 'get'){
	
}elseif($act == 'list'){
	
	
}


?>