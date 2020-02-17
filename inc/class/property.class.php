<?php
class Property extends Base{

	# -- Overwrite
	public static $table = "property";
	protected static $name = "property";
	protected static $upload_directory = "property";

	#-############################################
	# Add a New Property
	#-############################################
	public static function add(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Property Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);
	    # -- URL Name
	    $data['url_name'] = URL::readable($data['name']);

	    # -- Priority
	    $data['priority'] = Form::validate('priority',array('num' => 'Select a Priority between 1 - 10'));

		# -- Contents
		$data['content'] = Form::assign('content','minlen=10','Please enter a valid content');

		# -- Price
		$data['price'] = Form::assign('price', 'num','Please enter a valid Price. Numbers Only!!!');

		# -- Portfolio ID
		$data['portfolio_id'] = Form::assign('portfolio_id','req','Please select a valid Portfolio');

		# -- Property Type
		$data['property_type'] = Form::assign('property_type', 'minlen=3','Please enter a valid Property Type');

		# -- Location
		$data['location'] = Form::assign('location', 'minlen=5','Please enter a valid Location');

		# -- Size
		$data['size'] = Form::assign('size', 'minlen=5','Please enter a valid Size');

		# -- Bedroom
		$data['bedroom'] = Form::assign('bedroom', 'num','Select a valid Bedroom');

		# -- Living Room
		$data['living_room'] = Form::assign('living_room', 'num','Select a valid Living Room');

		# -- Kitchen
		$data['kitchen'] = Form::assign('kitchen', 'num','Select a valid Kitchen');

		# -- Toilet
		$data['toilet'] = Form::assign('toilet', 'num','Select a valid Toilet');

		# -- Bath Room
		$data['bathroom'] = Form::assign('bathroom', 'num','Select a valid Bath Room');

		# -- Parking Lots
		$data['parking_lots'] = Form::assign('parking_lots', 'num','Select a valid Parking Lot');

		# -- Floor
		$data['floor'] = Form::assign('floor', 'req','Select a valid Floor');

		# -- Cable TV
		$data['cable_tv'] = Form::assign('cable_tv', 'req','Select a valid Cable TV');

		# -- Core Fibre
		$data['core_fibre'] = Form::assign('core_fibre', 'req','Select a valid Core Fibre');

		# -- Inverter
		$data['inverter'] = Form::assign('inverter', 'req','Select a valid Inverter');

		# -- Security Fence
		$data['security_fence'] = Form::assign('security_fence', 'req','Select a valid Security Fence');

		# -- Car Port
		$data['car_port'] = Form::assign('car_port', 'req','Select a valid Car Port');

		# -- Guest Toilet
		$data['guest_toilet'] = Form::assign('guest_toilet', 'req','Select a valid Guest Toilet');

		# -- Guest Room
		$data['guest_room'] = Form::assign('guest_room', 'req','Select a valid Guest Room');

		# -- Maid Room
		$data['maid_room'] = Form::assign('maid_room', 'req','Select a valid Maid Room');

		# -- Surveillance
		$data['surveillance'] = Form::assign('surveillance', 'req','Select a valid Surveillance');

		# -- Smart Solar
		$data['smart_solar'] = Form::assign('smart_solar', 'req','Select a valid Smart Solar');

		# -- Panic Alarm
		$data['panic_alarm'] = Form::assign('panic_alarm', 'req','Select a valid Panic Alarm');

		# -- Intercom
		$data['intercom'] = Form::assign('intercom', 'req','Select a valid Intercom');

		# -- Video Door
		$data['video_door'] = Form::assign('video_door', 'req','Select a valid Video Door');

		# -- Fire Detection
		$data['fire_detection'] = Form::assign('fire_detection', 'req','Select a valid Fire Detection');

		# -- Water Treatment System
		$data['swimming_pool'] = Form::assign('swimming_pool', 'req','Select a valid Water Treatment System');

		# -- Rooftop Gym
		$data['rooftop_gym'] = Form::assign('rooftop_gym', 'req','Select a valid Rooftop Gym');

		# -- Priority
		$data['priority'] = Form::assign('priority', 'req','Select a valid Priority');


		# -- Property Image
		$data['picture'] = Form::validate('picture', array('picture' => 'Upload a valid image'));


