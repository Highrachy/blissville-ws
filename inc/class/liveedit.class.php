<?php

class LiveEdit {

	protected static $can_edit = false;

	public static function activate(){
		self::$can_edit = false;

		//Update can_edit to true for easier troubleshooting
		// self::$can_edit = true;

		if ((isset($_SESSION['id'])) && (isset($_GET['editable'])) && ($_GET['editable'] == 1))
			self::$can_edit = true;
		
		return self::$can_edit;

	}


	public static function start(){
		if (self::$can_edit){
			echo '<form class="live-edit" method="post">';
		}
	}


	public static function content($updated_content,$column_name){
		if (self::$can_edit){
			echo '<textarea name="data['.$column_name.']" class="editable">'.$updated_content.'</textarea>';
		} else {
			echo $updated_content;
		}
	}

	public static function header($updated_content,$column_name){
		if (self::$can_edit){
			echo '<textarea name="data['.$column_name.']" class="header-editable">'.$updated_content.'</textarea>';
		} else {
			echo $updated_content;
		}
	}
	public static function end($id=0,$table_name){

		if (self::$can_edit){
			$current_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			echo '<input type="hidden" name="id" value="'.$id.'">';

			echo '<input type="hidden" name="table_name" value="'.$table_name.'">';

			echo '<input type="hidden" name="editable" value="editable">';

			echo '
					<button type="submit" class="btn btn-primary btn-xs btn-editable">Update</button>
					<a class="btn btn-default btn-xs btn-editable" href="'.$current_page.'"> Reset </a>';
			echo '</form>';
		}
		
	}

	public static function update($data, $id, $table_name){
		global $success;
		$action = "";

		if (self::$can_edit){
				
			global $db, $_POST;

			$action = "";

			$data['updated_at'] = 'NOW()';

			if ($db->update_query($table_name,$data,"id=$id") > 0){
				$action = "update";
				$success = "Your Page has been successfully updated";
			} else {
				trigger_error('System error. We apologize for any inconvenience.');
			}

			$_POST = array();
			unset($_POST);	

		}
		
		return $action;

	}

	public static function save($data,$id,$table_name){
		$action = "";
		//Verify if it is editable
		if (isset($_POST['editable']) && ($_POST['editable'] == 'editable')){
			extract($_POST);
			$action = self::update($data, $id, $table_name);
		}
		return $action;
	}

}




