<?php
include('uitls/simple_html_dom.php');

	$name=$_GET['name'];
	$murl=$_GET['link'];
	$temp=$_GET['temp'];
	$id=$_GET['id'];
	$uhash=$_GET['uhash'];
	$data=$murl."&temp=".$temp."&id=".$id."&uhash=".$uhash;

	echo"<!DOCTYPE html>"
		. "   <meta charset=\"utf-8\">"
		. "   <title>";
	echo $name;
	echo "</title>";
	echo "   <meta name=\"viewport\" content=\"initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui\">"
		. "   <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">"
		. "   <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">"
		. "   <link href=\"css/ratchet.min.css\" rel=\"stylesheet\">"
		. "   <link href=\"css/app.css\" rel=\"stylesheet\">"
		. "   <link href=\"css/index.css\" rel=\"stylesheet\">"
		. "   <script src=\"javaScript/ratchet.min.js\"></script>"
		. "   <div class=\"content\">"
		. "   <ul class=\"table-view\">"
		. "       <li class=\"table-view-cell table-view-divider\">";
	echo $name;
	echo ":下载地址";
	echo"</li>";

	echo"<div class=\"card\">"
		. "<br>请输入您的邮箱，我们会把种子的下载地址发送到您的邮箱！</br>"
		. "       <form class=\"form1\" method=\"post\" role=\"search\" action=\"send.php\">"
		. "			  <input class=\"text1\" type=\"text\" name=\"email\">"
		. "           <input class=\"text1\" type=\"hidden\" name=\"url\" placeholder=\"Input movie name\" value=\"
						http://past-moies.elasticbeanstalk.com/searchTorrent$data\">"
		. "           <button class=\"btn btn-positive\" value=\"发送\" name=\"send\">"
		. "               send"
		. "           </button>"
		. "       </form>"
		. "   </div>";

echo "   </ul>"
. "</div>"
. "</html>";

?>