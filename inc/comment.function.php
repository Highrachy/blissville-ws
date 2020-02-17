<?php
function get_comments($id=1, $limit = 0){
	
	global $db;

	$query = "SELECT * FROM comments WHERE article_id = ".$id;
	

	if ($limit > 0)
		$query .= " LIMIT ". $limit;

	$rows = $db->fetch_all_row($query);
	
	return $rows;

}

function get_total_comments(){
  
  global $db;

  return $db->total_affected_rows();
}

function add_comments($comment){
	
	global $db;

	$action = "";
	
	if ($db->insert_query('comments',$comment) > 0){
		$action = "add";
	} else {
		trigger_error('System error. We apologize for any inconvenience.');
	}	
	
	return $action;
}


function toggle_comment($id,$status){
	
	global $db;

  $comment['show'] = 0;

	//Set the value of the comments
	if ($status == 0) // comment is shown, hide it
    $comment['show'] = 1;

	if ($db->update_query('comments',$comment,"id=$id") > 0){
		$action = "update";
	} else {
		$action = "not-found";
	}	

	return $action;
}


class Threaded_comments
{

    public $parents  = array();
    public $children = array();

    /**
     * @param array $comments
     */
    function __construct($comments)
    {
        foreach ($comments as $comment)
        {
            if ($comment['reply_to'] === NULL)
            {
                $this->parents[$comment['id']][] = $comment;
            }
            else
            {
                $this->children[$comment['reply_to']][] = $comment;
            }
        }
    }

    /**
     * @param array $comment
     * @param int $depth
     */
    private function format_comment($comment, $depth)
    {
        // for ($depth; $depth > 0; $depth--)
        // {
        //     echo "\t";
        // }

        // echo $comment['text'];
        // echo "\n";

        $maximum_depth = 2;

        //Reset the depth
        if ($depth > $maximum_depth)
          $depth = $maximum_depth; 




        // echo $depth + 1;

        // echo $comment['text'];
        // echo "<br>";
        // $letters = "";
        // $inits = explode($comment['name']);
        // foreach ($inits as $init)
        //   $letters .= substr($init, 0,1);
        // $initials = substr($letters,0,2);

        //Get the first two letters
        $first_letters = strtoupper(substr(preg_replace('/(\B.|\s+)/','',$comment['name']),0,2));

        //If the first letters is lower than 2, get first two
        if (strlen($first_letters) < 2){
          $first_letters = ucfirst(substr($comment['name'],0,2));
        }

    ?>  
        <div class="comment depth-<?php echo $depth+1 ?>">
          <div class="avatar color-<?php echo strtolower(substr($first_letters, 0,1)); ?>">
            <span class="name"><?php echo $first_letters ?></span>
          </div>
          <div class="media-body">
              <h4 class="media-heading comment-name"><?php echo $comment['name'] ?> </h4>
              <!-- <p class="comment-time"><?php echo date('M j, Y h:i a', strtotime($comment['created_at'])); ?></p> -->
              <p class="comment-time"><?php echo get_timeago(strtotime($comment['created_at'])); ?></p>

              <?php if (isset($_SESSION['name']) && isset($_SESSION['id'])){ ?>
              <p><?php echo $comment['text'] ?></p>
              <?php } else { 
                if ($comment['show'] == 1) { ?>
                  <p><?php echo $comment['text'] ?></p>
                <?php } else {?>
                  <p>** This comment has been hidden **</p>
                <?php } ?>

              <?php } ?>
              <form action ="#leave-comment"method="post"><input type="hidden" name="reply_to" value="<?php echo $comment['id'] ?>">
                <div class="pull-right">
                  <button type="submit" class="comment-reply btn btn-default btn-xs">Reply</button>
                  <input type="hidden" name="toggle_comment" value="<?php echo $comment['show'] ?>">
                  <input type="hidden" name="comment_name" value="<?php echo $comment['name'] ?>">
                  <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
                  <?php if (isset($_SESSION['name']) && isset($_SESSION['id'])){
                          if ($comment['show'] == 1) { ?>
                            &nbsp;<button type="submit" class="comment-reply btn btn-danger btn-xs">Hide</button>
                          <?php } else { ?>
                            &nbsp;<button type="submit" class="comment-reply btn btn-success btn-xs">Show</button>
                          <?php } ?>
                  <?php } ?>
                </div>
                

              </form><br class="clearfix">
          </div>
        </div> 
    <?php

    }

    /**
     * @param array $comment
     * @param int $depth
     */
    private function print_parent($comment, $depth = 0)
    {
        foreach ($comment as $c)
        {
            $this->format_comment($c, $depth);

            if (isset($this->children[$c['id']]))
            {
                $this->print_parent($this->children[$c['id']], $depth + 1);
            }
        }
    }

    public function print_comments()
    {
        foreach ($this->parents as $c)
        {
            $this->print_parent($c);
        }
    }

}

// $comments = get_comments();
// $threaded_comments = new Threaded_comments($comments);
 // echo $threaded_comments->print_comments();



             