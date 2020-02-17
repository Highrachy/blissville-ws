<?php

class Base{

	protected static $errors  = array();
	protected static $results = array();

	protected static $order_by = "";

	public static $table = "";
	protected static $name = "base";
	protected static $upload_directory = "";


	public static $rows = 0;
	public static $counter = 0;

	public static $default_sort_item = "name";
	public static $default_sort_order = "ASC";
	/**
		 *******************************************
		 * get_all
		 *
		 * @param string $where
		 * @param int limit
		 *
		 *******************************************
		 * Get all items from a table
		 *******************************************
	*/
	public static function get_all($where='',$limit=0,$start=0){
		# -- Make Database connection
		global $db;

		# -- Start Query
		$query = "SELECT * FROM ".static::$table;

		# -- Include Where
		if (!empty($where))
			$query .= " $where";

		# -- Include ORDER BY
		$query .= static::get_order_by();

		if ($limit > 0)
			$query .= " LIMIT $start,$limit";

		$results = $db->fetch_all_rows($query);

		static::$rows = $db->total_affected_rows();

		// Return that the action is not successful
		return $results;
	}


	#-############################################
	# Get a single item from the database
	#-############################################
	public static function get_one($where='',$force_result=false){
		# -- Make Database connection
		global $db;

		# -- Start Query
		$query = "SELECT * FROM ".static::$table;

		# -- Include Where
		if (!empty($where))
			$query .= " $where";

		
		# -- Include ORDER BY
		$query .= static::get_order_by();

		$results = $db->fetch_first_row($query);

		# -- Remove the where clause and try to return a result
		if (empty($results) && $force_result){
			# -- Start Query
			$query = "SELECT * FROM ".static::$table;
			$results = $db->fetch_first_row($query);			
		}

		static::$rows = $db->total_affected_rows();

		// Return that the action is not successful
		return $results;
	}


	#-############################################
	# Set the default ordering
	#-############################################
	public static function sort_order_by($order_by = 'name',$sort_order = ''){
		# -- $order should be ASC OR DESC
		if (!empty($order_by))
			static::$order_by = " ORDER BY $order_by $sort_order";
		// sort by the default sort and the sort order
		else static::$order_by = " ORDER BY ".static::$default_sort_item." ".static::$default_sort_order;
	}

	#-############################################
	# Get the Results in other methods
	#-############################################
	public static function get_order_by(){
		return static::$order_by;
	}

	#-############################################
	# Query the Database
	#-############################################
	public static function query($query, $save_total_returned_rows = true){
		# -- Make Database connection
		global $db;
		$results = $db->fetch_all_rows($query);
		if ($save_total_returned_rows){
			static::$rows = $db->total_affected_rows();
		}
		return $results;
	}
	#-############################################
	# Get affected rows
	#-############################################
	public static function affected_rows($query=""){

		# -- Make Database connection
		global $db;

		if (!empty($query)){
			static::$rows = $db->total_affected_rows($query);
		}
		return static::$rows;
	}


	#-############################################
	# To always Overwrite
	#-############################################
	public static function join_query(){
		# -- Start Query
		$query = "SELECT * FROM ".static::$table;

		return $query;
	}

	#-############################################
	# List All From Join Query
	#-############################################
	public static function list_all($limit = 0){
	
		global $db;

		$query = static::join_query();

		if ($limit > 0)
			$query .= " LIMIT ". $limit;

		$rows = $db->fetch_all_row($query);
		
		return $rows;

	}

	#-############################################
	# Check if a value exists in a column
	#-############################################
	public static function exist_in_database($column_name,$value,$additional_where_query="",$additional_column=""){

		# -- Make Database connection
		global $db;

		# -- Add a comma to additional column if present
		if (!empty($additional_column)){
			$additional_column = ', '.$additional_column;
		}

		$query = "SELECT $column_name $additional_column FROM ". static::$table ."
							WHERE $column_name = '".$value."' $additional_where_query";
		if (empty($additional_column)){
			$rows = $db->total_affected_rows($query);
		}
		else{
			static::$results = $db->fetch_first_row($query);
			$rows = $db->total_affected_rows();

		}


		if ($rows < 1) return false;
		else return true;
	}

	#-############################################
	# Insert Row into the database
	#-############################################
	public static function add_to_database($data){

		# -- Make Database connection
		global $db;

		$value = $db->insert_query(static::$table,$data);

		if ($value >= 1) { // If the insertion is successful
			# -- Successful
			return $value;

		} else { // An Error occured
			$errors['error'] = 'You could not be registered due to a system error. We apologize for any inconvenience.';
		}
		# -- Failed
		static::set_errors($errors);
		return 0;
	}

	#-############################################
	# Update a row in the database
	#-############################################
	public static function update_database($data,$id){

		# -- Make Database connection
		global $db;

		$value = $db->update_query(static::$table,$data,"id=$id");

		if ($value >= 1) { // If the insertion is successful
			return $value;
		} else { // An Error occured
			$errors['error'] = 'You could not be registered due to a system error. We apologize for any inconvenience.';
		}
		# -- Failed
		static::set_errors($errors);
		return 0;
	}

	#-############################################
	# Delete an Item in the database
	#-############################################
	public static function delete_in_database($id,$deleted_item=""){

		# -- Make Database connection
		global $db;

		$query = "DELETE FROM ".static::$table." WHERE id = '$id' LIMIT 1";
		$result = $db->delete_row($query);
		if ($result == 1){
			return 1;
		}
		return 0;
	}


	public static function set_table($table){
	   static::$table = $table; 
	}

