<?php

// this will parse the urls and the get

// first generate the url

require_once "simple_html_dom.php";
require_once 'connection.php';
require_once "functions.php";

$row = ex_query1Row("select * from ProcessVideos where processed ='No' limit 1");
$html = file_get_html('http://www.youtube.com' . $row["url"]);

// What do i need 
// the imbeded link for the site the link generated by youtube itself 
// cant you create that already ?
/// yes i can 
//so ?

$youtubeVidID =substr($row["url"], 9);


// link for embed links  = 
 $embeded_Link  = "<iframe width=\"720\" 
 height=\"640\" 
 src=\"http://www.youtube.com/embed/$youtubeVidID\" frameborder=\"0\" allowfullscreen></iframe>";
 

$Username="";
$description ="";
//foreach ($html->find('div[id=watch-container]') as $element) {

	
	foreach ($html->find('body') as $element) {

	$s = explode('<', $element);
				
	for ($q = 0; $q < count($s); $q++) {
		$mainstring = $s[$q];
		// Find UserName
		if (strlen(strstr($mainstring, "a href=\"/user/")) > 0) {
			$Username= substr($mainstring, 14,strlen($mainstring)-156);
			//echo "$Username";
			
		}

		
		if (strlen(strstr($mainstring, "meta property=\"og:")) > 0) {
				var_dump($mainstring);
			$st = substr($mainstring, 0, 100000);
			// if (strlen(strstr($mainstring, "meta property=\"og:")) > 0) {
			// //	$name = $mainstring;
			// //	$name = substr($name, 34, strlen($name) - 41);
			// //	echo "$name " . strlen($name);
			// echo "$mainstring \n";
// 
			 } 
			
			if (strlen(strstr($mainstring, "meta property=\"og:title\"")) > 0) {
				$name = $mainstring;
				$name = substr($name, 34, strlen($name) - 41);
				echo "$name " . strlen($name);

			} 
			
			
		}
	}

foreach ($html->find("p[id=eow-description]") as $element) {


	
$description = substr($element, 25);
	$description =substr($description, 0,strlen($description)-4);
var_dump ($description);
}



// after ward we need to get some information into the db and have it translate
// first is the embeded link

//id="watch-container"
//echo $html;

// video information 
$embeded_Link;
$youtubeVidID;
$Username;
?>