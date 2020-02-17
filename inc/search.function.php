<?php
	
function search($search_term, $table_name, $column_name, $content_column){

	global $db;

	$single_word = explode(" ",$search_term);
	
	//Breaking the string to array of words
	$search_query = "";

	//Build the search query by using the array of words that might be listed by the user
	while(list($key,$val) = each($single_word)){
		if ($val <> " " and strlen($val)>0){
			foreach ($column_name as $column) {
				$search_query .="$column LIKE '%$val%' OR ";
			}
			
		}
	}

	//Remove the last 'OR' after building the query
	$search_query = substr($search_query,0,(strlen($search_query) - 3));		

	//Search for the page in the edit table name
	$query = "SELECT * FROM $table_name WHERE $search_query AND $content_column IS NOT NULL AND $content_column <> ''";


	//perform the function of each word in the single word variable by using the array map
	// $replace = array_map('wrap_tag',$single_word);

	$rows = $db->fetch_all_row($query);

	$output = array();

	$count = 0;


	if ($db->total_affected_rows() >= 1){

		foreach ($rows as $row){

			foreach ($column_name as $column) {
				$output[$count][$column] = strip_tags($row[$column]);
			}

			$page_content =  strip_tags($row[$content_column]);
			
			
			//Extract the search term from the page.
			// $page_piece ="";
			// foreach($single_word as $tmp){
			// $pos = strpos($page_content,$tmp);
			// if (strpos($page_content,$tmp) !==false){
			// 	if (strlen($page_content) < 350)//The description is less than 350
			// 		$page_piece = $page_content;
			// 	else if ((strlen($page_content) - $pos) > 350)//The description is in the begining of the description
			// 		$page_piece = substr($page_content,0, 350)." ...";
			// 	else if ((strlen($page_content) - $pos) < 350)//The description is in the end of the description
			// 		$page_piece =  "...".substr($page_content, (2*(strlen($page_content) - $pos)-350), 350);
			// 	else $page_piece = "...".substr($page_content, $pos-50, 350);
			// } else if(strlen($page_content) < 350) {
			// 	$page_piece = $page_content;
			// }
			// 	else $page_piece = substr($page_content,0, 350)." ...";
			// }
			// $page_piece = extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...')
			$page_piece = extractRelevant($single_word, $page_content);
			//Replace the word by making the selection bold
			// $page_piece = str_replace($single_word,$replace,$page_piece);

			foreach ($single_word as $word)			
				$page_piece = wrap_tag($word,$page_piece); // replace all instances of the single word with highlighed value

			$output[$count]['search_content'] = $page_piece;

			$count++;
			
		}

	}

	return $output;	
}

function wrap_tag($value,$body){
	// return '<strong class="gray">'.$value. '</strong>';
	return preg_replace("/($value)/i",'<span style="background-color:yellow">$1</span>', $body);
}

function generate_page($id){
	if ($id == 2){
		return 'about-us/';
	} else if ($id == 5){
		return 'team/';
	} else if ($id == 6){
		return 'contact-us/';
	}
}

function get_page($id){
	if ($id == 2){
		return 'Our Firm';
	} else if ($id == 5){
		return 'Our People';
	} else if ($id == 6){
		return 'Contact Us';
	}
}

// find the locations of each of the words
// Nothing exciting here. The array_unique is required 
// unless you decide to make the words unique before passing in
function _extractLocations($words, $fulltext) {
	$locations = array();
	foreach($words as $word) {
		$wordlen = strlen($word);
		$loc = stripos($fulltext, $word);
		while($loc !== FALSE) {
			$locations[] = $loc;
			$loc = stripos($fulltext, $word, $loc + $wordlen);
		}
	}
	$locations = array_unique($locations);
	sort($locations);
	
	return $locations;
}
// Work out which is the most relevant portion to display
// This is done by looping over each match and finding the smallest distance between two found 
// strings. The idea being that the closer the terms are the better match the snippet would be. 
// When checking for matches we only change the location if there is a better match. 
// The only exception is where we have only two matches in which case we just take the 
// first as will be equally distant.
function _determineSnipLocation($locations, $prevcount) {
	// If we only have 1 match we dont actually do the for loop so set to the first
	$startpos = 1;	
	$loccount = count($locations);
	$smallestdiff = PHP_INT_MAX;	

	for($i=0; $i < $loccount; $i++) { 
		if (($loccount - 1) > 0 ){

			if($i == $loccount-1) { // at the end
				$diff = $locations[$i] - $locations[$i-1];
			}
			else {
				$diff = $locations[$i+1] - $locations[$i];
			}	
		} else {
			$diff = 0;
		}
		
		if($smallestdiff > $diff) {
			$smallestdiff = $diff;
			$startpos = $locations[$i];
		}
	}
		
	$startpos = $startpos > $prevcount ? $startpos - $prevcount : 0;
	return $startpos;
}
// 1/6 ratio on prevcount tends to work pretty well and puts the terms
// in the middle of the extract
function extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...') {
	$textlength = strlen($fulltext);
	if($textlength <= $rellength) {
		return $fulltext;
	}
	
	$locations = _extractLocations($words, $fulltext);
	$startpos  = _determineSnipLocation($locations,$prevcount);
	// if we are going to snip too much...
	if($textlength-$startpos < $rellength) {
		$startpos = $startpos - ($textlength-$startpos)/2;
	}
	
	$reltext = substr($fulltext, $startpos, $rellength);
	
	// check to ensure we dont snip the last word if thats the match
	if( $startpos + $rellength < $textlength) {
		$reltext = substr($reltext, 0, strrpos($reltext, " ")).$indicator; // remove last word
	}
	
	// If we trimmed from the front add ...
	if($startpos != 0) {
		$reltext = $indicator.substr($reltext, strpos($reltext, " ") + 1); // remove first word
	}
	
	return $reltext;
}