<?php
include('includes/config.inc.php');
require_once(DB);
 
// Call the backup function for all tables in a DB
//backup_tables(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//restore(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,'backup/db_1365684856_all.sql');
//backup_website();

//restore_website("backup/backup_1365691883.zip");


function restore($DBhost,$DBuser,$DBpass,$DBName,$filename)
{	
	$sqlErrorText = '';
	$sqlErrorCode = 0;
	$sqlStmt      = '';
	
	// Restore the backup
	$con = mysql_connect($DBhost,$DBuser,$DBpass);
	if ($con !== false){
	  // Load and explode the sql file
	  mysql_select_db("$DBName");
	  $f = fopen($filename,"r+");
	  $sqlFile = fread($f,filesize($filename));
	  $sqlArray = explode(';<|||||||>',$sqlFile);
			  
	  // Process the sql file by statements
	  foreach ($sqlArray as $stmt) {
		if (strlen($stmt)>3){
			 $result = mysql_query($stmt);
		}
	  }
	}
	
	// Print message (error or success)
	if ($sqlErrorCode == 0){
	   print("Database restored successfully!<br>\n");
	   print("Backup used: " . $filename . "<br>\n");
	} else {
	   print("An error occurred while restoring backup!<br><br>\n");
	   print("Error code: $sqlErrorCode<br>\n");
	   print("Error text: $sqlErrorText<br>\n");
	   print("Statement:<br/> $sqlStmt<br>");
	}
	
	// Close the connection
	mysql_close();
}

function restore_website($filename){
	// Include this library so we could delete the file
	require_once('functions/pclzip.lib.php');
	$r_file = pathinfo($filename,PATHINFO_FILENAME).".zip";
	// Remove the current dir
	rrmdir(dirname(__FILE__),$r_file); 
	
	// Extract archive
	$archive = new PclZip($filename);
	if ($archive->extract(PCLZIP_OPT_PATH, "./") == 0) {
		die("Error : ".$archive->errorInfo(true));
	}
	// Files restored successfully
	print("Files restored successfully!<br>\n");
	print("Backup used: " . $filename . "<br>\n");
	
}

// Recursively remove dir
function rrmdir($dir,$filename) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != "." && $object != ".." && $object != "restore.php" && $object != $filename && pathinfo($object,PATHINFO_EXTENSION) != "sql")  { 
					if (filetype($dir."/".$object) == "dir") {
						rrmdir($dir."/".$object,$filename); 
					} else {
						unlink($dir."/".$object); 
					}
				} 
			} 
		reset($objects); 
		} 
	}


?>