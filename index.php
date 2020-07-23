<?php
/* Debug */
//exit($F);
//Software ver:V2.1.3.202007231349
error_reporting(0);
$F='/'.$_GET['F'];
if($F=='/Submit/') {include('Submit.php'); exit();}
if($F=='/Submit') {include('Submit.php'); exit();}
if($F=='/About/') {include('About.php'); exit();}
if($F=='/About') {include('About.php'); exit();}
include('Function.php');
//文件密码访问
$file = fopen("Passwd.Info", "r") or exit("Unable to open file!");
while(!feof($file))
{
	$Line=explode('|!|', str_replace("\n","\r\n",fgets($file)));
	if($Line['0']==$F) {
		$Passwd=$Line['1'];
	}
}
fclose($file);
first_start();
$FilePathB=b64encode($F);
if(!empty($F)) {
	if(!is_dir($Path.$F)) {
		if(file_exists($Path.$F)) {
				if($_GET['Page']==1) {
				include('DownloadPage.php'); 
				exit;
			} else {
				include('Download.php'); 
				exit;
			}
		} else {
			include('404.php'); 
			exit;
		}
	}
}
//判断类型
if(!is_dir($Path.$F)) {
	if(file_exists($Path.$F)) {
			if($_GET['Page']==1) {
				include('DownloadPage.php'); 
				exit;
			} else {
				include('Download.php'); 
				exit;
			}
	}
}
//Main
$NowDir=$F;

if(empty($NowDir)) $STitle='Index of /'; else if(is_dir($Path.$NowDir)) $STitle='Index of '.$NowDir; else $STitle='Index of /';
include('Header.php');
?>

<div class="mdui-container doc-container">
    <div class="mdui-typo">
      <h2 class="doc-chapter-title doc-chapter-title-first mdui-text-color-theme">当前目录:<?php if(empty($NowDir)) echo '/'; else if(is_dir($Path.$NowDir)) echo $NowDir; else echo '/';
	  ?><a class="doc-anchor" id="font"></a></h2>
<div class="mdui-table-fluid">
  <table class="mdui-table">
    <thead>
      <tr>
        <th>文件名称</th>
        <th>文件大小</th>
        <th>修改日期</th>
      </tr>
    </thead>
    <tbody>
<?php
if(!empty($NowDir)){
	if(is_dir($Path.$NowDir)) $UPath=$NowDir;
}
$TPath=$Path.$UPath;
echo '<tr>';
if($Rewrite=='1') echo '<td><a href="http://'.str_replace("//","/",dirname($_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER['PHP_SELF']).str_replace(".","/",dirname($NowDir))).'">上级目录</a></td>'; else echo '<td><a href="?Dir='.str_replace(".","/",str_replace("//","/",dirname($NowDir))).'">上级目录</a></td>';
echo '<td>Dir</td>';
echo '<td>'.date("Y-m-d H:i:s",(filemtime("$TPath"))).'</td>';
echo '</tr>';
  if(is_dir($TPath)){
		$dir = scandir($TPath);
		foreach ($dir as $value){
		$sub_path =$TPath .'/'.$value;
		if($value == '.' || $value == '..'){
			continue;
		} else if(is_dir($sub_path)){
			echo '<tr>';
			if($Rewrite=='1') echo '<td><a href="http://'.str_replace("//","/",dirname($_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER['PHP_SELF'].'/').str_replace("$Path","","$sub_path")).'">'.$value.'</a></td>'; else echo '<td><a href="?Dir='.str_replace("$Path","","$sub_path").'">'.$value.'</a></td>';
			echo '<td>Dir</td>';
			echo '<td>'.date("Y-m-d H:i:s",(filemtime("$sub_path"))).'</td>';
			echo '</tr>';
			} else {
			if(!strstr($sub_path,'.htaccess')) {
					echo '<tr>';
					if($Rewrite=='1') echo '<td><a href="http://'.str_replace("//","/",dirname($_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER['PHP_SELF'].'/').str_replace("$Path","","$sub_path")).'/Info">'.$value.'</a></td>'; else echo '<td><a href="?Download='.str_replace("//","/",str_replace("$Path","","$sub_path")).'">'.$value.'</a></td>';
					echo '<td>'.SizeUnit(filesize($sub_path)).'</td>';
					echo '<td>'.date("Y-m-d H:i:s",(filemtime("$sub_path"))).'</td>';
					echo '</tr>';
				}
			}
		}
  }
?>
    </tbody>
  </table>
</div>
    </div>
</div>


</body>