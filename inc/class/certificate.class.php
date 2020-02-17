<?php
class Certificate extends Base{

	# -- Overwrite
	public static $table = "ism_certificates";
	protected static $name = "certificates";
	protected static $upload_directory = "certificates";

	#-############################################
	# Add a New Certificate
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;

		# -- Certificate Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);
		
		# -- Certificate number
		$data['number'] = Form::validate('number',array(
			'req' => 'The certificate number is required'
			)
		);

		# -- Verify Certificate
		$data['verify_certificate'] = Form::validate('verify_certificate', array('req' => 'Verify the Certificate Number'));
	
		
		# -- Given Date
		$data['given_date'] = Form::validate('given_date',array(
			'yymmdd' => 'Please enter a valid date'
		));


		# -- Have they collected the certificate
		$data['collected'] = Form::validate('collected', array('req' => 'Select if the certifcate has been collected'));

		# -- Collection Date
		if (Form::has_value('collection_date'))
			$data['collection_date'] = Form::validate('collection_date',array('yymmdd' => 'Please enter a valid date'));
		else
			$data['collection_date'] = $data['given_date'];

		# -- Link the certificate to a programme
		$data['programme_id'] = Form::validate('programme_id',array('num' => 'Select a programme'));

		# -- Module ID
		$data['module_id'] = Form::assign('module_id','num','Select a module');

		# - Created
		$data['created_at'] = "NOW()";
		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		# -- If the Certificate Number is to be verified
		# -- Verity the Certificate Number
		if ($data['verify_certificate'] == 'YES'){
			$data['number'] = self::verify_certificate($data['number'],$data['given_date'],$data['programme_id'],$data['module_id']);
		}

		if (empty($errors) && $data['number']) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database

