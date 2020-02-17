<?php 
include('config.php'); 

# -- Get all Homepage Content
Page::sort_order_by('id ASC');
Page::set_table(Page::TBL_HOME);
$homepage = Page::get_all();

# -- Get About Us Content (WHY Blissville)
Page::set_table(Page::TBL_ABOUT_US);
$about_content = Page::get_one('WHERE id = 6');//Benefits of Blissville
$about = Page::get_all();

# -- Get Investor Content
Page::set_table(Page::TBL_INVESTORS);
$investor = Page::get_one('WHERE id = 1');//Benefits of Blissville

# -- Get the Property
$propertys = Property::get_all('',2);

# -- Get the Slideshow
$slideshows = Slideshow::get_all('WHERE show_picture='."'YES'");

# -- Page Configuration ########################################################################################
$title = "home";
$subheader = false;
$register_footer = false;
$page_title = "Home";
$page_desc = "Welcome to Blissville Condominiums";
$breadcrumb = array();
$slider = true;
include(INCLUDE_DIR.'header.php'); 

?>
        
    <!-- Page content -->
    <div class="page-content">


        <?php if (!empty($slideshows)) {?>
        <!-- Slider block -->
        <section class="slider-block container-fluid p-0">
            <!-- Slider Section -->
            <div id="property-slider" class="carousel slider-section" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                  <?php $i = 0;
                   foreach($slideshows as $slideshow) { ?>
                    <div class="item<?php if ($i == 0) echo ' active' ?>">
                        <img src="<?php URL::display('assets/uploads/slideshow/'.$slideshow['picture']); ?>" alt="<?php echo $slideshow['name'] ?>">
                        
                        <?php if (!empty($slideshow['description'])) { ?>
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row">

                                    <div class="col-md-5 col-sm-12">

                                        <aside class="content">

                                            <h2><?php echo $slideshow['name'] ?></h2>
                                        
                                            <?php echo $slideshow['description'] ?>

                                            <?php if (!empty($slideshow['link_page']) && (!empty($slideshow['link_text']))) { ?>
                                                <a href="<?php echo $slideshow['link_page'] ?>" class="btn btn-primary">
                                                    <?php echo $slideshow['link_text'] ?>
                                                </a> &nbsp; &nbsp;
                                            <?php } ?>

                                            <?php if (!empty($slideshow['buy_page']) && (!empty($slideshow['buy_text']))) { ?>
                                                <a href="<?php echo $slideshow['buy_page'] ?>" class="btn btn-default">
                                                    <?php echo $slideshow['buy_text'] ?>      
                                                </a>
                                            <?php } //end if $slideshow buy now ?>
                                        </aside>
                                    </div> 
                                    <!-- /.col-md-6 -->

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                   <?php $i++; } //end forach slideshows ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#property-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#property-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- Slider Section /- -->
        </section><!-- Slider Block /- -->
        <?php } //end !empty slideshows ?>

        <section>
            <div class="promo">
                <div class="container">

                    <div class="content">
                        <h3 class="wow fadeInUp"><?php echo $homepage[0]['name'] ?></h3>
                        <span class="">
                            <div class="row">
                                <div class="col-md-10 wow fadeInUp" data-wow-delay="0s"><?php echo $homepage[0]['content'] ?></div>
                                <div class="col-md-2"><a href="our-portfolio.php" class="btn btn-default btn-lg wow fadeInRight" data-wow-delay="0.5s">Learn More</a></div>
                            </div>
                            
                            
                        </span>
                    </div>
                        
                </div>
            </div>
        </section>


        <section class="mt-80">
            <div class="container">

                <div class="row">



                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0s">
                        <div class="normal-header">
                            <h3><?php echo $homepage[1]['name'] ?></h3>
                        </div>
                        <div class="text-justify"><?php echo $homepage[1]['content'] ?></div>
                        <div class="mb-50">
                            <a href="our-portfolio.php" class="btn btn-primary btn-sm">Learn More</a>
                        </div>
                    </div>




                    <div class="col-md-8">
                                
                         <div class="normal-header hidden-md hidden-lg">
                            <h3>Properties</h3>
                         </div>
                        <div class="row">
                            <?php 
                                $count = 1; 
                                $delay = "";
                                foreach($propertys as $property) : 

                                $delay = $count ."s";
                                ?>
                            <div class="col-sm-6 wow fadeInUp" data-wow-delay="<?php echo $delay ?>">

                                <?php echo Property::box($property) ?>

                            </div>                                
                            <?php 
                                $count++;
                                endforeach
                             ?>
                                                    
                        </div>
                    </div>

                </div>
            </div>
        </section>



         <section class="mt-80">
            <div class="container">


                <div class="normal-header">
                    <h3>BENEFITS OF BLISSVILLE</h3>
                </div>

                <div class="row">

                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="0s">
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


                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-box">
                            <div class="text-center">
                                <div class="img-holder">
                                    <img src="<?php URL::display('assets/img/icons/141.png') ?>" alt="">
                                </div>
                                <h4 class="text-uppercase">Energy Efficient Houses</h4>
                            </div>
                            <div class="feature-text feature-short">
                                Energy efficient houses that gives you up to 25% power cost savings.
                            </div>
                        </div>
                        <!--end of feature-->
                    </div>



                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="0.6s">
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



                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="0.9s">
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



                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="1.2s">
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



                    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" data-wow-delay="1.5s">
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

                <div class="row">


                    <div class="col-md-4 col-sm-6 wow fadeInUp mb-50" data-wow-delay="0s">
                        
                        <div class="normal-header">
                            <h3><?php echo $homepage[2]['name'] ?></h3>
                        </div>
                        <div class="service-box pr-40">
                            <p><?php echo $homepage[2]['content'] ?></p>
                        </div>
                    </div>
                    

                    <div class="col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="1s">

                         <div class="normal-header">
                            <h3><?php echo $investor['name'] ?></h3>
                        </div>
                        <div class="service-box">
                            <p><?php echo Text::truncate($investor['content'], 350, ".", "") ?></p>
                        </div>

                    </div>

                    <div class="col-sm-8 col-sm-offset-2 col-md-offset-0 col-md-4 wow zoomIn" data-wow-delay="2s">

                        <div class="info-container" style="height:220px;">
                            
                            <!-- <img class="img-responsive" src="<?php URL::display('assets/img/investor.jpg') ?>" alt="TODO"> -->
                            <div class="info">
                                <div class="info-content">
                                    <h3 class="big"><span>Get up to 45%</span></h3>
                                    <h4 class="normal">Return on Investment</h4>
                                    <a href="investors.php" class="btn btn-default">Learn More</a>
                                    <br>
                                    <div class="small">Invest today and watch your money grow...</div>
                                </div>
                            </div>

                            <!-- 
                            <p class="mt-20">Blissville Condos are without a doubt one of the most viable real estate investments opportunities in the country and avails our esteemed investors with wonderful returns</p> -->
                        
                        </div>
                        <!-- /.info-container -->

                    </div>
                    <!-- /.col-sm-4 -->

                </div>
                <!-- /.row -->
            </div>
        </section>      

        
    </div><!-- Page Content -->

  <?php include('inc/footer.php');