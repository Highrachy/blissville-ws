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
require_once(INCLUDE_DIR.'profile.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'profile');

//Check for the id
if (isset($_GET['profile'])){
      $id = $_GET['profile'];
      
      //If the profile id is set but it is not defined
      if ($id == ""){
            redirect('admin/profile');
            exit();
      }  else {
            //The profile id is defined
            
            //Check if the user has posted the result
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

              # ****** COMPULSORY FIELDS **********#
              # *****************************************#
              # -- Name
              $data['name'] = assign('name','minlen=3','Please enter a valid Name');

                # -- Post
              $data['post'] = assign('post','minlen=3','Please enter a valid Post');

              # -- Email
              $data['email'] = assign('email');


             $id = $_SESSION['id'];

            $data['updated_at'] = "NOW()";


            if (empty($errors)) { // No Errors

                // Check if the email address exists in the database with a different Id
              $query = "SELECT name FROM admin WHERE email='".$data['email']."' AND id <> '$id'";
              $rows = $db->total_affected_rows($query);

              if ($rows == 0){ //No problem, name does not exist in the database
                $value = $db->update_query('admin',$data,"id=$id");         
                if ($value >= 1) { // If the insertion is successful
                  $_SESSION['name'] = $data['name'];
                  redirect('admin/dashboard.php?action=update');
                    
                } else { // An Error occured
                  trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
                }
              } else {
                $errors['error'] = 'The email address exists in the database';
              }
                  
            } // End of empty($errors) IF
 
              
            }
            
            //Display information to the user.
            $query = "SELECT id,name,email,post FROM admin
                      WHERE id = '{$_SESSION['id']}'";
            $table = $db->fetch_first_row($query);
            $total_rows = $db->total_affected_rows();

            //Check if the total_rows is less than 1
            if (get_total_profiles() < 1) {
                  redirect('admin/users/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);
            }
      }
} else {
      redirect('admin/users/?action=not-found');
      exit();
}

# -- Page Configuration ########################################################################################
$title = "Edit $name Profile";
$page_title = "Profiles";
$breadcrumb = array(
                      'Profiles' => 'admin/profile',
                      'Edit Profile' => '#'
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
                <?php echo "Edit Profile" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('name',$name,'class="form-control" placeholder="Enter Name"') ?>
                                  <?php show_errors('name') ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Email <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('email',$email,'class="form-control" placeholder="Email Address"') ?>
                                  <?php show_errors('email') ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Post <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('post',$post,'class="form-control" placeholder="Enter Post"') ?>
                                  <?php show_errors('post') ?>
                      </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <input type="reset" class="btn btn-default">Reset</button>
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

