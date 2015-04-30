<?php
require("config.php");
?><!DOCTYPE html>
<html>
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
<form action="sqltag.action.php?act=save" method="post" onsubmit="return sm(this)">
	<input name="id" value="" type="hidden" />
	<table border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<th>SQL Tag Title</th>
			<td><input name="title" /></td>
		</tr>
		<tr>
			<th>SQL Tag Name(Unique)</th>
			<td><input name="name" /></td>
		</tr>
		<tr>
			<th>Database Connection</th>
			<td>
				<select name="db">
				</select>
			</td>
		</tr>
		<tr>
			<th>SQL</th>
			<td><textarea name="sql" style="width:95%"></textarea></td>
		</tr>
		<tr>
			<th>SQL Tag Description</th>
			<td><input name="desc" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="submit">Save </button>
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