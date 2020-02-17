<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
$editor = true;

# -- Include the page function ########################################################################################
require_once(INCLUDE_DIR.'faqs.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'faqs');

 //Add a new faqs
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  # ****** COMPULSORY FIELDS **********#
  # *****************************************#
  # -- Question
  $data['question'] = assign('question','minlen=3','Please enter a valid Question');

  # -- Approved
  $data['answer'] = assign('answer','minlen=10','Please enter a valid answer');

  # -- Priority
  $data['priority'] = assign('priority', 'num');

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
    if ($data['category'] < 1){
        $data['category'] = add_faq_category($cat_data);
      }
    $action = add_faqs($data);
  }

  if (empty($errors)){
    
    if ($action == 'exists'){
      $errors['error'] = "The faqs exists in the database";
    } else {
      redirect('admin/faqs/?action='.$action); 
    }
         
  }
  
  
}

# -- Get Category ########################################################################################
$my_categorys = get_faqs_category();
$category = array();
$category[0] = "Add a New Category";
foreach ($my_categorys as $my_category) {
  $category[$my_category['id']] = $my_category['name'];
}

# -- Page Configuration ########################################################################################
$title = "New FAQs";
$page_title = "FAQs";
$breadcrumb = array(
                      'FAQs' => 'admin/FAQs',
                      'New FAQs' => '#'
              );

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

              <?php display_alert(); //Necessary for get_action to work effectively ?>
                
              <form action="#" class="form-horizontal" method="post">
              
                <h3 class="page-title">
                <?php echo "Add a New FAQs" ?>
                <br><br>
                </h3>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Question <span class="mandatory">*</span></label>
                    <div class="col-sm-7">
                      <?php Text('question','','class="form-control" placeholder="FAQs Question"') ?>
                      <?php show_errors('question') ?>
                    </div>
                  </div>


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
                      <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php 
                              $priority_value = array();
                              for ($i=1; $i <= 10 ; $i++) { 
                                  $priority_value[$i] = $i;
                              }

                                  Select('priority',$priority_value,'','class="form-control"') ;
                              ?>
                      </div>
                  </div>
                  

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Answer <span class="mandatory">*</span> </label>
                      <div class="col-sm-10">
                        <?php Textarea('answer',''," class='editor'") ?>
                        <?php show_errors('answer') ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add New</button>
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

