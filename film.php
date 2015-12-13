

<?php
include('uitls/simple_html_dom.php');
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

$url=$_GET['link'];
if($url == "undefined"){
	echo("<h1>没有找到相关资源请重试</h1>");
	echo"<br />\n";
	echo '<span><a href="javascript:history.go(-1);">&#9666;返回上一步</a></span>';
}
else {
	$html = file_get_html($url);
	$result = $html->find('div[class=tinfo]');
	for ($i = 0; $i < count($result); $i++) {
		echo "    <li class=\"table-view-cell media\">";
		$link = "";
		$title = "";
		foreach ($result[$i]->find('a') as $e) {
			$tem = $e->href;
			$title = $e->title;

			$e->href=str_replace("download.php","sendmail.php",$tem);
			$link = $e->href;
			// $e->href =str_replace("download.php","sendmail.php",$link1)

		}
//		$link = str_replace("/download.php?","",$link);
		echo "<a class=\"navigate-right\" data-transition=\"slide-in\" href=\"bridge.html?link=$link\">";
		echo "<img class=\"media-object pull-left\" src=\"torrent.gif\"  alt='image/nofound' /> "
				. "<div class=\"media-body\">";
		echo $title;
		echo "</div>"
				. "</a>"
				. "</li>";
	}
}
echo "   </ul>"
		. "</div>"
		. "</html>";

?>