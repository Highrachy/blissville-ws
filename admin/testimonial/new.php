<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
$editor = true;

# -- Include the page function ########################################################################################
require_once(INCLUDE_DIR.'testimonial.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'testimonial');

 //Add a new Testimonial
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  # ****** COMPULSORY FIELDS **********#
  # *****************************************#
  # -- Name
  $data['name'] = assign('name','minlen=3','Please enter a valid Name');

    # -- Company
  $data['company'] = assign('company','minlen=3','Please enter a valid Company');

  # -- Approved
  $data['approved'] = assign('approved', 'req');

  # -- Approved
  $data['testimonials'] = assign('testimonials','minlen=10','Please enter a valid Testimonial');

  #- Created 
  $data['created_at'] = "NOW()";

  if (empty($errors)){
    $action = add_testimonials($data, $id);
  }

  if (empty($errors)){   
    if ($action == 'exists'){
      $errors['error'] = "The Testimonial exists in the database";
    } else {
      redirect('admin/testimonial/?action='.$action); 
    }
  }
 
  
}

# -- Page Configuration ########################################################################################
$title = "New Testimonial";
$page_title = "Testimonials";
$breadcrumb = array(
                      'Testimonials' => 'admin/testimonial',
                      'New Testimonial' => '#'
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
                <?php echo "Add a New Testimonial" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('name','','class="form-control" placeholder="Name of the Testimonial"') ?>
                                  <?php show_errors('name') ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Company<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('company','','class="form-control" placeholder="Company of the Testimonial"') ?>
                                  <?php show_errors('company') ?>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Approved <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php 
                              $approved_value['YES'] = 'YES';
                              $approved_value['NO'] = 'NO';

                              Select('approved',$approved_value,'','class="form-control"') ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Testimonial <span class="mandatory">*</span> </label>
                      <div class="col-sm-10">
                        <?php Textarea('testimonials',''," class='editor'") ?>
                        <?php show_errors('testimonials') ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add New</button>
                        <button type="reset" class="btn btn-default">Clear</button>
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

