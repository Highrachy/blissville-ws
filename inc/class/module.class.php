<?php
class Module extends Base{

	# -- Overwrite
	public static $table = "ism_certificate_modules";
	protected static $name = "module";

	#-############################################
	# Add a New Module
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Module Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);


	    # -- Short Name
		$data['short_name'] = Form::validate('short_name',array(
			'xters=3-10' => 'The Certificate Code should be between 3 to 10 characters')
		);


		# -- Link the module to a programme
		$data['programme_id'] = Form::validate('programme_id',array('num' => 'Select a programme'));


		# - Created
		$data['created_at'] = "NOW()";


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				return self::add_to_database($data);

			} else {
				$errors['error'] = 'The module name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Module
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;

		# -- Module Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);


	    # -- Short Name
		$data['short_name'] = Form::validate('short_name',array(
			'xters=3-10' => 'The Certificate Code should be between 3 to 10 characters')
		);


		# -- Link the module to a programme
		$data['programme_id'] = Form::validate('programme_id',array('num' => 'Select a programme'));

		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Module ID
		$module_id = Form::assign('module_id','req');



		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$module_id'")){ //No problem, name does not exist in the database

				return self::update_database($data,$module_id);

			} else {
				$errors['error'] = 'The module name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Module
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$module_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the name with the id
			if (self::exist_in_database('id',$module_id)) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$module = self::$results;

				if (self::delete_in_database($module_id,$module['name'])) { // If it ran OK.
					# -- Successful
					return true;
				}


			}
		}

		# -- Failed
		return 0;
	}

} //end class
