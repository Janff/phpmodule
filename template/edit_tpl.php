<?php
require('config.php');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="//api.efunfun.com/js/jquery.js"></script>
<style>
table{ font-size:12px; border-collapse:collapse}
th{ font-weight:400}
th,td{ padding:5px 10px}
.note-gray{ color:#999}
</style>
</head>

<body>
<form action="" method="post" onsubmit="return sm(this)">
	<input name="id" value="" type="hidden" />
	<table border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<th>Template Title</th>
			<td>
				<input name="title" />
			</td>
		</tr>
		<tr>
			<th>Template Name</th>
			<td>
				<input name="name" />
			</td>
		</tr>
		<tr>
			<th>Template Path</th>
			<td><input name="tpl_path" /></td>
		</tr>
		<tr>
			<th>Save Path</th>
			<td><input name="save_path" /></td>
		</tr>
		<tr>
			<th>Save File Name</th>
			<td><input name="save_filename" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="submit">保存</button>
			</td>
		</tr>
	</table>
</form>
</body>
</html>

<script>

function sm(o){
	if($('[name=sql]').val()==''){
		alert('SQL語句不能為空');
		return false;
	}
	if($('[name=actionfile]').val()==''){
		alert('生成執行文件不能為空');
		return false;
	}
	$('[name=parameters]').val(paramToJson());
	$('#box_parameters').html('');
	
	//return false;
}
</script>