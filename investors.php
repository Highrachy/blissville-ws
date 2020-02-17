<?php 
include('config.php'); 

# -- Get All Investors
Page::sort_order_by('id ASC');
Page::set_table(Page::TBL_INVESTORS);
$investor = Page::get_all();

# -- Page Configuration 
$title = "investors";
$page_title = "Investors";
$page_desc = "Invest today and watch your money grow...";

$breadcrumb = array('Investors'=> '#');

include('inc/header.php');
?>


            <section class="page-content">
                <div class="container">
                    <div class="row mt-80">
                        <div class="col-sm-8">

                            <section class="our-vision">
                                 <div class="normal-header">
                                    <h3><?php echo $investor[0]['name'] ?></h3>
                                 </div>
                                 <div class="text-justify">
                                        
                                    <?php echo $investor[0]['content'] ?>

                                    <p style="margin-top:20px"><a href="#register-interest" class="btn btn-default">Click here to Invest</a></p>
                                 </div>  
                            </section>
                        </div>

                        <div class="col-sm-4">
                            
                            <section>
                                <div class="skip-header"></div>
                                <div class="pricing-table">
                                      <div class="price-amount"><h2><span><?php echo $investor[1]['name'] ?></span><?php echo $investor[1]['content'] ?><br>&nbsp;</h2></div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row mt-80">
                        <div class="col-sm-8">
                            <section class="executive-summary">
                                <div class="normal-header">
                                    <h3><?php echo $investor[2]['name'] ?></h3>
                                </div>
                                <div class="text-justify">
                                                
                                    <?php echo $investor[2]['content'] ?>
                                </div>

                            </section>


                            
                        </div>
                        <!-- /.col-sm-8 -->

                        <div class="col-sm-4">

                            <section class="projects-highlight">
                                
                                <div class="normal-header">
                                    <h3><?php echo $investor[3]['name'] ?></h3>
                                </div>
                                <?php echo $investor[3]['content'] ?>
                            </section>

                                           
                        </div>
                        <!-- /.col-sm-4 -->
                    </div>
                    <!-- row -->

                </div>
                <!-- Container -->


                <section class="investment-value promo mt-80">
                    <div class="container">
                        <ul class="list-unstyled">
                            
                            <li class="col-md-4"><h3><?php echo $investor[4]['name'] ?> <span><?php echo $investor[4]['content'] ?></span></h3></li>
                            <li class="col-md-4"><h3><?php echo $investor[5]['name'] ?><span><?php echo $investor[5]['content'] ?></span></h3></li>
                            <li class="col-md-4"><h3><?php echo $investor[6]['name'] ?><span><?php echo $investor[6]['content'] ?></span></h3></li>
                        </ul>
                    </div>
                </section>


                <div class="container">

                    <div class="row">
                        <div class="col-md-8">
                            
                            <section class="mid-term-forecast mt-80">
                                <div class="normal-header">
                                    <h3><?php echo $investor[7]['name'] ?></h3>
                                </div>
                                <div class="text-justify">
                                                
                                    <?php echo $investor[7]['content'] ?>
                                </div>

                            </section>
                        </div>
                        <div class="col-md-4">
                            
                            <section class="invest-today mt-80">
                                <div class="skip-header">
                                    <div>
                                        <img class="img-responsive" src="<?php URL::display('assets/img/investor.jpg') ?>" alt="TODO">
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </section>

<?php include('inc/footer.php');