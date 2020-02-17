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

    //Check if the user has posted the result
    if (Form::is_posted()){
      if (FloorPlan::delete()) {
        URL::redirect('admin/property/floor_plan/?action=delete');
      } else {
        $errors = FloorPlan::get_errors();
      }
    }

    //Get Floor Plan info from the database
    $table = FloorPlan::get_one('WHERE id ='.$floor_plan_id);

    //Check if the total_rows is less than 1
    if (FloorPlan::affected_rows() < 1) {
      URL::redirect('admin/property/floor_plan/?action=not-found&property='.$property_id);
    } else {

      //Get All the information from the database.
      $floor_plan_id = $table['id'];
      $name = $table['name'];
      $picture = $table['picture'];
      $description = $table['description'];

    }
  }
} else {
  URL::redirect('admin/property/floor_plan/?action=not-found');
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "floor_plans";
$page_title = "Delete Floor Plan";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                      <form class="form-horizontal" action="#" method="post">

                          <h3><?php echo $name ?> </h3>
                          <img src="<?php URL::display(FloorPlan::upload_url($picture)) ?>" alt="<?php echo $name ?>" class="img-responsive">
          
                          <div class="form-group">
                              <div class="col-sm-9">
                                <?php Form::hidden('Delete',$floor_plan_id) ?>
                                  <button type="submit" class="btn btn-primary">Delete Floor Plan</button>
                                  <a class="btn btn-default" href="<?php URL::display('admin/floor_plan') ?>">Back </a>
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

