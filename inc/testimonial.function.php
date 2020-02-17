<?php


function get_testimonials($limit = 0, $order_by_random= false, $approved = ''){
	
	global $db;

	$query = "SELECT * FROM testimonials";

	if (!empty($approved))
		$query .= " WHERE approved='".$approved."'";

	if ($order_by_random)
		$query .= " ORDER BY RAND()";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	if ($limit == 1)
		return $db->fetch_first_row($query);

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_testimonials($id){
	
	global $db;

	$query = "SELECT * FROM testimonials WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_testimonials(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_testimonials($limit = 0){
	
	global $db;

	$query = "SELECT id FROM testimonials";

	return $db->total_affected_rows($query);

}

function exist_testimonials($id){
	
	global $db;

	$query = "SELECT id FROM testimonials WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function approve_testimonial($id){
	
	global $db;

	//Set the value of the testimonial
	$testimonial['approved'] = 'YES';

	if ($db->update_query('testimonials',$testimonial,"id=$id") > 0){
		$action = "update";
	} else {
		$action = "not-found";
	}	

	return $action;
}

function disapprove_testimonial($id){
	
	global $db;

	//Set the value of the testimonial
	$testimonial['approved'] = 'NO';

	if ($db->update_query('testimonials',$testimonial,"id=$id") > 0){
		$action = "update";
	} else {
		$action = "not-found";
	}	

	return $action;
}

function add_testimonials($testimonial){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM testimonials WHERE name='".$testimonial['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('testimonials',$testimonial) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_testimonials($testimonial, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM testimonials WHERE name='".$testimonial['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('testimonials',$testimonial,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_testimonials($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM testimonials WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM testimonials WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}