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
require_once(INCLUDE_DIR.'faqs.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'faqs');

//Check for the id
if (isset($_GET['faqs'])){
      $id = $_GET['faqs'];
      
      //If the faqs id is set but it is not defined
      if ($id == ""){
            redirect('admin/faqs');
            exit();
      }  else {
            //The faqs id is defined
            
            //Display information to the user.
            $table = get_single_faqs($id);

            //Check if the total_rows is less than 1
            if (get_total_faqs() < 1) {
                  redirect('admin/faqs/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);
            }
      }
} else {
      redirect('admin/faqs/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "Preview faqs";
$page_title = "faqs";
$breadcrumb = array(
                      'FAQs' => 'admin/faqs',
                      'Preview faqs' => '#'
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
                <?php echo "Preview FAQs" ?>
                <br><br>
                </h3>

                <div><?php echo $question ?></div>
                <div><?php echo $answer ?></div>
              

                <div class="form-group">
                  <div class="col-sm-12">
                      <a href="<?php echo get_url('admin/faqs/edit.php?faqs='.$id) ?>"class="btn btn-sm btn-primary">Edit</a>
                      <a href="<?php echo get_url('admin/faqs/delete.php?faqs='.$id) ?>"class="btn btn-sm btn-danger">Delete</a>
                      <a href="<?php echo get_url('admin/faqs/') ?>"class="btn btn-sm btn-default">Back</a>
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

