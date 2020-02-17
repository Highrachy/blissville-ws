<?php
include('../../../config.php'); 

Page::set_table(Page::TBL_INVESTORS);

$task = URL::get('task');
$id = URL::get('id');

$action = "";

if (!empty($task)){
  if ($task == 'move-up'){
    $action = Page::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = Page::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = Page::toggle($id);
  }
}

if (!$action){
  $errors = Page::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,Page::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,Page::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$additional_query = Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

$page = Page::paginate($items_per_page,$additional_query);

// Get the total returned rows
$total_investors = Page::affected_rows();
$investors = Page::get_results();
$count = Page::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "investors";
$page_title = "Investor";

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
                        <h4>Investor Page
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                        </h4>
                      </div>
                      <?php if(!empty($investors)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:10%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:80%;"><?php echo Sort::generate_link('name') ?></th>
                              <th></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($investors as $investor) : extract($investor) ?>
                            <tr>
                              <td class="text-center"><?php echo $count++ ?></td>
                              <td><h5 class="m-0"><strong><?php echo $name ?> </strong></h5><p><small><?php echo Text::truncate(strip_tags($content),200) ?></small></p><br></td>
                              <td class="text-right">
                              <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/edit-content/investor/edit.php?investor='.$investor['id']) ?>" title="Edit Content"><i class="fa fa-pencil"></i> &nbsp; Edit</a>
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
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no investors in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

