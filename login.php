<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
// $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 

# -- Page Configuration ########################################################################################
$title = "home";
$page_title = "Login Page";
$page_desc = "Welcome to Blissville Condominiums";
$breadcrumb = array();

include('inc/header.php'); 
?>

<!-- start main content -->
<section class="properties">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-lg-offset-4">
                <h3>LOGIN</h3>
                <div class="divider"></div>
                <p style="font-size:13px;">Don't have an account yet? <a href="register.php">Register here!</a></p>
                <!-- start login form -->
                <div class="filterContent sidebarWidget">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="login">Login</label>
                                    <div>
                                        <?php Text('name','','class="form-control" placeholder="Enter your name here"') ?>
                                        <?php show_errors('name') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="form-group">
                                <label class="control-label" for="pass">Password</label> 
                                    <div>
                                        <?php Password('password','','class="form-control"') ?>
                                        <?php show_errors('password') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="LOGIN">
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div><!-- end row -->
                    </form><!-- end form -->
                </div><!-- end login form -->
            </div><!-- end col -->
            
        </div>
    </div><!-- end container -->
</section>
<!-- end main content -->
<?php include('inc/footer.php');