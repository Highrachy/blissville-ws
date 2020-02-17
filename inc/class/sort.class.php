<?php

class Sort{
  	// protected static $default_item_name;
  	protected static $default_order = 'ASC';  	
  	protected static $order_query = ''; 

  	public static $item_url = 'si';
  	public static $order_url = 'so';
  	public static $results;

  	
	#-############################################
	# Sort Items when Clicked
	#-############################################
	public static function current($sort_item="",$sort_order=""){

		//if empty assign default
		if (empty($sort_item)) {
			$sort_item = 'id';
		}

		if (empty($sort_order)){
			$sort_order = static::$default_order;
		}

		// Get the sort text from table name
		$sort_item_text = ucwords(str_replace('_', ' ', $sort_item));

		// Replace id with Added name in the sort_text
		if ($sort_item == 'id'){
		  $sort_item_text = "Added Date";
		}

		//get the sort order text by changing to upper case
		$sort_order = $sort_order_text = strtoupper($sort_order);


		// $sorted = $sort." ".$sort_order;
		// Build Output
		$output = array();
		$output['sort_item'] = $sort_item;
		$output['sort_order'] = $sort_order;
		// $output['sort_item_text'] = $sort_item_text;
		// $output['sort_order_text'] = $sort_order_text;

		self::$results = $output;
		self::$order_query = $sort_item . " " . $sort_order;


		return $sort_item_text . " ". $sort_order;
	}

  	public static function get_icon($name){
  		if (!empty(self::$results)){

  			extract(self::$results);

	  		if ($name == $sort_item ){
	  			if (strtoupper($sort_order) == 'DESC')
	  				return '&nbsp; <i class="fa fa-caret-down"></i>';
	  			else return '&nbsp; <i class="fa fa-caret-up"></i>';
	  		} 
  		}

  		return;
  	}

  	public static function get_url($name){

  		if (!empty(self::$results)){

  			extract(self::$results);

  			$current_page = "";
	  		// get current page
	  		$args = explode("&",$_SERVER["QUERY_STRING"]);
			foreach($args as $arg) {
				$keyval = explode("=",$arg);
				if(($keyval[0] != self::$item_url) && ($keyval[0] != self::$order_url))
					$current_page .= "&" . $arg;
			}


			//Use substr to omit first &
			$current_page = substr($current_page,1);

			if (!empty($current_page))
				$current_page .= '&';

			// Build the url
			$current_page .= self::$item_url . '=' . $name . '&';

			// get the sort order
			$current_sort_order = self::order($name);
			$current_page .= self::$order_url . '=' . $current_sort_order;

			// build the full url
			return $_SERVER['PHP_SELF'] .'?'. $current_page;

  		}
  		
  	}

  	public static function get_order_query(){
  		return " ORDER BY " . self::$order_query;
  	}

  	public static function order($name){

  		if (!empty(self::$results)){

  			extract(self::$results);

			if ($name == $sort_item){ //reverse only if it is the current sorted_item
		    	if (strtoupper($sort_order) == 'DESC')
		      		$sort_order = 'ASC';
		    	else $sort_order = 'DESC';
		  	}
		  	else {
		    	$sort_order = self::$default_order;
		  	}

		  	return strtolower($sort_order);
  		}

  		return;
	}

	public static function active_link($name, $class_name = 'active'){

		if (!empty(self::$results)){

  			extract(self::$results);

			if ($name == $sort_item)
				return  $class_name;
  		}
		
		return;
	
	}

	public static function generate_link($name, $readable_name = ""){

		if (empty($readable_name))
			$readable_name = ucwords($name);

		$output = "";
		// Get the link
		$output .= '<a href="';
		$output .= self::get_url($name);
		// Get the Class
		$output .= '" class="';
		$output .= self::active_link($name);
		$output .= '">';
		// Write the Name 
		$output .= $readable_name;
		// Get the Icon
		$output .= self::get_icon($name);
		$output .= "</a>";

		return $output;
	}

}
