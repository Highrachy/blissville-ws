<?php
include('../../../config.php'); 

# -- Property
$property_id = URL::get('property',0);

$property_name = Property::get_name($property_id);

if (empty($property_name)){
  URL::redirect('admin/property/?action=not-found');
}

//Check if the user clicks on the submit button
if (Form::is_posted()) {
  if (FloorPlan::add()) {
    URL::redirect('admin/property/floor_plan/?action=add&property='.$property_id);
  } else {
    $errors = FloorPlan::get_errors();
  }
}

# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "floor_plans";
$page_title = "All Floor Plans";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                                  
              <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
              
                  <h3 class="page-title">Add a New Floor Plan for <?php echo $property_name ?><br><br></h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Form::text('name','',array('class' => "form-control", 'placeholder' => "Name of the Floor Plan Area")) ?>
                                  <?php Form::show_info('name') ?>
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
                      <label class="col-sm-2 control-label">Picture<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="http://placehold.it/200x150" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php Form::show_info('picture') ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php Alert::display_error(); ?>
                        <?php Form::hidden('property_id',$property_id) ?>
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

