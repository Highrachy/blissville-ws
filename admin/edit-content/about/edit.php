<?php
include('../../../config.php'); 

Page::set_table(Page::TBL_ABOUT_US);

//Check for the id
if (isset($_GET['about'])){
  $about_id = $_GET['about'];

  //If the about id is set but it is not defined
  if ($about_id == ""){
    URL::redirect('admin/edit-content/about');
  }  else {
    //The about id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the about
      if (Page::update()) {
        URL::redirect('admin/edit-content/about/?action=update');
      } else {
        $errors = Page::get_errors();
      }
    }

    # -- Get about Info
    $about = Page::get_one("WHERE id = '$about_id' ");

    //Check if the total_rows is less than 1
    if (Page::affected_rows() < 1) {
      URL::redirect('admin/edit-content/about/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($about);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "abouts";
$page_title = "Edit about";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">

                
                    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                    
                      <h3 class="page-title">Edit Content <small><?php echo "$name" ?></small></h3>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                        <?php Form::text('name',$name,array('class' => "form-control", "placeholder" => "Name of the about Area")) ?>
                                        <?php Form::show_info('name') ?>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-7">
                              <?php Form::textarea('content',$content,array("class" => 'editor')) ?>
                              <?php Form::show_info('content','Enter your about Content here') ?>
                            </div>
                        </div>



                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('page_id',$about_id) ?>
                            <?php Form::submit('submit','Update Content',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("admin/edit-content/about") ?>" class="btn btn-default">Cancel</a>
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

