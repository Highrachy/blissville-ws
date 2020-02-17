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
require_once(INCLUDE_DIR.'investor.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'Investor Us Page');

//Check for the id
if (isset($_GET['investor'])){
      $id = $_GET['investor'];
      
      //If the investor id is set but it is not defined
      if ($id == ""){
            redirect('admin/investor');
            exit();
      }  else {
            //The investor id is defined
            
            //Check if the user has posted the result
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              # ****** GET PICTURE **********#
              # *****************************************#
              $investor = get_single_investors($id);
              $picture = $investor['picture'];

              if (isset($_POST['Delete'])){
                $id = $_POST['Delete'];
                $action = delete_investors($id);

                #- Delete Picture
                if (!empty($picture)){
                  $to_delete = UPLOAD_DIR. 'investor/'.$picture;
                  unlink($to_delete);
                }

              }

              redirect('admin/investor/?action='.$action);
            }
            
            //Display information to the user.
            $table = get_single_investors($id);

            //Check if the total_rows is less than 1
            if (get_total_investors() < 1) {
                  redirect('admin/investor/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);
            }
      }
} else {
      redirect('admin/investor/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "investor-us";
$page_title = "Investor Us";
$breadcrumb = array(
                      'Investor Us' => 'admin/investor',
                      'Delete Page' => '#'
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
                <?php echo "Delete $name" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><?php echo $name ?></p>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Image<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><img src="<?php get_url('assets/uploads/investor/' . $picture); ?>" class="img-responsive" alt="investor Image"></p>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><?php echo $priority ?></p>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Content <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <p class="form-control-static"><?php echo $content ?></p>
                      </div>
                  </div>


                  <div class="form-group no-border">
                    <div class="col-sm-offset-2 col-sm-10">
                      <?php Hidden('Delete',$id) ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="<?php echo get_url('admin/investor/') ?>"class="btn btn-default">Cancel</a>
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

