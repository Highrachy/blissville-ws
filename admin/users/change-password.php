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
// require_once(INCLUDE_DIR.'profile.function.php');

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

              if (same($_POST['password'], $_POST['retype_password'])){
                if (minimum_length($_POST['password'], 6)){
                  //New Password is correct
                  $data['password'] = md5($_POST['password']);

                  //Verify the old password
                  if (minimum_length($_POST['old_password'], 6)){
                  $data['old_password'] = md5($_POST['old_password']);
                } else {
                  $errors['old_password'] = "Please enter your password";
                }
                } else {
                  $errors['password'] = "Your password must be at least 6 characters";
                }

              } else {
                $errors['retype_password'] = "Your password does not match";
              }

              $id = $_SESSION['id'];

              $data['modified'] = "NOW()";


              if (empty($errors)) { // No Errors

                // Check if the email address exists in the database with a different Id
                $query = "SELECT name FROM admin WHERE password='".$data['old_password']."' AND id = '$id'";
                $rows = $db->total_affected_rows($query);

                if ($rows == 1){ //No problem, name does not exist in the database
                  $value = $db->update_query('admin',$data,"id=$id");         
                  if ($value >= 1) { // If the insertion is successful
                    redirect('admin/dashboard.php?action=update');
                      
                  } else { // An Error occured
                    trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
                  }
                } else {
                  $errors['old_password'] = 'Kindly enter a valid password';
                }
                  
              } // End of empty($errors) IF.
 
              
            }
            
            //Display information to the user.
            $query = "SELECT password FROM admin
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
$title = "Change Password";
$page_title = "Change Password";
$breadcrumb = array(
                      'Users' => 'admin/users',
                      'Change Password' => '#'
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

                
                <!-- Old Password -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Old Password <span class="mandatory">*</span></label>
                  <div class="col-sm-8">
                      <?php Password('old_password','','class="form-control" placeholder="Old Password"') ?>
                      <?php show_errors('old_password') ?>
                  </div>
                </div>
                
                <!-- New Password -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">New Password <span class="mandatory">*</span></label>
                  <div class="col-sm-8">
                      <?php Password('password','','class="form-control" placeholder="New Password"') ?>
                      <?php show_errors('password') ?>
                  </div>
                </div>
                
                <!-- Retype Password -->
                <div class="form-group">
                  <label class="col-sm-3 control-label">Retype Password <span class="mandatory">*</span></label>
                  <div class="col-sm-8">
                      <?php Password('retype_password','','class="form-control" placeholder="Retype Password"') ?>
                      <?php show_errors('retype_password') ?>
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

