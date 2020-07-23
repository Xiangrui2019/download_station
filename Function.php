<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
//文档根目录
$Path='./File/';
//是否开启伪静态1开启，0关闭
$Rewrite='1';
//邮件发送API使用是否为未知API
$UnAPI=true;
function Get_Info($Category){
	//网址设定
	If($Category=='SiteURL') {
		$Info='';
		if(empty($Info)) $Info=get_http_type().$_SERVER['HTTP_HOST'].'/';
	}
	//站点名称
	If($Category=='SiteName') $Info='未知下载站';
	//站点描述
	If($Category=='Description') $Info='未知下载站';
	//站点关键词
	If($Category=='KeyWord') $Info='未知下载站';
	//站点标题
	If($Category=='Title') $Info='未知下载站';
	//管理员邮箱
	If($Category=='A_E_Mail') $Info='2137535181@qq.com';
	//下载限速
	If($Category=='DownloadSpeed') $Info=100;
	return $Info; 
}

//函数开始

function Mail_Send($To,$Name,$Title,$Body) {
	$MReturn=file_get_contents('http://api.unknown-o.com/mail?&key=free&Name='.$Name.'&To='.$To.'&Title='.$Title.'&Body='.$Body);
	Return $MReturn; 
}

/* -- */
function get_http_type(){
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    return $http_type;
}

function first_start(){
	if(file_exists("First.info")){
		Return false; 
	} else {
		$url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
		file_get_contents('http://api.unknown-o.com/install.php?url='.$url);
		$myfile = fopen("First.info", "w") or die("Unable to open file!");
		$txt = "Okay";
		fwrite($myfile, $txt);
		fclose($myfile);
		Return true; 
	}
}

function getDir($path){
  if(is_dir($path)){
    $dir = scandir($path);
    foreach ($dir as $value){
      $sub_path =$path .'/'.$value;
      if($value == '.' || $value == '..'){
        continue;
      }else if(is_dir($sub_path)){
        echo '目录名:'.$value .'<br/>';
        getDir($sub_path);
      }else{
        //.$path 可以省略，直接输出文件名
        echo ' 最底层文件: '.$path. ':'.$value.' <hr/>';
      }
    }
  }
}

function SizeUnit($num){
   $p = 0;
   $format='Byte';
   if($num>0 && $num<1024){
     $p = 0;
     return number_format($num).' '.$format;
   }
   if($num>=1024 && $num<pow(1024, 2)){
     $p = 1;
     $format = 'KB';
  }
  if ($num>=pow(1024, 2) && $num<pow(1024, 3)) {
    $p = 2;
    $format = 'MB';
  }
  if ($num>=pow(1024, 3) && $num<pow(1024, 4)) {
    $p = 3;
    $format = 'GB';
  }
  if ($num>=pow(1024, 4) && $num<pow(1024, 5)) {
    $p = 3;
    $format = 'TB';
  }
  $num /= pow(1024, $p);
  return number_format($num, 3).' '.$format;
}

function GetFileNameFromAddresst($PathC){
	$arr = parse_url($PathC);
	$arr2 = pathinfo($arr['path']);
	$Filename=$arr2['basename'];
    return $Filename;
}

function b64encode($string) {
   $data = base64_encode($string);
   $data = str_replace(array('+','/','='),array('-','_',''),$data);
   return $data;
 }
 
function b64decode($string) {
   $data = str_replace(array('-','_'),array('+','/'),$string);
   $mod4 = strlen($data) % 4;
   if ($mod4) {
       $data .= substr('====', $mod4);
   }
   return base64_decode($data);
 }

function GetRandStr($length){
	$str='0123456789';
	$len=strlen($str)-1;
	$randstr='';
	for($i=0;$i<$length;$i++){
		$num=mt_rand(0,$len);
		$randstr .= $str[$num];
	}
	return $randstr;
}
