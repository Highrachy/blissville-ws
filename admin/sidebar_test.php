<?php
include('../config.php'); 

# -- Page Configuration ########################################################################################
$title = "Sidebar Page";
$page_title = "Login";


$subheader = false;
$register_footer = false;
$dashboard = true;

include(SERVER_DIR.'inc/header.php');
?>

    <aside class="left-panel">
            
            <div class="user text-center">
                  <img src="<?php URL::display('assets/img/profile/user1.jpg') ?>" class="img-circle img-responsive img-thumbnail" alt="User Image"><br>
                  <strong class="user-name">BLISSVILLE</strong>
  
            </div>
            
            
            
            <nav class="navigation">
                <ul class="list-unstyled">
                    <li><a href="<?php URL::display('dashboard.php') ?>"><i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span></a></li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-user"></i> <span class="nav-label">Contacts</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('contacts') ?>"><i class="fa fa-angle-right"></i> All Contacts</a></li>
                            <li><a href="<?php URL::display('contacts/new.php') ?>"><i class="fa fa-angle-right"></i> New Contact</a></li>
                            <li><a href="<?php URL::display('contacts/bulk-email.php') ?>"><i class="fa fa-angle-right"></i> Add Bulk Email</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Campaigns</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('campaigns') ?>"><i class="fa fa-angle-right"></i> All Campaigns</a></li>
                            <li><a href="<?php URL::display('campaigns/new.php') ?>"><i class="fa fa-angle-right"></i> New Campaign</a></li>
                            <li><a href="<?php URL::display('campaigns/status.php') ?>"><i class="fa fa-angle-right"></i> Campaign Status</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-users"></i> <span class="nav-label">Groups</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('groups') ?>"><i class="fa fa-angle-right"></i> All Groups</a></li>
                            <li><a href="<?php URL::display('groups/new.php') ?>"><i class="fa fa-angle-right"></i> New Group</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Templates</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('templates') ?>"><i class="fa fa-angle-right"></i> All Templates</a></li>
                            <li><a href="<?php URL::display('templates/new.php') ?>"><i class="fa fa-angle-right"></i> New Template</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-file-image-o"></i> <span class="nav-label">Library</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('library') ?>"><i class="fa fa-angle-right"></i> All Images</a></li>
                            <li><a href="<?php URL::display('library/upload-image.php') ?>"><i class="fa fa-angle-right"></i> Upload Image</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Tools</span></a>
                        <ul class="list-unstyled">
                         <li><a href="<?php URL::display('contacts/email-extractor.php') ?>"><i class="fa fa-angle-right"></i> Email Extractor</a></li>
                         <!-- <li><a href="<?php URL::display('builder') ?>"><i class="fa fa-angle-right"></i>Template Builder</a></li> -->
                        </ul>
                    </li>
                    <li><a href="<?php URL::display('users/logout.php') ?>"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>
                   
                </ul>
            </nav>
            
    </aside>
    
    <section class="right-panel">
      
      <div class="container-fluid">

            <div class="row">
                <div class="">


                            <h3>Welcome back 
                              <?php if (isset($_SESSION['name'])) echo ' '.$_SESSION['name']; ?>,</h3><br>

                            <?php Alert::display(); //Necessary for get_action to work effectively ?>
                            <div class="row">

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/edit-content') ?>">
                                      <i class="fa fa-edit"></i>
                                      Edit Contents
                                    </a>
                                  </div>
                                  

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/portfolio/new.php') ?>">
                                      <i class="fa fa-legal"></i>
                                      Add Portfolio
                                    </a>
                                  </div>
                                 

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/article/new.php') ?>">
                                      <i class="fa fa-file-text-o"></i>
                                      Add Article
                                    </a>
                                  </div>
                                   

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/event/new.php') ?>">
                                      <i class="fa fa-bullhorn"></i>
                                      Add FAQs
                                    </a>
                                  </div>
                                  


                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/slideshow/new.php') ?>">
                                      <i class="fa fa-image"></i>
                                      Add Slideshow
                                    </a>
                                  </div>
                                  

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/testimonial/new.php') ?>">
                                      <i class="fa fa-comments"></i>
                                      Add Testimonial
                                    </a>
                                  </div>
                                  

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/team/new.php') ?>">
                                      <i class="fa fa-group"></i>
                                      Contact Details
                                    </a>
                                  </div>
                                  

                                  <div class="col-xs-6 col-sm-3 dashboard-menu">
                                    <a href="<?php URL::display('admin/user/logout.php') ?>">
                                      <i class="fa fa-sign-out"></i>
                                      Logout
                                    </a>
                                  </div>

                            </div>

               
                </div>
            </div>


      </div>

    </section>


<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>


<script src="<?php URL::display('assets/js/nicescroll/jquery.nicescroll.min.js') ?>"></script>

<script>
  


  
$(function(){


  /*$('.dropdown-menu').click(function(event){
    event.stopPropagation();
  });*/




  /********************************
  Toggle Aside Menu
  ********************************/

  $(document).on('click', '.navbar-toggle', function(){

    $('aside.left-panel').toggleClass('collapsed');

  });





  /********************************
  Aside Navigation Menu
  ********************************/

  $("aside.left-panel nav.navigation > ul > li:has(ul) > a").click(function(){

    if( $("aside.left-panel").hasClass('collapsed') == false || $(window).width() < 768 ){



    $("aside.left-panel nav.navigation > ul > li > ul").slideUp(300);
    $("aside.left-panel nav.navigation > ul > li").removeClass('active');

    if(!$(this).next().is(":visible"))
    {

      $(this).next().slideToggle(300,function(){ $("aside.left-panel:not(.collapsed)").getNiceScroll().resize(); });
      $(this).closest('li').addClass('active');
    }

    return false;

    }

  });



  /********************************
  NanoScroll - fancy scroll bar
  ********************************/
  if( $.isFunction($.fn.niceScroll) ){
    $(".nicescroll").niceScroll({

      cursorcolor: '#9d9ea5',
      cursorborderradius : '0px'

    });

  }



  if( $.isFunction($.fn.niceScroll) ){
   $(".niceScroll").niceScroll({

     cursorcolor: '#9d9ea5',
     cursorborderradius : '0px'
   });
  }
  if( $.isFunction($.fn.niceScroll) ){
  $("aside.left-panel:not(.collapsed)").niceScroll({
    cursorcolor: '#8e909a',
    cursorborder: '0px solid #fff',
    cursoropacitymax: '0.5',
    cursorborderradius : '0px'
  });
  }


  /********************************
  Scroll To Top
  ********************************/
  $('.scrollToTop').click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });




});

</script>