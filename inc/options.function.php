<?php
function get_options(){
	
	global $db;

	$query = "SELECT * FROM options";
	$rows = $db->fetch_all_row($query);

	$options = array();

	foreach($rows as $row){
		$options[$row['name']] = $row['value'];

	}
	return $options;

}

function update_options($value, $id){
	
	global $db;

	$action = "";

	$options['value'] = $value;
	$options['updated_at'] = 'NOW()';

	if ($db->update_query('options',$options,"id=$id") > 0){
		$action = "update";
	} else {
		trigger_error('System error. We apologize for any inconvenience.');
	}	
	
	return $action;
}