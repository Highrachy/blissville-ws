<?php
include('../../config.php'); 

//Check if the user clicks on the submit button
if (Form::is_posted()) {
  if (FAQs::add()) {
    URL::redirect('admin/faqs/?action=add');
  } else {
    $errors = FAQs::get_errors();
  }
}

# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "faqs";
$page_title = "New FAQs";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                                  
              <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
              
                  <h3 class="page-title">Add a New FAQs<br><br></h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Question <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Form::text('question','',array('class' => "form-control", 'placeholder' => "Enter the Question Here")) ?>
                                  <?php Form::show_info('question') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Answer</label>
                      <div class="col-sm-7">
                        <?php Form::textarea('answer','',array("class" => 'editor')) ?>
                        <?php Form::show_info('answer','Enter your Faq Answer here') ?>
                      </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">Category <span class="mandatory">*</span></label>
                    <div class="col-sm-7">
                      <?php 
                        Form::select('category',FAQs::get_category(),array('class' => "form-control"));
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
                              for ($i=1; $i <= 10 ; $i++) { 
                                  $priority_value[$i] = $i;
                              }

                                  Form::select('priority',$priority_value,array('class' =>"form-control")) ;
                              ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add New</button>
                        <button type="reset" class="btn btn-default">Clear</button>
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