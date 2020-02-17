<?php

function get_trainings($limit = 0, $order_by_date = false){
	
	global $db;

	$query = "SELECT * FROM trainings";
	
	if ($order_by_date)
		$query .= " ORDER BY training_date DESC";


	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_latest_trainings($limit = 0, $must_get_records = true){
	
	global $db;

	$query = "SELECT * FROM trainings WHERE training_date > NOW() ORDER BY training_date ASC";


	if ($must_get_records && ($db->total_affected_rows($query) < $limit)){
		$query = "SELECT * FROM trainings ORDER BY training_date DESC";
	}
	

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}
function get_past_trainings($limit = 0){
	
	global $db;

	$query = "SELECT * FROM trainings WHERE training_date < NOW() ORDER BY training_date DESC";


	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_trainings($id){
	
	global $db;

	$query = "SELECT * FROM trainings WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_trainings(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_trainings($query = ""){
	
	global $db;

	if ($query == "")
	$query = "SELECT id FROM trainings";

	return $db->total_affected_rows($query);

}

function exist_trainings($id){
	
	global $db;

	$query = "SELECT id FROM trainings WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function add_trainings($training){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM trainings WHERE name='".$training['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('trainings',$training) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}

function update_trainings($training, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM trainings WHERE name='".$training['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('trainings',$training,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_trainings($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM trainings WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM trainings WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}