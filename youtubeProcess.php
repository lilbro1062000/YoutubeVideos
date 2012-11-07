<?php

// this will parse the urls and the get

// first generate the url
require_once "simple_html_dom.php";
require_once 'connection.php';
require_once "functions.php";

$row = ex_query1Row("select * from ProcessVideos where processed ='No'");
$html = file_get_html('http://www.youtube.com' . $row["url"]);
//foreach ($html->find('div[id=watch-container]') as $element) {
	foreach ($html->find('head') as $element) {

	$s = explode('<', $element);

	for ($q = 0; $q < count($s); $q++) {
		$mainstring = $s[$q];
		//var_dump($mainstring);
		if (strlen(strstr($mainstring, "meta property=\"og:")) > 0) {
				var_dump($mainstring);
			$st = substr($mainstring, 0, 100000);
			// if (strlen(strstr($mainstring, "meta property=\"og:")) > 0) {
			// //	$name = $mainstring;
			// //	$name = substr($name, 34, strlen($name) - 41);
			// //	echo "$name " . strlen($name);
			// echo "$mainstring \n";
// 
			// } 
			
			if (strlen(strstr($mainstring, "meta property=\"og:title\"")) > 0) {
				$name = $mainstring;
				$name = substr($name, 34, strlen($name) - 41);
				echo "$name " . strlen($name);

			} 
			if (strlen(strstr($mainstring, "meta property=\"og:description\"")) > 0) {
				$description = $mainstring;
				$description =substr($description, 30, strlen($description) - 37);
				echo "\n";
				echo "$description";
			}
		}
	}
}

// after ward we need to get some information into the db and have it translate
// first is the embeded link

//id="watch-container"
//echo $html;
?>