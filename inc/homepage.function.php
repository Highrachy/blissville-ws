<?php


function get_homepage($limit = 0){
	
	global $db;

	$query = "SELECT * FROM homepages";


	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_homepage_content($url_name){
	
	global $db;

	if (!empty($url_name)) { 
		$query = "SELECT * FROM homepages WHERE url_name = '".$url_name."'";

		$homepage =  $db->fetch_first_row($query);
	}


	if (empty($homepage)){

		$query = "SELECT * FROM homepages ORDER BY priority DESC";
		$homepage = $db->fetch_first_row($query);

	}

	return $homepage;
}

function get_homepage_sidebar(){
	
	global $db;

	$query = "SELECT * FROM homepages";

	$homepage =  $db->fetch_all_row($query);

	return $homepage;
}

function get_single_homepages($id){
	
	global $db;

	$query = "SELECT * FROM homepages WHERE id = ".$id;

	return $db->fetch_first_row($query);
}


function get_total_homepages(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_homepages($limit = 0){
	
	global $db;

	$query = "SELECT id FROM homepages";

	return $db->total_affected_rows($query);

}

function exist_homepages($id){
	
	global $db;

	$query = "SELECT id FROM homepages WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function decrease_homepages($id){
	
	global $db;

	$query = "SELECT id, priority FROM homepages WHERE id = ".$id;

	$homepage = $db->fetch_first_row($query);

	if (empty($homepage)){
		$action = "not-found";
	} else {

		//Get the value of homepage
		$homepage['priority'] = $homepage['priority'] - 1;

		if ($homepage['priority'] < 1){
			$action = "less-priority";
		} else {
			if ($db->update_query('homepages',$homepage,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}

	}
	return $action;
}

function increase_homepages($id){
	
	global $db;

	$query = "SELECT id, priority FROM homepages WHERE id = ".$id;

	$homepage = $db->fetch_first_row($query);

	if (empty($homepage)){
		$action = "not-found";
	} else {
		//Get the value of homepage
		$homepage['priority'] = $homepage['priority'] + 1;

		if ($homepage['priority'] > 10){
			$action = "high-priority";
		} else {
			if ($db->update_query('homepages',$homepage,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}
	}

	return $action;
}


function add_homepages($homepage){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM homepages WHERE name='".$homepage['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('homepages',$homepage) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_homepages($homepage, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM homepages WHERE name='".$homepage['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('homepages',$homepage,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_homepages($id){
	
	global $db;

	$action = "";

    $query = "SELECT picture FROM homepages WHERE id = '$id'";
    $homepage = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM homepages WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}