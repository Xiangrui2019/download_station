<?php
include('Function.php');
if($_POST['Mode']=='Send'){
	$Code=GetRandStr(6);
	setcookie("FileSubmit", md5($Code), time()+3600);
	if(!empty($_POST['E_Mail'])){
		$MJReturn=Mail_Send($_POST['E_Mail'],Get_Info('SiteName'),'文件提交验证','您好，您正在'.Get_Info('SiteName').'提交文件，'.$Code.'是您的验证码；如果您没有在本网站提交文件，请忽略本邮件！');
		$MAReturn=json_decode($MJReturn, true);
		if($UnAPI) {
			if($MAReturn['status']!=='good') {
				echo '我们在发送邮件时遇到一些错误遇到一些错误，这是未知API接口反馈原文: '.$MJReturn.'，您可以尝试稍后再次获取（不需要刷新页面）';
			} else echo 1;
		} else echo 1;
	} else echo '请输入你的邮箱以获取邮箱验证码！';
}

if($_POST['Mode']=='Submit'){
	$VerificationCode=$_POST['VerificationCode'];
	if(md5($VerificationCode)==$_COOKIE['FileSubmit']){
		$Filename=htmlspecialchars($_POST['Filename']);
		$Description=htmlspecialchars($_POST['Description']);
		$E_Mail=htmlspecialchars($_POST['E_Mail']);
		$Passwd=htmlspecialchars($_POST['Passwd']);
		$DownloadLink=htmlspecialchars($_POST['DownloadLink']);
		$Other=htmlspecialchars($_POST['Other']);
		if(empty($Filename)||empty($E_Mail)||empty($DownloadLink)) exit("您必须填写表单中的‘文件名称’，‘你的电子邮件地址’，‘文件的下载链接’，否则你的文件不会被提交的哦！");
		$MailY=Get_Info('SiteName').'的管理员好！你收到一个文件提交请求，以下是内容:<br>文件名称:'.$Filename.'<br>文件描述:'.$Description.'<br>提交者邮箱:'.$E_Mail.'<br>文件提取密码:'.$Passwd.'<br>文件下载链接:'.$DownloadLink.'<br>其他备注(提取码):'.$Other;
		$MJReturn=Mail_Send(Get_Info('A_E_Mail'),Get_Info('SiteName'),'文件提交申请',$MailY);
		$MAReturn=json_decode($MJReturn, true);
		if($UnAPI) {
			if($MAReturn['status']!=='good') {
				echo '我们在发送邮件时遇到一些错误，您可以尝试稍后再次提交（不需要刷新页面）';
			} else 	echo '1';
		} else echo '1';
	} else {
		echo '对不起，邮箱验证码错误！请重试！';
	}
}
