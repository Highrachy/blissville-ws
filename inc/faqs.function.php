<?php


function get_faqs($limit = 0){
	
	global $db;

	$query = "SELECT * FROM faqs";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function list_faqs($limit = 0){
	
	global $db;

	$query = "SELECT f.id, f.question, f.answer, f.priority, c.name as category, c.id as category_id FROM faqs f INNER JOIN faqs_category c ON f.category = c.id ORDER BY c.priority DESC,category ASC, f.priority DESC";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_faqs($id){
	
	global $db;

	$query = "SELECT  f.id, f.question, f.answer, f.priority, c.name as category, c.id as category_id FROM faqs f INNER JOIN faqs_category c ON f.category = c.id WHERE f.id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_faqs(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_faqs($limit = 0){
	
	global $db;

	$query = "SELECT id FROM faqs";

	return $db->total_affected_rows($query);

}

function exist_faqs($id){
	
	global $db;

	$query = "SELECT id FROM faqs WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function approve_faqs($id){
	
	global $db;

	//Set the value of the faqs
	$faqs['approved'] = 'YES';

	if ($db->update_query('faqs',$faqs,"id=$id") > 0){
		$action = "update";
	} else {
		$action = "not-found";
	}	

	return $action;
}

function disapprove_faqs($id){
	
	global $db;

	//Set the value of the faqs
	$faqs['approved'] = 'NO';

	if ($db->update_query('faqs',$faqs,"id=$id") > 0){
		$action = "update";
	} else {
		$action = "not-found";
	}	

	return $action;
}

function add_faqs($faqs){
	
	global $db;

	$action = "";
	
 	// Check if the question exists in the database
	$query = "SELECT question FROM faqs WHERE question='".$faqs['question']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, question does not exist in the database
		if ($db->insert_query('faqs',$faqs) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_faqs($faqs, $id){
	
	global $db;

	$action = "";
	
 	// Check if the question exists in the database with a different Id
	$query = "SELECT question FROM faqs WHERE question='".$faqs['question']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('faqs',$faqs,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_faqs($id){
	
	global $db;

	$action = "";

    $query = "SELECT question FROM faqs WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM faqs WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}

function get_faqs_category(){
	
	global $db;

	$query = "SELECT * FROM faqs_category";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function add_faq_category($category){
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT id FROM faqs_category WHERE name='".$category['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		$added = $db->insert_query('faqs_category',$category);
		if ( $added > 0){
			return $added;
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$added = $db->fetch_first_row($query);
		return $added['id'];
	}

}


function decrease_faqs($id){
	
	global $db;

	$query = "SELECT id, priority FROM faqs WHERE id = ".$id;

	$faq = $db->fetch_first_row($query);
	//Get the value of faq
	$faq['priority'] = $faq['priority'] - 1;

	if ($faq['priority'] < 1){
		$action = "less-priority";
	} else {
		if ($db->update_query('faqs',$faq,"id=$id") > 0){
			$action = "update";
		} else {
			$action = "not-found";
		}		
	}

	return $action;
}
function increase_faqs($id){
	
	global $db;

	$query = "SELECT id, priority FROM faqs WHERE id = ".$id;

	$faq = $db->fetch_first_row($query);
	//Get the value of faq
	$faq['priority'] = $faq['priority'] + 1;

	if ($faq['priority'] > 10){
		$action = "high-priority";
	} else {
		if ($db->update_query('faqs',$faq,"id=$id") > 0){
			$action = "update";
		} else {
			$action = "not-found";
		}		
	}

	return $action;
}