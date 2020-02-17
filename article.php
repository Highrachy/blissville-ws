<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 



# -- Start Editable ########################################################################################
require_once(INCLUDE_DIR.'editable.function.php');
activate_editable();

$action = "";

 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Verify if it is editable
  if (isset($_POST['editable']) && ($_POST['editable'] == 'editable')){
    extract($_POST);
    $action = update_editable($data, $id, $table_name);

    //Get Notification
    get_action($action,'page');
  }
 }
# -- End Editable ########################################################################################



#-############################################
# GET ALL CONTENTS FOR INVESTORS
#-############################################
require_once(INCLUDE_DIR.'investor.function.php');

$investor = get_investor();


# -- Page Configuration ########################################################################################
$title = "article";
$page_title = "Article";
$page_desc = "Invest today and watch your money grow...";

$register_interest = false;

$breadcrumb = array('Article'=> '#');

include('inc/header.php');
?>


            <section class="page-content">

                <!-- container -->
                <div class="container">
                        <!-- col-md-9 -->
                        <div class="col-md-9 col-sm-6 pl-0 content-area">
                            <div class="blog-listing">
                                <article>
                                    <div class="entry-cover">
                                        <a title="entry-cover" href="blog-detail.html"><img src="<?php get_url('assets/uploads/slideshow/slide-3.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <div class="entry-header">
                                        <h3 class="entry-title"><a href="blog-detail.html" title="Blog Title">Article with image format</a></h3>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a title="Blog Date" href="#"><i class="fa fa-clock-o"></i> Posted On 03 April,2015</a>
                                            </span>
                                            <span class="byline">
                                                <i class="fa fa-user"></i><a title="Author" href="#">Admin</a>
                                            </span>
                                            <span class="tag-link">
                                                <i class="fa fa-tag"></i><a title="Tags" href="#">apartment</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, aAenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdiet.</p>
                                        <a href="#" title="Read more" class="btn btn-default">Read More</a>
                                    </div>
                                </article>
                                
                                <article>
                                    <div class="entry-cover">
                                        <!-- Blog Slider -->
                                        <div id="blog-slider" class="carousel slide blog-slider" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <a title="entry-cover" href="blog-detail.html"><img src="<?php get_url('assets/uploads/slideshow/slide-2.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                                    <i><img src="images/blog/multi-img-icon.png" alt="multi images icon"/></i>
                                                </div>
                                                <div class="item">
                                                    <a title="entry-cover" href="blog-detail.html"><img src="<?php get_url('assets/uploads/slideshow/slide-3.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                                    <i><img src="images/blog/multi-img-icon.png" alt="multi images icon"/></i>
                                                </div>
                                                <div class="item">
                                                    <a title="entry-cover" href="blog-detail.html"><img src="<?php get_url('assets/uploads/slideshow/slide-1.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                                    <i><img src="images/blog/multi-img-icon.png" alt="multi images icon"/></i>
                                                </div>
                                            </div>
                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#blog-slider" role="button" data-slide="prev">
                                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#blog-slider" role="button" data-slide="next">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div><!-- Slider Section /- -->
                                    </div>
                                    <div class="entry-header">
                                        <h3 class="entry-title"><a href="blog-detail.html" title="Blog Title">Article with Slideshow format</a></h3>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a title="Blog Date" href="#"><i class="fa fa-clock-o"></i> Posted On 03 April,2015</a>
                                            </span>
                                            <span class="byline">
                                                <i class="fa fa-user"></i><a title="Author" href="#">Admin</a>
                                            </span>
                                            <span class="tag-link">
                                                <i class="fa fa-tag"></i><a title="Tags" href="#">apartment</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, aAenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdiet.</p>
                                        <a href="#" title="Read more" class="btn btn-default">Read More</a>
                                    </div>
                                </article>
                                
<!--                                 <article>
                                    <div class="entry-cover">
                                        <iframe src="http://player.vimeo.com/video/8444083" ></iframe> 
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <div class="entry-header">
                                        <h3 class="entry-title"><a href="blog-detail.html" title="Blog Title">Lorem ipsum with image format</a></h3>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a title="Blog Date" href="#"><i class="fa fa-clock-o"></i> Posted On 03 April,2015</a>
                                            </span>
                                            <span class="byline">
                                                <i class="fa fa-user"></i><a title="Author" href="#">Admin</a>
                                            </span>
                                            <span class="tag-link">
                                                <i class="fa fa-tag"></i><a title="Tags" href="#">apartment</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, aAenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdiet.</p>
                                        <a href="#" title="Read more" class="btn btn-default">Read More</a>
                                    </div>
                                </article> -->
                                
                                <article>
                                    <div class="entry-header">
                                        <h3 class="entry-title"><a href="blog-detail.html" title="Blog Title">Article with No Image</a></h3>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a title="Blog Date" href="#"><i class="fa fa-clock-o"></i> Posted On 03 April,2015</a>
                                            </span>
                                            <span class="byline">
                                                <i class="fa fa-user"></i><a title="Author" href="#">Admin</a>
                                            </span>
                                            <span class="tag-link">
                                                <i class="fa fa-tag"></i><a title="Tags" href="#">apartment</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, aAenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdiet.</p>
                                        <a href="#" title="Read more" class="btn btn-default">Read More</a>
                                    </div>
                                </article>
                                
                                <article>
                                    <div class="entry-header">
                                        <h3 class="entry-title"><a href="blog-detail.html" title="Blog Title">QUOTE POST</a></h3>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a title="Blog Date" href="#"><i class="fa fa-clock-o"></i> Posted On 03 April,2015</a>
                                            </span>
                                            <span class="byline">
                                                <i class="fa fa-user"></i><a title="Author" href="#">Admin</a>
                                            </span>
                                            <span class="tag-link">
                                                <i class="fa fa-tag"></i><a title="Tags" href="#">apartment</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry-cover">
                                        <span>
                                            <i>Now, one thing I tell everyone is learn about real estate. Repeat after me real estate provides the highest returns, the greatest values and the least risk.</i>
                                            <span>- Armstrong Williams</span>
                                        </span>
                                        <i class="fa fa-quote-right"></i>
                                    </div>                          
                                </article>
                            </div>
                            <div class="listing-pagination">
                                <ul class="pagination">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </div>
                        </div><!-- col-md-9 /- -->
                        <!-- col-md-3 -->
                        <div class="col-md-3 col-sm-6 widget-area">
                            <?php include(INCLUDE_DIR.'sidebar.php'); ?>

                        </div><!-- col-md-3 /- -->
                </div><!-- container /- -->
            </section>

<?php include('inc/footer.php');