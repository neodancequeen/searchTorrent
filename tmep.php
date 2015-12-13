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
    . "         <li class=\"table-view-cell table-view-divider\">Recommended movies</li>";


if ($_POST['search']) {
    $name = $_POST['name1'];
    $url = "http://www.bttiantang.com/s.php?q=$name&sitesearch=www.bttiantang.com&domains=bttiantang.com&hl=zh-CN&ie=UTF-8&oe=UTF-8";
    $html = file_get_html($url);

    foreach ($html->find('a') as $e) {
        $result = $e->href;
        $e->href = "http://www.bttiantang.com$result";
    }
    $cell = $html->find('div[class=item cl]');
    if (count($cell) == 1) {
        echo("<h1>没有找到相关电影请重试</h1>");
        echo "<br />\n";
        echo '<span><a href="javascript:history.go(-1);">&#9666;返回上一步</a></span>';
    } else {
        for ($i = 0; $i < count($cell) - 1; $i++) {
            echo "<li class=\"table-view-cell media\">";
            $douban = $cell[$i]->find('p[class=rt]');
            $title = $cell[$i]->find('p[class=tt cl]');
            foreach ($title as $key => $value) {
                foreach ($value->find('a') as $key => $value1) {
                    $link = $value1->href;
                    echo "<a class=\"navigate-right\" data-transition=\"slide-in\" href=\"film.php?link=$link\">";
                }
            }
            foreach ($cell[$i]->find('img') as $key => $img) {
                $image = $img->src;
                echo "<img class=\"media-object pull-left\" src=$image  alt='image/nofound'/> "
                    . "<div class=\"media-body\">";
            }
            foreach ($title as $key => $value) {
                foreach ($value->find('a') as $key => $value1) {
                    foreach ($value1->find('b') as $key => $value2) {
                        echo $value2;
                        echo '<br><br>';
                    }
                }
            }
            $pf = strip_tags($douban[0]->outertext, '<em><strong>');
            echo $pf;
            echo "</div>"
                . "</a>"
                . "</li>";
        }
    }
}
echo     "   </ul>"
         . "</div>"
         . "</html>"
         ."";
?>