<?php
include('../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
redirect_invalid_admin();

$dashboard = true;
# -- Page Configuration ########################################################################################
$title = "dashboard";
$page_title = "Dashboard";
$breadcrumb = array('Dashboard' => 'admin/dashboard.php');

include(SERVER_DIR.'inc/header.php');
?>
    <section class="inner-page">
      <div class="container">

            <div class="row">
                <div class="col-md-9 col-md-push-3">


                            <h3>Welcome back 
                              <?php if (isset($_SESSION['name'])) echo ' '.$_SESSION['name']; ?>,</h3><br>

                            <?php display_alert(); //Necessary for get_action to work effectively ?>
                            
                            <div class="row">
                              <div id="rootwizard">
                                <div class="navbar">
                                  <div class="navbar-inner">
                                    <div class="container">
                                      <ul>
                                        <li><a href="#tab1" data-toggle="tab">First</a></li>
                                        <li><a href="#tab2" data-toggle="tab">Second</a></li>
                                        <li><a href="#tab3" data-toggle="tab">Third</a></li>
                                        <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                                        <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                                        <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                                        <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div id="bar" class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                </div>
                                <div class="tab-content">
                                  <div class="tab-pane" id="tab1">
                                    1
                                  </div>
                                  <div class="tab-pane" id="tab2">
                                    2
                                  </div>
                                  <div class="tab-pane" id="tab3">
                                    3
                                  </div>
                                  <div class="tab-pane" id="tab4">
                                    4
                                  </div>
                                  <div class="tab-pane" id="tab5">
                                    5
                                  </div>
                                  <div class="tab-pane" id="tab6">
                                    6
                                  </div>
                                  <div class="tab-pane" id="tab7">
                                    7
                                  </div>
                                  <ul class="pager wizard">
                                    <li class="previous first" style="display:none;"><a href="#">First</a></li>
                                    <li class="previous"><a href="#">Previous</a></li>
                                    <li class="next last" style="display:none;"><a href="#">Last</a></li>
                                    <li class="next"><a href="#">Next</a></li>
                                  </ul>
                                </div>
                              </div>





                              <div class="panel panel-default">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title">Wizard with Validation</h3> 
                                    </div> 
                                    <div class="panel-body"> 
                                        <form id="wizard-validation-form" action="#" novalidate="novalidate">
                                            <div role="application" class="wizard clearfix" id="steps-uid-1"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="steps-uid-1-t-0" href="#steps-uid-1-h-0" aria-controls="steps-uid-1-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span> Step 1</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="steps-uid-1-t-1" href="#steps-uid-1-h-1" aria-controls="steps-uid-1-p-1"><span class="number">2.</span> Step 2</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="steps-uid-1-t-2" href="#steps-uid-1-h-2" aria-controls="steps-uid-1-p-2"><span class="number">3.</span> Step 3</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="steps-uid-1-t-3" href="#steps-uid-1-h-3" aria-controls="steps-uid-1-p-3"><span class="number">4.</span> Step Final</a></li></ul></div><div class="content clearfix">
                                                <h3 id="steps-uid-1-h-0" tabindex="-1" class="title current">Step 1</h3>
                                                <section id="steps-uid-1-p-0" role="tabpanel" aria-labelledby="steps-uid-1-h-0" class="body current" aria-hidden="false">
                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="userName2">User name </label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" id="userName2" name="userName" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="password2"> Password *</label>
                                                        <div class="col-lg-10">
                                                            <input id="password2" name="password" type="text" class="required form-control" aria-required="true">

                                                        </div>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="confirm2">Confirm Password *</label>
                                                        <div class="col-lg-10">
                                                            <input id="confirm2" name="confirm" type="text" class="required form-control" aria-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                                    </div>
                                                </section>
                                                <h3 id="steps-uid-1-h-1" tabindex="-1" class="title">Step 2</h3>
                                                <section id="steps-uid-1-p-1" role="tabpanel" aria-labelledby="steps-uid-1-h-1" class="body" aria-hidden="true" style="display: none;">

                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label" for="name2"> First name *</label>
                                                        <div class="col-lg-10">
                                                            <input id="name2" name="name" type="text" class="required form-control" aria-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="surname2"> Last name *</label>
                                                        <div class="col-lg-10">
                                                            <input id="surname2" name="surname" type="text" class="required form-control" aria-required="true">

                                                        </div>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="email2">Email *</label>
                                                        <div class="col-lg-10">
                                                            <input id="email2" name="email" type="text" class="required email form-control" aria-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-2 control-label " for="address2">Address </label>
                                                        <div class="col-lg-10">
                                                            <input id="address2" name="address" type="text" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group clearfix">
                                                        <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                                    </div>

                                                </section>
                                                <h3 id="steps-uid-1-h-2" tabindex="-1" class="title">Step 3</h3>
                                                <section id="steps-uid-1-p-2" role="tabpanel" aria-labelledby="steps-uid-1-h-2" class="body" aria-hidden="true" style="display: none;">
                                                    <div class="form-group clearfix">
                                                        <div class="col-lg-12">
                                                            <ul class="list-unstyled w-list">
                                                                <li>First Name : Jonathan </li>
                                                                <li>Last Name : Smith </li>
                                                                <li>Emial: jonathan@smith.com</li>
                                                                <li>Address: 123 Your City, Cityname. </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </section>
                                                <h3 id="steps-uid-1-h-3" tabindex="-1" class="title">Step Final</h3>
                                                <section id="steps-uid-1-p-3" role="tabpanel" aria-labelledby="steps-uid-1-h-3" class="body" aria-hidden="true" style="display: none;">
                                                    <div class="form-group clearfix">
                                                        <div class="col-lg-12">
                                                            <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required" aria-required="true">
                                                            <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div><div class="actions clearfix"><ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem">Previous</a></li><li aria-hidden="false" aria-disabled="false"><a href="#next" role="menuitem">Next</a></li><li aria-hidden="true" style="display: none;"><a href="#finish" role="menuitem">Finish</a></li></ul></div></div>
                                        </form>
                                    </div>  <!-- End panel-body -->
                                </div>
                                
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

