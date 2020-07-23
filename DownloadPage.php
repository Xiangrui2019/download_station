<?php 
$DownloadLink=$F;
$DownloadTurePath=$Path.$DownloadLink;
if(empty("$DownloadLink")) exit; else if(!file_exists($DownloadTurePath)) exit; else {
	$arr = parse_url($DownloadTurePath);
	$arr2 = pathinfo($arr['path']);
	$Filename=$arr2['basename'];
	$file = fopen("Info.List", "r") or exit("Unable to open file!");
	while(!feof($file))
	{
		$Line=explode('|!|', str_replace("\n","\r\n",fgets($file)));
		if($Line['0']==$DownloadLink) {
		    $Introduction=$Line['1'];
			$IntroductionO=$Line['3'];
			$DownloadImage=$Line['2'];
			$OtherDownloadAddresses=$Line['4'];
		}
	}
	fclose($file);
}

$STitle=$Filename;
include('Header.php'); 

?>

<div class="mdui-container" style="max-width: 400px; ">
<br><br>
<div class="mdui-card">

  <div class="mdui-card-media">
    <img src="<?php if(!empty($DownloadImage)) echo $DownloadImage; ?>"/>

    <div class="mdui-card-menu">
	<button onclick="javascript:history.go(-1);" class="mdui-color-theme-accent mdui-btn mdui-btn-icon mdui-text-color-white"><i class="mdui-icon material-icons">arrow_back</i></button>
    </div>
  </div>

  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title"><?php echo $Filename;?></div>
    <div class="mdui-card-primary-subtitle"><?php echo date("Y-m-d H:i:s",(filemtime("$DownloadTurePath"))); echo '&nbsp;&nbsp;&nbsp;'; echo SizeUnit(filesize($DownloadTurePath));?></div>
  </div>

  <div class="mdui-card-content"><?php if(empty($Introduction)) echo '不解释，你应该懂的，2333333'; else echo $Introduction;?><br><?php if(!empty($IntroductionO)) echo $IntroductionO;?></div>

  <div class="mdui-card-actions">
    <button onclick="DownloadNow();" class="mdui-btn mdui-ripple mdui-btn-dense mdui-color-theme-accent">本地下载</button>
	<?php if(!empty($OtherDownloadAddresses)) echo '<button onclick="OtherJump();" class="mdui-btn mdui-ripple mdui-btn-dense mdui-color-theme-accent">网盘下载</button>';?>
  </div>
  
</div>
</div>

<script>
function OtherJump(){
 //window.location.href="<?php echo preg_replace("/\s/","",$OtherDownloadAddresses);?>";
 window.open ('<?php echo preg_replace("/\s/","",$OtherDownloadAddresses);?>')
}
function DownloadNow(){
 window.location.href="<?php if($Rewrite=='1') echo 'http://'.str_replace("//","/",dirname($_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER['PHP_SELF']).'/'.$DownloadLink); else echo '?Download='.$DownloadLink?>";
}
</script>