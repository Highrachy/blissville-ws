<?php
include('../config.php'); 

$dashboard = true;
# -- Page Configuration ########################################################################################
$title = "dashboard";
$page_title = "Dashboard";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <div class="">


                            <h3>Welcome back,
                              <?php echo ' '.Session::get('name'); ?></h3><br>

                            <?php Alert::display(); //Necessary for get_action to work effectively ?>
                            <div class="row">

                                  <div class="col-md-6" >
                                    <div class="portlet portlet-big" style="background-image: url('<?php echo BASE_URL ?>assets/uploads/slideshow/slide-3.jpg');background-size:cover;">
                                        <a href="<?php URL::display('admin/property') ?>">
                                          
                                          <i class="fa fa-edit"></i>
                                          <h3>Edit Properties</h3>
                                          <span>Click to edit the Properties on the website</span>
                                        </a>
                                    </div>

                                  </div>


                                  <div class="col-sm-6">
                                    <div class="row">
                                        
                                      <div class="col-sm-6 portlet portlet-blue">
                                        <a href="<?php URL::display('admin/edit-content/homepage') ?>">

                                          <i class="fa fa-home"></i>
                                          <h3>Home Page</h3>
                                        </a>
                                      </div>
                                     

                                      <div class="col-sm-6 portlet portlet-red">
                                        <a href="<?php URL::display('admin/edit-content/about') ?>">
                                          <i class="fa fa-folder"></i>
                                          <h3>About</h3>
                                        </a>
                                      </div>
                                       

                                      <div class="col-sm-6 portlet portlet-black">
                                        <a href="<?php URL::display('admin/edit-content/portfolio') ?>">
                                          <i class="fa fa-file-text"></i>
                                          <h3>Portfolio</h3>
                                        </a>
                                      </div>
                                      


                                      <div class="col-sm-6 portlet portlet-orange">
                                        <a href="<?php URL::display('admin/edit-content/investor') ?>">
                                          <i class="fa fa-legal"></i>
                                          <h3>Investors</h3>
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

