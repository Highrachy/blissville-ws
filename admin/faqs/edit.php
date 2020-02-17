<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['faq'])){
  $faq_id = $_GET['faq'];

  //If the faq id is set but it is not defined
  if ($faq_id == ""){
    URL::redirect('admin/faqs');
  }  else {
    //The faq id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the Faqs
      if (FAQs::update()) {
        URL::redirect('admin/faqs/?action=update');
      } else {
        $errors = FAQs::get_errors();
      }
    }

    # -- Get Faqs Info
    $faq = FAQs::get_one("WHERE id = '$faq_id' ");

    //Check if the total_rows is less than 1
    if (FAQs::affected_rows() < 1) {
      URL::redirect('admin/faqs/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($faq);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "faqs";
$page_title = "Edit FAQs";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                
                    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                    
                      <h3 class="page-title">
                      <?php echo "Edit FAQs" ?>
                      <br><br>
                      </h3>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Question <span class="mandatory">*</span></label>
                          <div class="col-sm-7">
                                      <?php Form::text('question',$question,array('class' => "form-control", 'placeholder' => "Enter the Question Here")) ?>
                                      <?php Form::show_info('question') ?>
                          </div>
                      </div>


                      <div class="form-group">
                          <label class="col-sm-2 control-label">Answer</label>
                          <div class="col-sm-7">
                            <?php Form::textarea('answer',$answer,array("class" => 'editor')) ?>
                            <?php Form::show_info('answer','Enter your Faq Answer here') ?>
                          </div>
                      </div>
                      

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Category <span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                          <?php 
                            Form::select('category',FAQs::get_category(),array('class' => "form-control"),$category);
                            Form::show_info('category', 'Select from existing category or Add a new one');
                            Form::text('category_name','',array('class' => "form-control" , 'placeholder' => "Enter a new category name"));
                            Form::show_info('category_name', 'Select Add a New Category Above and Enter the Category Name');
                          ?>
                        </div>
                      </div>



                        <div class="form-group">
                            <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                  <?php 
                                    $priority_value = array();
                                    $priority_value[$priority] = $priority;
                                    for ($i=1; $i <= 10 ; $i++) { 
                                        $priority_value[$i] = $i;
                                    }

                                        Form::select('priority',$priority_value,array('class' => "form-control")) ;
                                    ?>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('faq_id',$faq_id) ?>
                            <?php Form::submit('submit','Update Faqs',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("faqs") ?>" class="btn btn-default">Cancel</a>
                          </div>
                        </div>
                    </form>

                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

