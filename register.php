<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
// $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

# -- Page Configuration ########################################################################################
$title = "home";
$page_title = "Registration Page";
$page_desc = "Welcome to Blissville Condominiums";
$breadcrumb = array();

include('inc/header.php');

?>

<!-- start main content -->
<section class="properties">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-lg-offset-4">
                <h3>REGISTER</h3>
                <div class="divider"></div>
                <p style="font-size:13px;">Already have an account? <a href="login.php">Login here!</a></p>
                <!-- start login form -->
                <div class="filterContent sidebarWidget">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="formBlock">
                                <label for="email">Name</label><br/>
                                <input type="text" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="formBlock">
                                <label for="email">Email</label><br/>
                                <input type="text" name="email" id="email" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="formBlock">
                                <label for="pass">Password</label><br/>
                                <input type="password" name="pass" id="pass" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="formBlock">
                                <label for="confirmPass">Confirm Password</label><br/>
                                <input type="password" name="confirmPass" id="confirmPass" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <div class="formBlock">
                                    <input class="buttonColor" type="submit" value="REGISTER" style="margin-top:24px;">
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