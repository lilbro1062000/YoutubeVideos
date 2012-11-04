<?php
    
    // this will parse the urls and the get 
    
    // first generate the url 
require_once "simple_html_dom.php";
require_once 'connection.php';
require_once "functions.php";
    
  $row = ex_query1Row("select * from ProcessVideos where processed ='No'");
  $html = file_get_html('http://www.youtube.com'.$row["url"]);
foreach ($html->find('div[id=watch-container]') as $element) {
	

		$s = explode('<', $element);
		
		for ($q = 0; $q < count($s); $q++) {
			if (strlen(strstr($s[$q], "met")) > 0) {
					
				$st =substr($s[$q], 0,100000);
				
				var_dump($st);
		}
	}
	
}

// after ward we need to get some information into the db and have it translate
// first is the embeded link  

//id="watch-container"
//echo $html;
?>