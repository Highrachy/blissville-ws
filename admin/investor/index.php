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
require_once(INCLUDE_DIR.'investor.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'investor area');


# -- Sorting ########################################################################################


$default_sort = 'priority';
$default_sort_text = "Priority";

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

  if ($task == 'move-up'){
    $action = increase_investors($id); 
  } elseif ($task == 'move-down'){
    $action = decrease_investors($id); 
  } elseif ($task == 'toggle'){
    $action = toggle_investors($id); 
  }
  redirect('admin/investor/?action='.$action.'&sort='.$sort.'&sort_order='.$sort_order); 
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

$total_investors = $total_returned_rows = total_investors();

//Include the paginate function
$page = paginate($total_returned_rows,$limit,$page);

# -- End of Pagination #################################################################################

//Fetch All rows
$query = "SELECT * FROM investors ORDER BY $sorted LIMIT $start,$limit";
$investors = $db->fetch_all_row($query);

# -- Page Configuration ########################################################################################
$title = "investor-us";
$page_title = "Investor Us";


$breadcrumb = array('Investor Us' => 'admin/investor');

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

                <?php display_alert(); //Necessary for get_action to work effectively ?>
                
                <div>
                    
                  <h3 class="page-title">
                  <a href="<?php echo get_url('admin/investor/new.php') ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Add New </a>
                  <?php echo get_plural($total_investors,'page') ?><small> currently sorted by <?php echo $sort_text ?> </small>
                  </h3>
                  <br class="clearfix">
                </div>

                <?php if(!empty($investors)) : ?>  
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover responsive">
                        <thead>
                              <tr>
                                <th style="width:10%;" class="text-center">
                                  <strong>
                                    <a href="<?php get_url('admin/investor/?sort=id&sort_order='.reverse_sort_order($sort_order,'id')) ?>" class="<?php get_active_tab('id',$sort) ?>">
                                      S/N <?php echo get_sort_icon($sort_order,'id') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:25%;">
                                  <strong>
                                    <a href="<?php get_url('admin/investor/?sort=name&sort_order='.reverse_sort_order($sort_order,'name')) ?>" class="<?php get_active_tab('name',$sort) ?>">
                                      Name <?php echo get_sort_icon($sort_order,'name') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:45%;">
                                  <strong>
                                    <a href="<?php get_url('admin/investor/?sort=priority&sort_order='.reverse_sort_order($sort_order,'priority')) ?>" class="<?php get_active_tab('priority',$sort) ?>">
                                      Priority <?php echo get_sort_icon($sort_order,'priority') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th class="text-center">&nbsp;</th>
                              </tr>
                        </thead>
                        <tbody>
                                    <?php foreach($investors as $investor) : ?>                           
                                      <tr>
                                        <td class="text-center"><?php echo ++$count + $start; ?></td>
                                        <td>
                                          <a href="<?php get_url('admin/investor/view.php?investor='.$investor['id']) ?>" class="tip" title="Preview investor">
                                            <?php echo truncate($investor['name'],50) ?>
                                          </a>
                                        </td>
                                        <td>
                                         &nbsp;&nbsp;<?php echo $investor['priority'] ?>

                                          <span class="pull-right">
                                              
                                            <a class="small-link tip" href="<?php echo '?id='.$investor['id'].'&task=move-up'.'&sort='.$sort.'&sort_order='.$sort_order; ?>" title="Increase"><i class="fa fa-arrow-up"></i> Increase</a>
                                            <a class="small-link tip" href="<?php echo '?id='.$investor['id'].'&task=move-down'.'&sort='.$sort.'&sort_order='.$sort_order; ?>" title="Decrease"><i class="fa fa-arrow-down"></i> Decrease</a>
                                          </span>
                                        </td>
                                        <td class="text-right">
                                          <a class="small-link tip" href="<?php get_url('admin/investor/edit.php?investor='.$investor['id']) ?>" title="Edit investor"><i class="fa fa-wrench"></i> Edit</a>
                                          <a class="small-link tip" href="<?php get_url('admin/investor/delete.php?investor='.$investor['id']) ?>" title="Delete"><i class="fa fa-trash"></i> Delete</a>
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
                <?php else : echo '<h6>&nbsp;&nbsp;You have no pages in the Investor Us section of the database. Add a <a href="new.php">New page.</a></h6>'; endif ?>
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