	#-############################################
	# Set Pagination Query
	#-############################################
	public static function paginate($limit,$additional_query="",$join_query = ""){

		$items_per_page = $limit;

		// Build the Query
		if (empty($join_query))
			$query = "SELECT * FROM ". static::$table .$additional_query;
		else
			$query = $join_query . $additional_query;

		// get the total number of and save in the affected rows
		$total_returned_rows = static::affected_rows($query);

		//Include the Paginator Class
		$page = new Paginator($total_returned_rows,$items_per_page);
		$generated_pages = $page->generate();
		$start = $page->get_start_position();



		// Generate the query of returned data
		$new_query = $query . " LIMIT $start, $limit";

		// Get the new query, dont save total returned rows
		$result = static::query($new_query,false);

		// Get the counter
		static::$counter = $start + 1;
		static::$rows = $total_returned_rows;
		static::$results = $result;

		//return generated_pages
		return $generated_pages;
	}
	#-############################################
	# Get the Counter
	#-############################################
	public static function get_counter(){
		return static::$counter;
	}


	#-############################################
	# Set the Results.
	#-############################################
	public static function set_results($results){
		static::$errors = "";
		static::$results = $results;
	}
  #-############################################
  # Get the Results in other methods
  #-############################################
  public static function get_results(){
    return static::$results;
  }


	#-############################################
	# Set the Error in other methods
	#-############################################
	/**
	 * Sets the error while performing an action
	 * @param string $error_name - Can be an array or a string
	 * @param string $message    - Only useful when the error name is given
	 *
	 * Erros can be set in 3 ways
	 * 1. Via an array - $errors['name'] = "error message here"
	 * 					 set_errors($errors);
	 * 2. Giving the error name and message
	 * 					 set_errors('name','error message here')
	 * 3. Giving the error message only. Error will be saved with error as the name
	 * 					 set_errors('error message here')
	 */
	public static function set_errors($error_name,$message=""){
		if (is_array($error_name) && (!empty($error_name)))
			static::$errors = $error_name;
		else if (!is_array($error_name) && empty($message)){
			static::$errors['error'] = $error_name;
		}
		else if (!empty($message)){
			static::$errors[$error_name] = $message;
		}
	}
	#-############################################
	# Get the Error in other methods
	#-############################################
	public static function get_errors(){
		return static::$errors;
	}

	#-############################################
	# Get the Upload Directory
	#-############################################
	public static function upload_directory($additional_directory = ""){

		if (!empty($additional_directory))
			$additional_directory = DIRECTORY_SEPARATOR . $additional_directory;

		return UPLOAD_DIR . static::$upload_directory . $additional_directory . DIRECTORY_SEPARATOR;
	}
	#-############################################
	# Get the Upload URL
	#-############################################
	public static function upload_url($link_to_file = ""){

		return UPLOAD_PATH . static::$upload_directory . DIRECTORY_SEPARATOR . $link_to_file;
	}

	#-############################################
	# Increase Priority
	#-############################################
	public static function increase_priority($id){

		global $db;

		$query = "SELECT priority FROM ".static::$table." WHERE id = ".$id;

		$table = $db->fetch_first_row($query);

		if (!empty($table)){
			$table['priority'] = $table['priority'] + 1;

			if ($table['priority'] <= 10){
				return static::update_database($table,$id);
			} else {
				$errors['error'] = 'Your Priority cannot exceed 10';
			}
		} else {
			$errors['error'] = 'Item not found in the database';
		}


		# -- Failed
		static::set_errors($errors);
		return 0;
	}

	#-############################################
	# Decrease Priority
	#-############################################
	public static function decrease_priority($id){

		global $db;

		$query = "SELECT priority FROM ".static::$table." WHERE id = ".$id;

		$table = $db->fetch_first_row($query);

		if (!empty($table)){
			$table['priority'] = $table['priority'] - 1;

			if ($table['priority'] >= 1){
				return static::update_database($table,$id);
			} else {
				$errors['error'] = 'Your Priority must greater than 0';
			}
		} else {
			$errors['error'] = 'Item not found in the database';
		}

		
		# -- Failed
		static::set_errors($errors);
		return 0;
	}

	#-############################################
	# Toggle
	#-############################################
	public static function toggle($id,$column="show_picture",$first='YES',$second='NO'){
		global $db;

		$query = "SELECT $column FROM ".static::$table." WHERE id = ".$id;

		$table = $db->fetch_first_row($query);

		if (!empty($table)){
			
			if ($table[$column] == $first){
				$table[$column] = $second;
			} else {
				$table[$column] = $first;
			}

			return static::update_database($table,$id);

		} else {
			$errors['error'] = 'Item not found in the database';
		}
		
		# -- Failed
		static::set_errors($errors);
		return 0;
	}



	#-############################################
	# Get the name
	#-############################################
	public static function get_name($id){
		# -- Make Database connection
		global $db;

		# -- Start Query
		$query = "SELECT name FROM ".static::$table." WHERE id = $id";

		$results = $db->fetch_first_row($query);

		// Return that the action is not successful
		return $results['name'];
	}


	#-############################################
	# Form Select Values
	#-############################################
	public static function form_select($default = array(),$key = 'id', $value = 'name'){

		# -- Make Database connection
		global $db;

		# -- Start Query
		$query = "SELECT $key, $value FROM ".static::$table;

		// Get Result
		$results = $db->fetch_all_rows($query);

		$output  = array();

		// Input default values first
		 foreach($default as $default_key => $default_value){
		 	$output[$default_key] = $default_value;
		 }

		// Input the data from database
		foreach ($results as $result) {
		  $output[$result[$key]] = $result[$value];
		}


		return $output;
	}


} //end class
