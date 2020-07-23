<?php
include('Function.php');
$STitle = '文件提交';
include('Header.php');
?>

<div class="mdui-container doc-container">
	<div class="mdui-typo">
		<h2 class="doc-chapter-title doc-chapter-title-first mdui-text-color-theme">提交文件<a class="doc-anchor" id="font"></a></h2>
		<p>那个...提交的文件不能是违规的哦！不会提交的童鞋可以到<a href="<?php echo Get_Info('SiteURL'); ?>About.php">关于页面</a>查看帮助哦！</p>
		<div class="mdui-textfield"><input id="Filename" name="Filename" class="mdui-textfield-input" type="text" placeholder="文件名称..." /></div>
		<div class="mdui-textfield"><input id="Description" name="Description" class="mdui-textfield-input" type="text" placeholder="文件说明..." /></div>
		<div class="mdui-textfield"><input id="E_Mail" name="E_Mail" class="mdui-textfield-input" type="text" placeholder="你的邮箱..." /></div>


		<div class="mdui-textfield"><input id="Passwd" name="Passwd" class="mdui-textfield-input" type="text" placeholder="文件提取码（可选）..." /></div>
		<div class="mdui-textfield"><input id="DownloadLink" name="DownloadLink" class="mdui-textfield-input" type="text" placeholder="文件下载链接...（支持网盘和直链）..." /></div>
		<div class="mdui-textfield"><input id="Other" name="Other" class="mdui-textfield-input" type="text" placeholder="文件备注信息...（如网盘提取码等）" /></div>
		<div class="mdui-row">
			<div class="mdui-col-xs-6">
				<div class="mdui-textfield"><input id="VerificationCode" name="VerificationCode" class="mdui-textfield-input" type="text" placeholder="邮件验证码" /></div>
			</div>
			<div class="mdui-col-xs-6"><button onClick="VerificationCodeGet();" id="VerificationCodeGet" class="mdui-btn mdui-color-theme-accent mdui-ripple">立即Get邮箱验证码！</button></div>
		</div>
		<br>
		<button onClick="Submit();" id="Submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">提交！</button>
	</div>
</div>
</body>

<script>
	function Wait() {
		document.getElementById("VerificationCodeGet").setAttribute("disabled", true);
		document.getElementById("VerificationCodeGet").innerHTML = "60秒后即可重新获取";
		setTimeout(function() {
			document.getElementById("VerificationCodeGet").removeAttribute("disabled");
			document.getElementById("VerificationCodeGet").innerHTML = "立即Get邮箱验证码！";
		}, 60000);
	}

	function VerificationCodeGet() {
		Wait();
		var E_Mail = document.getElementById("E_Mail").value;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "./FileSubmit.php");
		xhr.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
		xhr.send("E_Mail=" + E_Mail + "&Mode=Send");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				if (xhr.responseText !== '1') mdui.alert(xhr.responseText);
			}
		}
	}

	function Submit() {
		document.getElementById("Submit").innerHTML = "提交中...";
		var Filename = document.getElementById("Filename").value;
		var Description = document.getElementById("Description").value;
		var E_Mail = document.getElementById("E_Mail").value;
		var Passwd = document.getElementById("Passwd").value;
		var DownloadLink = document.getElementById("DownloadLink").value;
		var Other = document.getElementById("Other").value;
		var VerificationCode = document.getElementById("VerificationCode").value;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "./FileSubmit.php");
		xhr.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
		xhr.send("Mode=Submit&Filename=" + Filename + "&Description=" + Description + "&E_Mail=" + E_Mail + "&Passwd=" + Passwd + "&DownloadLink=" + DownloadLink + "&Other=" + Other + "&VerificationCode=" + VerificationCode);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				document.getElementById("Submit").innerHTML = "提交！";
				if (xhr.responseText == 1) {
					mdui.dialog({
						title: '提交成功',
						content: '恭喜您，文件提交成功；您的文件将在审核通过后被上传到本站，审核结果我们会通过邮件通知您！',
						modal: true
					});
					setTimeout(function() {
						window.location.reload();
					}, 3000);
				} else {
					mdui.alert(xhr.responseText, '提交失败...');
				}
			}
		}
	}
</script>