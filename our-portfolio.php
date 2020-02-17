<?php
include('config.php'); 

# -- Live Edit
// $editable = LiveEdit::activate();
// if (Form::is_posted())
//     $action = LiveEdit::save($data,$id,$table_name);

# -- Get About Us Content (WHY Blissville)
Page::sort_order_by('id ASC');
Page::set_table(Page::TBL_PORTFOLIO);
$portfolio_content = Page::get_one('WHERE id = 1');
$propertys = Property::get_all('',2);

# -- Map Configuration
$map['latitude'] = 6.438156;
$map['longitude'] = 3.540235;
$map['name'] = "Blissville Uno";

$lightbox = true;

# -- Page Configuration ########################################################################################
$title = "our-portfolio";
$page_title = "Our Portfolio";
$page_desc = "We don't just sell homes, we guarantee your future";

include('inc/header.php');

?>
        <section class="page-content">
            <div class="container">
                <div class="row">
                
                <!-- Our Portfolio -->
                <section class="our-portfolio mt-80">
                    <div class="col-md-8">
                        <div class="normal-header">
                            <h3><?php echo $portfolio_content['name']; ?></h3>
                        </div>
                        <div>
                            <?php echo $portfolio_content['content'] ?>
                        </div>


                        <section class="map-section mt-80">
                                 <div class="normal-header">
                                    <h3>Location</h3>
                                 </div>
                                <div id="map-location" style="height: 300px; width: 100%;"></div>
                        </section>

                    </div>
                    <div class="col-md-4">
                        <aside>
                            <!-- <div class="container"> -->
                                 <div class="normal-header">
                                    <h3>Properties</h3>
                                 </div>
                                <div class="row">
                                    <?php $i = 0;
                                    foreach($propertys as $property) { ?>
                                    <div class="col-sm-6 col-md-12">
                                        
                                        <?php echo Property::box($property) ?>
                                    </div>

                                    <?php } //endforeach ?>
                                                            
                                </div>
                            <!-- </div> -->
                        </aside>
                    </div>
                </section><!-- Our Portfolio /- -->



               

                </div>

            </div>
        </section>

        <section class="mt-80 portfolio">
            <div class="container">
                   
                <div class="row">
                    <div class="col-sm-12">
                        <div class="normal-header">
                            <h3>Photos</h3>
                        </div>
                    </div>
                </div>

                
                <h4 class="title first">Layout Plans - <span>2016</span></h4>
                <div class="row">

                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/1.jpg') ?>" class="fancybox"> <img src="<?php URL::display('assets/img/portfolio/1_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/2.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/2_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/3.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/3_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/4.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/4_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                </div> 


                <h4 class="title">Blissville Site <span>Quarter 4, 2016</span></h4>
                <div class="row">

                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/1.jpg') ?>" class="fancybox"> <img src="<?php URL::display('assets/img/portfolio/1_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/2.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/2_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/3.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/3_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="bare-land" href="<?php URL::display('assets/img/portfolio/4.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/4_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                </div>


                
                <h4 class="title">Quarter 1, 2017</h4>
                <div class="row">
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/5.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/5_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/6.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/6_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/7.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/7_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/8.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/8_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/9.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/9_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/10.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/10_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/11.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/11_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/12.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/12_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                </div>
             
                
                <h4 class="title">Blissville Levels</h4>
                <div class="row">
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/b-1.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/b-1_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/b-2.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/b-2_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/b-3.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/b-3_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/b-4.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/b-4_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                </div>
             
                
                <h4 class="title">Blissville Tests</h4>
                <div class="row">
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/c-1.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/c-1_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                </div>
             
                
                <h4 class="title">Blissville in Construction</h4>
                <div class="row">
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/d-1.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/d-1_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/d-2.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/d-2_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/d-3.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/d-3_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a rel="geo-technical investigation" href="<?php URL::display('assets/img/portfolio/d-4.jpg') ?>" class="fancybox">
                            <img src="<?php URL::display('assets/img/portfolio/d-4_small.jpg') ?>" alt="Portfolio Image" class="img-responsive">
                        </a>
                    </div>
                    
                </div>
             
            </div>
        </section>

<?php include('inc/footer.php');