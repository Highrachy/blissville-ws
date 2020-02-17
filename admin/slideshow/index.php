<?php
include('../../config.php'); 

$task = URL::get('task');
$id = URL::get('id');

$action = "";

if (!empty($task)){
  if ($task == 'move-up'){
    $action = Slideshow::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = Slideshow::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = Slideshow::toggle($id);
  }
}

if (!$action){
  $errors = Slideshow::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,Slideshow::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,Slideshow::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$additional_query = Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

$page = Slideshow::paginate($items_per_page,$additional_query);

// Get the total returned rows
$total_slideshows = Slideshow::affected_rows();
$slideshows = Slideshow::get_results();
$count = Slideshow::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "slideshows";
$page_title = "All Slideshows";

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
                        <h4>All Slideshows
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                          <small class="pull-right">
                            <a href="<?php echo URL::display('admin/slideshow/new.php') ?>"><i class="fa fa-plus"></i> New Slideshow</a>
                          </small>
                        </h4>
                      </div>
                      <?php if(!empty($slideshows)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:5%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:20%;" class="text-center">Picture</th>
                              <th style="width:45%;"><?php echo Sort::generate_link('name','Details') ?></th>
                              <th style="width:15%;"><?php echo Sort::generate_link('priority') ?></th>
                              <th style="width:15%;"></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($slideshows as $slideshow) : extract($slideshow) ?>
                            <tr>
                              <td class="text-center"><?php echo $count++ ?></td>
                              <td class="text-center"><img src="<?php URL::display(Slideshow::upload_url('small/'.$picture)) ?>" alt="<?php echo $name ?>" class="img-responsive"></td>
                              <td><h5 class="no-margin-bottom"><?php echo $name ?> </h5><small><?php echo $description ?></small></td>
                              <td align="center">
                                <?php echo $priority ?>
                                
                              <span class="pull-right">
                                                      
                                  <a class="small-link tip" href="<?php echo '?id='.$slideshow['id'].'&task=move-up'?>" title="Increase">
                                  <i class="fa fa-arrow-up"></i> Up</a>
                                  <a class="small-link tip" href="<?php echo '?id='.$slideshow['id'].'&task=move-down'?>" title="Decrease">
                                  <i class="fa fa-arrow-down"></i> Down</a>
                              </span>

                              </td>
                              <td class="text-right">
                              <a class="btn btn-danger btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/slideshow/delete.php?slideshow='.$slideshow['id']) ?>" title="Delete Slideshow"><i class="fa fa-times"></i></a>
                              <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/slideshow/edit.php?slideshow='.$slideshow['id']) ?>" title="Edit Slideshow"><i class="fa fa-pencil"></i></a>
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
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no slideshows in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

