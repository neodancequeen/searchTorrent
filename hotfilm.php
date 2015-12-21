<?php
include('uitls/simple_html_dom.php');
include('cLog.php');
echo"<!DOCTYPE html>"
    . "   <meta charset=\"utf-8\">"
    . "   <title>电影搜索</title>"
    . "   <meta name=\"viewport\" content=\"initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui\">"
    . "   <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">"
    . "   <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">"
    . "   <link href=\"css/ratchet.min.css\" rel=\"stylesheet\">"
    . "   <link href=\"css/app.css\" rel=\"stylesheet\">"
    . "   <script src=\"javaScript/ratchet.min.js\"></script>"
    . "   <div class=\"content\">"
    . "   <ul class=\"table-view\">"
    . "         <li class=\"table-view-cell table-view-divider\">最热下载</li>";

$url = "http://www.bttiantang.com/";
    $html = file_get_html($url);
    
    $cell = $html->find('ul.lst');
    $cell[1]->style = "display: block;";
    foreach ($cell[1]->find('a') as $e) {
        $result = $e->href;
        $e->href = "film.php?link=http://www.bttiantang.com$result";
    }

    $result=$cell[1]->find('li');
   for ($i = 0; $i < count($result); $i++) {
       $image = $result[$i]->find('div[class=img]');
       $imageA = $image[0]->find('a');
       $img = $imageA[0]->find('img');
       $tit = $result[$i]->find('div[class=tit]');
       $link = $imageA[0]->href;
       $imgUrl = $img[0]->src;
       echo "<li class=\"table-view-cell media\">";
       echo "<a class=\"navigate-right\" data-transition=\"slide-in\" href=\"$link\">";
       echo "<img class=\"media-object pull-left\" src=$imgUrl  alt='image/nofound'/> "
           . "<div class=\"media-body\">";

       $pfa = $tit[0]->find('a');
       $name = strip_tags($pfa[0]->outertext);
       $allname = strip_tags($tit[0]->outertext);
       $allname1 = str_replace($name, "", $allname);
       $allname2 = str_replace(" ", "", $allname1);
       echo $name;
       echo "<br><br>";
       echo "豆瓣评分：";
       echo $allname2;

       echo "</div>"
           . "</a>"
           . "</li>";
   }
       
    

echo "   </ul>" . "</div>" . "</html>" . "";
?>
