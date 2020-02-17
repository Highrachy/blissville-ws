<?php

function get_news($limit = 0){
	
	global $db;

	$query = "SELECT * FROM news";
	

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}



function get_single_news($id){
	
	global $db;

	$query = "SELECT * FROM news WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_news_by_name($url_name){
	
	global $db;

	$query = "SELECT * FROM news WHERE url_name = '".$url_name."'";

	return $db->fetch_first_row($query);
}

function get_total_news(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_news($limit = 0){
	
	global $db;

	$query = "SELECT id FROM news";

	return $db->total_affected_rows($query);

}

function exist_news($id){
	
	global $db;

	$query = "SELECT id FROM news WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function add_news($news){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM news WHERE name='".$news['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('news',$news) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_news($news, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM news WHERE name='".$news['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('news',$news,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_news($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM news WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM news WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}


function get_related_news($limit = 1){

	global $db;

	$query = "SELECT* FROM news
			LIMIT $limit";
	$rows = $db->fetch_all_row($query);
	
	return $rows;
}
