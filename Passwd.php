<?php
$PFileName=GetFileNameFromAddresst("$F");
$FileTurePath=$Path.$F;
if(empty("$F")) exit; else if(!file_exists($FileTurePath)) exit; else {
	$arr = parse_url($FileTurePath);
	$arr2 = pathinfo($arr['path']);
	$Filename=$arr2['basename'];
	$file = fopen("Info.List", "r") or exit("Unable to open file!");
	while(!feof($file))
	{
		$Line=explode('|!|', str_replace("\n","\r\n",fgets($file)));
		if($Line['0']==$F) {
		    $Introduction=$Line['1'];
			$IntroductionO=$Line['3'];
			$DownloadImage=$Line['2'];
			$OtherDownloadAddresses=$Line['4'];
		}
	}
	fclose($file);
}
$STitle=$Filename.' - 密码保护';
include('Header.php');
?>
<div class="mdui-container" style="max-width: 400px; ">
<br><br>
<div class="mdui-card">

  <div class="mdui-card-media">
    <img src=""/>

    <div class="mdui-card-menu">
	<button onclick="javascript:history.go(-1);" class="mdui-color-theme-accent mdui-btn mdui-btn-icon mdui-text-color-white"><i class="mdui-icon material-icons">arrow_back</i></button>
    </div>
  </div>

  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title"><?php echo $PFileName;?></div>
    <div class="mdui-card-primary-subtitle"><?php echo date("Y-m-d H:i:s",(filemtime("$FileTurePath")));?></div>
  </div>

  <div class="mdui-card-content">
  <?php if(empty($Introduction)) echo '啊偶，该文件夹存在密码保护'; else echo $Introduction;?><br><?php if(!empty($IntroductionO)) echo $IntroductionO;?>
  <div class="mdui-textfield">
    <input class="mdui-textfield-input" type="password" id="Password" name="Password" placeholder="输入密码以查看...."/>
</div>
</div>

  <div class="mdui-card-actions">
    <button onclick="PasswordSubmit();" class="mdui-btn mdui-ripple mdui-btn-dense mdui-color-theme-accent">查看</button>
  </div>
  
</div>
</div>

<script type="text/javascript">

        function PasswordSubmit() {
            var Password = document.getElementById("Password").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./PasswordSubmit.php");
            xhr.setRequestHeader('Content-Type',' application/x-www-form-urlencoded');
            xhr.send("Password="+Password+"&FilePath=<?php echo "$F";?>");
            xhr.onreadystatechange = function(){
                if (xhr.readyState==4 && xhr.status==200){
					if(xhr.responseText==1){
						setTimeout(location.reload(),500);
					} else {
						mdui.alert('对不起...密码错误，我们无法为您展现内容','密码错误')
					}
                }
            }
        }

</script>