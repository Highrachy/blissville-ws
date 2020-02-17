<?php

class Search {

  public static function generate_where_query($search_term, $column_name){

    //Breaking the string to array of words
    $single_word = explode(" ",$search_term);

    $where_query = "";

    //Build the search query by using the array of words that might be listed by the user
    while(list($key,$val) = each($single_word)){
      if ($val <> " " and strlen($val)>0){
        foreach ($column_name as $column) {
          $where_query .="$column LIKE '%$val%' OR ";
        }

      }
    }

    //Remove the last 'OR' after building the query
    $where_query = substr($where_query,0,(strlen($where_query) - 3));

    return $where_query;
  }

  /**
   * Highlight search Term
   * @param  string $text the text you wish to hightlight
   * @param  string $body the body of the text
   * @return string       returns an hightlighted text
   */
  public static function highlight($text,$body){
  	return preg_replace("/($text)/i",'<span style="background-color:yellow">$1</span>', $body);
  }

  public static function operators(){
    $operand = array();
    $operand['='] = "Equals to";
    $operand['<'] = "Less than";
    $operand['>'] = "Greater than";

    return $operand;
  }


public static function get($search_term, $table_name, $column_name, $content_column,$order_by='id ASC'){

  global $db;

  // Generate the Search Query
  $where_query = self::generate_where_query($search_term, $column_name);    

  //Search for the page in the edit table name
  $query = "SELECT * FROM $table_name WHERE $where_query AND $content_column IS NOT NULL AND $content_column <> '' ORDER BY $order_by";

  // Get all the rows
  $rows = $db->fetch_all_row($query);

  // Initialize Output and Counter
  $output = array();
  $count = 0;


  // Search Result is Returned
  if ($db->total_affected_rows() >= 1){

    //Breaking the string to array of words
    $single_word = explode(" ",$search_term);

    foreach ($rows as $row){

      foreach ($column_name as $column) {
        $output[$count][$column] = strip_tags($row[$column]);
      }

      $page_content =  strip_tags($row[$content_column]);
      
      
      //Extract the search term from the page.
      $page_piece = self::extract_relevant_text($single_word, $page_content);

      foreach ($single_word as $word)     
        $page_piece = self::highlight($word,$page_piece); // replace all instances of the single word with highlighed value

      $output[$count]['search_content'] = $page_piece;

      $count++;
      
    }

  }

  return $output; 
}

// 1/6 ratio on prevcount tends to work pretty well and puts the terms
// in the middle of the extract
public static function extract_relevant_text($words, $fulltext, $rellength=500, $prevcount=50, $indicator='...') {
  $textlength = strlen($fulltext);
  if($textlength <= $rellength) {
    return $fulltext;
  }
  
  $locations = self::_extract_locations($words, $fulltext);
  $startpos  = self::_determine_truncate_location($locations,$prevcount);
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

// find the locations of each of the words
// Nothing exciting here. The array_unique is required 
// unless you decide to make the words unique before passing in
private static function _extract_locations($words, $fulltext) {
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
private static function _determine_truncate_location($locations, $prevcount) {
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

}
