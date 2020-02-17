<?php
class FloorPlan extends Base{

	# -- Overwrite
	public static $table = "floor_plans";
	protected static $name = "floor_plans";
	protected static $upload_directory = "floor_plan";
	protected static $order_by = " ORDER BY priority DESC";

	#-############################################
	# Add a New FloorPlan
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- FloorPlan Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- FloorPlan Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);


		# -- FloorPlan Image
		$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));


		# - Created
		$data['created_at'] = "NOW()";


		# -- Property ID
		$data['property_id'] = Form::assign('property_id','req');


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				$small_pics = Upload::image('picture',self::upload_directory('small'));
				$data['picture'] = Upload::file('picture',self::upload_directory());

				if (!empty($data['picture']))
					return self::add_to_database($data);

				$errors['picture'] = Upload::get_errors();
			} else {
				$errors['error'] = 'The floor_plan name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing FloorPlan
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- FloorPlan Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- FloorPlan Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);



		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- FloorPlan ID
		$floor_plan_id = Form::assign('floor_plan_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- FloorPlan Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$floor_plan_id'")){ //No problem, name does not exist in the database

				# - If the picture is changed
                if ($change_pics){
					$small_pics = Upload::image('picture',self::upload_directory('small'));
					$data['picture'] = Upload::file('picture',self::upload_directory());
                }

                # - If there is an error in uploading
                if (Upload::get_errors()){
                 $errors = Upload::get_errors();
                } else {

                	if ($change_pics){
                		#- Delete Old Picture
	                    if (!empty($_POST['old_picture'])){

	                      $to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$_POST['old_picture'];
	                      unlink($to_delete);

	                      $to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$_POST['old_picture'];
	                      unlink($to_delete);
	                    }
                	}

					return self::update_database($data,$floor_plan_id);
                }

			} else {
				$errors['error'] = 'The floor_plan name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing FloorPlan
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$floor_plan_id = $_POST['Delete'];

			// Use exist_in_database
			// Get the id  and picture
			if (self::exist_in_database('id',$floor_plan_id,"",'picture')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$floor_plan = self::$results;

				if (self::delete_in_database($floor_plan_id)) { // If it ran OK.

					// Delete FloorPlan Image
					$to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$floor_plan['picture'];
					unlink($to_delete);
					$to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$floor_plan['picture'];
					unlink($to_delete);
				}

				# -- Successful
				return true;

			}
		}

		# -- Failed
		return 0;
	}

} //end class
