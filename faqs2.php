<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 

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
# Faqs
#-############################################
require_once(INCLUDE_DIR.'faqs.function.php');


# -- Page Configuration ########################################################################################
$title = "FAQs";
$page_title = "Frequently Asked Questions";
$page_desc = "Invest today and watch your money grow...";
$breadcrumb = array('Frequently Asked Questions' => 'faqs');
$register_interest = false;

//Fetch All rows
$faqs = list_faqs();


include('inc/header.php');
?>


            <section class="page-content">
                <div class="container">
                    <div class="row">
                        
                            <section class="faqs">
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
                                        <?php start_editable(); ?>
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <!-- START ACCORDION -->
                                            <div class="panel panel-default">

                                                <!-- FAQS START QUESTION -->
                                                <div class="panel-heading" role="tab" id="short-accordion-type<?php echo $id ?>">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id ?>" aria-expanded="false" aria-controls="collapse<?php echo $id ?>">
                                                        <?php echo header_editable($question,'question') ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <!-- FAQS END QUESTION -->

                                                <!-- FAQS START ANSWER -->
                                                <div id="collapse<?php echo $id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="short-accordion-type<?php echo $id ?>" aria-expanded="false">
                                                    <div class="panel-body">

                                                        <?php echo make_editable($answer,'answer') ?> 
                                                        <?php end_editable($id,'faqs'); // ID, TABLE NAME ?>                    
                                                       
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