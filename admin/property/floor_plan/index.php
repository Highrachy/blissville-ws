<?php
include('../../../config.php'); 

$task = URL::get('task');
$id = URL::get('id');

# -- Property
$property_id = URL::get('property',0);

$property_name = Property::get_name($property_id);

if (empty($property_name)){
  URL::redirect('admin/property/?action=not-found');
}


$action = "";

# -- Property
$property_id = URL::get('property',0);

$property_name = Property::get_name($property_id);

if (empty($property_name)){
  URL::redirect('admin/property/?action=not-found');
}


if (!empty($task)){
  if ($task == 'move-up'){
    $action = FloorPlan::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = FloorPlan::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = FloorPlan::toggle($id);
  }
}

if (!$action){
  $errors = FloorPlan::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,FloorPlan::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,FloorPlan::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$where_query = " WHERE property_id = $property_id ";
$additional_query = $where_query . Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

$page = FloorPlan::paginate($items_per_page,$additional_query);

// Get the total returned rows
$total_floor_plans = FloorPlan::affected_rows();
$floor_plans = FloorPlan::get_results();
$count = FloorPlan::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "floor_plans";
$page_title = "All Floor Plans";

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
                        <h4>Floor Plans - <?php echo $property_name ?>
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                          <small class="pull-right">
                            <a href="<?php echo URL::display('admin/property/floor_plan/new.php?property='.$property_id) ?>"><i class="fa fa-plus"></i> New Floor Plan</a>
                          </small>
                        </h4>
                      </div>
                      <?php if(!empty($floor_plans)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:5%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:20%;" class="text-center">Picture</th>
                              <th style="width:45%;"><?php echo Sort::generate_link('name','Name') ?></th>
                              <th style="width:15%;"><?php echo Sort::generate_link('priority') ?></th>
                              <th style="width:15%;"></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($floor_plans as $floor_plan) : extract($floor_plan) ?>
                            <tr>
                              <td class="text-center"><?php echo $count++ ?></td>
                              <td class="text-center"><img src="<?php URL::display(FloorPlan::upload_url('small/'.$picture)) ?>" alt="<?php echo $name ?>" class="img-responsive"></td>
                              <td><h5 class="no-margin-bottom"><?php echo $name ?> </h5></td>
                              <td align="center">
                                <?php echo $priority ?>
                                
                              <span class="pull-right">
                                                      
                                  <a class="small-link tip" href="<?php echo '?id='.$floor_plan['id'].'&task=move-up&property='.$property_id?>" title="Increase">
                                  <i class="fa fa-arrow-up"></i> Up</a>
                                  <a class="small-link tip" href="<?php echo '?id='.$floor_plan['id'].'&task=move-down&property='.$property_id ?>" title="Decrease">
                                  <i class="fa fa-arrow-down"></i> Down</a>
                              </span>

                              </td>
                              <td class="text-right">
                              <a class="btn btn-danger btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/property/floor_plan/delete.php?floor_plan='.$floor_plan['id']) ?>" title="Delete Floor Plan"><i class="fa fa-times"></i></a>
                              <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/property/floor_plan/edit.php?floor_plan='.$floor_plan['id']) ?>" title="Edit Floor Plan"><i class="fa fa-pencil"></i></a>
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
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no Floor Plan in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

