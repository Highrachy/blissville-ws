<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['property'])){
  $property_id = $_GET['property'];

  //If the property id is set but it is not defined
  if ($property_id == ""){
    URL::redirect('admin/property/?action=invalid');
  }  else {
    //The property id is defined

    //Check if the user has posted the result
    if (Form::is_posted()){
      if (Property::delete()) {
        URL::redirect('admin/property/?action=delete');
      } else {
        $errors = Property::get_errors();
      }
    }

    //Get Property info from the database
    $table = Property::get_one('WHERE id ='.$property_id);

    //Check if the total_rows is less than 1
    if (Property::affected_rows() < 1) {
      URL::redirect('admin/property/?action=not-found');
    } else {

      //Get All the information from the database.
      $property_id = $table['id'];
      $name = $table['name'];
      $picture = $table['picture'];
      $description = $table['description'];

    }
  }
} else {
  URL::redirect('admin/property/?action=not-found');
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "propertys";
$page_title = "Edit Property";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                      <form class="form-horizontal" action="#" method="post">

                          <h3><?php echo $name ?> </h3>
                          <img src="<?php URL::display(Property::upload_url($picture)) ?>" alt="<?php echo $name ?>" class="img-responsive">
                          <p><?php echo $description ?></p>
          
                          <div class="form-group">
                              <div class="col-sm-9">
                                <?php Form::hidden('Delete',$property_id) ?>
                                  <button type="submit" class="btn btn-primary">Delete Property</button>
                                  <a class="btn btn-default" href="<?php URL::display('admin/property') ?>">Back </a>
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

