<?php
include('../../config.php'); 

//Check if the user clicks on the submit button
if (Form::is_posted()) {
  if (Slideshow::add()) {
    URL::redirect('admin/slideshow/?action=add');
  } else {
    $errors = Slideshow::get_errors();
  }
}

# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "slideshows";
$page_title = "All Slideshows";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                                  
              <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
              
                  <h3 class="page-title">Add a New slideshow Area<br><br></h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Form::text('name','',array('class' => "form-control", 'placeholder' => "Name of the slideshow Area")) ?>
                                  <?php Form::show_info('name') ?>
                      </div>
                  </div>

                  
                 <!--  <div class="form-group">
                      <label class="col-sm-2 control-label">Price </label>
                      <div class="col-sm-7">
                            
                          <?php Form::text('price','',array('class' => "form-control", 'placeholder' => "Price to be displayed")) ?>
                          <?php Form::show_info('price','Leave as empty if Slide needs no price') ?>
                      </div>
                  </div> -->
                  

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-7">
                        <?php Form::textarea('description','',array("class" => 'editor')) ?>
                        <?php Form::show_info('description','Enter your Slideshow Description here') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Link Text</label>
                      <div class="col-sm-7">
                          <?php Form::text('link_text','',array('class' => "form-control", 'placeholder' => "Link Text")) ?>
                          <?php Form::show_info('link_text','This field will be ignored if empty') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Link to Page <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            
                          <?php Form::text('link_page','',array('class' => "form-control", 'placeholder' => "Link this Slide to... ")) ?>
                          <?php Form::show_info('link_page','Copy and Paste the URL you wish to redirect to') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Buy Text</label>
                      <div class="col-sm-7">
                          <?php Form::text('buy_text','',array('class' => "form-control", 'placeholder' => "Buy Text")) ?>
                          <?php Form::show_info('buy_text','This field will be ignored if empty') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Buy Page <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            
                          <?php Form::text('buy_page','',array('class' => "form-control", 'placeholder' => "This item can be bought at... ")) ?>
                          <?php Form::show_info('buy_page','Copy and Paste the URL the item can be bought') ?>
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

