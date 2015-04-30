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
<form action="createQueryFile.php" method="post" onsubmit="return sm(this)">
	<input name="parameters" value="" type="hidden" />
	<table border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
		<tr>
			<th>數據庫連接</th>
			<td>
				<select name="db">
					<?php
						for($i=0; $i<count($DataBaseList); $i++){
							echo '<option value="'.$i.'">'.$DataBaseList[$i]['title'].'</option>';
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>查詢語句</th>
			<td><textarea name="sql" style="width:95%"></textarea></td>
		</tr>
		<tr>
			<th>生成處理文件</th>
			<td><input name="actionfile" /></td>
		</tr>
		<tr>
			<th>數據展示方式</th>
			<td>
				<input type="radio" value="json" />JSON
				<input type="radio" value="tpl" />模板
				<input type="radio" value="tpl" />生成靜態文件
			</td>
		</tr>
		<tr>
			<th>文件模板</th>
			<td><input name="tplfile" /></td>
		</tr>
		<tr>
			<th valign="top">接收參數 <a onclick="addParamter()">添加</a><br />
				<span class="note-gray">param=aa<br />param1<br />param2</span>			
			</th>
			<td id="box_parameters">
				<p>
					參數名：<input name="param.name"/>
					是否必傳：<input type="radio" name="param.need" value="1" />是
								<input type="radio" name="param.need" value="0" checked="checked" />否
					驗證規則：<input name="param.rule" />
				</p>
			</td>
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
var param_n = 1;

function addParamter(){
	var param_tpl = '\
<p>\
	參數名：<input name="param.name"/>\
	是否必傳：<input type="radio" name="param.need'+param_n+'" value="1" />是\
			<input type="radio" name="param.need'+param_n+'" value="0" checked="checked" />否\
	驗證規則：<input name="param.rule" />\
</p>';
	$('#box_parameters').append(param_tpl);
	param_n++;
}

function paramToJson(){
	var o = {};
	var list = $('#box_parameters p');
	for(var i=0;i<list.length; i++){
		var item = $(list[i]);
		var name = item.find('[name=param.name]').val();
		if(name!=''){
			var need = Number(item.find('[type=radio]:checked').val());
			var rule = item.find('[name=param.rule]').val();
			o[name] = {need: need, rule: rule};
		}
	}
	return JSON.stringify(o);
}

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