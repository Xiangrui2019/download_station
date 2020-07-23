<?php 
include('Function.php'); 
$STitle='关于本站';
include('Header.php');
?>
<div class="mdui-container doc-container">
    <div class="mdui-typo">
      <h2 class="doc-chapter-title doc-chapter-title-first mdui-text-color-theme">关于本站 <a class="doc-anchor" id="font"></a></h2>
	  <?php
	  if(file_exists('About.Info')){
			$fp = fopen('About.Info',"r");
			$str = fread($fp,filesize('About.Info'));
			echo $str;
			fclose($fp);
		} else Echo "没有任何说明~~";
	  ?>
    </div>
</div>