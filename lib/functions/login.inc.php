<?php

$destination = 'admin/dashboard.php';
$login_table = 'admin';
//Login the person in directly if the section is active
if (isset($_SESSION['name']) && isset($_SESSION['id'])){
	redirect($destination);
	exit();
}

//Check if the user clicks on the submit button
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//$email = assign('email');
	$email = $_POST['email'];

	#validate the password
	//$password = assign('password','minlen=5',"Your password must be more than 5 characters");
	$password = $_POST['password'];


	if (empty($errors)) { // OK to proceed!

		// Query the database:
		$query = "SELECT * FROM $login_table WHERE (email ='$email' AND password ='"  . md5($password) .  "')";
		// $query = "SELECT * FROM $login_table WHERE (email ='$email' AND password ='"  . $password .  "')";
		//return var_dump($query);
		$row = $db->fetch_first_row($query);
		$rows = $db->total_affected_rows();

		
		if ($rows == 1) { // A match was made.
			
			//Allocate them into a session
			
			//Get the contact name
			$_SESSION['name']= $row['name'];
			$_SESSION['id']= $row['id'];


			//Add the login activity
			// add_activity('login', $row['name'].' logged in on '.date("l jS \of F Y h:i:s A"), $row_id)
	

			
			//Check if the user has tried to access a page before
			if (isset($_GET['continue'])){
				$url = $_GET['continue'];
				header("Location:$url");
				exit();
			} else {	
				//Redirect the user to the dashboard
				redirect($destination); // Define the URL:
				exit(); // Quit the script.
			}

		} else { // No match was made.
		
		 //The person has entered an invalid information
		 $errors['error'] = 'Invalid username or password.';	
		}//End of no match made

		
	} // End of $errors IF.
	// Omit the closing PHP tag to avoid 'headers already sent' errors!
}
