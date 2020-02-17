<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
include(SERVER_DIR.'lib/functions/upload.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();


$dashboard = true;
$editor = true;
$datetimepicker = true;


# -- Include the page function ########################################################################################
require_once(INCLUDE_DIR.'article.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'article');

# -- Get Article Type ########################################################################################
if (isset($_GET['type'])){
  $type = $_GET['type'];
  if (($type < QUOTES) && ($type > VIDEO))
    $type = ARTICLE; //Irregular, Make it 1
} else {
    $type = ARTICLE; //Not Set, Make it 1
}

//Get the type of Article
$type_name = get_article_type($type);



 //Add a new article
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  # ****** COMPULSORY FIELDS **********#
  # *****************************************#
  # -- Name
  $data['name'] = assign('name','minlen=3','Please enter a valid Name');

  $data['url_name'] = get_readable_url($data['name']);

  # -- Article
  $data['full_article'] = assign('full_article', 'minlen=3','Please enter a valid '.$type_name);


  # -- Excerpt
  if (isset($_POST['excerpt']) && (!empty($_POST['excerpt'])))
    $data['excerpt'] = assign('excerpt', 'minlen=250','Please enter a valid Excerpt');


  # -- Published_date
  $published_date = assign('published_date', 'req','Please select a valid Published Date');
  //Make start send compatible with mysql
  $data['published_date'] = date('Y-m-d',strtotime($published_date));


  # -- Type
  $data['type'] = assign('type', 'range=0-3','Please enter a select a valid article type');


  # -- Video URL
  if (isset($_POST['video']) && (!empty($_POST['video']))){
    if (is_valid_url($_POST['video'])){
      $data['video'] = $_POST['video'];
    } else {
      $errors['picture'] = 'Invalid Video URL';
    }
  }

  # -- Tags
  if (isset($_POST['tags']) && (!empty($_POST['tags'])))
    $data['tags'] = assign('tags', 'minlen=3','Please enter a valid tag separated by comma');

  # -- Picture
  if (isset($_FILES['picture']) && (!empty($_FILES['picture']['tmp_name']))){   
    if (!is_valid_image('picture'))
      $errors['picture'] = 'Invalid Picture';
  }

  # -- Picture 2
  if (isset($_FILES['picture2']) && (!empty($_FILES['picture2']['tmp_name']))){   
    if (!is_valid_image('picture2'))
      $errors['picture2'] = 'Invalid Picture';
  }

  # -- Picture 3
  if (isset($_FILES['picture3']) && (!empty($_FILES['picture3']['tmp_name']))){   
    if (!is_valid_image('picture3'))
      $errors['picture3'] = 'Invalid Picture';
  }

  # --Category

  $data['category'] = assign('category', 'req','Select a category'); 
  if ($data['category'] < 1){
    if (isset($_POST['category_name']) && (!empty($_POST['category_name']))){
      $cat_data['name'] = $_POST['category_name'];
      $cat_data['created_at'] = 'NOW()';
    }
    else $errors['category_name'] = 'Select a category';
  }

  #- Created 
  $data['created_at'] = "NOW()";


  if (empty($errors)){  

    # -- PICTURE 1
    if (isset($_FILES['picture']) && (!empty($_FILES['picture']['tmp_name']))){
        $upload_to = UPLOAD_DIR."article/";
        $small_pics = upload_image('picture',$upload_to.'small/');
        $data['picture'] = upload_file('picture',$upload_to);
    }  

    # -- PICTURE 2
    if (isset($_FILES['picture2']) && (!empty($_FILES['picture2']['tmp_name']))){
        $upload_to = UPLOAD_DIR."article/";
        $small_pics = upload_image('picture2',$upload_to.'small/');
        $data['picture2'] = upload_file('picture2',$upload_to);
    }  

    # -- PICTURE 3
    if (isset($_FILES['picture3']) && (!empty($_FILES['picture3']['tmp_name']))){
        $upload_to = UPLOAD_DIR."article/";
        $small_pics = upload_image('picture3',$upload_to.'small/');
        $data['picture3'] = upload_file('picture3',$upload_to);
    }


    if (empty($errors)){
      if ($data['category'] < 1){
        $data['category'] = add_category($cat_data);
      }
      $action = add_articles($data);
    }


  }
  
  if (empty($errors)){
    if ($action == 'exists'){
      $errors['error'] = "The article exists in the database";
    } else {
      redirect('admin/article/?action='.$action); 
    }
     
  }    
  
}


# -- Get Category ########################################################################################
$my_categorys = get_article_category();
$category = array();
$category[0] = "Add a New Category";
foreach ($my_categorys as $my_category) {
  $category[$my_category['id']] = $my_category['name'];
}
# -- Page Configuration ########################################################################################
$title = "New article";
$page_title = "Our Article";
$breadcrumb = array(
                'Articles' => 'admin/article',
                'New article' => '#'
              );

include(SERVER_DIR.'inc/header.php');
?>


    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
              <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
              
                <h3 class="page-title">
                <?php echo "Add a New $type_name" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <?php Text('name','','class="form-control" placeholder="Name of '.$type_name.'"') ?>
                        <?php show_errors('name') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $type_name ?> <span class="mandatory">*</span> </label>
                      <div class="col-sm-10">
                        <?php Textarea('full_article',''," class='editor'") ?>
                        <?php show_errors('full_article','Enter the '. $type_name .' here') ?>
                      </div>
                  </div>


                    

                  <?php if ($type > QUOTES) { // No Excerpt for Quotes ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Excerpt</label>
                      <div class="col-sm-10">
                        <?php Textarea('excerpt',''," class='editor'") ?>
                        <?php show_errors('excerpt', 'Enter a summary for your article. If ommitted, the excerpt will be extracted from the main article. It should be over 250 characters') ?>
                      </div>
                  </div>
                  <?php } ?>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Category <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php 
                              Select('category',$category,'','class="form-control"');
                              show_errors('category', 'Select from existing category or Add a new one');
                              Text('category_name','','class="form-control" placeholder="Enter a new category name"');
                              show_errors('category_name', 'Select Add a New Category Above and Enter the Category Name');
                            ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Published Date<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <div class='input-group date' id='datetimepicker_date'>
                            <?php Text('published_date',date('F, d Y'),'class="form-control" placeholder="MM/DD/YYYY"') ?>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            <?php show_errors('published_date') ?>
                        </div>
                      </div>
                  </div>   

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Tags<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Textarea('tags','','class="form-control" placeholder="Enter tags separated by comma"',5) ?>
                          <?php show_errors('tags') ?>
                      </div>
                  </div>
                  



                  <?php if ($type == VIDEO) { // Picture 3 ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Video URL <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <?php Text('video','','class="form-control" placeholder="Enter Video URL"') ?>
                        <?php show_errors('video','Video URL from Youtube') ?>
                      </div>
                  </div>
                  <?php } ?>
                    

                  <?php if (($type > QUOTES) && ($type < VIDEO)) { // No Pictures for Quotes and Video ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Picture</label>
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
                        <?php show_errors('picture') ?>
                      </div>
                  </div>
                  <?php } ?>
                    

                  <?php if ($type == SLIDESHOW) { // Picture 2 ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Picture 2</label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="http://placehold.it/200x150" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture2"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php show_errors('picture2') ?>
                      </div>
                  </div>
                  <?php } ?>                    

                  <?php if ($type == SLIDESHOW) { // Picture 3 ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Picture 3</label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="http://placehold.it/200x150" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture3"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php show_errors('picture3') ?>
                      </div>
                  </div>
                  <?php } ?>



                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save <?php echo $type_name ?></button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
                  </div>
                </form>


              </div>
              <aside class="col-md-3 col-md-pull-9">
                  <!--  components start -->
                  
                  <?php include(SERVER_DIR.'inc/admin-sidebar.php');  ?>
              </aside>

            </div>


      </div>
      <!-- /container -->  
    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

