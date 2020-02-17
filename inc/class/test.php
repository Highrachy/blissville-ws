<?php
	if (isset($_POST) && (!empty($_POST))){
		$selected_value = array();
		$name = "food[]";
		$name = preg_replace('/[^a-zA-Z0-9]/', '', $name);
      //Get all the values sent from the form
      for ($i=0;$i<count($_POST[$name]);$i++)
      //Assign them into teh chosen value
      $selected_value[] = $_POST[$name][$i];

		var_dump($selected_value);
	} 
?>

<form action="#" method="post">
	<input type="checkbox" name="food[]" id="dodo" value="dodo" class ="form-control">Dodo<br><br>
	<input type="checkbox" name="food[]" id="fish" value="fish" class ="form-control">Fish<br><br>
	<input type="checkbox" name="food[]" id="ponmo" value="ponmo" class ="form-control">Ponmo<br><br>
	<input type="checkbox" name="food[]" id="beans" value="beans" class ="form-control">Beans<br><br>
<input type="submit">
</form>