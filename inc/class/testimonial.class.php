<?php
class Testimonial extends Base{

	# -- Overwrite
	public static $table = "ism_testimonials";
	protected static $name = "testimonial";
	protected static $upload_directory = "testimonial";
	protected static $order_by = " ORDER BY priority ASC";

	#-############################################
	# Add a New Testimonial
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Testimonial Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Testimonial Company
		if (Form::has_value('company')){
			$data['company'] = Form::validate('company',array(
				'xters=6-255' => 'The company name should be between 6 to 255 characters')
			);
		} else {
			$data['company'] = " ";
		}

		# -- Testimonial Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a valid priority number')
		);


		# -- Testimonial Content
		$data['comment'] = Form::validate('comment', array('minlen=10' => 'Enter a valid comment'));
		
		# -- Approved
		$data['approved'] = Form::assign('approved', 'req');


		# -- Programme ID
		$data['programme_id'] = Form::assign('programme_id','req');
		$programme_id = $data['programme_id'];

		# - Created
		$data['created_at'] = "NOW()";

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name']," AND programme_id = '$programme_id'")){ //No problem, email does not exist in the database

				return self::add_to_database($data);

			} else {
				$errors['error'] = 'The testimonial name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Testimonial
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;


		# -- Testimonial Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);


		# -- Testimonial Company
		if (Form::has_value('company')){
			$data['company'] = Form::validate('company',array(
				'xters=6-255' => 'The company name should be between 6 to 255 characters')
			);
		} else {
			$data['company'] = " ";
		}

		# -- Testimonial Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a valid priority number')
		);


		# -- Testimonial Content
		$data['comment'] = Form::validate('comment', array('minlen=10' => 'Enter a valid comment'));
		
		# -- Approved
		$data['approved'] = Form::assign('approved', 'req');


		# -- Programme ID
		$data['programme_id'] = Form::assign('programme_id','req');
		$programme_id = $data['programme_id'];

		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Testimonial ID
		$testimonial_id = Form::assign('testimonial_id','req');


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$testimonial_id' AND programme_id = '$programme_id'")){ //No problem, name does not exist in the database
				return self::update_database($data,$testimonial_id);

			} else {
				$errors['error'] = 'The testimonial name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Testimonial
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$testimonial_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the id  and picture
			if (self::exist_in_database('id',$testimonial_id,"",'picture')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$testimonial = self::$results;

				if (self::delete_in_database($testimonial_id)) { // If it ran OK.

					# -- Successful
					return true;
				}

				# -- Successful
				return true;

			}
		}

		# -- Failed
		return 0;
	}

} //end class
