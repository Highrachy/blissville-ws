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
require_once(INCLUDE_DIR.'slideshow.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'slideshow area');

//Check for the id
if (isset($_GET['slideshow'])){
      $id = $_GET['slideshow'];
      
      //If the slideshow id is set but it is not defined
      if ($id == ""){
            redirect('admin/slideshow');
            exit();
      }  else {
            //The slideshow id is defined
            
            //Display information to the user.
            $table = get_single_slideshows($id);

            //Check if the total_rows is less than 1
            if (get_total_slideshows() < 1) {
                  redirect('admin/slideshow/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);
            }
      }
} else {
      redirect('admin/slideshow/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "$name";
$page_title = "slideshow Areas";
$breadcrumb = array(
                      'slideshow Areas' => 'admin/slideshow',
                      'View slideshow' => '#'
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
                <?php echo "View Slideshow : $name" ?>
                <br><br>
                </h3>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Image<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><img src="<?php get_url('assets/uploads/slideshow/' . $picture); ?>" class="img-responsive" alt="Slideshow Image"></p>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><?php echo $priority ?></p>
                      </div>
                  </div>
                
                


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="<?php echo get_url('admin/slideshow/edit.php?slideshow='.$id) ?>"class="btn btn-primary">Edit</a>
                        <a href="<?php echo get_url('admin/slideshow/delete.php?slideshow='.$id) ?>"class="btn btn-danger">Delete</a>
                        <a href="<?php echo get_url('admin/slideshow/') ?>"class="btn btn-default">Back</a>
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

