<?php
include('uitls/simple_html_dom.php');

	// $temp=$_GET['temp'];
	// $n=$_GET['n'];
	// $id=$_GET['id'];
	// $uhash=$_GET['uhash'];
	// $data=$murl."?n=".$n."&temp=".$temp."&id=".$id."&uhash=".$uhash;
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8"/>';
	
	
	//$full_url=str_replace("memoryofmovie.cn-hangzhou.aliapp.com","www.bttiantang.com",curPageURL());
	$full_url=str_replace("localhost/searchTorrent","www.bttiantang.com",curPageURL());
	 $html=file_get_html($full_url);

	 echo 	"<table width=\"620\" align=\"center\" cellpadding=\"0\" cellspacing=\"5\" bgcolor=\"#f4f4f4\" style=\"border:1px solid #dcdcdc; margin-top:5px\">"
  				."<tbody><tr>"
    			."<td width=\"300\" height=\"250\" align=\"center\" bgcolor=\"#FFFFFF\">";
		    
		    foreach($html->find('form') as $e){
							
						    $result =$e->action; 
						    $e->action="http://www.bttiantang.com".$result; 		   
						}
							$result=$html->find('div[style=position:relative]'); 	
			foreach ($result as $key => $value) {
				echo $value;
			}

    echo "</form></div></td>"
    	."<td width=\"300\" height=\"250\" align=\"center\" bgcolor=\"#FFFFFF\">"
    	."<h3>Past Movies</h3>"
    	."<img src=\"qrcode.jpg\"  alt=\"二维码\" width=\"300\" height=\"250\" align=\"center\"/>"
		. "扫描二维码关注我们微信公众号"
		. "</td></tr></tbody></table>";

	

	function curPageURL() 
	{
	    $pageURL = 'http';

	  
	    $pageURL .= "://";

	    if ($_SERVER["SERVER_PORT"] != "80") 
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	    } 
	    else 
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;
	}
?>

</html>