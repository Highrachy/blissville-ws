<?php 
include('config.php');

# -- Get About Us Content (WHY Blissville)
Page::sort_order_by('id ASC');
Page::set_table(Page::TBL_ABOUT_US);
$about = Page::get_all();

# -- Map Configuration
$map['latitude'] = 6.438156;
$map['longitude'] = 3.540235;
$map['name'] = "Blissville Uno";


# -- Page Configuration 
$title = "about-us";
$page_title = "About Blissville";
$page_desc = "Powered by Highrachy";

include('inc/header.php'); 

?>


                            <section class="page-content">
                                <div class="container">

                                    <div class="row mt-80">
                                        <div class="col-md-6">
                                            <div class="normal-header">
                                                <h3><?php echo $about[0]['name'] ?></h3>
                                            </div>
                                            <div class="text-justify">
                                                <?php echo $about[0]['content'] ?>
                                            </div>
                                               
                                            
                                        </div>
                                        <!-- /.col-sm-6 -->
                                        <div class="col-md-6">
                                            <div class="skip-header">
                                                    
                                                <img src="<?php URL::display('assets/images/about-us.jpg') ?>" alt="<?php echo $about[0]['name'] ?>" class="img-responsive" />
                                            </div>
                                        </div>
                                        <!-- /.col-sm-6 -->
                                        
                                    </div>
                                    <!-- /.row -->
                                    <!-- /.row -->
                                </div>
                            </section>

                            <section class="bg-gray mt-80">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-6">
                                            <div class="normal-header">
                                                <h3><?php echo $about[1]['name'] ?></h3>
                                            </div>
                                            <div class="text-justify">
                                                 <?php echo $about[1]['content'] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-md-offset-1">
                                            <div class="skip-header">
                                                <div id="map-location" style="height: 300px; width: 100%;"></div>
                                            </div>
                                        </div>
                                        <!-- /.col-sm-6 -->

                                        
                                    </div>
                                </div>
                                    
                            </section>


                            <section class="content-parallax" style="background-image: url('<?php URL::display('assets/uploads/slideshow/slide-3.jpg'); ?>">
                                <div class="content-parallax_overlay"></div>

                                <div class="container">

                                    <div class="content-parallax_text">
                                       

                                        <div class="normal-header">
                                            <h3>FEATURES OF BLISSVILLE</h3>
                                        </div>

                                        <div class="row">
                                        
                                            <div class="col-sm-8 col-xs-10 col-md-4">
                                                
                                                <div class="service-box">
                                                    <h3><?php echo $about[2]['name'] ?></h3>
                                                     <?php echo $about[2]['content'] ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-10 col-md-4">
                                                
                                                <div class="service-box">
                                                    <h3><?php echo $about[3]['name'] ?></h3>
                                                     <?php echo $about[3]['content'] ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-10 col-md-4">
                                                <div class="service-box">
                                                    <h3><?php echo $about[4]['name'] ?></h3>
                                                     <?php echo $about[4]['content'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </section> 


                            <section class="mt-80">
                                <div class="container">


                                    <div class="normal-header mb-30">
                                        <h3>BENEFITS OF BLISSVILLE</h3>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/130.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">15% Immediate Returns</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                    You can enjoy up to 15% immediate returns on investment from our discounted package
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>


                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/141.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">Enery Efficient Houses</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                    Energy efficient houses that gives you up to 25% power cost savings.
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>



                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/114.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">Friendly Payment Plans</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                    Flexible and customized payment plans to complement your income streams.
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>



                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/074.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">Seamless Transfer of Ownership</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                   We strictly transact with proper titled lands for seamless transfer of ownership.
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>



                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/019.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">Strategically located</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                   Close proximity to healthcare facilities, grocery shopping centres, ATMs and filling stations for increased convenience
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>



                                        <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                            <div class="feature-box">
                                                <div class="text-center">
                                                    <div class="img-holder">
                                                        <img src="<?php URL::display('assets/img/icons/080.png') ?>" alt="">
                                                    </div>
                                                    <h4 class="text-uppercase">Homeliness and Comfort</h4>
                                                </div>
                                                <div class="feature-text feature-short">
                                                    The use of Horticulture and other natural components increase homeliness of the estates.
                                                </div>
                                            </div>
                                            <!--end of feature-->
                                        </div>

                                        
                                    </div>
                                </div>
                            </section>



                            <section class="bg-gray mt-80">
                                <div class="container">
                                       

                                    <div class="normal-header">
                                        <h3>Management Team</h3>
                                    </div>
                                        
                                    <div class="row">
                                        
                                        <div class="col-sm-6 col-xs-offset-1 col-sm-offset-0 col-xs-10">
                                            <div class="thumbnail mb-30">
                                                <!-- <img class="img-responsive" src="<?php URL::display('assets/img/team.png') ?>" alt=""> -->
                                                <div class="caption">
                                                    <h4 class="text-primary" style="margin-bottom: 5px">Nnamdi Ijei, PMP (Co-founder)</h4>
                                                    <!-- <small><strong class="text-success">Co-founder</strong></small> -->

                                                    <p>As a seasoned professional certified by the Project management institute of America, Nnamdi has several years of project management experience, during which he has worked on countless projects including the branch Network expansion program for StanbicIBTC bank at the turn of the decade. He is the current CEO of Highrachy Investment and Technology Ltd.</p>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-offset-1 col-sm-offset-0 col-xs-10">
                                            <div class="thumbnail mb-30">
                                                <!-- <img class="img-responsive" src="<?php URL::display('assets/img/team.png') ?>" alt=""> -->
                                                <div class="caption">
                                                    <h4 class="text-primary" style="margin-bottom: 5px">Emeka Ijei LLB, BL, LLM (Co-founder)</h4>
                                                    <!-- <small><strong class="text-success">Co-founder</strong></small> -->

                                                    <p>The Erudite lawyer with experience in corporate law and management has a keen eye for compliance and perfection. Equipped with a masters degree in Law from  the University of London, He is the legal and general counsel for A &amp; P Foods, part of Pladis, a global biscuit and confectionary business.</p>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                            
                                        <div class="col-sm-6 col-xs-offset-1 col-sm-offset-0 col-xs-10">
                                            <div class="thumbnail mb-30">
                                                <!-- <img class="img-responsive" src="<?php URL::display('assets/img/team.png') ?>" alt=""> -->
                                                <div class="caption">
                                                    <h4 class="text-primary" style="margin-bottom: 5px">Julius Airhia (Engineer)</h4>
                                                    <!-- <small><strong class="text-success">Engineer</strong></small> -->

                                                    <p>With over 10 years experience in construction management in diverse capacities for many sizes of construction feats and equipped with a B.Eng in Civil Engineering Julius is more than capable of delivering our projects in line with project requirements.</p>

                                                </div>
                                            </div>
                                        </div>
                

                                        <div class="col-sm-6 col-xs-offset-1 col-sm-offset-0 col-xs-10">
                                            <div class="thumbnail mb-30">
                                                <!-- <img class="img-responsive" src="<?php URL::display('assets/img/team.png') ?>" alt=""> -->
                                                <div class="caption">
                                                    <h4 class="text-primary" style="margin-bottom: 5px">Haruna Popoola (IT, Research &amp; Development)</h4>
                                                    <!-- <small><strong class="text-success">IT, Research &amp; Development</strong></small> -->

                                                    <p>The ingenious Haruna manages our ICT and research unit. With a bachelor of technology degree in Computer Science &amp; Engineering and a diploma in Application development, he has constantly proven to be an integral part of such a solution oriented team.</p>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                    
                            </section>


                            <section class="mt-80">
                                <div class="container">

                                    <div class="normal-header">
                                        <h3>Strategic<span> Relationships </span></h3>
                                    </div>

                                    <div class="row">
                                        <ul class="clients-grid clearfix">
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/samsung.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/gtbank.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/jutem.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/ezinc.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/schmid.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/commax.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                            <li class="col-md-3 col-sm-4 col-xs-6"><a href="#"><img src="<?php URL::display('assets/images/clients/voltronic.png') ?>" alt="Clients" class="img-responsive"></a></li>
                                        </ul>


                                    </div>
                                </div>
                            </section>




<?php include('inc/footer.php');