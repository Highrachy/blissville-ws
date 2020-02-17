<?php
include('../config.php'); 

# -- Page Configuration ########################################################################################
$title = "Dashboard Test Page";
$page_title = "Login";


$subheader = false;
$register_footer = false;
$dashboard = true;

include(SERVER_DIR.'inc/header.php');
?>
    
    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <div class="">


                            <h3>Welcome back 
                              <?php if (isset($_SESSION['name'])) echo ' '.$_SESSION['name']; ?>,</h3><br>

                            <?php Alert::display(); //Necessary for get_action to work effectively ?>
                            <div class="row">
                                  
                                  <div class="col-md-6" >
                                    <div class="portlet portlet-big" style="background-image: url('<?php echo BASE_URL ?>assets/uploads/slideshow/slide-3.jpg');background-size:cover;">
                                        <a href="<?php URL::display('admin/portfolio/new.php') ?>">
                                          
                                          <i class="fa fa-legal"></i>
                                          <h3>Add Portfolio</h3>
                                          <span>Add New Portfolio into the database</span>
                                        </a>
                                    </div>

                                  </div>


                                  <div class="col-md-6">
                                    <div class="row">
                                        
                                      <div class="col-xs-6 portlet portlet-blue">
                                        <a href="<?php URL::display('admin/portfolio/new.php') ?>">

                                          <i class="fa fa-legal"></i>
                                          <h3>Add Portfolio</h3>
                                        </a>
                                      </div>
                                     

                                      <div class="col-xs-6 portlet portlet-red">
                                        <a href="<?php URL::display('admin/article/new.php') ?>">
                                          <i class="fa fa-file-text-o"></i>
                                          <h3>Add Article</h3>
                                        </a>
                                      </div>
                                       

                                      <div class="col-sm-6 portlet portlet-black">
                                        <a href="<?php URL::display('admin/event/new.php') ?>">
                                          <i class="fa fa-bullhorn"></i>
                                          <h3>Add FAQs</h3>
                                        </a>
                                      </div>
                                      


                                      <div class="col-sm-6 portlet portlet-orange">
                                        <a href="<?php URL::display('admin/slideshow/new.php') ?>">
                                          <i class="fa fa-image"></i>
                                          <h3>Add Slideshow</h3>
                                        </a>
                                      </div>
                                    </div>

                                  </div>
                                 
                                  
                            </div>

               
                </div>
            </div>


      </div>

    </section>


<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>
