<?php
class Document extends Base{

	# -- Overwrite
	public static $table = "ism_documents";
	protected static $name = "documents";
	protected static $upload_directory = "documents";

	#-############################################
	# Add a New Document
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Document Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);

		# -- Brochure
		if (Form::is_valid_file('document')){
			$data['document'] = Form::validate('document', array('file' => 'Upload a valid document'));
		}


		# - Created
		$data['created_at'] = "NOW()";



		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

		        # -- Upload the Brochure
				if (Form::is_valid_file('document')){
					$data['document'] = Upload::file('document',self::upload_directory());
				}
					
				return self::add_to_database($data);

			} else {
				$errors['error'] = 'The document name exists in the database';
			}

		}


		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Document
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;

		# -- Document Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);

		# -- Document ID
		$document_id = Form::assign('document_id','req');

		# - Brochure
        $change_document = false;
    	if (Form::is_valid_file('document')){
	        $change_document = true;
			# -- Brochure
			$data['document'] = Form::validate('document', array('file' => 'Upload a valid document'));
        }


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$document_id'")){ //No problem, name does not exist in the database


				# - If the document is changed
                if ($change_document){
					$data['document'] = Upload::file('document',self::upload_directory());
                }

                # - If there is an error in uploading
                if (Upload::get_errors()){
                 $errors = Upload::get_errors();
                } else {

                	if ($change_document){
                		#- Delete Old Picture
	                    if (!empty($_POST['old_document'])){

	                      $to_delete = self::upload_directory().$_POST['old_document'];
	                      unlink($to_delete);
	                    }
                	}

					return self::update_database($data,$document_id);
                }

			} else {
				$errors['error'] = 'The document name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Document
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$document_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the name with the id
			if (self::exist_in_database('id',$document_id,"",'name')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$document = self::$results;

				if (self::delete_in_database($document_id,$document['name'])) { // If it ran OK.


                  $to_delete = self::upload_directory().$document['document'];
                  unlink($to_delete);

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


  
  #-############################################
  # Display Side Menu
  #-############################################
  public static function side_menu(){
    # -- Make Database connection
    global $db;

    $output = array();

    # -- Get all other pages
    $documents = self::get_all();


    $category_header = array();

    $final_output = "";

    foreach ($documents as $document) {

    	extract($document);      

    	# -- Final Output
		$final_output .= '<a href="'.URL::href(Document::upload_url($document)).'" class="list-group-item header"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;'. $name.'</a>';                 
       
    }	

    # -- Display all the pages
    echo '<aside class="sidebar">
            <div class="list-group">
            <span class="list-group-item top header">Quick Links</span>
          '. $final_output.'
          <a href="'.URL::href('programme').'" class="list-group-item header"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;Professional Courses</a>
          <a href="'.URL::href('upcoming-courses').'" class="list-group-item header"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;Upcoming Courses</a>
          <a href="'.URL::href('certificate').'" class="list-group-item header"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;Verify your Certificate</a>
          <a href="'.URL::href('subscribe-to-our-newsletter').'" class="list-group-item header"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;Join our Mailing List</a>
            </div>
         </aside>';
    return;
  }  

} //end class
