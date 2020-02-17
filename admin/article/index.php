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
require_once(INCLUDE_DIR.'article.function.php');

# -- Action ########################################################################################

if (isset($_GET['action']))
get_action($_GET['action'],'article');



# -- Sorting ########################################################################################


$default_sort = 'published_date';
$default_sort_text = "Published Date";

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

$total_articles = $total_returned_rows = total_articles();

//Include the paginate function
$page = paginate($total_returned_rows,$limit,$page);

# -- End of Pagination #################################################################################

//Fetch All rows
$query ="SELECT a.id, a.name, a.published_date, COUNT(c.article_id) as total_comments
          FROM  `articles` a
          LEFT JOIN comments c ON c.article_id = a.id
          GROUP BY a.name
          ORDER BY $sorted LIMIT $start,$limit"; 
$articles = $db->fetch_all_row($query);
# -- Page Configuration ########################################################################################
$title = "article";
$page_title = "All articles";
$breadcrumb = array('All articles' => 'admin/article.php');

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
              <div class="col-md-9 col-md-push-3">

                <?php display_alert(); //Necessary for get_action to work effectively ?>
                
                <div>
                    
                  <h3 class="page-title">
                  <a href="<?php echo get_url('admin/article/new.php') ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Add New </a>
                  <?php echo get_plural($total_articles,'Article') ?><small> currently sorted by <?php echo $sort_text ?> </small>
                  </h3>
                  <br class="clearfix">
                </div>

                <?php if(!empty($articles)) : ?>  
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover responsive">
                        <thead>
                              <tr>
                                <th style="width:7%;" class="text-center">
                                  <strong>
                                    <a href="<?php get_url('admin/article/?sort=id&sort_order='.reverse_sort_order($sort_order,'id')) ?>" class="<?php get_active_tab('id',$sort) ?>">
                                      S/N <?php echo get_sort_icon($sort_order,'id') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:35%;">
                                  <strong>
                                    <a href="<?php get_url('admin/article/?sort=name&sort_order='.reverse_sort_order($sort_order,'name')) ?>" class="<?php get_active_tab('name',$sort) ?>">
                                      Name <?php echo get_sort_icon($sort_order,'name') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:25%;">
                                  <strong>
                                    <a href="<?php get_url('admin/article/?sort=published_date&sort_order='.reverse_sort_order($sort_order,'published_date')) ?>" class="<?php get_active_tab('published_date',$sort) ?>">
                                      Published <?php echo get_sort_icon($sort_order,'published_date') ?>
                                    </a>
                                  </strong>
                                </th>
                                <th style="width:15%;">
                                  <strong>
                                    <a href="<?php get_url('admin/article/?sort=total_comments&sort_order='.reverse_sort_order($sort_order,'total_comments')) ?>" class="<?php get_active_tab('total_comments',$sort) ?>">
                                      Comments <?php echo get_sort_icon($sort_order,'total_comments') ?>
                                    </a>
                                    </strong>
                                </th>
                                <th class="text-center">&nbsp;</th>
                              </tr>
                        </thead>
                        <tbody>
                          <?php foreach($articles as $article) : ?>                           
                            <tr>
                              <td class="text-center"><?php echo ++$count + $start; ?></td>
                              <td>
                                <a href="<?php get_url('admin/article/view.php?article='.$article['id']) ?>" class="tip" title="View Article">
                                  <?php echo truncate($article['name'],40) ?>
                                </a>
                              </td>
                              <td>
                                <a href="<?php get_url('admin/article/edit.php?article='.$article['id']) ?>" class="tip" title="Edit Date">
                                 <?php echo formatted_date($article['published_date']) ?> 
                                </a>
                              </td>
                              <td>
                                <a href="<?php get_url('admin/article/view.php?article='.$article['id']) ?>#comments" class="tip" title="View Comments">
                                 <small><?php echo get_plural($article['total_comments'],'Comment','Comments','No Comment')  ?> </small> 
                                </a>
                              </td>
                              <td class="text-right">
                                <a class="small-link tip" href="<?php get_url('admin/article/edit.php?article='.$article['id']) ?>" title="Edit article"><i class="fa fa-wrench"></i> Edit</a>
                                <a class="small-link tip" href="<?php get_url('admin/article/delete.php?article='.$article['id']) ?>" title="Delete"><i class="fa fa-trash"></i> Delete</a>
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
                <?php else : echo '<h6>&nbsp;&nbsp;You have no articles in the database. Add a <a href="new.php">New article.</a></h6>'; endif ?>
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

