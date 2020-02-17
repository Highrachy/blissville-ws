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
$title = "investors";
$page_title = "Investors";
$page_desc = "Invest today and watch your money grow...";

$breadcrumb = array('Investors'=> '#');

include('inc/header.php');
?>


            <section class="page-content">

                <!-- container -->
                <div class="container">
                        <!-- col-md-9 -->
                        <div class="col-md-9 col-sm-6 pl-0 content-area">
                            <div class="blog-listing single-post col-md-12">
                            <article>
                                <div class="entry-cover">
                                    <img src="images/blog/blog-1.jpg" class="img-responsive" alt="blog">
                                    <i class="fa fa-image"></i>
                                </div>
                                <div class="entry-header">
                                    <h3 class="entry-title">Lorem ipsum with image format</h3>
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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at erat justo. Donec mi ex, tempus non neque it vitae, porttitor blandit lorem. Sed fringilla pellentesque quam, eget vehicula nulla varius eget. Suspendisse dolor  potenti. Quisque nulla odio, sollicitudin nec mattis in, bibendum eu elit. Interdum et malesuada fames acn ipsum primis in faucibus.</p>
                                    <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdiet. Phasellus non euismod ligula. Sed aliquam, quam a venenatis scelerisque, felis augue tristique urna, quis finibus velit metus et ligula. Suspendisse non diam felis. Praesent euismod aliquet purus, non sollicitudin enim mollis eu. </p>
                                    <blockquote>
                                        <p>Aenean mollis elementum metus, in vehicula orci. Suspendisse lacus orci, euismod finibus fringilla at, auctor eget purus. Curabitur interdum pretium imperdienon sollicitudin enim mollis eu.</p>
                                    </blockquote>
                                    <p>Phasellus non euismod ligula. Sed aliquam, quam a venenatis scelerisque, felis augue tristique urna, quis finibus velit metus et ligula. Suspendisse non diam felisur interdum pretium imperdiet. Phasellus non  it opn euismod ligula. Sed aliquam, quam a venenatis scelerisque, felis augue tristique urna, quis finibus velit metus et ligulauspendisse non diam felis.</p>
                                </div>
                            </article>
                            <!-- Related Post -->
                            <div class="related-post p-0 row">
                                <h3>Related Post</h3>
                                <div class="col-md-4 col-sm-12">
                                    <a title="Related post" href="#"><img src="images/blog/releted-post-1.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/releted-post-1.jpg" alt="releted-post-1"></a>
                                    <a title="Related post" href="#">Suspendisse non diamur imperdiet.</a>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <a title="Related post" href="#"><img src="images/blog/releted-post-2.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/releted-post-2.jpg" alt="releted-post-1"></a>
                                    <a title="Related post" href="#">Lorem ipsun dolor sit amet felis</a>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <a title="Related post" href="#"><img src="images/blog/releted-post-3.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/releted-post-3.jpg" alt="releted-post-1"></a>
                                    <a title="Related post" href="#">Phaselus one it opn met diam felis</a>
                                </div>
                            </div><!-- Related Post /- -->
                            <!-- Post Navigation -->
                            <div class="post-navigation">
                                <a title="Nexr Post" href="#" class="pull-left prev-post">
                                    <i class="fa fa-long-arrow-left"></i> Previous Post
                                    <b>Heading Title of Post</b>
                                </a>
                                <a title="Next Post" href="#" class="pull-right next-post">
                                    Next Post<i class="fa fa-long-arrow-right"></i>
                                    <b>Heading Title of Post</b>
                                </a>
                            </div><!-- Post Navigation /- -->
                            <!-- Entry Author -->
                            <div class="entry-author">
                                <img alt="author" src="images/blog/author.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/author.jpg">
                                <h6>Robert Louise <span>Author</span></h6>
                                <p>Suspendisse non diam felisur interdum pretium imperdiet. Phasellus non  it opn euismod ligula. Sed aliquamisur interdum pretium imperdiet. Phasellus non  it opn euismod ligula. Sed aliquam, quam a venenatis scelerisquelerisque, felis augue tristique urna,</p>
                            </div><!-- Entry Author /- -->
                            <!-- Comment Area -->
                            <div class="comments-area">
                                <h3>Comments</h3>
                                
                                <!-- Post -->
                                <ul class="commentlist"> 
                                    <li>
                                        <div class="comment">
                                            <span class="comment-image">
                                                <img src="images/blog/disha-seth.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/disha-seth.jpg" alt="disha-seth">
                                            </span>
                                            <h4 class="comment-info">
                                                Disha Seth <span>Monday, 5 April 2015</span>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet, consecteturSed aliquamisur interdum pretium imperdietsellus non  it opn euismod ligulas varius elit viverra mauris laoreet eu ornare felis molestie. </p>
                                            <a title="Replay" href="#">Reply</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <span class="comment-image">
                                                <img src="images/blog/meera-nod.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/meera-nod.jpg" alt="meera-nod">
                                            </span>
                                            <h4 class="comment-info">
                                                Meera Nod <span>2 min ago, 10 April 2015 </span>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet, consecteturSed aliquamisur interdum pretium imperdietsellus non  it opn euismod ligulas varius elit viverra mauris laoreet eu ornare felis molestie. </p>
                                            <a title="Replay" href="#">Reply</a>
                                        </div>
                                        <ul class="children">
                                            <li>
                                                <div class="comment">
                                                    <span class="comment-image">
                                                        <img src="images/blog/pranva-thakur.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/pranva-thakur.jpg" alt="pranva-thakur">
                                                    </span>
                                                    <h4 class="comment-info">
                                                        Pranav Thakur <span>Monday, 5 April 2015</span>
                                                    </h4>
                                                    <p>Lorem ipsum dolor sit amet, consecteturSed aliquamisur interdum pretium lorem ipsum imperdietsellus non euismod ligulas varius elit viverrafelis molestie.</p>
                                                    <a title="Replay" href="#">Reply</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <span class="comment-image">
                                                <img src="images/blog/nimesh-roy.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/blog/nimesh-roy.jpg" alt="nimesh-roy">
                                            </span>
                                            <h4 class="comment-info">
                                                Nimesh Roy <span>Monday, 5 April 2015</span>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet, pro sanctus ullamcorper ei, sonet commodo ad sed. Ne exerci dolorum sit. Meaevertitur signiferumque et. Doctus probatus intellegat nec ne. Vim an bonorum efficiantur, in assum primis euismod duo, tritanilabitur has ei.</p>
                                        </div>
                                    </li>
                                </ul>
                                <!-- Post /- -->
                                
                                <div class="comment-respond" id="respond">
                                    <h3>Leave a Comment</h3>
                                    <form class="comment-form" id="commentform" method="post" action="#">
                                        <div class="col-md-7">
                                            <label>First Name</label>
                                            <input type="text" name="author" class="comments-line">
                                        </div>
                                        <div class="col-md-7">
                                            <label>E-Mail</label>
                                            <input type="text" name="email" class="comments-line">
                                        </div>
                                        <div class="col-md-7">
                                            <label>Subject</label>
                                            <input type="text" name="url" class="comments-line">
                                        </div>
                                        <div class="col-md-11">
                                            <label>Message</label>                              
                                            <textarea name="comment" class="comments-area"></textarea><grammarly-btn><div style="visibility: hidden; z-index: 2;" class="_9b5ef6-textarea_btn _9b5ef6-offline _9b5ef6-anonymous _9b5ef6-not_focused" data-grammarly-reactid=".0"><div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0"><div title="Protected by Grammarly" class="_9b5ef6-status" data-grammarly-reactid=".0.0.0">&nbsp;</div></div></div></grammarly-btn>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" value="Submit Comment" id="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Comment Area /- -->
                            </div>
                            <!-- blog listing /- -->
                        </div><!-- col-md-9 /- -->
                        <!-- col-md-3 -->
                        <div class="col-md-3 col-sm-6 widget-area">
                            <!-- Widget Search -->
                            <aside class="widget widget-search">
                                <h3 class="widget-title">search property</h3>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </aside><!-- Widget Search /- -->
                            <!-- Widget Category -->
                            <aside class="widget widget-category">
                                <h2 class="widget-title">Property Catagories</h2>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-angle-right"></i> <a title="comfort" href="#">Comfort</a></li>
                                    <li><i class="fa fa-angle-right"></i> <a title="Luxury" href="#">Luxury</a></li>
                                    <li><i class="fa fa-angle-right"></i> <a title="Market Updates" href="#">Market Updates</a></li>
                                    <li><i class="fa fa-angle-right"></i> <a title="Sales" href="#">Sales</a></li>
                                </ul>
                            </aside><!-- Widget Category /- -->
                            <!-- Widget Popular Post -->
                            <aside class="widget widget-property-featured">
                                <h2 class="widget-title">Popular Post</h2>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Popular Post" href="#"><img src="images/aa-listing/feacture1.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture1.jpg" alt="feacture1"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Popular Post" href="#">Heading Title here</a>
                                        <span><i class="fa fa-clock-o"></i> 03 April,2015</span>
                                    </div>
                                </div>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Popular Post" href="#"><img src="images/aa-listing/feacture2.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture2.jpg" alt="feacture2"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Popular Post" href="#">Heading Title here</a>
                                        <span><i class="fa fa-clock-o"></i> 03 April,2015</span>
                                    </div>
                                </div>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Popular Post" href="#"><img src="images/aa-listing/feacture3.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture3.jpg" alt="feacture3"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Popular Post" href="#">Heading Title here</a>
                                        <span><i class="fa fa-clock-o"></i> 03 April,2015</span>
                                    </div>
                                </div>
                            </aside><!-- Widget Popular Post /- -->
                            
                            <!-- Widget Featured Property -->
                            <aside class="widget widget-property-featured">
                                <h2 class="widget-title">featured property </h2>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Featured Post" href="#"><img src="images/aa-listing/feacture1.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture1.jpg" alt="feacture1"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Featured Post" href="#">Southwest 39th Terrace</a>
                                        <h3>&dollar;350000</h3>
                                    </div>
                                </div>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Featured Post" href="#"><img src="images/aa-listing/feacture2.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture2.jpg" alt="feacture2"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Featured Post" href="#">Southwest 39th Terrace</a>
                                        <h3>&dollar;350000</h3>
                                    </div>
                                </div>
                                <div class="property-featured-inner">
                                    <div class="col-md-4 col-sm-3 col-xs-2 p-0">
                                        <a title="Featured Post" href="#"><img src="images/aa-listing/feacture3.jpg" tppabs="http://wpmines.com/demos/propertyexpert/images/aa-listing/feacture3.jpg" alt="feacture3"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
                                        <a title="Featured Post" href="#">Southwest 39th Terrace</a>
                                        <h3>&dollar;350000</h3>
                                    </div>
                                </div>
                            </aside><!-- Widget Featured Property /- -->
                            <!-- Widget Property Tags -->
                            <aside class="widget widget-property-tags">
                                <h2 class="widget-title">Tags</span></h2>
                                <a title="tag" href="#">lorem</a>
                                <a title="tag" href="#">ipsum</a>
                                <a title="tag" href="#">dolor siton</a>
                                <a title="tag" href="#">Dolor</a>
                                <a title="tag" href="#">Amet</a>
                                <a title="tag" href="#">Fusicon</a>
                                <a title="tag" href="#">Corn</a>
                                <a title="tag" href="#">Eget purus</a>
                                <a title="tag" href="#">orciem</a>
                            </aside><!-- Widget Property Tags -->
                        </div><!-- col-md-3 /- -->
                </div><!-- container /- -->
            </section>

<?php include('inc/footer.php');