<?php

function get_notifications($limit = 0){
	
	global $db;

	$query = "SELECT * FROM notifications ORDER BY published_date DESC ";
	

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_notifications($id){
	
	global $db;

	$query = "SELECT * FROM notifications WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_notification_by_name($url_name){
	
	global $db;

	$query = "SELECT * FROM notifications WHERE url_name = '".$url_name."'";

	return $db->fetch_first_row($query);
}

function get_total_notifications(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_notifications($limit = 0){
	
	global $db;

	$query = "SELECT id FROM notifications";

	return $db->total_affected_rows($query);

}

function exist_notifications($id){
	
	global $db;

	$query = "SELECT id FROM notifications WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function add_notifications($notification){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM notifications WHERE name='".$notification['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('notifications',$notification) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_notifications($notification, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM notifications WHERE name='".$notification['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('notifications',$notification,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_notifications($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM notifications WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM notifications WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}

function get_related_notifications($id, $limit = 1){

	global $db;

	$query = "SELECT * FROM notifications
			WHERE id <> $id
			LIMIT $limit";
	$rows = $db->fetch_all_row($query);
	
	return $rows;
}