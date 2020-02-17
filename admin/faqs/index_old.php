<?php
include('../../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;

# -- Include the page function ########################################################################################
require_once(INCLUDE_DIR.'faqs.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'faqs');



# -- Sorting ########################################################################################


$default_sort = 'id';
$default_sort_text = "Added Date";

if (isset($_GET['sort'])){
  $sort = $_GET['sort'];
  $sort_text = ucwords(str_replace('_', ' ', $sort));
}else{
  $sort = $default_sort;
  $sort_text = $default_sort_text;
}

if ($sort == 'id'){
  $sort_text = "Added Date";
}



$sort_order = 'DESC';
$sort_order_text = 'DESC';

if (isset($_GET['sort_order'])){
  $sort_order = $_GET['sort_order'];

  if ($sort_order == 'asc'){
    $sort_order = 'ASC';
    $sort_order_text = "ASC";
  } 
}

$sorted = $sort." ".$sort_order;
$sort_text .= " <em>".$sort_order_text."</em>";


# -- Task ########################################################################################

if (isset($_GET['task'])){
  $task = $_GET['task'];

  if (isset($_GET['id']))
    $id = $_GET['id'];

  $action = "";

  if ($task == 'approve'){
    $action = approve_faqs($id); 
  } elseif ($task == 'disapprove'){
    $action = disapprove_faqs($id); 
  }
  redirect('admin/faqs/?action='.$action.'&sort='.$sort.'&sort_order='.$sort_order); 
}


# -- Pagination ########################################################################################

include(SERVER_DIR.'lib/functions/paginate.php');
//Default Configuration for the pagination
$limit = 10;
if (isset($_GET['p'])){
      $page = abs($_GET['p']);
      $start = ($page - 1) * $limit; 
}else{
      $page = 1;
      $start = 0; 
}     
$total_returned_rows = $count = 0;

$total_faqs = $total_returned_rows = total_faqs();

//Include the paginate function
$page = paginate($total_returned_rows,$limit,$page);

# -- End of Pagination #################################################################################

//Fetch All rows
$query = "SELECT * FROM faqs ORDER BY $sorted LIMIT $start,$limit";
$faqs = $db->fetch_all_row($query);

# -- Page Configuration ########################################################################################
$title = "faqs";
$page_title = "All faqs";
$breadcrumb = array('All faqs' => 'admin/faqs.php');

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

                <?php display_alert(); //Necessary for get_action to work effectively ?>
                
                <div>
                    
                  <h3 class="page-title">
                  <a href="<?php echo get_url('admin/faqs/new.php') ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Add New </a>
                  <?php echo get_plural($total_faqs,'FAQ') ?><small> currently sorted by <?php echo $sort_text ?> </small>
                  </h3>
                  <br class="clearfix">
                </div>

                <?php if(!empty($faqs)) : ?>  
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover responsive">
                        <thead>
                              <tr>
                                <th style="width:10%;" class="text-center">
                                  <strong>
                                    <a href="<?php get_url('admin/faqs/?sort=id&sort_order='.reverse_sort_order($sort_order,'id')) ?>" class="<?php get_active_tab('id',$sort) ?>">
                                      S/N <?php echo get_sort_icon($sort_order,'id') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:70%;">
                                  <strong>
                                    <a href="<?php get_url('admin/faqs/?sort=question &sort_order='.reverse_sort_order($sort_order,'question ')) ?>" class="<?php get_active_tab('question ',$sort) ?>">
                                      Question  <?php echo get_sort_icon($sort_order,'question ') ?>
                                    </a>
                                  </strong>
                                </th>
                                </th>
                                <th class="text-center">&nbsp;</th>
                              </tr>
                        </thead>
                        <tbody>
                                    <?php foreach($faqs as $faq) : ?>                           
                                      <tr>
                                        <td class="text-center"><?php echo ++$count + $start; ?></td>
                                        <td>
                                          <a href="<?php get_url('admin/faqs/view.php?faqs='.$faq['id']) ?>" class="tip" title="Preview faqs">
                                            <?php echo truncate($faq['question'],80) ?>
                                          </a>
                                        </td>
                                        <td class="text-right">
                                          <a class="small-link tip" href="<?php get_url('admin/faqs/edit.php?faqs='.$faq['id']) ?>" title="Edit faqs"><i class="fa fa-wrench"></i> Edit</a>
                                          <a class="small-link tip" href="<?php get_url('admin/faqs/delete.php?faqs='.$faq['id']) ?>" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                      </tr>
                                    <?php endforeach ?>
                        </tbody>
                  </table>
                </div>
                <?php if (isset($page) && ($page != "")) :  ?>
                  <div class="table-footer">
                    <?php echo $page; ?>
                  </div>
                <?php endif ?>
                <?php else : echo '<h6>&nbsp;&nbsp;You have no faqs in the database. Add a <a href="new.php">New faqs.</a></h6>'; endif ?>
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

