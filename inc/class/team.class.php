<?php
class Team extends Base{

	# -- Overwrite
	public static $table = "teams";
	protected static $name = "teams";
	protected static $upload_directory = "team";

	public static $default_sort_item = "priority";
	public static $default_sort_order = "DESC";

	#-############################################
	# Add a New Team
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Team Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters')
		);

		# -- Team Post
		$data['post'] = Form::validate('post',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters' )
		);

		# -- Team Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Team Profile
		$data['profile'] = Form::validate('profile', array('minlen=10' => 'Enter a valid profile'));

		# -- Team Image
		# -- Optional Field
	    if (Form::is_valid_file('picture'))
			$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));


		# - Created
		$data['created_at'] = "NOW()";


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				 # -- Upload Optional field if available
		        if (Form::is_valid_file('picture')){
		          $small_pics = Upload::image('picture',self::upload_directory('small'));
		          $data['picture'] = Upload::file('picture',self::upload_directory());
		        }

				
		        if (empty(Upload::get_errors()))
					return self::add_to_database($data);
				else
					$errors['picture'] = Upload::get_errors();

			} else {
				$errors['error'] = 'The team name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Team
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;

		# -- Team Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters')
		);

		# -- Team Post
		$data['post'] = Form::validate('post',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters' )
		);

		# -- Team Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Team Profile
		$data['profile'] = Form::validate('profile', array('minlen=10' => 'Enter a valid profile'));

		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Team ID
		$team_id = Form::assign('team_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- Team Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }

 		# -- Delete Picture
	    $delete_picture = false;
	    if (isset($_POST['delete_image'][0]) && ($_POST['delete_image'][0] == 'YES')){
	    	$delete_picture = true;
     		$data['picture'] = 'NULL';
	    
	    }

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$team_id'")){ //No problem, name does not exist in the database

				# - If the picture is changed
                if ($change_pics){
					$small_pics = Upload::image('picture',self::upload_directory('small'));
					$data['picture'] = Upload::file('picture',self::upload_directory());
                }

                # - If there is an error in uploading
                if (Upload::get_errors()){
                 $errors = Upload::get_errors();
                } else {

                	if ($change_pics || $delete_picture){
                		#- Delete Old Picture
	                    if (!empty($_POST['old_picture'])){

	                      $to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$_POST['old_picture'];
	                      unlink($to_delete);

	                      $to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$_POST['old_picture'];
	                      unlink($to_delete);
	                    }
                	}

					return self::update_database($data,$team_id);
                }

			} else {
				$errors['error'] = 'The team name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Team
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$team_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the id  and picture
			if (self::exist_in_database('id',$team_id,"",'picture')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$team = self::$results;

				if (self::delete_in_database($team_id)) { // If it ran OK.

					// Delete Team Image
					$to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$team['picture'];
					unlink($to_delete);
					$to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$team['picture'];
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
