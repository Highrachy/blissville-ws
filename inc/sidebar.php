<?php 
// require_once(INCLUDE_DIR.'article.function.php');
// require_once(INCLUDE_DIR.'notification.function.php');
// require_once(INCLUDE_DIR.'event.function.php');
// require_once(INCLUDE_DIR.'training.function.php');
// require_once(INCLUDE_DIR.'archive.function.php');
// require_once(INCLUDE_DIR.'team.function.php');


// return var_dump($side_categories);
//To Do 
// Smart sidebar 
// menu in options database
// Working Search Menu
// Sitemap

if (!isset($sidebar))
  $sidebar = 'general';

//available sidebar
$sidebar_selector = array('general', 'article', 'notification', 'events', 'trainings','team','archive');

if (!in_array($sidebar, $sidebar_selector)){
  $sidebar = 'general';
}

// Arrangement - Start with the searchbar
// General - Recent Article, Recent Notification, Upcoming events, Trainings, Archive
// Article - Popular Article(3), Recent Article, Recent Notification, Upcoming events, Trainings, Archive
// Notification -  Recent Notification (4), Recent Article,  Upcoming events, Trainings, Archive
// Events -  Recent Article, Recent Notification , Trainings, Archive
// Trainings -  Recent Article, Recent Notification ,  Upcoming Event, Archive
// Team - All Team, Recent Article, Recent Notification ,  Upcoming Event, Trainings, Archive
// Archive- Recent Article, Recent Notification ,  Upcoming Event, Trainings



// $side_recent_articles = get_articles(2);
// $side_upcoming_event = get_latest_events(2, false);
// $side_upcoming_traing = get_latest_trainings(2, false);
// $side_archive = get_side_archive();
// $side_team = get_teams();


// if ($sidebar == 'article'){  
//   $side_categories = get_article_category();
//   $side_popular_articles = get_popular_articles(3);
// }

// if ($sidebar == 'notification'){  
//   $side_recent_notifications = get_notifications(4);
// } else {
//   $side_recent_notifications = get_notifications(2);
// }


?>
            
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
                                            <div class="col-md-5 col-sm-3 col-xs-2 p-0">
                                                <a title="Popular Post" href="#"><img src="<?php get_url('assets/uploads/slideshow/slide-1.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                            </div>
                                            <div class="col-md-7 col-sm-9 col-xs-10 featured-content">
                                                <a title="Popular Post" href="#">Heading Title here</a>
                                                <span><i class="fa fa-clock-o"></i> 03 April,2016</span>
                                            </div>
                                        </div>
                                        <div class="property-featured-inner">
                                            <div class="col-md-5 col-sm-3 col-xs-2 p-0">
                                                <a title="Popular Post" href="#"><img src="<?php get_url('assets/uploads/slideshow/slide-2.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                            </div>
                                            <div class="col-md-7 col-sm-9 col-xs-10 featured-content">
                                                <a title="Popular Post" href="#">Heading Title here</a>
                                                <span><i class="fa fa-clock-o"></i> 03 April,2016</span>
                                            </div>
                                        </div>
                                        <div class="property-featured-inner">
                                            <div class="col-md-5 col-sm-3 col-xs-2 p-0">
                                                <a title="Popular Post" href="#"><img src="<?php get_url('assets/uploads/slideshow/slide-3.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                            </div>
                                            <div class="col-md-7 col-sm-9 col-xs-10 featured-content">
                                                <a title="Popular Post" href="#">Heading Title here</a>
                                                <span><i class="fa fa-clock-o"></i> 03 April,2016</span>
                                            </div>
                                        </div>
                                    </aside><!-- Widget Popular Post /- -->
                                    
                                    <!-- Widget Featured Property -->
                                    <aside class="widget widget-property-featured">
                                        <h2 class="widget-title">Featured property </h2>
                                        <div class="property-featured-inner">
                                            <div class="col-md-5 col-sm-3 col-xs-2 p-0">
                                                <a title="Featured Post" href="#"><img src="<?php get_url('assets/uploads/slideshow/slide-1.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                            </div>
                                            <div class="col-md-7 col-sm-9 col-xs-10 featured-content">
                                                <a title="Featured Post" href="#">4 Bedroom Apartments</a>
                                                <h3>&#8358; 35 Million</h3>
                                            </div>
                                        </div>
                                        <div class="property-featured-inner">
                                            <div class="col-md-5 col-sm-3 col-xs-2 p-0">
                                                <a title="Featured Post" href="#"><img src="<?php get_url('assets/uploads/slideshow/slide-2.jpg') ?>" alt="blog" class="img-responsive" /></a>
                                            </div>
                                            <div class="col-md-7 col-sm-9 col-xs-10 featured-content">
                                                <a title="Featured Post" href="#">5 Bedroom Terraces</a>
                                                <h3>&#8358; 45 Million</h3>
                                            </div>
                                        </div>
                                    </aside><!-- Widget Featured Property /- -->
                                    <!-- Widget Property Tags -->
                                    <aside class="widget widget-property-tags">
                                        <h2 class="widget-title">Real estate</span></h2>
                                        <a title="tag" href="#">Blissville</a>
                                        <a title="tag" href="#">Highrachy</a>
                                        <a title="tag" href="#">Quote</a>
                                        <a title="tag" href="#">Cheap</a>
                                        <a title="tag" href="#">Afforadable</a>
                                        <a title="tag" href="#">Nigeria</a>
                                        <a title="tag" href="#">Bedroom</a>
                                        <a title="tag" href="#">Condominiums</a>
                                        <a title="tag" href="#">Terraces</a>
                                    </aside><!-- Widget Property Tags -->