<?php

function get_events($limit = 0, $order_by_date = false){
	
	global $db;

	$query = "SELECT * FROM events";
	
	if ($order_by_date)
		$query .= " ORDER BY event_date DESC";


	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_latest_events($limit = 0, $must_get_records = true){
	
	global $db;

	$query = "SELECT * FROM events WHERE event_date > NOW() ORDER BY event_date ASC";


	if ($must_get_records && ($db->total_affected_rows($query) < $limit)){
		$query = "SELECT * FROM events ORDER BY event_date DESC";
	}
	

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}
function get_past_events($limit = 0){
	
	global $db;

	$query = "SELECT * FROM events WHERE event_date < NOW() ORDER BY event_date DESC";


	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_events($id){
	
	global $db;

	$query = "SELECT * FROM events WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_events(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_events($query = ""){
	
	global $db;

	if ($query == "")
	$query = "SELECT id FROM events";

	return $db->total_affected_rows($query);

}

function exist_events($id){
	
	global $db;

	$query = "SELECT id FROM events WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function add_events($event){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM events WHERE name='".$event['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('events',$event) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}

function update_events($event, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM events WHERE name='".$event['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('events',$event,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_events($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM events WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM events WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}