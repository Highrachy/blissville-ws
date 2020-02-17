<?php


function get_teams($limit = 0, $dept = ""){
	
	global $db;

	$query = "SELECT * FROM teams";

	if (!empty($dept))
		$query .= " WHERE department='".$dept."'";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_departments(){
	
	global $db;

	$query = "SELECT DISTINCT department FROM teams";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_teams($id){
	
	global $db;

	$query = "SELECT * FROM teams WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_teams(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_teams($limit = 0){
	
	global $db;

	$query = "SELECT id FROM teams";

	return $db->total_affected_rows($query);

}

function exist_teams($id){
	
	global $db;

	$query = "SELECT id FROM teams WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}

function add_teams($team){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM teams WHERE name='".$team['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('teams',$team) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}


function add_team_content($content){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM team_content WHERE name='".$content['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('team_content',$content) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}


function update_teams($team, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM teams WHERE name='".$team['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('teams',$team,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}


function update_team_content($content){
	
	global $db;

	$action = "";

	$id 	= $content['id'];
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM team_content WHERE name='".$content['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('team_content',$content,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}


function delete_teams($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM teams WHERE id = '$id'";
    $team = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM teams WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}


function delete_team_content($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM team_content WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM team_content WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}