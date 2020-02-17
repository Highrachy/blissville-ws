<?php
include('../../../config.php'); 

Page::set_table(Page::TBL_HOME);

//Check for the id
if (isset($_GET['homepage'])){
  $homepage_id = $_GET['homepage'];

  //If the homepage id is set but it is not defined
  if ($homepage_id == ""){
    URL::redirect('admin/edit-content/homepage');
  }  else {
    //The homepage id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the Homepage
      if (Page::update()) {
        URL::redirect('admin/edit-content/homepage/?action=update');
      } else {
        $errors = Page::get_errors();
      }
    }

    # -- Get Homepage Info
    $homepage = Page::get_one("WHERE id = '$homepage_id' ");

    //Check if the total_rows is less than 1
    if (Page::affected_rows() < 1) {
      URL::redirect('admin/edit-content/homepage/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($homepage);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "homepages";
$page_title = "Edit Homepage";

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
                                        <?php Form::text('name',$name,array('class' => "form-control", "placeholder" => "Name of the homepage Area")) ?>
                                        <?php Form::show_info('name') ?>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-7">
                              <?php Form::textarea('content',$content,array("class" => 'editor')) ?>
                              <?php Form::show_info('content','Enter your Homepage Content here') ?>
                            </div>
                        </div>



                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('page_id',$homepage_id) ?>
                            <?php Form::submit('submit','Update Content',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("admin/edit-content/homepage") ?>" class="btn btn-default">Cancel</a>
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

