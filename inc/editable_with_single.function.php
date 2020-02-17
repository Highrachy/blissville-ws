<?php

function activate_editable(){
	global $editor, $editable,$_GET, $can_edit;

	$can_edit = false;

	if (isset($_GET['editable']) && is_valid_admin() && ($_GET['editable'] == 1)){
		$can_edit = true;
	}

	$editor = true;

}

function update_single_editable($updated_content, $id, $table_name, $column_name){
	global $can_edit;
	$action = "";
	if ($can_edit){
			
		global $db, $_POST;

		$action = "";

		$data[$column_name] = $updated_content;

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

function make_single_editable($updated_content,$id=0,$table_name,$column_name){
	global $can_edit;
	if ($can_edit){
			
		$current_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		echo '<form method="post">';

		echo '<textarea name="updated_content" class="editable">'.$updated_content.'</textarea>';

		echo '<input type="hidden" name="id" value="'.$id.'">';

		echo '<input type="hidden" name="table_name" value="'.$table_name.'">';
		echo '<input type="hidden" name="column_name" value="'.$column_name.'">';

		echo '<input type="hidden" name="single_editable" value="single_editable">';

		if ($stop_link) echo '</a>';

		echo '
				<button type="submit" class="btn btn-info btn-xs">Update</button>
				&nbsp;
				<a class="btn btn-default btn-xs" href="'.$current_page.'"> Reset </a>';
		echo '</form>';
	}


}

function start_editable(){
	global $can_edit;
	if ($can_edit){
		echo '<form method="post">';
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
