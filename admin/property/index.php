<?php
include('../../config.php'); 

$task = URL::get('task');
$id = URL::get('id');

$action = "";

if (!empty($task)){
  if ($task == 'move-up'){
    $action = Property::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = Property::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = Property::toggle($id);
  }
}

if (!$action){
  $errors = Property::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,Property::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,Property::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$additional_query = Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

$page = Property::paginate($items_per_page,$additional_query,Property::join_query());

// Get the total returned rows
$total_propertys = Property::affected_rows();
$propertys = Property::get_results();
$count = Property::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "propertys";
$page_title = "All Propertys";

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
                        <h4>All Propertys
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                          <small class="pull-right">
                            <a href="<?php echo URL::display('admin/property/new.php') ?>"><i class="fa fa-plus"></i> New Property</a>
                          </small>
                        </h4>
                      </div>
                      <?php if(!empty($propertys)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:5%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:15%;" class="text-center">Picture</th>
                              <th style="width:25%;"><?php echo Sort::generate_link('name','Name') ?></th>
                              <th align="center" style="width:15%;"><?php echo Sort::generate_link('price') ?></th>
                              <th align="center" class="text-center" style="width:12%;"><?php echo Sort::generate_link('floor_plans','Floor Plans') ?></th>
                              <th align="center" class="text-center" style="width:12%;"><?php echo Sort::generate_link('priority') ?></th>
                              <th></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($propertys as $property) : extract($property) ?>
                            <tr>
                              <!-- S/N -->
                              <td class="text-center"><?php echo $count++ ?></td>

                              <!-- IMAGE -->
                              <td class="text-center"><img src="<?php URL::display(Property::upload_url('small/'.$picture)) ?>" alt="<?php echo $name ?>" class="img-responsive"></td>
                              <td>
                                <h5 class="no-margin-bottom"><?php echo $name ?> </h5>
                                <small><?php echo $portfolio_name ?></small> 
                              </td>

                              <!-- PRICE AND PAYMENT PLANS -->
                              <td>
                                <h5 class="no-margin-bottom">&#8358; <?php echo number_format($price) ?></h5>
                                 <small><a href="#">Edit Payment Plans</a></small>
                              </td>

                              <!-- FLOOR PLANS -->
                              <td align="center">

                                <h5 class="no-margin-bottom"><?php echo $floor_plan ?></h5>
                                
                                <span class="pull-right">
                                                        
                                    <a class="small-link tip" href="<?php URL::display('admin/property/floor_plan/?property='.$property['id']) ?>" title="View Floor Plans">
                                    <i class="fa fa-eye"></i> View</a>
                                    <a class="small-link tip" href="<?php URL::display('admin/property/floor_plan/new.php?property='.$property['id']) ?>" title="View Floor Plans">
                                    <i class="fa fa-plus"></i> Add</a>
                                </span>
                              </td>

                              <!-- PRIORITY -->
                              <td align="center">
                                 <h5 class="no-margin-bottom"><?php echo $priority ?></h5>
                                
                                <span class="pull-right">
                                                        
                                    <a class="small-link tip" href="<?php echo '?id='.$property['id'].'&task=move-up'?>" title="Increase">
                                    <i class="fa fa-arrow-up"></i> Up</a>
                                    <a class="small-link tip" href="<?php echo '?id='.$property['id'].'&task=move-down'?>" title="Decrease">
                                    <i class="fa fa-arrow-down"></i> Down</a>
                                </span>

                              </td>

                              <!-- EDIT AND DELETE BUTTONS -->
                              <td class="text-right">
                              <a class="btn btn-danger btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/property/delete.php?property='.$property['id']) ?>" title="Delete Property"><i class="fa fa-times"></i></a>
                              <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/property/edit.php?property='.$property['id']) ?>" title="Edit  Property"><i class="fa fa-pencil"></i></a>
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
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no propertys in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

