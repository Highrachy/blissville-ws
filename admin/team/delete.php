<?php
include('../../config.php'); 

//Check for the id
if (isset($_GET['team'])){
  $team_id = $_GET['team'];

  //If the team id is set but it is not defined
  if ($team_id == ""){
    URL::redirect('admin/team/?action=invalid');
  }  else {
    //The team id is defined

    //Check if the user has posted the result
    if (Form::is_posted()){
      if (Team::delete()) {
        URL::redirect('admin/team/?action=delete');
      } else {
        $errors = Team::get_errors();
      }
    }

    //Get Team info from the database
    $table = Team::get_one('WHERE id ='.$team_id);

    //Check if the total_rows is less than 1
    if (Team::affected_rows() < 1) {
      URL::redirect('admin/team/?action=not-found');
    } else {

      //Get All the information from the database.
      $team_id = $table['id'];
      $name = $table['name'];
      $picture = $table['picture'];
      $description = $table['description'];

    }
  }
} else {
  URL::redirect('admin/team/?action=not-found');
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "teams";
$page_title = "Delete Team";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                      <form class="form-horizontal" action="#" method="post">

                          <h3><?php echo $name?> <br> <small><?php echo $post ?></small></h3>
                          <?php if (!empty($picture)): ?>
                            <img src="<?php URL::display(Team::upload_url($picture)) ?>" alt="<?php echo $name ?>" class="img-responsive">
                          <?php endif ?>

                          <p><?php echo $profile ?></p>
          
                          <div class="form-group">
                              <div class="col-sm-9">
                                <?php Form::hidden('Delete',$team_id) ?>
                                  <button type="submit" class="btn btn-primary">Delete Team</button>
                                  <a class="btn btn-default" href="<?php URL::display('admin/teams') ?>">Back </a>
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

