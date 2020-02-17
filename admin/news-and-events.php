<?php
include('../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
# -- Page Configuration ########################################################################################
$title = "dashboard";
$page_title = "Dashboard";
$breadcrumb = array('Dashboard' => 'admin/dashboard.php');


include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
                <div class="col-md-9 col-md-push-3">


                            <h3>News and Events</h3><br>

                            <?php display_alert(); //Necessary for get_action to work effectively ?>
                            <div class="row">


                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php get_url('admin/article/') ?>">
                                      <i class="fa fa-file-text-o"></i>
                                      Articles
                                    </a>
                                  </div>

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php get_url('admin/news/') ?>">
                                      <i class="fa fa-files-o"></i>
                                      News
                                    </a>
                                  </div>
                                   

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php get_url('admin/event/') ?>">
                                      <i class="fa fa-bullhorn"></i>
                                      Events
                                    </a>
                                  </div>

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php get_url('admin/notification/') ?>">
                                      <i class="fa fa-bell-o"></i>
                                      Notifications
                                    </a>
                                  </div>

                            </div>

               
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

