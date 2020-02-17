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
            //The article id is defined
            
            //Check if the user has posted the result
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              # ****** GET PICTURE **********#
              # *****************************************#
              $article = get_single_articles($id);
              $picture = $article['picture'];

              if (isset($_POST['Delete'])){
                $id = $_POST['Delete'];
                $action = delete_articles($id);

                #- Delete Picture
                $to_delete = UPLOAD_DIR. 'article/'.$picture;
                unlink($to_delete);
              }

              redirect('admin/article/?action='.$action);
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
            }
      }
} else {
      redirect('admin/article/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "Delete $name";
$page_title = "articles";
$breadcrumb = array(
                      'articles' => 'admin/article',
                      'Delete article' => '#'
              );

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
              <form action="#" class="form-horizontal" method="post">
              
                <h3 class="page-title">
                <?php echo "Delete article" ?>
                <br><br>
                </h3>

                  
                 <div class="post">
                  <!-- Post Title & Meta -->
                  <h2><?php echo $name ?></h2>
                  <div class="post-meta">
                    Posted by <span class="meta-author"><a href="#"><?php echo $article_author['name'] ?></a></span>
                    <span class="meta-date">on <?php echo date('M d, Y',strtotime($published_date)) ?></span>
                    <span class="meta-tags"><a href="#"><?php echo $tags; ?></a></span>
                    <span class="meta-comment"><a href="#">4 comments</a></span>
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
                    <?php echo truncate($full_article,500) ?>
                  </div>
                  <!-- End Post Content -->

                </div>


                  <div class="form-group">
                    <div class="col-sm-12">
                        <br><br>
                      <?php Hidden('Delete',$id) ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="<?php echo get_url('admin/article/') ?>"class="btn btn-default">Cancel</a>
                    </div>
                  </div>

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

