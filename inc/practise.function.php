<?php


function get_practise_areas($limit = 0, $start = 0, $sort_by_priority = true){
	
	global $db;

	$query = "SELECT id, name, content, priority FROM practices ORDER BY priority DESC, name ASC";

	if (!$sort_by_priority)
	$query = "SELECT id, name, content, priority FROM practices ORDER BY name ASC";

	if ($limit > 0){
		if ($start > 0){
			$query .= " LIMIT $start, $limit";
		} else {
			$query .= " LIMIT ". $limit;
		}
	}
	
	$rows = $db->fetch_all_row($query);

	
	return $rows;

}
function get_single_practise_areas($id){
	
	global $db;

	$query = "SELECT id, name, content, priority FROM practices WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_practise_areas(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_practise_areas($limit = 0){
	
	global $db;

	$query = "SELECT id FROM practices";

	return $db->total_affected_rows($query);

}

function exist_practise_areas($id){
	
	global $db;

	$query = "SELECT id FROM practices WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function decrease_practise_areas($id){
	
	global $db;

	$query = "SELECT id, priority FROM practices WHERE id = ".$id;

	$practice = $db->fetch_first_row($query);
	//Get the value of practice
	$practice['priority'] = $practice['priority'] - 1;

	if ($practice['priority'] < 1){
		$action = "less-priority";
	} else {
		if ($db->update_query('practices',$practice,"id=$id") > 0){
			$action = "update";
		} else {
			$action = "not-found";
		}		
	}

	return $action;
}
function increase_practise_areas($id){
	
	global $db;

	$query = "SELECT id, priority FROM practices WHERE id = ".$id;

	$practice = $db->fetch_first_row($query);
	//Get the value of practice
	$practice['priority'] = $practice['priority'] + 1;

	if ($practice['priority'] > 10){
		$action = "high-priority";
	} else {
		if ($db->update_query('practices',$practice,"id=$id") > 0){
			$action = "update";
		} else {
			$action = "not-found";
		}		
	}

	return $action;
}
function add_practise_areas($practice){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM practices WHERE name='".$practice['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('practices',$practice) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_practise_areas($practice, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM practices WHERE name='".$practice['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('practices',$practice,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_practise_areas($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM practices WHERE id = '$id'";
    $practise = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM practices WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}