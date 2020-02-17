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
require_once(INCLUDE_DIR.'testimonial.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'testimonial');

//Check for the id
if (isset($_GET['testimonial'])){
      $id = $_GET['testimonial'];
      
      //If the testimonial id is set but it is not defined
      if ($id == ""){
            redirect('admin/testimonial');
            exit();
      }  else {
            //The testimonial id is defined
            
            //Display information to the user.
            $table = get_single_testimonials($id);

            //Check if the total_rows is less than 1
            if (get_total_testimonials() < 1) {
                  redirect('admin/testimonial/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);
            }
      }
} else {
      redirect('admin/testimonial/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "Preview Testimonial";
$page_title = "Testimonials";
$breadcrumb = array(
                      'Testimonials' => 'admin/testimonial',
                      'Preview Testimonial' => '#'
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
                <?php echo "Preview Testimonial" ?>
                <br><br>
                </h3>

                <div class="clearfix">
                    <ul class="list-unstyled">
                        <li class="testimonials">
                            <div class="testimonial no-bg">
                                <i class="fa fa-quote-left fa-3x pull-left fa-muted"></i>
                                <?php echo $testimonials ?>
                            </div>
                            <p class="clearfix"><span class="testimonial-details no-margin"><strong class="testimonial-name"><?php echo $name ?> - </strong><?php echo $company ?></span> <br class="clearfix">
                            </p>
                        </li><!-- end testimonial -->
                    </ul> 
                </div>

                <p> <strong>Approved : <?php echo $approved ?></strong> </p><br>
              

                <div class="form-group">
                  <div class="col-sm-10">
                      <a href="<?php echo get_url('admin/testimonial/edit.php?testimonial='.$id) ?>"class="btn btn-sm btn-primary">Edit</a>
                      <a href="<?php echo get_url('admin/testimonial/delete.php?testimonial='.$id) ?>"class="btn btn-sm btn-danger">Delete</a>
                      <a href="<?php echo get_url('admin/testimonial/') ?>"class="btn btn-sm btn-default">Back</a>
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

