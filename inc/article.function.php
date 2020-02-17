<?php
define ('QUOTES', 0);
define ('ARTICLE', 1);
define ('SLIDESHOW', 2);
define ('VIDEO', 3);

function get_article_type($type){

	switch ($type) {
	  case QUOTES:
	    $type_name = "Quotes";
	    break;
	  
	  case ARTICLE:
	    $type_name = "Article";
	    break;
	  
	  case SLIDESHOW:
	    $type_name = "Slideshow Article";
	    break;
	  
	  case VIDEO:
	    $type_name = "Video Article";
	    break;
	  
	  default:
	    $type_name = "Article";
	    break;
	}

	return $type_name;
}


function get_articles($limit = 0, $show_all = true,$start=0){
	
	global $db;

	$query = "SELECT a.id AS id, a.name AS name, a.url_name, a.excerpt, a.full_article, a.tags, a.picture, a.doc_name, a.doc_path, a.published_date, cat.name AS category, COUNT( c.article_id ) AS total_comments
		FROM articles a
		LEFT JOIN category cat ON cat.id = a.category
		LEFT JOIN comments c ON a.id = c.article_id";
		$query .= " WHERE NOW() >= published_date";
	$query .= " GROUP BY a.name
				ORDER BY  a.published_date DESC";
	

	if ($limit > 0)
		$query .= " LIMIT $start, $limit";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}
function get_articles_by_criteria($sort_type, $sort_criteria,$limit=0, $start=0){
	
	global $db;

	$query = "SELECT a.id AS id, a.name AS name, a.url_name, a.excerpt, a.full_article, a.tags, a.picture, a.doc_name, a.doc_path, a.published_date, cat.name AS category, COUNT( c.article_id ) AS total_comments
		FROM articles a
		LEFT JOIN category cat ON cat.id = a.category
		LEFT JOIN comments c ON a.id = c.article_id";

	if ($sort_type == 'tag'){
		$query .= " WHERE NOW() >= published_date AND a.tags LIKE '%$sort_criteria%'";
	} else if ($sort_type == 'category'){
		$query .= " WHERE NOW() >= published_date AND cat.url_name = '$sort_criteria'";		
	} 
		
	$query .= " GROUP BY a.name
				ORDER BY  a.published_date DESC";
	

	if ($limit > 0)
		$query .= " LIMIT $start, $limit";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_tags($tags){
	$combined = explode(',', $tags);

	$tag_link = array();

	foreach ($combined as $tag) {
		$tag_link[] = "<a href='".BASE_URL."articles/tags/".trim($tags)."' class='dark-link'>".$tag."</a> ";
	}

	$final_tag = implode(',', $tag_link);

	return $final_tag;
}

function get_tags_button($tags){
	$combined = explode(',', $tags);

	$tag_link = array();

	foreach ($combined as $tag) {
		$tag_link[] = "<a class='btn btn-default btn-sm' href='".BASE_URL."articles/tags/'".trim($tags)."'>".$tag."</a> ";
	}

	$final_tag = implode('&nbsp;', $tag_link);

	return $final_tag;
}
function get_article_category(){
	
	global $db;

	$query = "SELECT * FROM category";

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_single_articles($id){
	
	global $db;

	$query = "SELECT a.id AS id, a.name AS name, a.url_name, a.excerpt, a.full_article, a.tags, a.picture, a.doc_name, a.doc_path, a.published_date, c.name AS category, c.id as category_id
		FROM articles a
		LEFT JOIN category c ON c.id = a.category
		WHERE a.id = ".$id;

	return $db->fetch_first_row($query);
}

function get_article_by_name($url_name){
	
	global $db;

	$query = "SELECT a.id AS id, a.name AS name, a.url_name, a.excerpt, a.full_article, a.tags, a.picture, a.doc_name, a.doc_path, a.published_date, c.name AS category, c.id as category_id
		FROM articles a
		LEFT JOIN category c ON c.id = a.category
		WHERE a.url_name = '".$url_name."'";

	return $db->fetch_first_row($query);
}

function get_total_articles(){
	
	global $db;

	return $db->total_affected_rows();
}

function total_articles($limit = 0){
	
	global $db;

	$query = "SELECT id FROM articles";

	return $db->total_affected_rows($query);

}

function exist_articles($id){
	
	global $db;

	$query = "SELECT id FROM articles WHERE id =".$id;
	$rows = $db->total_affected_rows($query);

	if ($rows == 0){
		return false;
	}else {
		return true;
	}

}


function add_articles($article){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT name FROM articles WHERE name='".$article['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		if ($db->insert_query('articles',$article) > 0){
			$action = "add";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function update_articles($article, $id){
	
	global $db;

	$action = "";
	
 	// Check if the name exists in the database with a different Id
	$query = "SELECT name FROM articles WHERE name='".$article['name']."' AND id <> '$id'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, email does not exist in the database
		if ($db->update_query('articles',$article,"id=$id") > 0){
			$action = "update";
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$action = 'exists';
	}

	return $action;
}
function delete_articles($id){
	
	global $db;

	$action = "";

    $query = "SELECT name FROM articles WHERE id = '$id'";
    $contact = $db->fetch_first_row($query);
    $total_rows = $db->total_affected_rows();
    
    if ($total_rows == 1) { // No problems! You can delete, file exist;
      //To Delete
      $query = "DELETE FROM articles WHERE id = '$id' LIMIT 1";
      $result = $db->delete_row($query);
      if ($result == 1) { // If it ran OK.
        $action = "delete";
      } else {
      	trigger_error('System error. We apologize for any inconvenience.');
      }
    }

	return $action;
}

function get_popular_articles($limit = 2){
	global $db;

	$query = "SELECT a.id, a.name, a.url_name, a.published_date, a.picture, COUNT(c.article_id) AS popularity
			FROM articles a
			LEFT JOIN comments c ON a.id = c.article_id
			GROUP BY a.name
			ORDER BY popularity DESC, a.name LIMIT $limit";	

	$rows = $db->fetch_all_row($query);
	
	return $rows;
}


function get_related_articles($id, $limit = 1){

	global $db;

	$query = "SELECT a.id, a.name, a.url_name, a.published_date, a.picture, COUNT(c.article_id) AS total_comments
			FROM articles a
			LEFT JOIN comments c ON a.id = c.article_id
			WHERE a.id <> $id
			GROUP BY a.name
			LIMIT $limit";
	$rows = $db->fetch_all_row($query);
	
	return $rows;
}


function add_category($category){
	global $db;

	$action = "";
	
 	// Check if the name exists in the database
	$query = "SELECT id FROM category WHERE name='".$category['name']."'";

	$rows = $db->total_affected_rows($query);

	if ($rows == 0){ //No problem, name does not exist in the database
		$added = $db->insert_query('category',$category);
		if ( $added > 0){
			return $added;
		} else {
			trigger_error('System error. We apologize for any inconvenience.');
		}	
	} else {
		$added = $db->fetch_first_row($query);
		return $added['id'];
	}

}