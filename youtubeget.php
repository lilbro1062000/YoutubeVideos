<?php

require_once "simple_html_dom.php";
require_once 'connection.php';
require_once "functions.php";



for ($i = 0; $i < 50; $i++) {

	//echo(file_get_html('www.google.com'));
$string1 = "unity3d";
$string2 = "programming";
	$html = file_get_html('http://www.youtube.com/results?search_query='.$string1.'+'.$string2.'&page=' . $i);
	foreach ($html->find('li[class=yt-grid-box]') as $element) {

		$s = explode('"', $element);
		
		for ($q = 0; $q < count($s); $q++) {
			if (strlen(strstr($s[$q], "watch?v=")) > 0) {
				$st =substr($s[$q], 0,20);
				
				
				if(ex_query1RowAns("Select 1 from ProcessVideos where url =\"".$st."\"")!=1)
				{
					ex_query("INSERT INTO  `TMSprdDB`.`ProcessVideos` (
`url` ,
`string1`,
`string2`,
`type` ,
`processed`
)
VALUES ('".$st."','$string1','$string2','YouTube','No')");
					echo "\nInserted video ".$st."\n <br>";
				}
				else {
					echo "Already Inserted \n <br>";
				}
				//$rest = substr("abcdef", -2);    // returns "ef"
			}
		}
	}
	
	//  var_dump($html->find('div[class=yt-lockup-content]'));
	//  echo $ret;

}


//i got every page now i just have crawl all of them and get links for the videos
?>
