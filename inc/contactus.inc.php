<?php
// Check for the Users Name
if (preg_match ('/^[A-Z0-9 \'.-]{2,60}$/i', $_POST['name'])) {
	$name = $_POST['name'];
} else {
	$errors[] = 'Please enter a valid Name!';
}


// Check for the phone number
if (!(empty($_POST['phone']))) {
	$phone = $_POST['phone'];
} else {
	$errors[] = 'Please enter a desired phone Number';
}

// Check for an email address:
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$email = $_POST['email'];
} else {
	$errors[] = 'Please enter a valid email address!';
}

// Check for the address
if (!(empty($_POST['comments']))) {
	$body = $_POST['comments'];
} else {
	$errors[] = 'Please enter your comments';
}

if (empty($errors)) { // If everything's OK...
		
		$subject = "Feedback From a Client ($name)";
		$ourEmail = "haruna@highrachy.com";
		
		//Send the message to us
		$headers = "From: {$name}\r\nReply-To: {$ourEmail}\r\n";
		mail($ourEmail, $subject, $body,$headers);
		$success = "Your message has been successfully received";
		unset($_POST);
		

} // End of empty($errors) IF.