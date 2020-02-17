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
require_once(INCLUDE_DIR.'options.function.php');
# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'option');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


  # -- Address
  if (isset($_POST['address']) && (!empty($_POST['address']))){
    $value = assign('address', 'minlen=5','Please enter a valid Address');
    $id = 1;
  }

  # -- Phone
  if (isset($_POST['phone']) && (!empty($_POST['phone']))){
    $value = assign('phone', 'minlen=5','Please enter a valid Phone');
    $id = 2;
  }


  # -- Email
  if (isset($_POST['email']) && (!empty($_POST['email']))){
    $value = assign('email', 'email','Please enter a valid Email');
    $id = 3;
  }


  # -- Facebook
  if (isset($_POST['facebook']) && (!empty($_POST['facebook']))){
    $value = assign('facebook', 'req','Please enter a valid Facebook');
    $id = 4;
  }


  # -- Twitter
  if (isset($_POST['twitter']) && (!empty($_POST['twitter']))){
    $value = assign('twitter', 'req','Please enter a valid Twitter');
    $id = 5;
  }


  # -- Linkedin
  if (isset($_POST['linkedin']) && (!empty($_POST['linkedin']))){
    $value = assign('linkedin', 'req','Please enter a valid Linkedin');
    $id = 6;
  }


  # -- Youtube
  if (isset($_POST['youtube']) && (!empty($_POST['youtube']))){
    $value = assign('youtube', 'req','Please enter a valid Youtube');
    $id = 6;
  }


  $action = update_options($value,$id);
  get_action($action,'option');
  
}

# -- Page Configuration ########################################################################################
$title = "home";
$page_title = "Options Page";
$breadcrumb = array(
                'Options' => '#',
              );

include(SERVER_DIR.'inc/header.php');
?>


    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
            
                <h3 class="page-title">
                Options Page
                <br><br>
                </h3>
                <?php foreach ($options as $name => $value ){ if ($name == 'menu') continue; ?>

                
                <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">


                  <?php if ($name == 'address'){ ?>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Address </label>
                      <div class="col-sm-7">
                        <?php Textarea('address',$value," class='editor'") ?>
                        <?php show_errors('address','Enter your Address here') ?>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>

                  <?php } else { ?>
                  <?php if (!empty($value)) { ?>
                  <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo ucfirst($name) ?></label>
                      <div class="col-sm-7">
                        <div class="input-group">
                          <?php Text($name,$value,'class="form-control" placeholder="Enter your value for '.ucfirst($name)) ?>"') ?>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"> Save</button>
                          </span>
                        </div>
                      </div>
                    <?php show_errors($name) ?>
                  </div>
                  <?php } ?>
                  
                  <?php } ?>
                </form>
                <?php } ?>


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

