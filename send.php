<?php
require_once "uitls/email.class.php";

echo"<!DOCTYPE html>"
		. "   <meta charset=\"utf-8\">"
		. "   <title>Ratchet template page</title>"
		. "   <meta name=\"viewport\" content=\"initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui\">"
		. "   <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">"
		. "   <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">"
		. "   <link href=\"css/ratchet.min.css\" rel=\"stylesheet\">"
		. "   <link href=\"css/app.css\" rel=\"stylesheet\">"
		. "   <script src=\"javaScript/ratchet.min.js\"></script>"
		. "   <div class=\"content\">"
		. "   <ul class=\"table-view\">"
		. "       <li class=\"table-view-cell table-view-divider\">Recommended torrents</li>";

	$email = $_POST['email'];
	$url = $_POST['url'];
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.sina.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "past_movies@sina.com";//SMTP服务器的用户邮箱
	$smtpemailto =$email;//发送给谁
	$smtpuser = "past_movies";//SMTP服务器的用户帐号
	$smtppass = "31QuTmpWRQ6u";//SMTP服务器的用户密码
	$mailtitle = "尊敬的用户您好最新鲜的种子为您呈上";//邮件主题
	$mailcontent = "<h1>您的下载地址为".$url."</h1>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state==""){
		echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
		exit();
	}
	echo "恭喜！邮件发送成功！！";
	echo "</div>";
?>