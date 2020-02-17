<?php
include('../../config.php'); 

$task = URL::get('task');
$id = URL::get('id');

$action = "";

if (!empty($task)){
  if ($task == 'move-up'){
    $action = FAQs::increase_priority($id);
  } elseif ($task == 'move-down'){
    $action = FAQs::decrease_priority($id);
  } elseif ($task == 'toggle'){
    $action = FAQs::toggle($id);
  }
}

if (!$action){
  $errors = FAQs::get_errors();
} else {
  $_GET['action'] = 'update';
}


# -- Sort ########################################################################################
// Get the sort parameters from url or use the default sorting criterion
$sort_item = URL::get(Sort::$item_url,FAQs::$default_sort_item);
$sort_order = URL::get(Sort::$order_url,FAQs::$default_sort_order);

$sort_text = Sort::current($sort_item,$sort_order);
$additional_query = Sort::get_order_query();


# -- Pagination ########################################################################################
//Default Configuration for the pagination
$items_per_page = 10;

//For Join Only


$page = FAQs::paginate($items_per_page,$additional_query,FAQs::join_query());

// Get the total returned rows
$total_faqs = FAQs::affected_rows();
$faqs = FAQs::get_results();
$count = FAQs::get_counter();
# -- End of Pagination #################################################################################

# -- Page Configuration ########################################################################################
$dashboard = true;
$title = "FAQs";
$page_title = "Frequently Asked Questions";

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
                        <h4>FAQs
                          <small> currently sorted by <?php echo $sort_text ?> </small>
                          <small class="pull-right">
                            <a href="<?php echo URL::display('admin/faqs/new.php') ?>"><i class="fa fa-plus"></i> New FAQs</a>
                          </small>
                        </h4>
                      </div>
                      <?php if(!empty($faqs)) : ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover responsive">
                          <thead>
                            <tr>

                                    
                              <th style="width:10%;" class="text-center">
                                <?php echo Sort::generate_link('id','S/N') ?>
                              </th>
                              <th style="width:65%;"><?php echo Sort::generate_link('question') ?></th>
                              <th style="width:15%;"><?php echo Sort::generate_link('priority') ?></th>
                              <th></th>
                            </tr>
                          </thead>

                          <tbody>
                             <?php foreach($faqs as $faq) : extract($faq) ?>
                            <tr>
                              <td class="text-center"><?php echo $count++ ?></td>
                              <td>
                                <h5 class="m-0"><strong><?php echo $question ?> </strong></h5>
                                <p>
                                  <small>
                                    <em class="gray"><?php echo $category ?></em>
                                    <br>
                                    <?php echo Text::truncate(strip_tags($answer),200) ?>
                                  </small>
                                </p>
                              </td>
                              <td align="center">
                                <?php echo $priority ?>
                                
                              <span class="pull-right">
                                                      
                                  <a class="small-link tip" href="<?php echo '?id='.$faq['id'].'&task=move-up'?>" title="Increase">
                                  <i class="fa fa-arrow-up"></i> Up</a>
                                  <a class="small-link tip" href="<?php echo '?id='.$faq['id'].'&task=move-down'?>" title="Decrease">
                                  <i class="fa fa-arrow-down"></i> Down</a>
                              </span>

                              </td>
                              <td class="text-right">
                                <a class="btn btn-danger btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/faqs/delete.php?faq='.$faq['id']) ?>" title="Delete FAQs"><i class="fa fa-times"></i></a>
                                <a class="btn btn-default btn-icon btn-hollow btn-xs tip pull-right" href="<?php URL::display('admin/faqs/edit.php?faq='.$faq['id']) ?>" title="Edit  FAQs"><i class="fa fa-pencil"></i></a>
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
                      <?php else : echo '<h6>&nbsp;&nbsp;You have no faqs in the database.</h6>'; endif ?>
                  </div>
                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

