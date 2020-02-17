<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['faq'])){
  $faq_id = $_GET['faq'];

  //If the faq id is set but it is not defined
  if ($faq_id == ""){
    URL::redirect('admin/faqs/?action=invalid');
  }  else {
    //The faq id is defined

    //Check if the user has posted the result
    if (Form::is_posted()){
      if (FAQs::delete()) {
        URL::redirect('admin/faqs/?action=delete');
      } else {
        $errors = FAQs::get_errors();
      }
    }

    //Get FAQs info from the database
    $table = FAQs::get_one('WHERE id ='.$faq_id);

    //Check if the total_rows is less than 1
    if (FAQs::affected_rows() < 1) {
      URL::redirect('admin/faqs/?action=not-found');
    } else {

      //Get All the information from the database.
      extract($table);
    }
  }
} else {
  URL::redirect('admin/faqs/?action=not-found');
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "faqs";
$page_title = "Delete FAQs";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                      <form class="form-horizontal" action="#" method="post">

                          <h3>Delete FAQS</h3>
                          <h4><?php echo $question ?></h4>
                          <p><?php echo $answer ?></p>
          
                          <div class="form-group">
                              <div class="col-sm-9">
                                <?php Form::hidden('Delete',$faq_id) ?>
                                  <button type="submit" class="btn btn-primary">Delete FAQs</button>
                                  <a class="btn btn-default" href="<?php URL::display('admin/faqs') ?>">Back </a>
                              </div>
                          </div>

                          <?php Alert::display() ?>
                      </form>

                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>