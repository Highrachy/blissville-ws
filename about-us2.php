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

$page = "";
if (isset($_GET['page'])){
  //Get all infomation about the selected page
  $page = $_GET['page'];
} 

$about = get_about($page);


if ($page == 'testimonials'){
  require_once(INCLUDE_DIR.'testimonial.function.php');
  $testimonials = get_testimonials(0,false,'YES');
}


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
                                                <h3>Our Vision</h3>
                                            </div>
                                            <div class="text-justify">
                                                 <p class="lead">&ldquo;To be a front runner in providing convenient and efficient housing thereby enhancing returns to our investors and property owners.&rdquo;</p>
                                                 <p>Our projects strategically aim at providing energy efficient luxurious condos that are well within your grasp. Unique edifices that don't just cater for the affordability on procurement but also ensure that the lives of the occupants are enhanced at minimum running and maintenance cost. The architectural designs respond imaginatively to the cultural climatic and environment conditions as such only the most suitable materials are considered and specified. We don't just sell homes, we guarantee your future.</p>

                                                <p>We intend to continuously and progressively expand
                                                    our portfolio nationwide over the next five years and
                                                    provide similar housing solutions suitable for
                                                    strategically selected locations like Ibeju Lekki,
                                                    Porthharcourt, Uyo, Abuja and Kaduna.</p>
                                            </div>
                                               
                                            
                                        </div>
                                        <!-- /.col-sm-6 -->
                                        <div class="col-sm-6">
                                            <div class="skip-header">
                                                    
                                                <img src="assets/images/about-us.jpg" alt="rent" class="img-responsive" />
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
                                                <h3>Benefits of Blissville Condos</h3>
                                                    <ul>
                                                        <li>Our discounted purchase rates avail you with up to 15% for  immediate returns on investment.</li>
                                                        <li>Energy efficient houses that gives you up to 25% power cost  savings</li>
                                                        <li>Flexible and customized payment plans to complement your  income streams</li>
                                                        <li>We strictly transact with proper titled lands for seamless  transfer of ownership.</li>
                                                        <li>Blissville Estates are strategically located with multiple  roads and close proximity to healthcare facilities, grocery shopping centres,  ATMs and filling stations for increased convenience.</li>
                                                        <li>The use of Horticulture and other natural components  increase homeliness of the estates</li>
                                                    </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">                                       
                                            <div class="normal-header">
                                                <h3>Location Summary</h3>
                                            </div>
                                            <div class="text-justify">
                                                 <p>Blissville Condos will be accessible via multiple routes giving you the option of choice while on the move. Our estates will be conveniently located within the Lekki/Epe axis between Ikate and Chevron environs. </p>
                                                 <p>Notable locations within close proximity include;</p>
                                                <ul>
                                                    <li>The new Circle Mall</li>
                                                    <li>Prince Ebeano Supermarket</li>
                                                    <li>Dreamworld Africana Amusement Park</li>
                                                    <li>Lekki Conservation Center accessories</li>
                                                    <li>Several bank branches, ATMs, plazas and filling/service stations guarantee the convenience experienced by our residents.</li>
                                                </ul>  
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                    
                            </section>


                            <section class="mt-80">
                                <div class="container">

                                    <div class="normal-header">
                                        <h3>Features of <span>Blissville Condominiums</span></h3>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            
                                            <div class="service-box">
                                                <h3>Safety and Security:</h3>
                                                <p>
                                                    <strong>'Safety first'</strong> is the watch phrase as we implement several standardized security features;
                                                </p>
                                                    <ul>
                                                        <li>Perimeter fence, electrically protected</li>
                                                        <li>Automated gates that can be controlled right from the comfort of your home</li>
                                                        <li>Panic Alarm system</li>
                                                        <li>Fire detection and firefighting apparatus</li>
                                                    </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            
                                            <div class="service-box">
                                                <h3>Power and ICT:</h3>
                                                <p>We have harnessed superior architectural designs with technological systems that enhance lives and save time and lots of money;</p>
                                                <ul>
                                                    <li>Smart solar and inverter systems</li>
                                                    <li>Efficient lighting systems</li>
                                                    <li>Cable TV distribution network</li>
                                                    <li>Core fiber internet connectivity</li>
                                                    <li>Intercom and Gate Management</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="service-box">
                                                <h3>Ambience and Lifestyle:</h3>
                                                <p>We provide plush luxury at affordable rates via a wide range of recreational amenities including;</p>
                                                <ul>
                                                    <li>Swimming pool/ Children’s play area <span class="danger">*</span></li>
                                                    <li>Rooftop gym/ Dance room</li>
                                                    <li>Sky lounge with exciting views</li>
                                                    <li>Dedicated parking for vehicles</li>
                                                </ul>
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
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/samsung.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/gtbank.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/diamond.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/jutem.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/ezinc.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/schmid.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/commax.png" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="assets/images/clients/voltronic.png" alt="Clients" class="img-responsive"></a></li>
                                        </ul>


                                    </div>
                                </div>
                            </section>




<?php include('inc/footer.php');