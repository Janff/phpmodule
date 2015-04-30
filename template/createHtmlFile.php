<?php
require('config.php');
require('../file/fileUtil.php');
require('../database/mysql.php');

//?name=&p1=&p2=
$jsonarr = array(
	'code' => '0',
	'msg' => 'No message'
);
$name = $_GET['name'];

if($name==''){
	$jsonarr['code'] = '1001';
	$jsonarr['msg'] = 'Name is empty';
	json_encode($jsonarr);
	exit();
}

$db = new mysql($module_sqltag['sql_host'], $module_sqltag['sql_user'], $module_sqltag['sql_pwd'], $module_sqltag['sql_database'], '', 'utf8');

$rs = $db->getList("select * from template_file where name='$name'");
$tpl = $rs['list'][0];

//Get all the sqltags, and sort
$rs = $db->getList("select * from template_sqltag");
$sqltags = $rs['list'];
$tags = array();
foreach($sqltags as $v){
	$tags[$v['name']] = $v;
}

$content = file_get_contents($tpl['tpl_path']);
// handle tpl content
$content = preg_replace_callback('/\\<sqltag\s*([^\\>]+)?\\>([\\s\\S]+?)\\<\\/sqltag\\>/',function($matches) use($db,$tags){
	$params = explode(';',$matches[1]);
	$tagname = array_shift($params);
	$sql = $tags[$tagname]['sql'];
	$html = $matches[2];
	$htmlstr = '';
	
	foreach($params as $k=>$val){ //replace {$G1},{$G2}...
		$sql = str_replace('{$G'.($k+1).'}', $val, $sql);
	}
	$rs = $db->getList($sql);
	
	foreach($rs['list'] as $item){ // replace field vars
		$htmlstr .= preg_replace_callback("/\\{\\$([^\\}]+)\\}/",function($m) use($item){
			//print_r($m);
			$p = explode(';',$m[1]); 
			$field = array_shift($p);

			if(count($p)>=1) $fn = array_shift($p);
			
			$str = $item[$field];
			array_unshift($p, $str);
			
			if(isset($fn)) $str = call_user_func_array($fn, $p);//field content handle
			
			return $str;
		},$html);
	};
	
	return $htmlstr;
	
},$content);

$filelink = $tpl['save_path'].$tpl['save_filename'];
$f = new FileUtil();
$f->createFile($filelink,$content,true);

$jsonarr['code'] = '200';
$jsonarr['msg'] = 'Success';
pageJSON($jsonarr);

echo '/* 
<br>
Template Path::<a href="'.$tpl['tpl_path'].'" target="_blank">'.$tpl['tpl_path'].'</a><br>
Save Path:<a href="'.$filelink.'" target="_blank">'.$filelink.'</a><br>
*/';

function pageJSON($rs){
	if(isset($_GET['callback'])){
		echo $_GET['callback'].'('.json_encode($rs).')';
	}else{
		echo json_encode($rs);
	}
}


//---------------functions-----------------------
function func($str){
	return $str.'----------';
}
?>