			if (!self::exist_in_database('number',$data['number'])){ //No problem, email does not exist in the database

				return self::add_to_database($data);
			} else {
				$errors['error'] = 'The certificate number exists in the database';
			}

		}
		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Certificate
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;

		# -- Certificate Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);
		
		# -- Certificate number
		$data['number'] = Form::validate('number',array(
			'req' => 'The certificate number is required'
			)
		);

		# -- Verify Certificate
		$data['verify_certificate'] = Form::validate('verify_certificate', array('req' => 'Verify the Certificate Number'));
	
		
		# -- Given Date
		$data['given_date'] = Form::validate('given_date',array(
			'yymmdd' => 'Please enter a valid date'
		));


		# -- Have they collected the certificate
		$data['collected'] = Form::validate('collected', array('req' => 'Select if the certifcate has been collected'));

		
		# -- Collection Date
		if (Form::has_value('collection_date'))
			$data['collection_date'] = Form::validate('collection_date',array('yymmdd' => 'Please enter a valid date'));
		else
			$data['collection_date'] = $data['given_date'];

		# -- Link the certificate to a programme
		$data['programme_id'] = Form::validate('programme_id',array('num' => 'Select a programme'));

		# -- Module ID
		$data['module_id'] = Form::assign('module_id','num','Select a module');

		
		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		# -- If the Certificate Number is to be verified
		# -- Verity the Certificate Number
		if ($data['verify_certificate'] == 'YES'){
			$data['number'] = self::verify_certificate($data['number'],$data['given_date'],$data['programme_id'],$data['module_id']);
		}
		
		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Certificate ID
		$certificate_id = Form::assign('certificate_id','req');

		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors) && $data['number']) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('number',$data['number']," AND id <> '$certificate_id'")){ //No problem, name does not exist in the database
					
				return self::update_database($data,$certificate_id);

			} else {
				$errors['error'] = 'The certificate number exists in the database';
			}

		}


		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Certificate
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$certificate_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the name with the id
			if (self::exist_in_database('id',$certificate_id,"",'name')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$certificate = self::$results;

				if (self::delete_in_database($certificate_id,$certificate['name'])) { // If it ran OK.

					# -- Successful
					return true;

				}

			}
		}

		# -- Failed
		return 0;
	}


	#-############################################
	# Modules
	#-############################################
	public static function modules(){

		$result = array();

		$modules = Module::get_all();

		$result[0] = "No Sub Modules";

		foreach ($modules as $module) {
		  $result[$module['id']] = $module['name'];
		}

		return $result;
	}



	#-############################################
	# Programmes
	#-############################################
	public static function programmes(){

		$result = array();

		$programmes = Programme::get_all();

		$result[0] = "Not a Programme";

		foreach ($programmes as $programme) {
		  $result[$programme['id']] = $programme['name'];
		}

		return $result;
	}



	#-############################################
	# Verify Certificate Number
	#-############################################
	public static function verify_certificate($number,$given_date,$programme_id,$module_id){

		# -- Convert Certificate Number to uppercase
		$number = strtoupper($number);

		# -- Extract all certificate fragments
		$student_number = substr($number, -3);
		$batch = substr($number,-4, -3);
		$month = substr($number,-6, -4);
		$year = substr($number,-8, -6);
		$short_name = substr($number,0, -8);


		// Must be greater than 0
		if ((int)$student_number <= 0){
			self::set_errors('number', 'Invalid Student Number in Certificate Number');
			return false;
		}

		// Month with Leading Zero
		if (date('m',strtotime($given_date)) != $month){
			self::set_errors('number', 'Invalid Month in Certificate Number');
			return false;
		}

		// Year without Century
		if (date('y',strtotime($given_date)) != $year){
			self::set_errors('number', 'Invalid Year in Certificate Number');
			return false;	
		}

		// Short  Name
		// If Module is defined, Verify against module name
		if ($module_id > 0){
			$module = Module::get_one('where id ='.$module_id);
			if (empty($module)){
				self::set_errors('module_id', 'Invalid Module');
				return false;
			}
			if ($module['short_name'] != $short_name){
				self::set_errors('number', 'Invalid Certificate Code in Certificate Number');
				return false;
			}

		} else if ($programme_id > 0) { // Programme is not defined verify against programme short code
			$programme = Programme::get_one('where id ='.$programme_id);
			if (empty($programme)){
				self::set_errors('programme_id', 'Invalid programme');
				return false;
			}
			if ($programme['short_name'] != $short_name){
				self::set_errors('number', 'Invalid Short Name in Certificate Number');
				return false;
			}

		} else if ($programme_id != 0) { // If none is defined, Cannot verify short code
			self::set_errors('number', 'Cannot Verify Short Name in Certificate Number');
			return false;	
		}		

		return $number;
	}


	#-############################################
	# Search for Certificate
	#-############################################
	public static function search(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (empty($errors)){

			Form::set_form_method($_GET);
			$where = " WHERE ";
			$search_term = "";
			// Name
			if (Form::has_value('name')){
				$where .= "name LIKE '%".$_GET['name']."%' AND ";
				$search_term .= "Name = ".$_GET['name']." AND ";
			}
			// Number
			if (Form::has_value('number')){
				$where .= "number LIKE '%".$_GET['number']."%' AND ";
				$search_term .= "Certificate Number = ".$_GET['number']." AND ";
			}
			// Verify Certificate
			if (Form::has_value('verify_certificate')){
				$where .= "verify_certificate = '".$_GET['verify_certificate']."' AND ";
				$search_term .= "Verify Certificate = ".$_GET['verify_certificate']." AND ";
			}
			// Given Date
			if (Form::has_value('given_date')){
				$where .= "given_date ". $_GET['given_date_operand'] . " '" . $_GET['given_date'] . "' AND ";
				$search_term .= "Given Date ". $_GET['given_date_operand'] . " " .$_GET['given_date']." AND ";
			}
			// Collected
			if (Form::has_value('collected')){
				$where .= "collected = ".$_GET['collected']." AND ";
				$search_term .= "Collected = " . $_GET['collected']." AND ";
			}
			// Collection Date
			if (Form::has_value('collection_date')){
				$where .= "collection_date ". $_GET['collection_date_operand'] . " '" . $_GET['collection_date']."' AND ";
				$search_term .= "Collection Date ". $_GET['collection_date_operand'] . " " .$_GET['collection_date']." AND ";
			}
			// Programme
			if (Form::has_value('programme_id')){
				$programme_name = Programme::get_name($_GET['programme_id']);
				$where .= "programme_id = '".$_GET['programme_id']."' AND ";
				$search_term .= "Programme Name = " . $programme_name ." AND ";
			}
			// Module
			if (Form::has_value('module_id')){
				$module = Module::get_one('WHERE id = '.$_GET['module_id']);
				$where .= "module_id = '".$_GET['module_id']."' AND ";
				$search_term .= "Module = " . $module['name'] ." AND ";
			}

			//Remove excess AND
		    //Remove the last 'AND' after building the query
		    $where = substr($where,0,(strlen($where) - 4));
		    $search_term = substr($search_term,0,(strlen($search_term) - 4));


			$query = "SELECT * 
						FROM ".Certificate::$table.$where;


			// Get total_search_result and
			// $search_results = $db->fetch_all_rows($query);
			// $total_search_result = $db->total_affected_rows();

			# -- Successful
			// static::$rows = $total_search_result;
			// self::set_results($search_results);
			self::set_results($query);
			return $search_term;

		}

		# -- Failed
		self::set_errors($errors);
		return 0;

	}


} //end class
