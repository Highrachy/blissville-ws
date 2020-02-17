<?php 
include('config.php'); 

# -- Live Edit
$editable = LiveEdit::activate();
if (Form::is_posted())
    $action = LiveEdit::save($data,$id,$table_name);

# -- Fetch All FAQs 
$faqs = FAQs::list_all();

# -- Page Configurations
$title = "faqs";
$page_title = "Frequently Asked Questions";
$page_desc = "Invest today and watch your money grow...";
$register_interest = false;

include('inc/header.php');
?>


            <section class="page-content">
                <div class="container">
                    <div class="row">
                        
                            <section class="faqs mt-80">
                                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                                    
                                    <?php 

                                    //Get the name of a new category from the FAQs
                                    $new_category = "";

                                    //used to identify the first category
                                    $count = 0;

                                    //UNIVERSAL LOOP FOR ALL FAQS
                                    foreach ($faqs as $faq) : 

                                        extract($faq);

                                        $count++;

                                        //Check for the name of the new Category
                                        if ($category != $new_category):
                                          $new_category = $category; //get the new category name

                                            //check if it is not the firset category

                                    ?>
                                    
                                    <!-- Write the name of the category here -->
                                    <div class="<?php if ($count != 1) echo 'mt-80 ' ?>normal-header">
                                        <h3><?php echo $new_category ?></h3>
                                    </div>

                                    <?php endif; // End if category is not new category?>

                                    <div class="accordions-type">
                                        <?php LiveEdit::start(); ?>
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <!-- START ACCORDION -->
                                            <div class="panel panel-default">

                                                <!-- FAQS START QUESTION -->
                                                <div class="panel-heading" role="tab" id="short-accordion-type<?php echo $id ?>">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id ?>" aria-expanded="false" aria-controls="collapse<?php echo $id ?>">
                                                        <?php echo LiveEdit::header($question,'question') ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <!-- FAQS END QUESTION -->

                                                <!-- FAQS START ANSWER -->
                                                <div id="collapse<?php echo $id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="short-accordion-type<?php echo $id ?>" aria-expanded="false">
                                                    <div class="panel-body">

                                                        <?php echo LiveEdit::content($answer,'answer') ?> 
                                                        <?php LiveEdit::end($id,'faqs'); // ID, TABLE NAME ?>                    
                                                       
                                                    </div>
                                                </div>
                                                <!-- FAQS END ANSWER -->
                                            </div>
                                            <!-- END ACCORDION -->
                                        </div>          
                                    </div>
                                    <!-- /. accordion type -->
                                    <?php endforeach; ?>
                                </div>
                                <!-- col-md-9 -->
                            </section>
                    </div>

                </div>
                <!-- Container -->
            </section>

<?php include('inc/footer.php');