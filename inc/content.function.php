<?php


function get_single_content($content_id){
	
	global $db;

	$query = "SELECT id, name, picture, content FROM contents where id=".$content_id;
	$rows = $db->fetch_first_row($query);
	return $rows;

}


function get_page_content($page_id){
	
	global $db;

	$query = "SELECT id, name, picture, content FROM contents where page_id=".$page_id;
	$rows = $db->fetch_all_row($query);
	return $rows;

}

// function add_activity($type,$description,$activity_id=0){
	
// 	global $db;

// 	$activity['type'] = $type;
// 	$activity['description'] = $description;
// 	$activity['activity_id'] = $activity_id;
// 	$activity['created'] = 'NOW()';

// 	$value = $db->insert_query('hn_activity',$activity);

// }