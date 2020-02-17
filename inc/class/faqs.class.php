<?php
class FAQs extends Base{

	# -- Overwrite
	public static $table = "faqs";
	protected static $name = "faqs";

	public static $default_sort_item = "category";
	public static $default_sort_order = "DESC";

	#-############################################
	# Add a New question
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Question
		$data['question'] = Form::validate('question',array(
			'minlen=6'=>'Enter a Valid Question')
		);

		# -- Answer
		$data['answer'] = Form::validate('answer',array(
			'minlen=6'=>'Enter a Valid Answer')
		);

		# -- FAQs Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);


		# -- Category
		$data['category'] = $_POST['category'];

		# -- Category Name
		if ($data['category'] < 1){

		  	# -- Get the Category ID
		    $cat_data['name'] = Form::validate('category_name',array(
				'xters=6-100' => 'The name should be between 6 to 100 characters',
				'name'=>'Enter a Valid name')
			);


			# -- Get Form Errors
			$errors = array_merge(Form::get_errors(),$errors);

			if (empty($errors)){
				if (!FCategory::exist_in_database('name',$cat_data['name'])){ //No problem, email does not exist in the database
			      $cat_data['priority'] = 1;
			      $cat_data['created_at'] = 'NOW()';
			      $data['category'] = FCategory::add_to_database($cat_data);

				} else {
					$errors['error'] = 'The category name exists in the database';
				}
			}
		    else $errors['category_name'] = 'Select a category';
		} else {

			# -- Validate the Category
			$data['category'] = Form::validate('category',array(
				'num'=>'Enter a category')
			);
		}


		# - Created
		$data['created_at'] = "NOW()";

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('question',$data['question'])){ //No problem, email does not exist in the database

				return self::add_to_database($data);

			} else {
				$errors['error'] = 'The question exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing question
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Question
		$data['question'] = Form::validate('question',array(
			'minlen=6'=>'Enter a Valid Question')
		);

		# -- Answer
		$data['answer'] = Form::validate('answer',array(
			'minlen=6'=>'Enter a Valid Answer')
		);

		# -- FAQs Priority
		$data['priority'] = Form::validate('priority',array(
			'range=1-10' => 'The priority should be between 1 to 10',
			'num'=>'Enter a priority number')
		);


		# -- Category
		$data['category'] = $_POST['category'];

		# -- Category Name
		if ($data['category'] < 1){

		  	# -- Get the Category ID
		    $cat_data['name'] = Form::validate('category_name',array(
				'xters=6-100' => 'The name should be between 6 to 100 characters',
				'name'=>'Enter a Valid name')
			);


			# -- Get Form Errors
			$errors = array_merge(Form::get_errors(),$errors);

			if (empty($errors)){
				if (!FCategory::exist_in_database('name',$cat_data['name'])){ //No problem, email does not exist in the database
			      $cat_data['priority'] = 1;
			      $cat_data['created_at'] = 'NOW()';
			      $data['category'] = FCategory::add_to_database($cat_data);

				} else {
					$errors['error'] = 'The category name exists in the database';
				}
			}
		    else $errors['category_name'] = 'Select a category';
		} else {

			# -- Validate the Category
			$data['category'] = Form::validate('category',array(
				'num'=>'Enter a category')
			);
		}


		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- FAQ ID
		$faq_id = Form::assign('faq_id','req');

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);


		if (empty($errors)) { // No Errors

			// Check if the question exist in the database
			if (!self::exist_in_database('question',$data['question']," AND id <> '$faq_id'")){ //No problem, question does not exist in the database

				return self::update_database($data,$faq_id);

			} else {
				$errors['error'] = 'The question exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing question
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$faq_id = $_POST['Delete'];

			// Use exist_in_database
			// Get the name with the id
			if (self::exist_in_database('id',$faq_id,'','question')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$question = self::$results;

				if (self::delete_in_database($faq_id,$question['question'])) { // If it ran OK.
					# -- Successful
					return true;
				}
			}
		}

		# -- Failed
		return 0;
	}


	#-############################################
	# Join Query
	#-############################################
	public static function join_query(){

		return "SELECT f.id, f.question, f.answer, f.priority, c.name as category, c.id as category_id FROM ".self::$table." f INNER JOIN ".FCategory::$table." c ON f.category = c.id";

	}


	#-############################################
	# Category
	#-############################################
	public static function get_category(){

		$result = array();

		$categorys = FCategory::get_all();
			$result[0] = "Add New Category";
		foreach ($categorys as $category) {
		  $result[$category['id']] = $category['name'];
		}

		return $result;
	}



} //end class
