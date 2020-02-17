<?php

function activate_editable(){
	global $editor, $editable,$_GET, $can_edit;

	$can_edit = false;

	if (isset($_SESSION['name']) && (isset($_SESSION['id'])) && (isset($_GET['editable'])) && ($_GET['editable'] == 1))
		$can_edit = true;
	
	$editor = true;

}

function start_editable(){
	global $can_edit;
	if ($can_edit){
		echo '<form class="live-edit" method="post">';
	}
}

function make_editable($updated_content,$column_name){
	global $can_edit;
	if ($can_edit){
		echo '<textarea name="data['.$column_name.']" class="editable">'.$updated_content.'</textarea>';
	} else {
		echo $updated_content;
	}
}

function header_editable($updated_content,$column_name){
	global $can_edit;
	if ($can_edit){
		echo '<textarea name="data['.$column_name.']" class="header-editable">'.$updated_content.'</textarea>';
	} else {
		echo $updated_content;
	}
}

function end_editable($id=0,$table_name){
	global $can_edit;

	if ($can_edit){
		$current_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		echo '<input type="hidden" name="id" value="'.$id.'">';

		echo '<input type="hidden" name="table_name" value="'.$table_name.'">';

		echo '<input type="hidden" name="editable" value="editable">';

		echo '
				<button type="submit" class="btn btn-info btn-xs btn-editable">Update</button>
				<a class="btn btn-default btn-xs btn-editable" href="'.$current_page.'"> Reset </a>';
		echo '</form>';
	}
	
}

function update_editable($data, $id, $table_name){
	global $can_edit;

	$action = "";

	if ($can_edit){
			
		global $db, $_POST;

		$action = "";

		$data['updated_at'] = 'NOW()';

		if ($db->update_query($table_name,$data,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}

		$_POST = array();
		unset($_POST);	

	}
	
	return $action;

}

