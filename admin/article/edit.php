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

//Check for the id
if (isset($_GET['article'])){
      $id = $_GET['article'];
      
      //If the article id is set but it is not defined
      if ($id == ""){
            redirect('admin/article');
            exit();
      }  else {
            //The article id is defined
            
            //Check if the user has posted the result
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              extract($_POST);

              # ****** COMPULSORY FIELDS **********#
              # *****************************************#
              # -- Name
              $data['name'] = assign('name','minlen=3','Please enter a valid Name');

              $data['url_name'] = get_readable_url($data['name']);

              # -- Excerpt
              if (isset($_POST['excerpt']) && (!empty($_POST['excerpt'])))
                $data['excerpt'] = assign('excerpt', 'minlen=250','Please enter a valid Excerpt');

              # -- Article
              $data['full_article'] = assign('full_article', 'minlen=3','Please enter a valid Article');
              
              # -- Published_date
              $published_date = assign('published_date', 'req','Please select a valid Published Date');
              //Make start send compatible with mysql
              $data['published_date'] = date('Y-m-d',strtotime($published_date));

              # -- Tags
              if (isset($_POST['tags']) && (!empty($_POST['tags'])))
              $data['tags'] = assign('tags', 'minlen=3','Please enter a valid tag separated by comma');


              # -- Picture 1
              $change_pics = false;
              if (isset($_FILES['picture']['tmp_name'])){
                $change_pics = true;
                if (!is_valid_image('picture'))
                  $change_pics = false;

              }

              # -- Picture 2
              $change_pics2 = false;
              if (isset($_FILES['picture2']['tmp_name'])){
                $change_pics2 = true;
                if (!is_valid_image('picture2'))
                  $change_pics2 = false;
              }

              # -- Picture 3
              $change_pics3 = false;
              if (isset($_FILES['picture3']['tmp_name'])){
                $change_pics3 = true;
                if (!is_valid_image('picture3'))
                  $change_pics3 = false;
              }


              # --Category
              $data['category'] = assign('category', 'req','Select a category'); 
              if ($data['category'] < 1){
                if (isset($_POST['category_name']) && (!empty($_POST['category_name']))){
                  $cat_data['name'] = $_POST['category_name'];
                  $cat_data['updated_at'] = 'NOW()';
                }
                else $errors['category_name'] = 'Select a category';
              }

              #- Modified 
              $data['updated_at'] = "NOW()";

              if (empty($errors)){

                #-- PICTURE =======================================================================

                # - If the picture is changed
                if ($change_pics){
                  $upload_to = UPLOAD_DIR."article/";
                  $small_pics = upload_image('picture',$upload_to.'small/');
                  $data['picture'] = upload_file('picture',$upload_to);
                }


                 # - Assign Previous image if there is any fuck up
                if (isset($data['picture']) && (empty($data['picture']))){
                  $data['picture'] = $_POST['old_picture'];
                  $change_pics = false;
                }

                if (isset($data['picture']) && ($data['picture'] == $_POST['old_picture']))
                  $change_pics = false;
                
                # -- END PICTURE ========================================================================


                #-- PICTURE 2 =======================================================================

                # - If the picture is changed
                if ($change_pics2){
                  $upload_to = UPLOAD_DIR."article/";
                  $small_pics = upload_image('picture2',$upload_to.'small/');
                  $data['picture'] = upload_file('picture2',$upload_to);
                }


                 # - Assign Previous image if there is any fuck up
                if (isset($data['picture2']) && (empty($data['picture2']))){
                  $data['picture2'] = $_POST['old_picture2'];
                  $change_pics2 = false;
                }

                if (isset($data['picture2']) && ($data['picture2'] == $_POST['old_picture2']))
                  $change_pics2 = false;

                # -- END PICTURE 2 ========================================================================

                #-- PICTURE 3 =======================================================================

                # - If the picture is changed
                if ($change_pics3){
                  $upload_to = UPLOAD_DIR."article/";
                  $small_pics = upload_image('picture3',$upload_to.'small/');
                  $data['picture'] = upload_file('picture3',$upload_to);
                }


                 # - Assign Previous image if there is any fuck up
                if (isset($data['picture3']) && (empty($data['picture3']))){
                  $data['picture3'] = $_POST['old_picture3'];
                  $change_pics3 = false;
                }

                if (isset($data['picture3']) && ($data['picture3'] == $_POST['old_picture3']))
                  $change_pics3 = false;

                # -- END PICTURE 3 ========================================================================


                if (empty($errors)){

                  if ($data['category'] < 1){
                    $data['category'] = add_category($cat_data);
                  }

                  $action = update_articles($data, $id);


                  # -- PICTURE ===============================================
                  if ($change_pics){
                    #- Delete Old Picture
                    if (!empty($_POST['old_picture'])){
                      $to_delete = UPLOAD_DIR. 'article/'.$_POST['old_picture'];
                      unlink($to_delete);
                      $to_delete = UPLOAD_DIR. 'article/small/'.$_POST['old_picture'];
                      unlink($to_delete);
                    }
                  }
                  # -- END PICTURE ===============================================


                  # -- PICTURE 2 ===============================================
                  if ($change_pics2){
                    #- Delete Old Picture
                    if (!empty($_POST['old_picture2'])){
                      $to_delete = UPLOAD_DIR. 'article/'.$_POST['old_picture2'];
                      unlink($to_delete);
                      $to_delete = UPLOAD_DIR. 'article/small/'.$_POST['old_picture2'];
                      unlink($to_delete);
                    }
                  }
                  # -- END PICTURE 2 ===============================================


                  # -- PICTURE 3 ===============================================
                  if ($change_pics3){
                    #- Delete Old Picture
                    if (!empty($_POST['old_picture3'])){
                      $to_delete = UPLOAD_DIR. 'article/'.$_POST['old_picture3'];
                      unlink($to_delete);
                      $to_delete = UPLOAD_DIR. 'article/small/'.$_POST['old_picture3'];
                      unlink($to_delete);
                    }
                  }
                  # -- END PICTURE 3 ===============================================
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
            
            //Display information to the user.
            $table = get_single_articles($id);

            //Check if the total_rows is less than 1
            if (get_total_articles() < 1) {
                  redirect('admin/article/index.php?action=not-found');
                  exit();
            } else {
                  
                  //Get All the information from the database.
                  extract($table);

                  //Get the type of Article
                  $type_name = get_article_type($type);

                  $present_category = $category; 
            }
      }
} else {
      redirect('admin/article/?action=not-found');
      exit();
}

# -- Get Category ########################################################################################
$my_categorys = get_article_category();
$category_list = array();
$category_list[$category_id] = $present_category;
$category_list[0] = "Add a New Category";
foreach ($my_categorys as $my_category) {
  if ($my_category['id'] == $category_id) continue;
    $category_list[$my_category['id']] = $my_category['name'];
}


# -- Page Configuration ########################################################################################
$title = "Edit Article";
$page_title = "Articles";
$breadcrumb = array(
                      'articles' => 'admin/article',
                      'Edit article' => '#'
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
                <?php echo "Edit article" ?>
                <br><br>
                </h3>

                   <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <?php Text('name',$name,'class="form-control" placeholder="Name of the article"') ?>
                        <?php show_errors('name') ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Full Article <span class="mandatory">*</span> </label>
                      <div class="col-sm-10">
                        <?php Textarea('full_article',$full_article," class='editor'") ?>
                        <?php show_errors('full_article','Enter the full article here') ?>
                      </div>
                  </div>

                  <?php if ($type > QUOTES) { // No Excerpt for Quotes ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Excerpt</label>
                      <div class="col-sm-10">
                        <?php Textarea('excerpt',$excerpt," class='editor'") ?>
                        <?php show_errors('excerpt', 'Enter a summary for your article. If omitted, the excerpt will be extracted from the main article. It should be over 250 characters') ?>
                      </div>
                  </div>
                  <?php } ?>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Category<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php 
                              Select('category',$category_list,$category_id,'class="form-control"');
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
                            <?php Text('published_date',formatted_date($published_date),'class="form-control" placeholder="MM/DD/YYYY"') ?>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                      </div>
                  </div>   


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Tags<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Textarea('tags',$tags,'class="form-control" placeholder="Enter tags separated by comma"',5) ?>
                          <?php show_errors('tags') ?>
                      </div>
                  </div>


                  <?php if ($type == VIDEO) { // Picture 3 ?> 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Video URL <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <?php Text('video',$video,'class="form-control" placeholder="Enter Video URL"') ?>
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
                            <img src="<?php echo UPLOAD_URL.'article/'.$picture ?>" data-src="<?php echo UPLOAD_URL.'article/'.$picture ?>" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Change image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
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
                            <img src="<?php echo UPLOAD_URL.'article/'.$picture2 ?>" data-src="<?php echo UPLOAD_URL.'article/'.$picture2 ?>" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Change image</span><span class="fileinput-exists">Change</span><input type="file" name="picture2"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php show_errors('picture2') ?>
                      </div>
                  </div>
                  <?php } ?>



                  <?php if ($type == SLIDESHOW) { // Picture 3 ?> 
                  <div class="form-group">
                      <label class="col-sm-3 control-label">Picture 3</label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="<?php echo UPLOAD_URL.'article/'.$picture3 ?>" data-src="<?php echo UPLOAD_URL.'article/'.$picture3 ?>" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Change image</span><span class="fileinput-exists">Change</span><input type="file" name="picture3"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php show_errors('picture3') ?>
                      </div>
                  </div>
                  <?php } ?>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name = "old_picture" value="<?php echo $picture ?>"> 
                        <input type="hidden" name = "old_picture2" value="<?php echo $picture2 ?>"> 
                        <input type="hidden" name = "old_picture3" value="<?php echo $picture3 ?>"> 
                        <button type="submit" class="btn btn-primary">Update <?php echo $type_name ?></button>
                        <input type="reset" class="btn btn-default">
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

