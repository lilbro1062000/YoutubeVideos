<?php

// this will parse the urls and the get

// first generate the url

require_once "simple_html_dom.php";
require_once 'connection.php';
require_once "functions.php";

$row = ex_query1Row("SELECT * 
FROM  `ProcessVideos` 
WHERE  `Key` =1");
$html = file_get_html('http://www.youtube.com' . $row["url"]);

// What do i need
// the imbeded link for the site the link generated by youtube itself
// cant you create that already ?
/// yes i can
//so ?

$youtubeVidID = substr($row["url"], 9);

// link for embed links  =
$embeded_Link = "<iframe width=\"720\" height=\"640\" src=\"http://www.youtube.com/embed/$youtubeVidID\" frameborder=\"0\" allowfullscreen></iframe>";
$Username = "";
$description = "";
$videoimage = "http://i2.ytimg.com/vi/" . $youtubeVidID . "/hqdefault.jpg";
$title = "";
//foreach ($html->find('div[id=watch-container]') as $element) {

foreach ($html->find('body') as $element) {

	$s = explode('<', $element);

	for ($q = 0; $q < count($s); $q++) {
		$mainstring = $s[$q];
		// Find UserName
		if (strlen(strstr($mainstring, "link itemprop=\"url\" href=\"http://www.youtube.com/user/")) > 0) {
			
			$Username = substr($mainstring, 54);
			$Username = substr($Username, 0,strlen($Username)-9);
		}
		
		if (strlen(strstr($mainstring, "itemprop=\"name\" content=")) > 0) {
			
			$title = substr($mainstring, 30);
			$title =substr($title, 0,strlen($title)-7);
			

		}

		if (strlen(strstr($mainstring, "meta property=\"og:title\"")) > 0) {
			$title = $mainstring;
			$title = substr($name, 34, strlen($title) - 41);

		}

	}
}

foreach ($html->find("p[id=eow-description]") as $element) {

	$description = substr($element, 25);
	$description = substr($description, 0, strlen($description) - 4);
	
}

echo "\n<br /> Name of Video is:" . $title;
echo "\n<br /> Description of Video is:" . $description;
echo "\n<br /> Embeded link of Video is: " . $embeded_Link;
echo "\n<br /> image of Video is: " . $videoimage;
echo "\n<br /> User Upload of Video is: " . $Username;

// after ward we need to get some information into the db and have it translate
// first is the embeded link

//id="watch-container"
//echo $html;

// video information
?>