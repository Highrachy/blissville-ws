<?php
class Programme extends Base{

	# -- Overwrite
	public static $table = "ism_programmes";
	protected static $name = "programmes";
	protected static $upload_directory = "programmes";

	#-############################################
	# Add a New Programme
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Programme Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);


	    # -- URL Name
	    $data['url_name'] = URL::readable($data['name']);


	    # -- Short Name
		$data['short_name'] = Form::validate('short_name',array(
			'xters=3-10' => 'The shortname should be between 3 to 10 characters')
		);

	    
		# -- Programme Duration
		$data['duration'] = Form::validate('duration', array('range=0-365' => 'Your duration should be between 0 - 365 days'));
		
		# -- For Exclusive programmes without duration
		if ($data['duration'] > 0){
			# -- Start Date
			$data['start_date'] = Form::validate('start_date',array(
				'yymmdd' => 'Please enter a valid date',
				'later'=>'Please enter a later date')
			);
		}


		# -- Programme Category
		$data['category_id'] = Form::validate('category_id', array('req' => 'Select a Category for the Programme'));

		# -- Programme Duration
		$data['duration'] = Form::validate('duration', array('range=0-365' => 'Your duration should be between 0 - 365 days'));

		# -- Programme Content
		$data['content'] = Form::validate('content', array('minlen=10' => 'Enter a valid content'));

		# -- Programme Registration
		$data['registration'] = Form::validate('registration', array('num' => 'Enter a valid registration fee (numbers only)'));

		# -- Tuition
		$data['tuition'] = Form::validate('tuition', array('num' => 'Enter a valid tuition (numbers only)'));

		# -- Programme Image
		$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));

	    # -- Picture 2
	    # -- Optional Field
	    if (Form::is_valid_file('picture2'))
	    $data['picture2'] = Form::validate('picture2', array('picture' => 'Upload a valid image'));

		# -- Brochure
		if (Form::is_valid_file('brochure')){
			$data['brochure'] = Form::validate('brochure', array('file' => 'Upload a valid brochure'));
		}

		# -- Registration Info
		if (Form::has_value('registration_info')){
			$data['registration_info'] = Form::validate('registration_info', array('minlen=10' => 'Invalid Registration Information'));
		}

		# -- Additional Header
		if (Form::has_value('additional_header')){
			$data['additional_header'] = Form::validate('additional_header', array('minlen=5' => 'Invalid Additional Header'));
		}

		# -- Additional Content
		if (Form::has_value('additional_content')){
			$data['additional_content'] = Form::validate('additional_content', array('minlen=5' => 'Invalid Additional Content'));
		}


		# -- Programme Certificate Image
		$sample_certificate = false;
		if (Form::is_valid_file('sample_certificate')){
			$sample_certificate = true;
	        # -- Certificate  Image
			$picture = Form::validate('sample_certificate', array('picture' => 'Upload a valid sample certificate'));
		}

		# - Created
		$data['created_at'] = "NOW()";



		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			$data['short_name'] = strtoupper($data['short_name']);

			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				$small_pics = Upload::image('picture',self::upload_directory('small'));
				$data['picture'] = Upload::file('picture',self::upload_directory());

		        # -- Upload Optional field if available
		        if (Form::is_valid_file('picture2')){
		          $small_pics = Upload::image('picture2',self::upload_directory('small'));
		          $data['picture2'] = Upload::file('picture2',self::upload_directory());
		        }

		        # -- Upload the Brochure
				if (Form::is_valid_file('brochure')){
					$data['brochure'] = Upload::file('brochure',self::brochure_directory());
				}

				# -- Upload Sample Certificate if available
				if ($sample_certificate){
					$small_sample_certicate = Upload::image('sample_certificate',self::upload_directory('certificate/small'));
					$data['sample_certificate'] = Upload::file('sample_certificate',self::upload_directory('certificate'));
				}

				if (!empty($data['picture']))
					return self::add_to_database($data);

				$errors['picture'] = Upload::get_errors('picture');
			} else {
				$errors['error'] = 'The programme name exists in the database';
			}

		}


		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Programme
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;

		# -- Programme Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);

	    # -- URL Name
	    $data['url_name'] = URL::readable($data['name']);


	    # -- Short Name
		$data['short_name'] = Form::validate('short_name',array(
			'xters=3-10' => 'The shortname should be between 3 to 10 characters')
		);

		
		# -- Programme Duration
		$data['duration'] = Form::validate('duration', array('range=0-365' => 'Your duration should be between 0 - 365 days'));

		# -- For Exclusive programmes without duration
		if ($data['duration'] > 0){
			# -- Start Date
			$data['start_date'] = Form::validate('start_date',array(
				'yymmdd' => 'Please enter a valid date',
				'later'=>'Please enter a later date')
			);
		}

		# -- Programme Category
		$data['category_id'] = Form::validate('category_id', array('req' => 'Select a Category for the Programme'));


		# -- Programme Content
		$data['content'] = Form::validate('content', array('minlen=10' => 'Enter a valid content'));

		# -- Programme Registration
		$data['registration'] = Form::validate('registration', array('num' => 'Enter a valid registration fee (numbers only)'));

		# -- Tuition
		$data['tuition'] = Form::validate('tuition', array('num' => 'Enter a valid tuition (numbers only)'));

		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Programme ID
		$programme_id = Form::assign('programme_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- Programme Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }

	    # -- Picture 2
	    # -- Optional Field
	    $change_pics2 = false;
	    if (Form::is_valid_file('picture2')){
	      $change_pics2 = true;
	      $data['picture2'] = Form::validate('picture2', array('picture' => 'Upload a valid image'));
	    }


	    # -- Delete Picture 2
	    $delete_picture2 = false;
	    if (isset($_POST['delete_image'][0]) && ($_POST['delete_image'][0] == 'YES')){
	    	$delete_picture2 = true;
     		$data['picture2'] = 'NULL';
	    
	    }
	    # -- Delete Certificate
	    $delete_certificate = false;
	    if (isset($_POST['delete_certificate'][0]) && ($_POST['delete_certificate'][0] == 'YES')){
	    	$delete_certificate = true;
      		$data['certificate'] = 'NULL';
	    }

	    # -- Remove Brochure
	    $remove_brochure = false;
	    if (isset($_POST['remove_brochure'][0]) && ($_POST['remove_brochure'][0] == 'YES')){
	    	$remove_brochure = true;
      		$data['brochure'] = 'NULL';
	    }

		# - Brochure
        $change_brochure = false;
    	if (Form::is_valid_file('brochure')){
	        $change_brochure = true;
			# -- Brochure
			$data['brochure'] = Form::validate('brochure', array('file' => 'Upload a valid brochure'));
        }


		# -- Registration Info
		if (Form::has_value('registration_info')){
			$data['registration_info'] = Form::validate('registration_info', array('minlen=10' => 'Invalid Registration Information'));
		}

		# -- Additional Header
		if (Form::has_value('additional_header')){
			$data['additional_header'] = Form::validate('additional_header', array('minlen=5' => 'Invalid Additional Header'));
		}

		# -- Additional Content
		if (Form::has_value('additional_content')){
			$data['additional_content'] = Form::validate('additional_content', array('minlen=5' => 'Invalid Additional Content'));
		}

		# - Sample Certificate
        $change_certificate = false;
    	if (Form::is_valid_file('sample_certificate')){
	        $change_certificate = true;
	        # -- Certificate  Image
			$picture = Form::validate('sample_certificate', array('picture' => 'Upload a valid sample certificate'));
        }

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			$data['short_name'] = strtoupper($data['short_name']);

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$programme_id'")){ //No problem, name does not exist in the database

				# - If the picture is changed
                if ($change_pics){
					$small_pics = Upload::image('picture',self::upload_directory('small'));
					$data['picture'] = Upload::file('picture',self::upload_directory());
                }

                # - If the picture2 is changed
                if ($change_pics2){
                  $small_pics = Upload::image('picture2',self::upload_directory('small'));
                  $data['picture2'] = Upload::file('picture2',self::upload_directory());
                }


				# - If the brochure is changed
                if ($change_brochure){
					$data['brochure'] = Upload::file('brochure',self::brochure_directory());
                }

				# - If the sample certificate is changed
                if ($change_certificate){
					$small_sample_certicate = Upload::image('sample_certificate',self::upload_directory('certificate/small'));
					$data['sample_certificate'] = Upload::file('sample_certificate',self::upload_directory('certificate'));
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

					if ($change_pics2 || $delete_picture2){
					#- Delete Old Picture
					  if (!empty($_POST['old_picture2'])){

					    $to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'small/'.$_POST['old_picture2'];
					    unlink($to_delete);

					    $to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.$_POST['old_picture2'];
					    unlink($to_delete);
					  }

					  if ($delete_picture2){
					    $data['picture2'] = "";
					  }
					}


                	if ($change_certificate || $delete_certificate){
                		#- Delete Old Certificate
	                    if (!empty($_POST['old_certificate'])){

	                      $to_delete = UPLOAD_DIR. self::$name . DIRECTORY_SEPARATOR .'certificate/small/'.$_POST['old_certificate'];
	                      unlink($to_delete);

	                      $to_delete = UPLOAD_DIR. self::$name.DIRECTORY_SEPARATOR.'certificate/'.$_POST['old_certificate'];
	                      unlink($to_delete);
	                    }
                	}

                	if ($change_brochure || $remove_brochure){
                		#- Delete Old Picture
	                    if (!empty($_POST['old_brochure'])){

	                      $to_delete = self::brochure_directory().$_POST['old_brochure'];
	                      unlink($to_delete);
	                    }
                	}

					return self::update_database($data,$programme_id);
                }

			} else {
				$errors['error'] = 'The programme name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Update Date Only
	#-############################################
	public static function update_date(){
		# -- Make Database connection
		global $db;

		# -- Start Date
		$data['start_date'] = Form::validate('start_date',array(
			'yymmdd' => 'Please enter a valid date',
			'later'=>'Please enter a later date')
		);
		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Programme ID
		$programme_id = Form::assign('programme_id','req');

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			return self::update_database($data,$programme_id);
		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}

	#-############################################
	# Delete existing Programme
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$programme_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the name with the id
			if (self::exist_in_database('id',$programme_id,"",'name')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$programme = self::$results;

				if (self::delete_in_database($programme_id,$programme['name'])) { // If it ran OK.

					// Delete references to the programme in the gallery table
					$query = "DELETE FROM ".Gallery::$table." WHERE programme_id = '$programme_id'";
					$value = $db->delete_row($query);

					// Delete references to the programme in the testimonial table
					$query = "DELETE FROM ".Testimonial::$table." WHERE programme_id = '$programme_id'";
					$value = $db->delete_row($query);
				}

				# -- Successful
				return true;

			}
		}

		# -- Failed
		return 0;
	}


	#-############################################
	# Category
	#-############################################
	public static function categories(){

		$result = array();

		$categorys = PCategory::get_all();

		foreach ($categorys as $category) {
		  $result[$category['id']] = $category['name'];
		}

		return $result;
	}


	#-############################################
	# Get the programme name
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
	# Live Edit
	#-############################################
	public static function live_edit_url($url_name){
	# -- Make Database connection
	global $db;

	$output = "";

	# -- Get the parent page
	$editable_url = URL::href('programme.php?p='.$url_name.'&editable=1');
	echo $editable_url;
	return;
	}

  #-############################################
  # Display the Price in the right format
  #-############################################
	public static function price($price){
	    return 'N'.number_format($price);
	}
  #-############################################
  # Programme Box
  #-############################################
  public static function box($programme,$additional_class = ""){
  	extract($programme);
  	return 						"
                                  <div class=\"thumbnail ".$additional_class."\">
                                      <div class=\"img-holder\">
                                          
                                        <a href=\"".URL::href('programme/'.$url_name)."\">
                                                <img src=\"".URL::href(Programme::upload_url($picture))."\" alt=\"".$name."\" class=\"img-responsive\">
                                        </a>
                                        <figure class=\"date\">
                                            <div class=\"month\">". date('M', strtotime($start_date)) ."</div>
                                            <div class=\"day\">".  date('d', strtotime($start_date)) ."</div>
                                        </figure>
                                      </div>
                                      <div class=\"caption\">
                                          <h3>$name</h3>
                                        <p><a href=\"".URL::href('programme/'.$url_name)."\" class=\"btn btn-default btn-sm\"> Learn More</a></p>
                                      </div>
                                  </div>
                                ";
  }

  public static function generate_main_menu(){
  	# -- Make Database connection
	global $db;

	# -- Start Query
	$query = "SELECT p.url_name, p.name FROM ".Page::$table." p WHERE id=2 OR parent_id=2";
	$pages = $db->fetch_all_rows($query);
	$total_pages = $db->total_affected_rows();

	# -- Start Query
	$query = "SELECT p.url_name, p.name,c.name as category FROM ".self::$table." p LEFT OUTER JOIN ".PCategory::$table." c  ON p.category_id = c.id ORDER BY p.category_id ASC, p.name ASC";
	$programmes = $db->fetch_all_rows($query);
	$total_programmes = $db->total_affected_rows();

	$total = $total_pages + $total_programmes;
	$limit = ceil($total / 3);

	$count = 0;
	$present_column = 1;

	$category_header = array();

	$output = "";

	$output .= '<div class="col-sm-4">';
	$output .= '<h4>Our Programmes</h4>';
	$output .= "\n\t".'<ul class="list-unstyled">';

	foreach ($pages as $page) {
		$output .= "\n\t\t".'<li><a href="'.URL::href('programmes/'.$page['url_name']).'"><i class="fa fa-caret-right"></i> &nbsp;&nbsp; '.$page['name'].'</a></li>';
		$count++;
	}


	foreach ($programmes as $programme) {
		extract($programme);

		if (!in_array($category,$category_header)){
			$category_header[] = $category;

			$output .= "\n\t"."</ul>";
			// Should it break into a new column
			if ($count >= $limit && $present_column <= 3){
				//reset count
				$count = 0;
				$present_column++;
				// close column
				$output .= "\n"."</div>";
				// Introduce new column	
				$output .= "\n\n".'<div class="col-sm-4">';
			} 
			// Write the category name
			$output .= "\n\n\t"."<h4>$category</h4>";
			$output .= "\n\t".'<ul class="list-unstyled">';

		}

		$output .= "\n\t\t".'<li><a href="'.URL::href('programme/'.$url_name).'"><i class="fa fa-caret-right"></i> &nbsp;&nbsp; '.$programme['name'].'</a></li>';

		$count++;
	}

	$output .= "\n\t"."</ul>";
	$output .="\n"."</div>";

	echo $output;
	return;

  }
  #-############################################
  # Display Side Menu
  #-############################################
  public static function side_menu($current_id=0,$current_category=0){
    # -- Make Database connection
    global $db;

    $output = array();

    # -- Get all other pages
    $category = self::categories();
    self::$order_by = " ORDER BY category_id ASC, name ASC ";
    $programmes = self::get_all();


    $page_name = 'programme';

    $category_header = array();

    foreach ($programmes as $programme) {

    	extract($programme);                       
       
    	// if this is the first time the header is used
    	// save it in an array to show that the header 
    	// has been used.
    	if (!in_array($category[$category_id], $category_header)){

	        // Add the heading to the array
	        $category_header[] = $category[$category_id];

	        //Get the Current Category
	        $in = "";
	        if ($current_category == $category_id) {
	        	$in = ' in';
	        }


	        // Output the Header Code
			$output[$category_id] = ' <!-- '.$category[$category_id].' -->
                            <a href="#collapse'.$category_id.'" class="list-group-item header" data-toggle="collapse"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;'. $category[$category_id].'</a>

                                <div id="collapse'.$category_id.'" class="collapse'.$in.'">
            ';
    	}

      # -- Get the Active page
      $active = "";
      if ($current_id == $id) {
        $active = ' active';
      }

      $output[$category_id] .= '<a href="'.URL::href($page_name.'/'.$programme['url_name']).'" class="list-group-item small'.$active.'"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;'.$programme['name'].'</a>';
    }   

 	$final_output = "";

    ksort($output);
    foreach ($output as $result) {
     $final_output .= $result;
    # -- Close the last Header 
    $final_output .= '</div>';

    }

    # -- Display all the pages
    echo '<aside class="sidebar">
            <div class="list-group">
            <span class="list-group-item top header">Our Programmes</span>
          '. $final_output.'
            </div>
         </aside>';
    return;
  }  

} //end class
