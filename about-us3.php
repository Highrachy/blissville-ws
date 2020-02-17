






<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 

$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


# -- Start Editable ########################################################################################
require_once(INCLUDE_DIR.'editable.function.php');
activate_editable();

$action = "";

 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Verify if it is editable
  if (isset($_POST['editable']) && ($_POST['editable'] == 'editable')){
    extract($_POST);
    $action = update_editable($data, $id, $table_name);

    //Get Notification
    get_action($action,'page');
  }
 }
# -- End Editable ########################################################################################



#-############################################
# GET ALL CONTENTS FOR ABOUT US 
#-############################################
require_once(INCLUDE_DIR.'about.function.php');

$about = get_about();


# -- Page Configuration ########################################################################################
$title = "about-us";
$page_title = "About Blissville condominiums";
$page_desc = "Powered by Highrachy";
$breadcrumb = array('About Us'=> '#');

include('inc/header.php'); 

?>


                            <section class="page-content">
                                <div class="container">

                                    <div class="row mt-80">
                                        <div class="col-sm-6">
                                             <div class="normal-header">
                                                <h3><?php echo $about[0]['name'] ?></h3>
                                            </div>
                                            <div class="text-justify">
                                                <?php echo $about[0]['content'] ?>
                                            </div>
                                               
                                            
                                        </div>
                                        <!-- /.col-sm-6 -->
                                        <div class="col-sm-6">
                                            <div class="skip-header">
                                                    
                                                <img src="<?php get_url('assets/images/about-us.jpg') ?>" alt="rent" class="img-responsive" />
                                            </div>
                                        </div>
                                        <!-- /.col-sm-6 -->
                                        
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </section>

                            <section class="bg-gray mt-80">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="normal-header">
                                                <h3><?php echo $about[1]['name'] ?></h3>
                                            </div>
                                            <div id="map-location" style="height: 300px; width: 100%;"></div>                              
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="skip-header text-justify">
                                                 <?php echo $about[1]['content'] ?>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                    
                            </section>


                            <section class="mt-80">
                                <div class="container">

                                    <div class="normal-header">
                                        <h3>FEATURES OF BLISSVILLE CONDOMINIUMS</h3>
                                    </div>

                                    <div class="row">
                                    
                                        <div class="col-sm-4">
                                            
                                            <div class="service-box">
                                                <h3><?php echo $about[2]['name'] ?></h3>
                                                 <?php echo $about[2]['content'] ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            
                                            <div class="service-box">
                                                <h3><?php echo $about[3]['name'] ?></h3>
                                                 <?php echo $about[3]['content'] ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="service-box">
                                                <h3><?php echo $about[4]['name'] ?></h3>
                                                 <?php echo $about[4]['content'] ?>
                                            </div>
                                        </div>
                                         <div class="col-xs-12"><span class="danger">* </span> Subject to land conditions</div>
                                    </div>
                                </div>
                            </section>



                            <section class="mt-80">
                                <div class="container">

                                    <div class="normal-header">
                                        <h3>Strategic<span> Partnerships </span></h3>
                                    </div>

                                    <div class="row">
                                        <ul class="clients-grid clearfix">
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/samsung.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/gtbank.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/diamond.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/jutem.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/ezinc.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/schmid.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/commax.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php get_url('assets/images/clients/voltronic.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                        </ul>


                                    </div>
                                </div>
                            </section>




<?php include('inc/footer.php');