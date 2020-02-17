<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
include(SERVER_DIR.'lib/functions/upload.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
$editor = true;

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
              # ****** OPTIONAL FIELDS **********#
              # *****************************************#

              # -- Contents
              if (exists('content')){
                $data['content'] = assign('content','minlen=10','Please enter a valid content'); 
              }

              # ****** COMPULSORY FIELDS **********#
              # *****************************************#
              # -- Name
              $data['name'] = assign('name','minlen=3','Please enter a valid Name');

              $data['url_name'] = get_readable_url($data['name']);

              # -- Priority
              $data['priority'] = assign('priority', 'num');

              # -- investor Desc
              $data['content'] = assign('content','minlen=10','Please enter a valid investor Content');

              #- Modified 
              $data['updated_at'] = "NOW()";

              # - Picture
              $change_pics = false;
              if (isset($_FILES['picture']['tmp_name'])){
                $change_pics = true;
                if (!is_valid_image('picture'))
                  $change_pics = false;

              }


              if (empty($errors)){
                # - If the picture is changed
                if ($change_pics){
                  $upload_to = UPLOAD_DIR."investor/";
                  $data['picture'] = upload_file('picture',$upload_to);
                }

                # - Assign Previous image if there is any fuck up
                if (isset($data['picture']) && (empty($data['picture']))){
                  $data['picture'] = $_POST['old_picture'];
                  $change_pics = false;
                }

                if (isset($data['picture']) && ($data['picture'] == $_POST['old_picture']))
                  $change_pics = false;

                if (empty($errors)){
                  $action = update_investors($data, $id);

                  if ($change_pics){
                    #- Delete Old Picture
                    if (!empty($_POST['old_picture'])){
                      $to_delete = UPLOAD_DIR. 'investor/'.$_POST['old_picture'];
                      unlink($to_delete);
                    }
                  }
                }
                

              }

              if (empty($errors)){
                
                if ($action == 'exists'){
                  $errors['error'] = "The investor exists in the database";
                } else {
                  redirect('admin/investor/?action='.$action); 
                }
                     
              }


              
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
                      'Edit Page' => '#'
              );

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
              <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
              
                <h3 class="page-title">
                <?php echo "Edit $name" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Text('name',$name,'class="form-control" placeholder="Name of the Page"') ?>
                                  <?php show_errors('name') ?>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php 
                              $priority_value = array();
                              for ($i=1; $i <= 10 ; $i++) { 
                                  $priority_value[$i] = $i;
                              }

                                  Select('priority',$priority_value,$priority,'class="form-control"') ;
                              ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Picture<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="<?php get_url('assets/uploads/investor/' . $picture); ?>" data-src="<?php get_url('assets/uploads/investor/' . $picture); ?>" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php show_errors('picture') ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Content<span class="mandatory">*</span> </label>
                      <div class="col-sm-10">
                        <?php Textarea('content',$content," class='editor'") ?>
                        <?php show_errors('content','Enter the investor Content here') ?>
                      </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name = "old_picture" value="<?php echo $picture ?>">                        
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-default">Reset</button>
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

