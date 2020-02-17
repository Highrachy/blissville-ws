<?php


function get_article_archives(){
	
	global $db;

	$query = "SELECT *,published_date AS archive_date, name as archive_title, url_name as link FROM articles WHERE published_date < (NOW() - INTERVAL 1 MONTH) ORDER BY YEAR(published_date), MONTH(published_date) DESC";

	$rows = $db->fetch_all_row($query);

	return $rows;

}

function get_article_archives_count(){
	
	global $db;

	$query = "SELECT published_date, published_date as archive_date, COUNT(id) AS count, id FROM articles WHERE published_date < (NOW() - INTERVAL 1 MONTH) GROUP BY YEAR(published_date), MONTH(published_date)";

	$rows = $db->fetch_all_row($query);

	return $rows;

}

function get_side_archive(){
	
	global $db;

  $articles = get_article_archives_count();

  $data = array();

  foreach ($articles as $article){

    extract($article);
    $month = date('F Y',strtotime($archive_date));
    if (!isset($data[$month]) || (empty($data[$month])))
      $data[$month] = $count;
    else $data[$month] = $data[$month]+$count;
  }

  $notifications = get_notification_archives_count();

  foreach ($notifications as $notification){

    extract($notification);
    $month = date('F Y',strtotime($archive_date));
    if (!isset($data[$month]) || (empty($data[$month])))
      $data[$month] = $count;
    else $data[$month] = $data[$month]+$count;
  }

	return $data;

}


function get_notification_archives(){
	
	global $db;

	$query = "SELECT *,published_date AS archive_date, name as archive_title, url_name as link FROM notifications WHERE published_date < (NOW() - INTERVAL 1 MONTH) ORDER BY YEAR(published_date), MONTH(published_date)";

	$rows = $db->fetch_all_row($query);

	return $rows;

}

function get_notification_archives_count(){
	
	global $db;

	$query = "SELECT published_date, published_date as archive_date, COUNT(id) AS count, id FROM notifications WHERE published_date < (NOW() - INTERVAL 1 MONTH) GROUP BY YEAR(published_date), MONTH(published_date)";

	$rows = $db->fetch_all_row($query);

	return $rows;

}


function generate_archive($archive_name,$archive_count,$archive_data,$archive_link="") { ?>


			<?php if (!empty($archive_count)) { ?>
            <h4 class="lined margin-20"><?php echo $archive_name. " Archive"; ?></h4>

	          <div class="panel-group accordion">
                <!-- accordion -->
		        <div class="panel-group" id="<?php echo $archive_name ?>">
		            <?php 
		            foreach ($archive_count as $counter) { 
		            	extract($counter);
		            	$month = date('F Y',strtotime($archive_date));
		            	if ($count > 0) { ?>
		            	
			                    <!-- accordion item -->
			                    <div class="panel panel-default">
			                        <div class="panel-heading">
			                            <a data-toggle="collapse" data-parent="#<?php echo $archive_name ?>" href="#<?php echo $archive_name ?>-<?php echo $id ?>"><h4 class="panel-title"> <?php echo $month." <strong class='count'>$count</strong>" ?> </h4></a>
			                        </div>
			                        <div id="<?php echo $archive_name ?>-<?php echo $id ?>" class="panel-collapse collapse">
			                            <div class="panel-body">

					                        <?php 
					                        echo "<ul>";
					                        foreach ($archive_data as $archive) {
					                          extract($archive);
					                    	  $archive_month = date('F Y',strtotime($archive_date));
					                    	  if ($month == $archive_month) {
					                    	  	echo "<li><a href='";
					                    	  	get_url($archive_link);
					                    	  	echo $link."'>$archive_title</a></li>";
					                    	  }//end if
					                    	}//end foreach
					                    	echo "</ul>"
					                       	?>
			                            </div>
			                        </div>
			                    </div>
			                    <!-- end accordion item -->
		            	<?php } //end if count > 1?>
		            <?php } //end foreach ?>
	                <!-- end accordion -->
		        </div>
              </div>
              <?php } //end empty archive count?>


              <?php
}

	