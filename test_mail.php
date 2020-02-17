<?php
	$from = "no-reply@blissville.com.ng";
	$to1 = "harunpopson@yahoo.com";
	$to2 = "harunpopson@gmail.com";
	$to3 = "haruna@highrachy.com";
	
	$subject = "Emailing Test";
	$headers = "From:" . $from;
	$message = "This is a test, is it working?";
	echo "<h1>Testing the Mail Sender Function </h1>";
	mail($to1,$subject,$message,$headers);
	echo "Mail Sent to $to1";
	mail($to2,$subject,$message,$headers);
	echo "<br><br>Mail Sent to $to2";
	mail($to3,$subject,$message,$headers);
	echo "<br><br>Mail Sent to $to3";

?>