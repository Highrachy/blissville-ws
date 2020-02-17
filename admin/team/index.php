<?php
include('../../config.php'); 

$task = URL::get('task');
$id = URL::get('id');

$action = "";

if (!empty($task)){
  if ($task == 'move-up'){
    $action = Team::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = Team::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = Team::toggle($id);
  }
}

if (!$action){
  $errors = Team::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,Team::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,Team::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$additional_query = Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

$page = Team::paginate($items_per_page,$additional_query);

// Get the total returned rows
$total_teams = Team::affected_rows();
$teams = Team::get_results();
$count = Team::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "teams";
$page_title = "All Teams";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <?php Alert::display() ?>
                <!-- content  start -->
                <div id="content">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4>All Teams
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                          <small class="pull-right">
                            <a href="<?php echo URL::display('admin/team/new.php') ?>"><i class="fa fa-plus"></i> New Team</a>
                          </small>
                        </h4>
                      </div>
                      <?php if(!empty($teams)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:5%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:30%;"><?php echo Sort::generate_link('name') ?></th>
                              <th style="width:35%;"><?php echo Sort::generate_link('post') ?></th>
                              <th style="width:15%;"><?php echo Sort::generate_link('priority') ?></th>
                              <th style="width:15%;"></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($teams as $team) : extract($team) ?>
                            <tr>
                              <td class="text-center"><?php echo $count++ ?></td>
                              <td><h5><?php echo $name ?></h5></td>
                              <td><h5><?php echo $post ?></h5></td>
                              <td align="center">
                                <?php echo $priority ?>
                                
                              <span class="pull-right">
                                                      
                                  <a class="small-link tip" href="<?php echo '?id='.$team['id'].'&task=move-up'?>" title="Increase">
                                  <i class="fa fa-arrow-up"></i> Up</a>
                                  <a class="small-link tip" href="<?php echo '?id='.$team['id'].'&task=move-down'?>" title="Decrease">
                                  <i class="fa fa-arrow-down"></i> Down</a>
                              </span>

                              </td>
                              <td class="text-right">
                              <a class="btn btn-danger btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/team/delete.php?team='.$team['id']) ?>" title="Delete Team"><i class="fa fa-times"></i></a>
                              <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/team/edit.php?team='.$team['id']) ?>" title="Edit Team"><i class="fa fa-pencil"></i></a>
                              </td>
                            </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <?php if (isset($page) && ($page != "")) :  ?>
                      <div class="table-footer">
                        <ul class="pagination pagination-sm">
                          <?php echo $page; ?>
                        </ul>
                      </div>
                    <?php endif ?>
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no teams in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

