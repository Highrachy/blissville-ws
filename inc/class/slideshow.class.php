<?php
class Slideshow extends Base{

	# -- Overwrite
	public static $table = "slideshows";
	protected static $name = "slideshows";
	protected static $upload_directory = "slideshow";
	protected static $order_by = " ORDER BY priority DESC";

	#-############################################
	# Add a New Slideshow
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Slideshow Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Slideshow Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Slideshow Descripton
		$data['description'] = Form::validate('description', array('minlen=10' => 'Enter a valid description'));

		# -- Slideshow Image
		$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));

		# -- Slideshow Link Page and Text
		if (Form::has_value('link_page')){

			if (Form::has_value('link_text')){
				$data['link_text'] = Form::validate('link_text',array('req' => "Please enter a valid Link Text" , 'xters=1-20' => 'The Link Text should less than 20 characters'));
			} else {
				$data['link_text'] = 'Learn More';
			}

			$data['link_page'] = Form::validate('link_page',array('req'=> "Please enter a valid Link Page"));
		}

		# -- Slideshow Buy Page and Text
		if (Form::has_value('buy_page')){

			if (Form::has_value('buy_text')){
				$data['buy_text'] = Form::validate('buy_text',array('req'=> "Please enter a valid Buy Text" , 'xters=1-20' => 'The Buy Text should less than 20 characters'));
			} else {
				$data['buy_text'] = 'Buy Now';
			}

			$data['buy_page'] = Form::validate('buy_page',array('req'=> "Please enter a valid Buy Page"));
		}

		# - Created
		$data['created_at'] = "NOW()";


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
				$errors['error'] = 'The slideshow name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Slideshow
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Slideshow Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters',
			'name'=>'Enter a Valid name')
		);

		# -- Slideshow Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);

		# -- Slideshow Descripton
		$data['description'] = Form::validate('description', array('minlen=10' => 'Enter a valid description'));


		# -- Slideshow Link Page and Text
		if (Form::has_value('link_page')){

			if (Form::has_value('link_text')){
				$data['link_text'] = Form::validate('link_text',array('req' => "Please enter a valid Link Text" , 'xters=1-20' => 'The Link Text should less than 20 characters'));
			} else {
				$data['link_text'] = 'Learn More';
			}

			$data['link_page'] = Form::validate('link_page',array('req'=> "Please enter a valid Link Page"));
		}

		# -- Slideshow Buy Page and Text
		if (Form::has_value('buy_page')){

			if (Form::has_value('buy_text')){
				$data['buy_text'] = Form::validate('buy_text',array('req'=> "Please enter a valid Buy Text" , 'xters=1-20' => 'The Buy Text should less than 20 characters'));
			} else {
				$data['buy_text'] = 'Buy Now';
			}

			$data['buy_page'] = Form::validate('buy_page',array('req'=> "Please enter a valid Buy Page"));
		}


		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Slideshow ID
		$slideshow_id = Form::assign('slideshow_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- Slideshow Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$slideshow_id'")){ //No problem, name does not exist in the database

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

					return self::update_database($data,$slideshow_id);
                }

			} else {
				$errors['error'] = 'The slideshow name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Slideshow
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$slideshow_id = $_POST['Delete'];

			// Use exist_in_database
			// Get the id  and picture
			if (self::exist_in_database('id',$slideshow_id,"",'picture')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$slideshow = self::$results;

				if (self::delete_in_database($slideshow_id)) { // If it ran OK.

					// Delete Slideshow Image
					$to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$slideshow['picture'];
					unlink($to_delete);
					$to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$slideshow['picture'];
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
