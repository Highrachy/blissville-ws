<?php

// function file_perms($file, $octal = false)
// {
//     if(!file_exists($file)) return false;
//     $perms = fileperms($file);
//     $cut = $octal ? 2 : 3;
//     return substr(decoct($perms), $cut);
// }


################################
# -- Compulsory Fields
################################

# -- Base Url
$base_url = assign('base_url','req','Invalid BASE URL');	

if (!is_valid_url($base_url)){ //Not valid Url, check if it is a valid ip
	if (!is_valid_ip($base_url)){
		$errors['base_url'] = "Invalid BASE URL";
	}
}

# -- DB Host
$db_host = assign('db_host','req','Invalid HOST');	


# -- DB Name
$db_name = assign('db_name','req','Invalid DB NAME');

# -- DB User
$db_user = assign('db_user','req','Invalid DB USER');

# -- DB Password
$db_password = $_POST['db_password'];

# -- Admin Name
$admin_name = assign('admin_name','req','Please enter a valid ADMIN NAME');

# -- Admin Email
$admin_email = assign('admin_email','email','Invalid ADMIN EMAIL');

# -- Admin Password
$admin_password = assign('admin_password','req','Enter a valid Password');

# -- Retype
if (!same($admin_password, $_POST['retype'])){
	$errors['retype'] = "Your password does not correspond";
}

################################
# -- Connect to the database
################################
$connect = @mysql_connect(trim($db_host),trim($db_user),trim($db_password));

//Select the database
$db = @mysql_select_db(trim($db_name));

//Get the mysql version
$v=@mysql_fetch_array(mysql_query("SELECT VERSION();"));
$mysql_ver =  explode(".", $v[0]);
$mysql_ver = $mysql_ver[0];

//Get the php version
$php_ver = explode(".", phpversion());
$php_ver = $php_ver[0];

//Check the php and mysql version
if(isset($mysql_ver) && $mysql_ver>5){$errors[]= "MySQL version must be more than <b>5</>";}
if(isset($php_ver) && $php_ver>5){$errors[]= "PHP version must be more than <b>5</b>";}


//Check file permission of folders with upload material to 777
// if(file_perms('attachments') <> 77) {$errors[]= "Set permission '<strong>777</strong>' to folder <b>attachments</b>";}
// if(file_perms('uploadfiles') <> 77) {$errors[]= "Set permission '<strong>777</strong>' to folder <b>uploadfiles</b>";}


if(!$connect){$errors[]= "Connection to the database failed";}
if(!$db){$errors[]= "Database is not found";}

if(empty($errors)){ //error is empty

		$code =	'<?php 
		return array(
			\'base_www\'			=>	"'.$base_url.'"'.',
			\'host\'				=>	"'.$db_host.'"'.',
			\'username\'			=>	"'.$db_user.'"'.',
			\'password\'			=>	"'.$db_password.'"'.',
			\'db\'				=>	"'.$db_name.'"'.',
			\'date\'				=>	"'.time().'"'.',
		);

		?>';


		$fp = fopen('inc/main.config.php', 'w+');
		$conf_test = fwrite($fp, $code);
		fclose($fp);
		$success = "Your configuration file has been successfully created";

		
}
