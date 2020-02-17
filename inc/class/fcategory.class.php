<?php
class FCategory extends Base{

	# -- Overwrite
	public static $table = "faqs_category";
	protected static $name = "faqs category";

	#-############################################
	# Add a New Category
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Category Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Category Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

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
				$errors['error'] = 'The category name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Category
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Category Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Category Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);


		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Category ID
		$category_id = Form::assign('category_id','req');


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$category_id'")){ //No problem, name does not exist in the database

				return self::update_database($data,$category_id);

			} else {
				$errors['error'] = 'The category name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Category
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$category_id = $_POST['Delete'];

			// Use exist_in_database
			// Get the name with the id
			if (self::exist_in_database('id',$category_id)) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$category = self::$results;

				if (self::delete_in_database($category_id,$category['name'])) { // If it ran OK.
					# -- Successful
					return true;
				}


			}
		}

		# -- Failed
		return 0;
	}


} //end class
