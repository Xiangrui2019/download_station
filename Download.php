<?php
// 将发送到客户端的本地文件 
$local_file=str_replace("//","/",$Path.$F);
$arr = parse_url($_GET['Download']);
$arr2 = pathinfo($arr['path']);
$Filename=$arr2['basename'];
// 文件名 
$download_file=$Filename; 
// 设置下载速率
$download_rate=Get_Info("DownloadSpeed"); 
if(file_exists($local_file)&&is_file($local_file)){ 
 header('Cache-control: private');// 发送 headers 
 header('Content-Type: application/octet-stream'); 
 header('Content-Length: '.filesize($local_file)); 
 header('Content-Disposition: filename='.$download_file); 
 flush();// 刷新内容 
 $file=fopen($local_file,"r"); 
 while (!feof($file)){ 
  print fread($file,round($download_rate*1024));// 发送当前部分文件给浏览者 
  flush();// flush 内容输出到浏览器端 
  sleep(1);// 终端1秒后继续 
 } 
 fclose($file);// 关闭文件流
}else{ 
exit('404 File not found');
}
