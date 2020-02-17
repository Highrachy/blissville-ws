<?php
include('../../../config.php'); 

Page::set_table(Page::TBL_PORTFOLIO);

//Check for the id
if (isset($_GET['portfolio'])){
  $portfolio_id = $_GET['portfolio'];

  //If the portfolio id is set but it is not defined
  if ($portfolio_id == ""){
    URL::redirect('admin/edit-content/portfolio');
  }  else {
    //The portfolio id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the portfolio
      if (Page::update()) {
        URL::redirect('admin/edit-content/portfolio/?action=update');
      } else {
        $errors = Page::get_errors();
      }
    }

    # -- Get portfolio Info
    $portfolio = Page::get_one("WHERE id = '$portfolio_id' ");

    //Check if the total_rows is less than 1
    if (Page::affected_rows() < 1) {
      URL::redirect('admin/edit-content/portfolio/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($portfolio);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "portfolios";
$page_title = "Edit portfolio";

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
                                        <?php Form::text('name',$name,array('class' => "form-control", "placeholder" => "Name of the portfolio Area")) ?>
                                        <?php Form::show_info('name') ?>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-7">
                              <?php Form::textarea('content',$content,array("class" => 'editor')) ?>
                              <?php Form::show_info('content','Enter your portfolio Content here') ?>
                            </div>
                        </div>



                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('page_id',$portfolio_id) ?>
                            <?php Form::submit('submit','Update Content',array('class'=>"btn btn-primary")) ?> 
                            <a href="<?php URL::display("admin/edit-content/portfolio") ?>" class="btn btn-default">Cancel</a>
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

