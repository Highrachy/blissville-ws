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
                                        <a href="<?php URL::display('admin/portfolio/new.php') ?>">
                                          
                                          <i class="fa fa-edit"></i>
                                          <h3>Edit Contents</h3>
                                          <span>Edit Webisite Contents</span>
                                        </a>
                                    </div>

                                  </div>


                                  <div class="col-md-6">
                                    <div class="row">
                                        
                                      <div class="col-xs-6 portlet portlet-blue">
                                        <a href="<?php URL::display('admin/portfolio/new.php') ?>">

                                          <i class="fa fa-legal"></i>
                                          <span class="number">1</span>
                                          <h3>Add Portfolio</h3>
                                        </a>
                                      </div>
                                     

                                      <div class="col-xs-6 portlet portlet-red">
                                        <a href="<?php URL::display('admin/article/new.php') ?>">
                                          <i class="fa fa-file-text-o"></i>
                                          <span class="number">29</span>
                                          <h3>Add Article</h3>
                                        </a>
                                      </div>
                                       

                                      <div class="col-sm-6 portlet portlet-black">
                                        <a href="<?php URL::display('admin/event/new.php') ?>">
                                          <i class="fa fa-bullhorn"></i>
                                          <span class="number">430</span>
                                          <h3>Add FAQs</h3>
                                        </a>
                                      </div>
                                      


                                      <div class="col-sm-6 portlet portlet-orange">
                                        <a href="<?php URL::display('admin/slideshow/new.php') ?>">
                                          <i class="fa fa-image"></i>
                                          <span class="number">1576</span>
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

