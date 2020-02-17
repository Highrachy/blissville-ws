<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['team'])){
  $team_id = $_GET['team'];

  //If the team id is set but it is not defined
  if ($team_id == ""){
    URL::redirect('admin/teams');
  }  else {
    //The team id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the Team
      if (Team::update()) {
        URL::redirect('admin/team/?action=update');
      } else {
        $errors = Team::get_errors();
      }
    }

    # -- Get Team Info
    $team = Team::get_one("WHERE id = '$team_id' ");

    //Check if the total_rows is less than 1
    if (Team::affected_rows() < 1) {
      URL::redirect('admin/team/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($team);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "teams";
$page_title = "Edit Team";

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
                                        <?php Form::text('name',$name,array('class' => "form-control", 'placeholder' => "Name of the Team Member")) ?>
                                        <?php Form::show_info('name') ?>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Post </label>
                            <div class="col-sm-7">
                                  
                                <?php Form::text('post',$post,array('class' => "form-control", 'placeholder' => "Post of the Team Member")) ?>
                                <?php Form::show_info('post') ?>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profile</label>
                            <div class="col-sm-7">
                              <?php Form::textarea('profile',$profile,array("class" => 'editor')) ?>
                              <?php Form::show_info('profile','Enter your Team Profile here') ?>
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

                                        Form::select('priority',$priority_value,array('class' =>"form-control"),$priority) ;
                                    ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Picture</label>
                            <div class="col-sm-7">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                                  <img src="<?php URL::display('assets/uploads/team/' . $picture); ?>" data-src="<?php URL::display('assets/uploads/team/' . $picture); ?>" alt="Placeholder">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                                <div>
                                  <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
                                  <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>

                                    &nbsp;&nbsp;<label class="checkbox-inline"><?php Form::Checkbox('delete_image','YES') ?> Delete Image</label>
                                </div>
                              </div>
                              <?php Form::show_info('picture') ?>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('team_id',$team_id) ?>
                            <?php Form::hidden('old_picture',$picture) ?>
                            <?php Form::submit('submit','Update Team',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("team") ?>" class="btn btn-default">Cancel</a>
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

