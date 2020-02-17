<?php

class Text {

  #-############################################
	# Convert_to_words
	#-############################################
  public static function plural($number,$singular,$plural="",$zero="",$return_number = true){

    $output = "";

    // return the value for 0
    if (!empty($zero) && ($number == 0)){
      return $zero;
    }

    // return singular if number is 1
    else if ($number == 1){
      $output = $singular;
    }
    
    // return plural if given
    else if ($plural != ""){
      $output = $plural;
    }

    else{ // generate the plural

      // get the last letter of the word
      $last_letter = strtolower($singular[strlen($singular)-1]);
        switch($last_letter) {
            case 'y':
                $output = substr($singular,0,-1).'ies';
                break;
            case 's':
                $output = $singular.'es';
                break;
            default:
                $output = $singular.'s';
        }
    }

    if ($return_number){
      $output = $number.' '.$output;
    } 

    return $output;
  }

   
  public static function truncate($string, $limit, $break=" ", $pad="...",$shorter_than_limit=false) {
  /*
  |------------------------------------------------------------
  | USAGE
  |------------------------------------------------------------
  |
  | 1. The default action is to break on the first " " 
  |    after $limit characters and pad with "..."
  |
  | 2. To truncate at another character, change the $break
  |    e.g. Use '.' for breaks at full stop
  |    
  | 3. When using '.', It is better to set shorter_than_limit to true
  |
  |
   */
  
    $length = strlen($string);

    // return with no change if string is shorter than $limit
    if($length <= $limit) return $string;

    // if the returned string should be longer than $limit character
    if ($shorter_than_limit){
      $string = substr($string, 0, $limit);
    }

    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = strpos($string, $break, $limit))) {
      if($breakpoint < strlen($string) - 1) {
        $string = substr($string, 0, $breakpoint);
      }
    }

    // Add pad
    if ($length > strlen($string)){
      $string = $string . $break. $pad;
    }

    return $string;

  }


  public static function truncate_words($input, $num_of_words, $padding="") {


    /*
    |------------------------------------------------------------
    | USAGE
    |------------------------------------------------------------
    |
    | $shortdesc = truncateWords($description, 10, "...");
    | echo "$shortdesc"
    |
    |
     */
    
    $output = strtok($input, " \n");
    while(--$num_of_words > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;
  }


  public static function truncate_middle($text,$no_of_xters=16, $padding="..."){

    # -- Get the Text Length
    $text_length = strlen($text);

    # -- Return the whole text if you dont need to truncate
    if ($no_of_xters >= $text_length)
      return $text;

    # -- Get the total no of Characters
    # -- Subtract the padding length from no_of_xters
    $no_of_xters = $no_of_xters - strlen($padding);

    # -- 3. Get the range
    $mid_range = ceil($no_of_xters / 2);

    # -- Return the final answer
    # -- Replace the text from midrange with $padding
    # -- Append the text from midrange to end
    echo "$text <br> $padding <br> $mid_range <br> $text_length<br>";
    return substr_replace($text, $padding, $mid_range, $text_length - $no_of_xters);
  }

} //end class

