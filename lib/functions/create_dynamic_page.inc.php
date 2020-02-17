<?php
# - Usage Example 
/*

include('includes/config.inc.php'); 
include("functions/create_dynamic_page.inc.php");
$src = BASE_URL."index2.php";
$temp = "temp_index.php";
$dest = "index3.html";
create_page($src,$temp,$dest);

*/

# - End Usage


# - Call this function once you have updated your content.
function create_page($srcurl,$tempfilename,$targetfilename){
	
	global $errors; # Use the default $erros variable
	
	# - Delete the former temporary file if it exists
	if (file_exists($tempfilename))
	{
	  unlink($tempfilename);
	}
	
	# - Get the content of the source url (It must be the full url)
	$html = file_get_contents($srcurl);
	
	# - Display an error if the page is empty or cannot be gotten
	if (!$html)
	{
	  $errors[] = "Unable to load $srcurl. Static page update aborted!";
	  exit();
	}
	
	# - Put the content saved in html into the temporary file
	if (!file_put_contents($tempfilename, $html))
	{
	  # - Display an error if the file cannot be gotten
	  $errors[] = "Unable to write $tempfilename. Static page update aborted!";
	  exit();
	}
	
	# - Save the temporary file into the target file
	copy($tempfilename, $targetfilename);
	
	# - Delete the temporary file as the operation is successful
	unlink($tempfilename);
}
