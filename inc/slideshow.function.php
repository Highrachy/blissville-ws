<?php


function get_slideshow($limit = 0, $order_by_random= false, $show_picture = false){
	
	global $db;

	$query = "SELECT * FROM slideshows";

	if ($show_picture )
		$query .= " WHERE show_picture='YES'";

	if ($order_by_random)
		$query .= " ORDER BY RAND(), priority";
	else
		$query .= " ORDER BY priority DESC ";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;


	$rows = $db->fetch_all_row($query);

	
	return $rows;

}

function get_single_slideshows($id){
	
	global $db;

	$query = "SELECT * FROM slideshows WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_slideshows(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_slideshows($limit = 0){
	
	global $db;

	$query = "SELECT id FROM slideshows";

	return $db->total_affected_rows($query);

}

function exist_slideshows($id){
	
	global $db;

	$query = "SELECT id FROM slideshows WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function decrease_slideshows($id){
	
	global $db;

	$query = "SELECT id, priority FROM slideshows WHERE id = ".$id;

	$slideshow = $db->fetch_first_row($query);

	if (empty($slideshow)){
		$action = "not-found";
	} else {

		//Get the value of slideshow
		$slideshow['priority'] = $slideshow['priority'] - 1;

		if ($slideshow['priority'] < 1){
			$action = "less-priority";
		} else {
			if ($db->update_query('slideshows',$slideshow,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}

	}
	return $action;
}

function increase_slideshows($id){
	
	global $db;

	$query = "SELECT id, priority FROM slideshows WHERE id = ".$id;

	$slideshow = $db->fetch_first_row($query);

	if (empty($slideshow)){
		$action = "not-found";
	} else {
		//Get the value of slideshow
		$slideshow['priority'] = $slideshow['priority'] + 1;

		if ($slideshow['priority'] > 10){
			$action = "high-priority";
		} else {
			if ($db->update_query('slideshows',$slideshow,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}
	}

	return $action;
}

function toggle_slideshows($id){
	
	global $db;

	$query = "SELECT show_picture FROM slideshows WHERE id = ".$id;

	$slideshow = $db->fetch_first_row($query);

	if (empty($slideshow)){
		$action = "not-found";
	} else {

		if ($slideshow['show_picture'] == 'YES'){
			$slideshow['show_picture'] = 'NO';
		} else {
			$slideshow['show_picture'] = 'YES';
		}
		
		if ($db->update_query('slideshows',$slideshow,"id=$id") > 0){
			$action = "update";
		} else {
			$action = "not-found";
		}		
	}

	return $action;
}

function add_slideshows($slideshow){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM slideshows WHERE name='".$slideshow['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('slideshows',$slideshow) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_slideshows($slideshow, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM slideshows WHERE name='".$slideshow['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('slideshows',$slideshow,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_slideshows($id){
	
	global $db;

	$action = "";

    $query = "SELECT picture FROM slideshows WHERE id = '$id'";
    $slideshow = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM slideshows WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
        #- Delete Old Picture
		$to_delete = UPLOAD_DIR. 'slideshow/'.$slideshow['picture'];
		unlink($to_delete);
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}