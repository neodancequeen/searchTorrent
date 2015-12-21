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
		. "       <li class=\"table-view-cell table-view-divider\">";

$email = $_POST['email'];
$url = $_POST['url'];
$url = str_replace("sendmail.php","download.php",$url);
$s1='=';
$s2='下载';
$i1=strpos($url,$s1);//开始位置
$i2=strpos($url,$s2);//结束位置
if ($i1!==false && $i2!==false)
	$str=substr($url,$i1+1,$i2-$i1-1);
//******************** 配置信息 ********************************
$smtpserver = "smtp.sina.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "past_movies@sina.com";//SMTP服务器的用户邮箱
$smtpemailto =$email;//发送给谁
$smtpuser = "past_movies";//SMTP服务器的用户帐号
$smtppass = "31QuTmpWRQ6u";//SMTP服务器的用户密码
$mailtitle = "尊敬的用户您好最新鲜的种子为您呈上";//主题
$mailcontent = "<h1>尊敬的用户".$str."下载地址为:</h1><br>"
		.'<h3><a href='.$url. ' target="_blank">点击下载</a></h3>'
		."<br>请注意不要在手机下载种子，手机不能识别！";//内容
$mailtype = "HTML";//格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
$smtp->sendmail($smtpusermail, $smtpusermail, $mailtitle, $mailcontent.$smtpemailto, $mailtype);
if($state==""){
	echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
	exit();
}
echo "恭喜！邮件发送成功！！";
echo "</div>";
?>