<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['slideshow'])){
  $slideshow_id = $_GET['slideshow'];

  //If the slideshow id is set but it is not defined
  if ($slideshow_id == ""){
    URL::redirect('admin/slideshow/?action=invalid');
  }  else {
    //The slideshow id is defined

    //Check if the user has posted the result
    if (Form::is_posted()){
      if (Slideshow::delete()) {
        URL::redirect('admin/slideshow/?action=delete');
      } else {
        $errors = Slideshow::get_errors();
      }
    }

    //Get Slideshow info from the database
    $table = Slideshow::get_one('WHERE id ='.$slideshow_id);

    //Check if the total_rows is less than 1
    if (Slideshow::affected_rows() < 1) {
      URL::redirect('admin/slideshow/?action=not-found');
    } else {

      //Get All the information from the database.
      $slideshow_id = $table['id'];
      $name = $table['name'];
      $picture = $table['picture'];
      $description = $table['description'];

    }
  }
} else {
  URL::redirect('admin/slideshow/?action=not-found');
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "slideshows";
$page_title = "Delete Slideshow";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                      <form class="form-horizontal" action="#" method="post">

                          <h3><?php echo $name ?> </h3>
                          <img src="<?php URL::display(Slideshow::upload_url($picture)) ?>" alt="<?php echo $name ?>" class="img-responsive">
                          <p><?php echo $description ?></p>
          
                          <div class="form-group">
                              <div class="col-sm-9">
                                <?php Form::hidden('Delete',$slideshow_id) ?>
                                  <button type="submit" class="btn btn-primary">Delete Slideshow</button>
                                  <a class="btn btn-default" href="<?php URL::display('admin/slideshows') ?>">Back </a>
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

