<?php
include('../../../config.php'); 

//Check for the id
if (isset($_GET['floor_plan'])){
  $floor_plan_id = $_GET['floor_plan'];

  //If the floor_plan id is set but it is not defined
  if ($floor_plan_id == ""){
    URL::redirect('admin/property/floor_plan/?action=invalid&property='.$property_id);
  }  else {
    //The floor_plan id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the Floor Plan
      if (FloorPlan::update()) {
        URL::redirect('admin/property/floor_plan/?action=update&property='.$property_id);
      } else {
        $errors = FloorPlan::get_errors();
      }
    }

    # -- Get Floor Plan Info
    $floor_plan = FloorPlan::get_one("WHERE id = '$floor_plan_id' ");

    //Check if the total_rows is less than 1
    if (FloorPlan::affected_rows() < 1) {
      URL::redirect('admin/property/floor_plan/?action=not-found&property='.$property_id);
    } else {
      //Get All the information from the database.
      extract($floor_plan);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "floor_plans";
$page_title = "Edit Floor Plan";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                
                    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                    
                      <h3 class="page-title">
                      <?php echo "Edit $name" ?>
                      <br><br>
                      </h3>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                        <?php Form::text('name',$name,array('class' => "form-control", "placeholder" => "Name of the Floor Plan Area")) ?>
                                        <?php Form::show_info('name') ?>
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
                            <label class="col-sm-2 control-label">Picture<span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                                  <img src="<?php URL::display('assets/uploads/floor_plan/' . $picture); ?>" data-src="<?php URL::display('assets/uploads/floor_plan/' . $picture); ?>" alt="Placeholder">
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
                            <?php Form::hidden('floor_plan_id',$floor_plan_id) ?>
                            <?php Form::hidden('old_picture',$picture) ?>
                            <?php Form::submit('submit','Update Floor Plan',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("floor_plan") ?>" class="btn btn-default">Cancel</a>
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

