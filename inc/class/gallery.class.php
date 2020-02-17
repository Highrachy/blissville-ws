<?php
class Gallery extends Base{

	# -- Overwrite
	public static $table = "ism_gallerys";
	protected static $name = "gallery";
	protected static $upload_directory = "gallery";
	protected static $order_by = " ORDER BY priority ASC";

	#-############################################
	# Add a New Gallery
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Gallery Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Gallery Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Show Image
		$data['show_picture'] = Form::assign('show_picture', 'req');
		
		# -- Show on Homepage
		$data['show_homepage'] = Form::assign('show_homepage', 'req');

		# -- Gallery Image
		$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));

		# -- Programme ID
		$data['programme_id'] = Form::assign('programme_id','req');

		# - Created
		$data['created_at'] = "NOW()";


		// var_dump($data);
		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			// if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				$small_pics = Upload::image('picture',self::upload_directory('small'));
				$data['picture'] = Upload::file('picture',self::upload_directory());

				if (!empty($data['picture']))
					return self::add_to_database($data);

				$errors['picture'] = Upload::get_errors();
			// } else {
				// $errors['error'] = 'The gallery name exists in the database';
			// }

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Gallery
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;


		# -- Gallery Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Gallery Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Show Image
		$data['show_picture'] = Form::assign('show_picture', 'req');

		# -- Show on Homepage
		$data['show_homepage'] = Form::assign('show_homepage', 'req');


		# -- Programme ID
		$data['programme_id'] = Form::assign('programme_id','req');

		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Gallery ID
		$gallery_id = Form::assign('gallery_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- Gallery Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			// if (!self::exist_in_database('name',$data['name']," AND id <> '$gallery_id'")){ //No problem, name does not exist in the database

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

					return self::update_database($data,$gallery_id);
                }

			// } else {
			// 	$errors['error'] = 'The gallery name exists in the database';
			// }

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Gallery
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$gallery_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the id  and picture
			if (self::exist_in_database('id',$gallery_id,"",'picture')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$gallery = self::$results;

				if (self::delete_in_database($gallery_id)) { // If it ran OK.

					// Delete Gallery Image
					$to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$gallery['picture'];
					unlink($to_delete);
					$to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$gallery['picture'];
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
