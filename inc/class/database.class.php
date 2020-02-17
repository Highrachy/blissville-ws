<?php
class Database {
private $server   = ""; //database server
private $user     = ""; //database login name
private $pass     = ""; //database login password
private $database = ""; //database name
private $pre      = ""; //table prefix

//number of rows affected by SQL query
private $affected_rows = 0;

//This corresponds to the normal $dbc
private $link_id = 0;

//This corresponds to the normal $result
private $query_id = 0;


#-#############################################
# desc: constructor
public function __construct($server, $user, $pass, $database, $pre=''){
	$this->server=$server;
	$this->user=$user;
	$this->pass=$pass;
	$this->database=$database;
	$this->pre=$pre;

	// Make the connection:
	$this->link_id = @mysqli_connect($this->server, $this->user, $this->pass, $this->database);

	// If no connection could be made, trigger an error:
	if (!$this->link_id) {
		trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
	} else { // Otherwise, set the encoding:
		mysqli_set_charset($this->link_id, 'utf8');
	}
	// unset the data so it can't be dumped
	$this->server='';
	$this->user='';
	$this->pass='';
	$this->database='';
}#-#connect()



#-#############################################
# desc: Escape Data
public function escape_data($data){

// Strip the slashes if Magic Quotes is on:
if (get_magic_quotes_gpc()) $data = stripslashes($data);

// Apply trim() and mysqli_real_escape_string():
return @mysqli_real_escape_string ($this->link_id, trim ($data));

}#-#Escape Data()



#-#############################################
# Desc: executes SQL query to an open connection
# Param: (MySQL query) to execute
# returns: (query_id) for fetching results etc
public function query($sql) {
	// do query
	$this->query_id = @mysqli_query($this->link_id,$sql);

	if (!$this->query_id) {
		trigger_error("<b>MySQL Query fail:</b> $sql");
		return 0;
	}

	$this->affected_rows = @mysqli_affected_rows($this->link_id);

	return $this->query_id;
}#-#query()


#-#############################################
# desc: fetches and returns results one line at a time
# param: query_id for mysqli run. if none specified, last used
# return: (array) fetched record(s)
protected function fetch_array($query_id=-1) {
	// retrieve row
	if ($query_id instanceof mysqli_result) {
		$this->query_id=$query_id;
	}

	if (isset($this->query_id)) {
		$record = @mysqli_fetch_assoc($this->query_id);
	}else{
		trigger_error("Invalid Records could not be fetched.");
	}

	return $record;
}#-#fetch_array()


#-#############################################
# desc: does a query, fetches the first row only, frees resultset
# param: (MySQL query) the query to run on server
# returns: array of fetched results
public function fetch_first_row($query_string) {
	$query_id = $this->query($query_string);
	$out = $this->fetch_array($query_id);
	$this->free_result($query_id);
	return $out;
}#-#fetch_first_row()

#-#############################################
# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
public function fetch_all_rows($sql) {
	$query_id = $this->query($sql);
	$out = array();

	while ($row = $this->fetch_array($query_id)){
		$out[] = $row;
	}

	$this->free_result($query_id);
	return $out;
}#-#fetch_all_array()

//TODO : Remove function
public function fetch_all_row($sql){
	return $this->fetch_all_rows($sql);
}

#-#############################################
# desc: returns the total number of affected row
# param: (MySQL query) the query to run on server
# returns: integer
public function total_affected_rows($query_string ="") {
	if ($query_string != "")
	$query_id = $this->query($query_string);
	return $this->affected_rows;
}#-#total_affected_rows()


#-#############################################
# desc: does an insert query with an array
# param: table (no prefix), assoc array with data
# returns: id of inserted record, false if error
public function insert_query($table, $data) {
	$q="INSERT INTO `".$this->pre.$table."` ";
	$v=''; $n='';

	foreach($data as $key=>$val) {
		$n.="`$key`, ";
		if(strtolower($val)=='null') $v.="NULL, ";
		elseif(strtolower($val)=='now()') $v.="NOW(), ";
		else $v.= "'".$this->escape_data($val)."', ";
	}

	$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";

	$query_id = $this->query($q);
	if ($this->affected_rows == 1){
		return mysqli_insert_id($this->link_id);
	}
	else return false;

}#-#query_insert()

#-#############################################
# desc: does an update query with an array
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: (query_id) for fetching results etc
public function update_query($table, $data, $where='1',$use_limit = true) {
	$q="UPDATE `".$this->pre.$table."` SET ";
	$limit = " LIMIT 1 ";
	if (!$use_limit) $limit= "";
	foreach($data as $key=>$val) {
		if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
		elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
        elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], ";
		else $q.= "`$key`='".$this->escape_data($val)."', ";
	}

	$q = rtrim($q, ', ') . ' WHERE '.$where. $limit.';';

	$this->query($q);
	return $this->affected_rows;
}#-#query_update()

#-#############################################
# desc: delete from the database
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: boolean value
public function delete_row($q) {
	$this->query($q);
	return $this->affected_rows;
}#-#delete row()



#-#############################################
# desc: frees the resultset
# param: query_id for mysqli run. if none specified, last used
protected function free_result($query_id=-1) {
	if ($query_id instanceof mysqli_result) {
		$this->query_id=$query_id;
	}
	if((is_int($this->query_id) && ($this->query_id!=0)) && (!@mysqli_free_result($this->query_id))) {
		trigger_error("The resources could not be freed.");
	}
}#-#free_result()
#-#############################################
# desc: destructor
function __destruct(){
		if(!@mysqli_close($this->link_id)){
			trigger_error("Connection close failed.");
		}
}#-#destructor()

}//CLASS Database
###################################################################################################

?>
