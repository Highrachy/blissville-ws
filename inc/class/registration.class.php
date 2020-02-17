<?php
class Registration extends Base{

	# -- Overwrite
	public static $table = "ism_course_registration";
	protected static $name = "registrations";
	protected static $upload_directory = "registrations";


	#-############################################
	# Search for registration
	#-############################################
	public static function search(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (empty($errors)){
			Form::set_form_method($_GET);
			$where = " WHERE ";
			$search_term = "";
			// Name
			if (Form::has_value('name')){
				$where .= "name LIKE '%".$_GET['name']."%' AND ";
				$search_term .= "Name = ".$_GET['name']." AND ";
			}
			// Email
			if (Form::has_value('email')){
				$where .= "email LIKE '%".$_GET['email']."%' AND ";
				$search_term .= "Email = ".$_GET['email']." AND ";
			}
			// Phone
			if (Form::has_value('phone')){
				$where .= "phone LIKE '%".$_GET['phone']."%' AND ";
				$search_term .= "Phone = ".$_GET['phone']." AND ";
			}
			// Choice
			if (Form::has_value('choice')){
				$where .= "choice = '".$_GET['choice']."' AND ";
				$search_term .= "Choice = " . $_GET['choice'] ." AND ";
			}
			// Registered Date
			if (Form::has_value('registered_date')){
				$where .= "registered_date ". $_GET['registered_date_operand'] . " '" . $_GET['registered_date'] . "' AND ";
				$search_term .= "Registered Date ". $_GET['registered_date_operand'] . " " .$_GET['registered_date']." AND ";
			}

			//Remove excess AND
		    //Remove the last 'AND' after building the query
		    $where = substr($where,0,(strlen($where) - 4));
		    $search_term = substr($search_term,0,(strlen($search_term) - 4));


			$query = "SELECT * 
						FROM ".Registration::$table.$where." ORDER BY id DESC";



			// Get total_search_result and
			// $search_results = $db->fetch_all_rows($query);
			// $total_search_result = $db->total_affected_rows();

			# -- Successful
			// static::$rows = $total_search_result;
			// self::set_results($search_results);
			self::set_results($query);
			return $search_term;

		}

		# -- Failed
		self::set_errors($errors);
		return 0;

	}


} //end class
