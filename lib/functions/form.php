<?php



	# - All Functions
		# 1.  Text($name, $value, $others)
		# 2.  Password($name, $value, $others)
		# 3.  FileUpload($name, $others)
		# 4.  Radio($name, $value,$checked, $others)
		# 5.  CheckBox($name, $value,$checked, $others)
		# 6.  Select($name,$data,$value,$others) => data = (val,key) or (val)
		# 7.  Textarea($name,$value,$others)
		# 8.  Hidden($name,$value)

	

function Text($name, $value=false,$others=false) {

	//Check the Value
	$value = checkValue($name,$value);
	
	//Start Creating the TextBox
	echo '<input type="text" name="' . $name . '" id="' . $name . '"';
	
	// Add the value to the input:
	if ($value) echo ' value="' . htmlspecialchars($value) . '"';

	// Get the other attributes function
	get_others($name,$others);

	//append the ending tag to the text element
	echo '>';	
}	

function Email($name, $value=false,$others=false) {

	//Check the Value
	$value = checkValue($name,$value);
	
	//Start Creating the TextBox
	echo '<input type="email" name="' . $name . '" id="' . $name . '"';
	
	// Add the value to the input:
	if ($value) echo ' value="' . htmlspecialchars($value) . '"';

	// Get the other attributes function
	get_others($name,$others);

	//append the ending tag to the text element
	echo '>';	
}

function Password($name, $value=false,$others=false) {
	//Check the Value
	$value = checkValue($name,$value);
	
	//Start Creating the Password Field
	echo '<input type="password" name="' . $name . '" id="' . $name . '"';
	
	// Add the value to the input:
	if ($value) echo ' value="' . htmlspecialchars($value) . '"';
	
	// Get the other attributes function
	get_others($name,$others);
	
	//append the ending tag to the password element
	echo '>';	
}

function FileUpload($name,$others="") {
	
	//Start Creating the File Upload Field
	echo '<input type="file" name="' . $name . '" id="' . $name . '"';
	

	// Get the other attributes function
	get_others($name,$others);
	
	//append the ending tag to the password element
	echo '>';	
}

function Radio($name, $value,$checked=false,$others=false) {

	$chosen_value ="";
	//Check if the value has been posted
	if (isset($_POST[$name])){

		//Assign posted value
		$chosen_value = $_POST[$name];
		if (get_magic_quotes_gpc()) $chosen_value = stripslashes($chosen_value);
	}
	
	//Start Creating the Radio Button
	echo '<input type="radio" name="' . $name . '" id="' . $value . '" value="' . htmlspecialchars($value) . '"';
	
	//If there is a posted value and the posted value is this value
	if (($chosen_value == $value)) echo ' checked';
	
	//if there is no posted value but this value is checked by default
	elseif (($checked)) echo ' checked';
	

	// Get the other attributes function
	get_others($name,$others);
	
	//append the ending tag to the password element
	echo '>';
}

function CheckBox($name, $value,$checked=false,$others=false) {
	//Check the Value
	$chosen_value[] = array();
	//Assume check box is not marked by default
	$mark = false;
	
	//Get the values passed into the checkbox
	if (isset($_POST[$name])){
		//Get all the values sent from the form
		for ($i=0;$i<count($_POST[$name]);$i++)
		//Assign them into teh chosen value
		$chosen_value[] = $_POST[$name][$i];
	} else $mark = true; //If values is not passed, mark the default checkboxes
	
	
	//Start Creating the Checkbox
	echo '<input type="checkbox" name="' . $name . '[]" id="' .$name.$value . '" value="' . htmlspecialchars($value) . '"';
	
	//If there is a posted value and the posted value is this value
	if (in_array($value,$chosen_value)) echo ' checked';
	
	//if there is no posted value but this value is checked by default
	else if ($mark && $checked) echo ' checked';
	
	// Get the other attributes function
	get_others($name,$others);
	
	//append the ending tag to the password element
	echo '>';	
}

function Select($name, $data,$default_value = false, $others=false) {

	$value = $default_value;

	//Check the Value
	$chosen_value = checkValue($name,$value);

	if ($chosen_value == false){
		$chosen_value = $default_value;
	}
	
	//Start Creating the Select Field
	echo '<select name="' . $name . '" id="' . $name . '"';

	// Get the other attributes function
	get_others($name,$others);

	//append the ending tag to the password element
	echo '>';	
	
	//Start Creating the Option Field
	foreach ($data as $val => $key) {
	// Do something with $value.
		echo '<option value="'.$val.'"';
		if ($chosen_value == $val) echo ' selected';
		echo '>'.$key.'</option>';
	}

	
	//Close the select
	echo "</select>";
	
}

function Textarea($name, $value=false,$others=false,$rows=10) {
	//Check the Value
	$value = checkValue($name,$value);

	//Start Creating the TextArea
	echo '<textarea name="' . $name . '" id="' . $name . '" rows="'.$rows.'" cols="80"';

	// Get the other attributes function
	// get_others($name,$others);
	echo ' '.$others;

	//append the ending tag to the textarea element
	echo ">";

	// Add the value to the textarea:
	if ($value) echo $value;

	// Complete the textarea:
	echo '</textarea>';
}

function Hidden($name,$value){
	echo '<input type="hidden" name="' . $name . '" id="' . $name . '" value="'.$value.'">';
}

function checkValue($name,$value){
		
	//Check if the value has been posted
	if (isset($_POST[$name])){
		
		//Assign posted value
		$value = $_POST[$name];
		
		// Strip slashes if Magic Quotes is enabled:
		if ($value && get_magic_quotes_gpc())
		 $value = stripslashes($value);

		return $value;
	}

	if ($value) return $value; else return false;
}

function get_others($name,$others){

	global $errors;

	//If there is an error associated with the field
	if (isset($errors[$name])){
		//check if there are other attributes added
		if ($others) {
			//check if class is included in the added attributes
			if (strpos($others,'class="') !== false){
				echo str_replace('class="', 'class="error ', $others);
			} else {
				//Class is not included add yours 
				echo 'class="error"';
			}

		} else { //No others variable
			//Class is not included add yours 
			echo ' class="error"';

		}

	} else {// No $errors	
		//Add additional attributes
		if ($others) echo ' '.$others;
	}	
}

?>