<?php

class Date {
  // Type      Character   Description Range or examples
  // Hour          H       Hour, numeric, 24-hour clock, leading zero 00–23
  // Hour          h       Hour, numeric, 12-hour clock, leading zero 01–12
  // Hour          G       Hour, numeric, 24-hour clock 0–23
  // Hour          g       Hour, numeric, 12-hour clock 1–12
  // Hour          A       Ante/Post Meridiem designation AM, PM
  // Hour          a       Ante/Post Meridiem designation am, pm
  // Minute        i       Minute, numeric 00–59
  // Second        s       Second, numeric 00–59
  // Second        u       Microseconds, string 000000–999999
  // Day           d       Day of the month, numeric, leading zero 01–31
  // Day           j       Day of the month, numeric 1–31
  // Day           z       Day of the year, numeric 0–365
  // Day           N       Day of the week, numeric (Monday is 1) 1–7
  // Day           w       Day of the week, numeric (Sunday is 0) 0–6
  // Day           S       English ordinal suffix for day of the month, textual “st,” “th,” “nd,” “rd”
  // Week          D       Abbreviated weekday name Mon, Tue, Wed, Thu, Fri, Sat, Sun
  // Week          l       Full weekday name Monday, Tuesday, Wednesday Thursday, Friday,Saturday, Sunday
  // Week          W       ISO 8601:1988 week number in the year, numeric,
  // week          1       is the first week that has at least 4 days in the current year, Monday is the first day of the week 1–53
  // Month         F       Full month name January–December
  // Month         M       Abbreviated month name Jan–Dec
  // Month         m       Month, numeric, leading zero 01–12
  // Month         n       Month, numeric 1–12
  // Month         t       Month length in days, numeric 28, 29, 30, 31
  // Year          Y       Year, numeric, including century e.g., 2016
  // Year          y       Year without century, numeric e.g., 16
  // Year          o       ISO 8601 year with century; numeric; the fourdigit year corresponding to the ISO week number; 
  //                       same as Y except if the ISO week number belongs to the previous or next year, that year is used instead e.g. 2016
  // Year          L       Leap year flag (yes is 1) 0, 1
  // Timezone      O       Hour offset from GMT, ±HHMM (e.g., −0400, +0230)−1200–+1200
  // Time zone     P       Like O, but with a colon −12:00 –+12:00
  // Time zone     Z       Seconds offset from GMT; west of GMT is negative, east of GMT is positive -43200–50400
  // Time zone     e       Time zone identifier e.g., America/New_York
  // Time zone     T       Time zone abbreviation e.g., EDT

  #-############################################
	# Convert_to_words
	#-############################################
  public static function sql_to_php($date){//formats date from mysql
    if (empty($date)) return;
    $php_date = strtotime($date);
    return $php_date;
  }


  public static function short($date){//formats date from mysql
    if (empty($date)) return;
    $php_date = strtotime($date);
    $formatted_date = date('M. j, Y (D)', $php_date);
    return $formatted_date;
  }


  public static function full($date){//formats date from mysql
    if (empty($date)) return;
    $php_date = strtotime($date);
    $formatted_date = date('F j, Y', $php_date);
    return $formatted_date;
  }


  public static function add_days($date,$no_of_days){//formats date from mysql
    if (empty($date)) return;
    $php_date = strtotime("$date + $no_of_days days");
    return date('Y-m-d',$php_date);
  }

  public static function programme($start_date,$duration,$short_month = false){

    $duration = $duration - 1;

    $end_date = strtotime("$start_date + $duration days");
    $start_date = strtotime($start_date);


    $start_date_day =  date('j', $start_date);
    if ($short_month)
      $start_date_month =  date('M.', $start_date);
    else
      $start_date_month =  date('F', $start_date);
    $start_date_year =  date('Y', $start_date);

    $end_date_day =  date('j', $end_date);
    if ($short_month)
      $end_date_month =  date('M.', $end_date);
    else 
      $end_date_month =  date('F', $end_date);
    $end_date_year =  date('Y', $end_date);
    // December 23 - 25, 2016;
    // December 23, 2016
    // December 23 - January 25, 2017
    $output = "";
    $output .= $start_date_month;
    $output .= " ".$start_date_day;
    if ($start_date_month != $end_date_month)
      $output .=  " - ".$end_date_month . " " . $end_date_day;
    else if ($start_date_day != $end_date_day)
      $output .= " - ".$end_date_day;
    $output .= ", ";
    $output .= " ".$end_date_year;

    return $output;



  }


  public static function time($date){//formats date from mysql
    if (empty($date)) return;
    $php_date = strtotime($date);
    $formatted_date = date('h:i a', $php_date );
    return $formatted_date;

  }

  public static function days_to_go($date){
      $time = strtotime($date);
      // $time = time() - $time; // to get the time since that moment
      $time = $time - time(); // to get the time since that moment

      // $time = strtotime($time);
      $time = ($time<1)? 1 : $time;
      $tokens = array (
          31536000 => 'year',
          2592000 => 'month',
          604800 => 'week',
          86400 => 'day',
          3600 => 'hour',
          60 => 'minute',
          1 => 'second'
      );

      foreach ($tokens as $unit => $text) {
          if ($time < $unit) continue;
          $numberOfUnits = floor($time / $unit);
          return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
      }
     

  }

  public static function is_later($date)
  {
    $date = strtotime($date);
    $year = date('Y',$date);
    $month = date('m',$date);
    $day = date('j',$date);


    // depending on the year, calculate the number of days in the month
    if ($year % 4 == 0)      // LEAP YEAR 
      $days_in_month = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    else
      $days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);


    // first, check the incoming month and year are valid. 
    if (!$month || !$day || !$year) return false;
    if (1 > $month || $month > 12)  return false;
    if ($year < 0)                  return false;
    if (1 > $day || $day > $days_in_month[$month-1]) return false;
 
    // get current date
    $today = date("U");
    $date = mktime(0, 0, 0, $month, $day, $year);
    if ($date < $today)
      return false;

    return true;
  }


  public static function timeago( $ptime ){
      $estimated_time = time() - $ptime;

      if( $estimated_time < 1 )
      {
          return 'less than 1 second ago';
      }

      $condition = array( 
                  12 * 30 * 24 * 60 * 60  =>  'year',
                  30 * 24 * 60 * 60       =>  'month',
                  24 * 60 * 60            =>  'day',
                  60 * 60                 =>  'hour',
                  60                      =>  'minute',
                  1                       =>  'second'
      );

      foreach( $condition as $secs => $str )
      {
          $d = $estimated_time / $secs;

          if( $d >= 1 )
          {
              $r = round( $d );
              return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
          }
      }
  }


} //end class
