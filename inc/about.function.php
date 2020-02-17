<?php


function get_about($limit = 0){
	
	global $db;

	$query = "SELECT * FROM abouts";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}


function get_single_abouts($id){
	
	global $db;

	$query = "SELECT * FROM abouts WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function total_abouts($limit = 0){
	
	global $db;

	$query = "SELECT id FROM abouts";

	return $db->total_affected_rows($query);

}
	
function get_total_abouts(){
	
	global $db;

	return $db->total_affected_rows();
}


function add_abouts($about){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM abouts WHERE name='".$about['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('abouts',$about) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}

function update_abouts($about, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM abouts WHERE name='".$about['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('abouts',$about,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_abouts($id){
	
	global $db;

	$action = "";

    $query = "SELECT picture FROM abouts WHERE id = '$id'";
    $about = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM abouts WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}