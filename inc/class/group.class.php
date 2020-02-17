<?php
class Group extends Base{

	# -- Overwrite
	public static $table = "ism-slideshow";
	protected static $name = "slideshow";

	#-############################################
	# Add a New Group
	#-############################################
	public static function add(){
		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		# -- Group Name
		$data['name'] = Form::assign('name','minlen=3','Please enter a valid Group Name');

		# - Created
		$data['created'] = "NOW()";


		if (empty($errors)) { // No Errors
			// Check if the email address exists in the database
			// Add to database only if it doesn't exist in database
			if (!self::exist_in_database('name',$data['name'])){ //No problem, email does not exist in the database
				return self::add_to_database($data);
			} else {
				$errors['error'] = 'The group name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Edit existing Group
	#-############################################
	public static function update(){
		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		# -- Group Name
		$data['name'] = Form::assign('name','minlen=3','Please enter a valid Group Name');

		# -- Group ID
		$group_id = $_POST['group_id'];

		#- Modified
		$data['modified'] = "NOW()";

		if (empty($errors)) { // No Errors

			// Check if the name exist in the database
			if (!self::exist_in_database('name',$data['name']," AND id <> '$group_id'")){ //No problem, name does not exist in the database
				return self::update_database($data,$group_id);
			} else {
				$errors['error'] = 'The group name exists in the database';
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}


	#-############################################
	# Delete existing Group
	#-############################################
	public static function delete(){
		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (isset($_POST['Delete'])){
			$group_id = $_POST['Delete'];

			// Use exist_in_database 
			// Get the name with the id
			if (self::exist_in_database('id',$group_id,"",'name')) { // No problems! You can delete, file exist;

				// Get the row to be deleted
				$group = self::$results;

				if (self::delete_in_database($group_id,$group['name'])) { // If it ran OK.

					// Delete references to the group in the contactgroup table
					$query = "DELETE FROM hn_contactgroup WHERE group_id = '$group_id'";
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
	# Add a New Contact to the Group
	#-############################################
	public static function add_contacts(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		# -- Get the Contact
		if (empty($_POST['contacts'])){
			$errors['error'] = "Please select the email you wish to add to the group";
		} else {
			$contacts = $_POST['contacts'];
		}

		# - Created
		$data['created'] = "NOW()";


		if (empty($errors)) { // No Errors

			//Loop to add the contacts to the group
			$data['group_id'] = $group_id = $_POST['group_id'];

			foreach ($contacts as $contact){
				//Check if the contact exist in the group
				$query = "SELECT id FROM hn_contactgroup WHERE contact_id = '$contact' AND group_id = '$group_id'";
				$rows = $db->total_affected_rows($query);

				if ($rows == 0){ //No problem, the contact can be added to the group
					$data['contact_id'] = $contact;

					$value = $db->insert_query('hn_contactgroup',$data);
				}
			}

			if ($value >= 1) { // If the insertion is successful
				return $value;
			}

		}

		# -- Failed
		self::set_errors($errors);
		return 0;

	}


	#-############################################
	# Remove Contact to the Group
	#-############################################
	public static function remove_contacts(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		# -- Get the Contact
		if (empty($_POST['contacts'])){
			$errors['error'] = "Kindly select the email you wish to remove to the group";
		} else {
			$contacts = $_POST['contacts'];
		}

		if (empty($errors)) { // No Errors

			//Loop to remove the contacts to the group
			$data['group_id'] = $group_id = $_POST['group_id'];

			foreach ($contacts as $contact){
				//Check if the contact exist in the group
				$query = "DELETE FROM hn_contactgroup WHERE contact_id = '$contact' AND group_id = '$group_id' LIMIT 1";
				$result = $db->delete_row($query);
			}

			return $result;

		}

		# -- Failed
		self::set_errors($errors);
		return 0;

	}


	#-############################################
	# Add 1 Contact to the Group
	#-############################################
	public static function add_one_contact(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (!empty($_GET['contact']) && !empty($_GET['group'])){
			$contacts = $_GET['contact'];
			$group_id = $_GET['group'];

			# - Database Value
			$data['contact_id'] = $contacts;
			$data['group_id'] = $group_id;
			$data['created'] = "NOW()";

			//Check if the contact exist in the group
			$query = "SELECT id FROM hn_contactgroup WHERE contact_id = '$contact' AND group_id = '$group_id'";
			$rows = $db->total_affected_rows($query);

			if ($rows == 0){ //No problem, the contact can be added to the group
				$value = $db->insert_query('hn_contactgroup',$data);
			}

			# -- Success
			return $value;
		}

		# -- Fail
		return 0;
	}


	#-############################################
	# Remove 1 Contact to the Group
	#-############################################
	public static function remove_one_contact(){

		# -- Make Database connection
		$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (!empty($_GET['contacts']) && !empty($_GET['group_id'])){
			$contacts = $_GET['contacts'];
			$group_id = $_GET['group_id'];

			$query = "DELETE FROM hn_contactgroup WHERE contact_id = '$contact' AND group_id = '$group_id' LIMIT 1";
			$result = $db->delete_row($query);

			return $result;

		}

		# -- Fail
		return 0;
	}


	#-############################################
	# Search for Contacts in the Group
	#-############################################
	public static function search_contact($search_term,$group_id=0){

			# -- Make Database connection
			$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			// remove unncessary spaces from the search term
			$search_term = trim($search_term);

			// Search Term cannot be empty
			if (empty($search_term)){
				$errors['error'] = "The Search Term cannot be empty";
			}

			// Dont search for any word less than 3
			if (strlen($search_term) < 3){
				$errors['error'] = "The Search Term must be greater or equal to 3 characters";
			}

			if (empty($errors)){

				// Column to Search in the database
				$column_name = array('c.email','c.first_name','c.last_name','c.company');

				// Generate the Where Query
				$where_query = Search::generate_where_query($search_term, $column_name);

				$query = "";
				$query = "SELECT c.id as id,c.email as email, c.first_name, c.last_name
							FROM hn_contactgroup
							INNER JOIN hn_contacts c ON hn_contactgroup.contact_id = c.id
							WHERE group_id = $group_id AND ";

				//Change the query if all Contacts is selected
				if ($group_id == 0){
					$query =  "SELECT c.id as id,c.email as email, c.first_name, c.last_name
							FROM  hn_contacts c WHERE ";
				}

				// The search query is placed in bracket to group
				$query .= "($where_query) ORDER BY c.first_name ASC";

				// Get total_search_result and
				$search_results = $db->fetch_all_rows($query);
				$total_search_result = $db->total_affected_rows();

				# -- Successful
				self::set_results($search_results);
				return $total_search_result;

			}

			# -- Failed
			self::set_errors($errors);
			return 0;

	}

	#-############################################
	# Build Search Table
	#-############################################
	public static function build_search_table($search_term="",$search_results=""){

		$output="";
		$count = 1;
		$single_word = explode(" ",$search_term);

		if (!empty($search_results)) {
				$output .= '<div class="table-responsive">
											<table class="table table-striped table-condensed table-hover responsive">
												<tbody>';


				foreach ($search_results as $result){

					$full_name = trim($result['first_name']. ' '. $result['last_name']);
					$email = $result['email'];


					foreach ($single_word as $word){
							$full_name = Search::highlight($word,$full_name);
							$email = Search::highlight($word,$email);
					}

					if (!empty($full_name)){
						$full_name = $full_name . '<br>';
					}

					$output .='<tr>
											<td class="text-center">&nbsp; '. $count++ .'</td>
											<td><small><strong>'. $full_name .'</strong></small>
												<a href="'.URL::href('contacts/view.php?contact='.$result['id']).'">'
												.$email.' </a>&nbsp;&nbsp;
										 </td>
										</tr>';
				} //end for each


				$output .='		</tbody>
										</table>
									</div>';
		} else {// end if not empty
					$output .= "<br><br><br><p class='text-center text-gray'>No search found <br> for <em>$search_term</em></p>";
		}//end else

		return $output;
	}

} //end class
