<?php

function is_feature_available($option){
	if (($option == 'YES') || $option >= 1)
		echo 'icon-check.png';
	else
		echo 'icon-check-green.png';

	return;
}

function available_feature($feature_value, $feature_name){
	$output = "";
	if ($feature_value != 'NO'){

		$output .= '<li class="col-sm-6 ';

		if ($feature_value == 'PRE') {
			$output .= ' text-success strong';
		}
		$output .= '"> <img class="icon" src="'.get_href('assets/images/');

		if (($feature_value == 'YES') || (intval($feature_value) >= 1))
			$output .= 'icon-check.png';
		else
			$output .= 'icon-check-green.png';

		$output .= '" alt="'.$feature_name.'" /> &nbsp;'.$feature_name.'</li>';
	}

	echo $output;
	return;
}


function get_portfolio($limit = 0,$sorted="",$start="0"){
	
	global $db;

	$query = "SELECT * FROM portfolios WHERE id > 1";


	$query .= " ORDER BY priority DESC";

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	//for dashboard sorting
	if (!empty($sorted))
		$query = "SELECT * FROM portfolios WHERE id > 1 ORDER BY $sorted LIMIT $start,$limit";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_portfolio_content($url_name){
	
	global $db;

	if (!empty($url_name)) { 
		$query = "SELECT * FROM portfolios WHERE  (id > 1) AND (url_name = '".$url_name."')";

		$portfolio =  $db->fetch_first_row($query);
	}


	if (empty($portfolio)){

		$query = "SELECT * FROM portfolios  WHERE id > 1 ORDER BY priority DESC";
		$portfolio = $db->fetch_first_row($query);

	}

	return $portfolio;
}


function get_other_portfolio_content($url_name){
	
	global $db;

	$portfolio = array();

	if (!empty($url_name)) { 
		$query = "SELECT * FROM portfolios WHERE  (id > 1) AND (url_name <> '".$url_name."')";

		$portfolio =  $db->fetch_all_row($query);
	}

	return $portfolio;
}

function get_single_portfolio($id){
	
	global $db;

	$query = "SELECT * FROM portfolios WHERE id = ".$id;

	return $db->fetch_first_row($query);
}

function get_total_portfolios(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_portfolios($limit = 0){
	
	global $db;

	$query = "SELECT id FROM portfolios WHERE id > 1";

	return $db->total_affected_rows($query);

}

function exist_portfolios($id){
	
	global $db;

	$query = "SELECT id FROM portfolios WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function decrease_portfolios($id){
	
	global $db;

	$query = "SELECT id, priority FROM portfolios WHERE id = ".$id;

	$portfolio = $db->fetch_first_row($query);

	if (empty($portfolio)){
		$action = "not-found";
	} else {

		//Get the value of portfolio
		$portfolio['priority'] = $portfolio['priority'] - 1;

		if ($portfolio['priority'] < 1){
			$action = "less-priority";
		} else {
			if ($db->update_query('portfolios',$portfolio,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}

	}
	return $action;
}

function increase_portfolios($id){
	
	global $db;

	$query = "SELECT id, priority FROM portfolios WHERE id = ".$id;

	$portfolio = $db->fetch_first_row($query);

	if (empty($portfolio)){
		$action = "not-found";
	} else {
		//Get the value of portfolio
		$portfolio['priority'] = $portfolio['priority'] + 1;

		if ($portfolio['priority'] > 10){
			$action = "high-priority";
		} else {
			if ($db->update_query('portfolios',$portfolio,"id=$id") > 0){
				$action = "update";
			} else {
				$action = "not-found";
			}		
		}
	}

	return $action;
}

function add_portfolios($portfolio){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM portfolios WHERE name='".$portfolio['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('portfolios',$portfolio) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_portfolios($portfolio, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM portfolios WHERE name='".$portfolio['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('portfolios',$portfolio,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_portfolios($id){
	
	global $db;

	$action = "";

    $query = "SELECT picture FROM portfolios WHERE id = '$id'";
    $portfolio = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM portfolios WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}