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
                                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                                    <div class="feature boxed bg-secondary">
                                        <form class="text-center form-email" data-error="There were errors, please check all required fields and try again" data-success="Thanks for taking the time to complete the planner. We'll be in touch shortly!">
                                            <h4 class="uppercase mt48 mt-xs-0">Plan your Foundry project</h4>
                                            <p class="lead mb64 mb-xs-24">
                                                Share a little detail about your project so we<br> can tailor the solution that's right for you.
                                            </p>
                                            <div class="overflow-hidden">
                                                <hr>
                                                <h6 class="uppercase">
                                                1. What type of work do you require?
                                                </h6>
                                                <div class="col-sm-3">
                                                    <p class="mb16">
                                                        Web Design
                                                    </p>
                                                    <div class="checkbox-option text-left">
                                                        <div class="inner"></div>
                                                        <input type="checkbox" name="webdesign" value="webdesign">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb16">
                                                        Branding &amp; Identity
                                                    </p>
                                                    <div class="checkbox-option text-left">
                                                        <div class="inner"></div>
                                                        <input type="checkbox" name="branding" value="branding">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb16">
                                                        Print Marketing
                                                    </p>
                                                    <div class="checkbox-option text-left checked">
                                                        <div class="inner"></div>
                                                        <input type="checkbox" name="print" value="print">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb16">
                                                        Photography
                                                    </p>
                                                    <div class="checkbox-option text-left">
                                                        <div class="inner"></div>
                                                        <input type="checkbox" name="photography" value="photography">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="overflow-hidden">
                                                <h6 class="uppercase">
                                                2. What is your approximate budget?
                                                </h6>
                                                <div class="col-sm-4">
                                                    <p>&lt; $4,000</p>
                                                    <div class="radio-option">
                                                        <div class="inner"></div>
                                                        <input type="radio" name="budget" value="under4k">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>$4,000 - $10,000</p>
                                                    <div class="radio-option checked">
                                                        <div class="inner"></div>
                                                        <input type="radio" name="budget" value="4kup">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>$10,000+</p>
                                                    <div class="radio-option">
                                                        <div class="inner"></div>
                                                        <input type="radio" name="budget" value="10kup">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="overflow-hidden">
                                                <h6 class="uppercase">
                                                3. Your personal details
                                                </h6>
                                                <input type="text" name="name" class="col-md-6 validate-required" placeholder="Your Name*">
                                                <input type="text" name="email" class="col-md-6 validate-required validate-email" placeholder="Your Email Address*">
                                                <input type="text" name="website" placeholder="Your Current Website Address">
                                                <textarea name="message" placeholder="Additional comments" rows="2"></textarea>
                                                <hr>
                                            </div>
                                            <div class="overflow-hidden">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <h6 class="uppercase">
                                                    4. Lastly, how did you hear of us?
                                                    </h6>
                                                    <div class="select-option">
                                                        <i class="ti-angle-down"></i>
                                                        <select name="referrer">
                                                            <option selected="" value="Default">Select An Option</option>
                                                            <option value="google">Google</option>
                                                            <option value="website">Our Website</option>
                                                            <option value="friend">A Friend</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit">Submit Planner</button>
                                                </div>
                                            </div>
                                        </form>
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
?>
OUr discounted purchase rates avail you with up to 15% for immediate returns on investment.
Energy efficient houses that gives you up to 25% power cost savings
Flexible and customized payments plans to  complement your income streams
We strictly transact with proper titled lands for seamless transfer of ownership.
Blissville Estates are strategically located with multiple roads