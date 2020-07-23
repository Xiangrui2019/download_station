<?php
include('Function.php');
header("Content-type:text/html;charset=utf-8");
$Password = $_POST["Password"];
if (empty("$Password")) exit('403 Forbidden');
$file = fopen("Passwd.Info", "r") or exit("Unable to open file!");
while (!feof($file)) {
	//fgets() Read row by row
	$Line = explode('|!|', str_replace("\n", "\r\n", fgets($file)));
	if ($Line['0'] == $_POST["FilePath"]) {
		$Passwd = $Line['1'];
	}
	//echo fgets($file). "<br />";
}
fclose($file);
if ($Passwd == $Password) {
	echo "1";
	setcookie(b64encode($_POST["FilePath"]), md5($Password), time() + 3600000);
}