		# - Created
		$data['created_at'] = "NOW()";



		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(),$errors);

		if (empty($errors)) { // No Errors

			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database

				$small_pics = Upload::image('picture',self::upload_directory('small'));
				$data['picture'] = Upload::file('picture',self::upload_directory());


				if (!empty($data['picture']))
					return self::add_to_database($data);

				$errors['picture'] = Upload::get_errors('picture');
			} else {
				$errors['error'] = 'The property name exists in the database';
			}

		}


		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Property
	#-############################################
	public static function update(){
		# -- Make Database connection
		global $db;
		$errors = array();

		# -- Property Name
		$data['name'] = Form::validate('name',array(
			'xters=6-100' => 'The name should be between 6 to 100 characters'
			)
		);
	    # -- URL Name
	    $data['url_name'] = URL::readable($data['name']);

	    # -- Priority
	    $data['priority'] = Form::validate('priority',array('num' => 'Select a Priority between 1 - 10'));

		# -- Contents
		$data['content'] = Form::assign('content','minlen=10','Please enter a valid content');

		# -- Price
		$data['price'] = Form::assign('price', 'num','Please enter a valid Price. Numbers Only!!!');

		# -- Portfolio ID
		$data['portfolio_id'] = Form::assign('portfolio_id','req','Please select a valid Portfolio');

		# -- Property Type
		$data['property_type'] = Form::assign('property_type', 'minlen=3','Please enter a valid Property Type');

		# -- Location
		$data['location'] = Form::assign('location', 'minlen=5','Please enter a valid Location');

		# -- Size
		$data['size'] = Form::assign('size', 'minlen=5','Please enter a valid Size');

		# -- Bedroom
		$data['bedroom'] = Form::assign('bedroom', 'num','Select a valid Bedroom');

		# -- Living Room
		$data['living_room'] = Form::assign('living_room', 'num','Select a valid Living Room');

		# -- Kitchen
		$data['kitchen'] = Form::assign('kitchen', 'num','Select a valid Kitchen');

		# -- Toilet
		$data['toilet'] = Form::assign('toilet', 'num','Select a valid Toilet');

		# -- Bath Room
		$data['bathroom'] = Form::assign('bathroom', 'num','Select a valid Bath Room');

		# -- Parking Lots
		$data['parking_lots'] = Form::assign('parking_lots', 'num','Select a valid Parking Lot');

		# -- Floor
		$data['floor'] = Form::assign('floor', 'req','Select a valid Floor');

		# -- Cable TV
		$data['cable_tv'] = Form::assign('cable_tv', 'req','Select a valid Cable TV');

		# -- Core Fibre
		$data['core_fibre'] = Form::assign('core_fibre', 'req','Select a valid Core Fibre');

		# -- Inverter
		$data['inverter'] = Form::assign('inverter', 'req','Select a valid Inverter');

		# -- Security Fence
		$data['security_fence'] = Form::assign('security_fence', 'req','Select a valid Security Fence');

		# -- Car Port
		$data['car_port'] = Form::assign('car_port', 'req','Select a valid Car Port');

		# -- Guest Toilet
		$data['guest_toilet'] = Form::assign('guest_toilet', 'req','Select a valid Guest Toilet');

		# -- Guest Room
		$data['guest_room'] = Form::assign('guest_room', 'req','Select a valid Guest Room');

		# -- Maid Room
		$data['maid_room'] = Form::assign('maid_room', 'req','Select a valid Maid Room');

		# -- Surveillance
		$data['surveillance'] = Form::assign('surveillance', 'req','Select a valid Surveillance');

		# -- Smart Solar
		$data['smart_solar'] = Form::assign('smart_solar', 'req','Select a valid Smart Solar');

		# -- Panic Alarm
		$data['panic_alarm'] = Form::assign('panic_alarm', 'req','Select a valid Panic Alarm');

		# -- Intercom
		$data['intercom'] = Form::assign('intercom', 'req','Select a valid Intercom');

		# -- Video Door
		$data['video_door'] = Form::assign('video_door', 'req','Select a valid Video Door');

		# -- Fire Detection
		$data['fire_detection'] = Form::assign('fire_detection', 'req','Select a valid Fire Detection');

		# -- Water Treatment System
		$data['swimming_pool'] = Form::assign('swimming_pool', 'req','Select a valid Water Treatment System');

		# -- Rooftop Gym
		$data['rooftop_gym'] = Form::assign('rooftop_gym', 'req','Select a valid Rooftop Gym');

		# -- Priority
		$data['priority'] = Form::assign('priority', 'req','Select a valid Priority');

		# -- Modified
		$data['updated_at'] = "NOW()";

		# -- Property ID
		$property_id = Form::assign('property_id','req');

		# - Picture
        $change_pics = false;
    	if (Form::is_valid_file('picture')){
	        $change_pics = true;
	        # -- Property Image
			$picture = Form::validate('picture', array('picture' => 'Upload a valid image'));
        }


		# -- Get Form Errors
		$errors = array_merge(Form::get_errors(), $errors);

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$property_id'")){ //No problem, name does not exist in the database

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

					return self::update_database($data,$property_id);
                }

			} else {
				$errors['error'] = 'The property name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Property
	#-############################################
	public static function delete(){
		# -- Make Database connection
		global $db;

		if (isset($_POST['Delete'])){
			$property_id = $_POST['Delete'];

			// Use exist_in_database
			// Get the name with the id
			if (self::exist_in_database('id',$property_id,"",'name')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$property = self::$results;

				if (self::delete_in_database($property_id,$property['name'])) { // If it ran OK.

					// Delete references to the property in the gallery table
					$query = "DELETE FROM ".Gallery::$table." WHERE property_id = '$property_id'";
					$value = $db->delete_row($query);

					// Delete references to the property in the testimonial table
					$query = "DELETE FROM ".Testimonial::$table." WHERE property_id = '$property_id'";
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
	# Property Box
	#-############################################
	public static function box($property,$additional_class = ""){
		extract($property);
		$portfolio_url = 'property.php?p='.$url_name;
		$formatted_price = '&#8358; ' . Number::to_number_words($price);
		if ($id == 2) { // 4 bedroom maisonette
			$formatted_price = '<strike> '.$formatted_price.'</strike> SOLD OUT';
		}
		return 	"		<div class=\"property-box\">
	                        <figure>
	                        	<a href=\"". URL::href($portfolio_url) ."\">
		                            <img src=\"".URL::href(self::upload_url($picture))."\" alt=\"$name\" class=\"img-responsive\">
		                            <div class=\"overlay\"></div>
		                        </a>
	                        </figure>
	                        <div class=\"item-detail\">

	                        	<h3 class=\"place m-0\">$name</h3>
	                        	<div class=\"item-info\">
	                                <span class=\"area\"><i class=\"fa fa-expand\"></i>$size</span>
	                                <span class=\"bed\"><i><img src=\"".URL::href('assets/images/icon/bed-icon.png')."\" alt=\"bed-icon\" /></i> $bedroom</span>
	                                <span class=\"bath\"><i><img src=\"".URL::href('assets/images/icon/bath-icon.png')."\" alt=\"bed-icon\" /></i>$bathroom</span>
	                        	</div>
	                        </div>
	                        <div class=\"item-detail item-detail-bordered\">
	                            <div class=\"left\">
	                        	<span class=\"price\">".$formatted_price."</span>
	                            </div>
	                            <div class=\"right\">

	                                <div><a href=\"". URL::href($portfolio_url) ."\" class=\"btn btn-primary btn-xs\">Details</a></div>
	                            </div>
	                        </div>
	                    </div>";
	}



	#-############################################
	# Available Features
	#-############################################
	public static function available_feature($feature_value, $feature_name){
		$output = "";
		if ($feature_value != 'NO'){

			$output .= '<li class="col-sm-6 ';

			if ($feature_value == 'PRE') {
				$output .= ' text-success strong';
			}
			$output .= '"> <img class="icon" src="'.URL::href('assets/images/');

			if (($feature_value == 'YES') || (intval($feature_value) >= 1))
				$output .= 'icon-check.png';
			else
				$output .= 'icon-check-green.png';

			$output .= '" alt="'.$feature_name.'" /> &nbsp;'.$feature_name.'</li>';
		}

		echo $output;
		return;
	}


	#-############################################
	# Join Query
	#-############################################
	public static function join_query(){

		return "SELECT
					p.id, p.name, p.url_name, p.price, p.priority, p.picture,
					ptf.name as portfolio_name,
					(
						SELECT COUNT( f2.property_id )
						FROM ".FloorPlan::$table." f2
						WHERE p.id = f2.property_id
					) AS floor_plan
					FROM ".self::$table." p
				 	LEFT JOIN ".FloorPlan::$table." f ON f.property_id = p.id
				 	LEFT JOIN ".Portfolio::$table." ptf ON ptf.id = p.portfolio_id

				 	GROUP BY p.name

				";
	}
} //end class
