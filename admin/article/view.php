<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
# -- Include the page function ########################################################################################
require_once(INCLUDE_DIR.'article.function.php');
require_once(INCLUDE_DIR.'comment.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'article');

//Check for the id
if (isset($_GET['article'])){
      $id = $_GET['article'];
      
      //If the article id is set but it is not defined
      if ($id == ""){
            redirect('admin/article');
            exit();
      }  else {
            //The article id is definedif ($_SERVER['REQUEST_METHOD'] == 'POST'){


            # -- Show / Hide Comment #######################################################################################
            if (isset($_POST['toggle_comment'])){
              $toggle_comment = $_POST['toggle_comment'];
              $comment_id = $_POST['comment_id'];
              $action = toggle_comment($comment_id,$toggle_comment);
              //Get Notification
              get_action($action,'comment');

              $_POST = array();
            }

            //Display information to the user.
            $article = get_single_articles($id);

            //Check if the total_rows is less than 1
            if (get_total_articles() < 1) {
                  redirect('admin/article/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($article);

                  # -- Load Comments ########################################################################################
                  $comments = get_comments($id);
                  $total_comments = get_total_comments();
                  $threaded_comments = new Threaded_comments($comments);
            }
      }
} else {
      redirect('admin/article/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "Preview Article";
$page_title = "Preview Article";
$breadcrumb = array(
                      'Articles' => 'admin/article',
                      'Preview article' => '#'
              );

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
              <form action="#" class="form-horizontal" method="post">

                <div class="post">
                  <!-- Post Title & Meta -->
                  <h2><?php echo $name ?></h2>
                  <div class="post-meta">
                    Posted by <span class="meta-author">Administrator</span>
                    <span class="meta-date">on <?php echo date('M d, Y',strtotime($published_date)) ?></span>
                    <span class="meta-tags"><a href="#"><?php echo $tags ?></a></span>
                    <span class="meta-comment"><a href="#"><?php get_plural($total_comments,'Comment') ?></a></span>
                  </div>
                  <!-- End Post Title & Meta -->
                  
                  <?php if (isset($picture) && (!empty($picture))) { ?>
                    <!-- Image -->
                    <div class="post-image-wrap">
                      <a href="<?php echo UPLOAD_URL.'article/'.$article['picture'] ?>" rel="prettyPhoto" class="post-image">
                        <img src="<?php echo UPLOAD_URL.'article/'.$article['picture'] ?>" alt="<?php echo $name ?>" class="img-responsive">
                        <div class="link-overlay icon-search"></div>
                      </a>
                    </div>
                    <!-- End Image -->
                  <?php } ?>

                  <!-- Post Content -->
                  <div class="post-content">
                    <?php echo $full_article ?>
                  </div>
                  <!-- End Post Content -->

                </div>
                <!-- End Post -->
              
                <div class="form-group">
                  <div class="col-sm-12">
                      <br><br>
                      <a href="<?php echo get_url('admin/article/edit.php?article='.$id) ?>"class="btn btn-primary">Edit Article</a>
                      <a href="<?php echo get_url('admin/article/delete.php?article='.$id) ?>"class="btn btn-danger">Delete Article</a>
                      <a href="<?php echo get_url('admin/article/') ?>"class="btn btn-default">Back</a>
                  </div>
                </div>


                <!-- Comments -->
                <div id="comments" class="title">
                  <h3 class="lined"><?php echo get_plural($total_comments,'Comment') ?></h3>
                </div>
                <div class="blog-comments">
                  <div class="comments">
                    <?php  echo $threaded_comments->print_comments(); ?>
                    
                  </div>
                </div>
                <!-- /.Comments -->

                </form>
              </div>
              <aside class="col-md-3 col-md-pull-9">
                  <!--  components start -->
                  
                  <?php include(SERVER_DIR.'inc/admin-sidebar.php');  ?>
              </aside>

            </div>


      </div>
      <!-- /container -->  
    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

