<?php
include('../config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//Redirect Invalid Admin
// redirect_invalid_admin();

$dashboard = true;
# -- Page Configuration ########################################################################################
$title = "dashboard";
$page_title = "Dashboard";
$breadcrumb = array('Dashboard' => 'admin/dashboard.php');

include(SERVER_DIR.'inc/header.php');
?>
<style>
  ul.thumbnails.image_picker_selector {
  overflow: auto;
  list-style-image: none;
  list-style-position: outside;
  list-style-type: none;
  padding: 0px;
  margin: 0px; }
  ul.thumbnails.image_picker_selector ul {
    overflow: auto;
    list-style-image: none;
    list-style-position: outside;
    list-style-type: none;
    padding: 0px;
    margin: 0px; }
  ul.thumbnails.image_picker_selector li.group {width:100%;} 
  ul.thumbnails.image_picker_selector li.group_title {
    float: none; }
  ul.thumbnails.image_picker_selector li {
    margin: 0px 20px 20px 0px;
    float: left;
  }
    ul.thumbnails.image_picker_selector li .thumbnail {
      padding: 8px;
      border: 1px solid #dddddd;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none; 

      /*additional*/
      overflow:hidden;

    }
      ul.thumbnails.image_picker_selector li .thumbnail:hover{
        background: rgba(60,118,61,0.1);
      }
      ul.thumbnails.image_picker_selector li .thumbnail img {
        -webkit-user-drag: none; 

        /* additional css*/
        border: 1px solid #eaeaea;
        -moz-transition: .6s;
        -webkit-transition: .6s;
        transition: .6s;
        width:100%;
        height:150px;
        position:relative;
      }

      /*ul.thumbnails.image_picker_selector li .thumbnail:hover img{
        -moz-transform: scale(1.1) rotate(.01deg);
        -webkit-transform: scale(1.1) rotate(.01deg);
        transform: scale(1.1) rotate(.01deg);
      }*/
    ul.thumbnails.image_picker_selector li .thumbnail.selected {
        background: rgba(68,108,178,0.5);
    }

    /*additional*/
      ul.thumbnails.image_picker_selector li .thumbnail p {
        margin-top: 15px;
        text-align: center;
      }
      ul.thumbnails.image_picker_selector li .thumbnail p span{
        display: block;
        font-size:10px;
        color:#999;
        margin-top: -5px;
      }
    ul.thumbnails.image_picker_selector li .thumbnail.selected img {
      border-color:transparent; 
    }
      ul.thumbnails.image_picker_selector li .thumbnail.selected p span{
        color:white;
      }

      ul.thumbnails.image_picker_selector li .thumbnail.selected p {
        color:white;
      }

</style>
    <section class="inner-page">
      <div class="container">

            <div class="row">
                <div class="col-md-9 col-md-push-3">

                              <h3>Customize Your Bed Room</h3>
                              <hr>
                              <img src="<?php get_url('assets/img/select/description/bedroom.jpg'); ?>" alt="" class="img-responsive">

                              <br><br>

  

                              <?php display_alert(); //Necessary for get_action to work effectively ?>

                              

                              <label for="colour"><h4>Select Your Preferred Wall Colour Below:</h4></label>
                              <select name="colour" class="imageselect form-control">
                                <option value="1" data-img-src="<?php get_url('assets/img/select/any.jpg'); ?>" data-img-label="Any Colour<span>&nbsp;</span>">Any Colour</option>
                                <option value="2" data-img-src="<?php get_url('assets/img/select/colour/cream.jpg'); ?>" data-img-label="Cream Colour<span>+ ₦50,000</span>">Cream</option>
                                <option value="3" data-img-src="<?php get_url('assets/img/select/colour/blue.jpg'); ?>" data-img-label="Blue Colour<span>+ ₦50,000</span>">Blue</option>
                                <option value="4" data-img-src="<?php get_url('assets/img/select/colour/brown.jpg'); ?>" data-img-label="Brown Colour<span>+ ₦50,000</span>">Brown</option>
                                <option value="5" data-img-src="<?php get_url('assets/img/select/colour/green.jpg'); ?>" data-img-label="Green Colour<span>+ ₦50,000</span>">Green</option>
                                <option value="6" data-img-src="<?php get_url('assets/img/select/colour/red.jpg'); ?>" data-img-label="Red Colour<span>+ ₦50,000</span>">Red</option>
                                <option value="7" data-img-src="<?php get_url('assets/img/select/colour/purple.jpg'); ?>" data-img-label="Purple Colour<span>+ ₦50,000</span>">Purple</option>
                                <option value="8" data-img-src="<?php get_url('assets/img/select/colour/gray.jpg'); ?>" data-img-label="Gray Colour<span>+ ₦50,000</span>">Gray</option>
                                <option value="9" data-img-src="<?php get_url('assets/img/select/colour/white.jpg'); ?>" data-img-label="White Colour<span>&nbsp</span>">White</option>
                              </select>

                              <br>
                              <br>            

                              <label for="colour"><h4>Select Your Preferred Tiles:</h4></label>
                              <select name="colour" class="imageselect form-control">
                                <option value="1" data-img-src="<?php get_url('assets/img/select/any.jpg'); ?>" data-img-label="Any Tiles<span>&nbsp;</span>">Any Tiles</option>
                                <option value="2" data-img-src="<?php get_url('assets/img/select/tiles/1.jpg'); ?>" data-img-label="Chinese Tiles<span>+ ₦500,000</span>">Chinese Tiles</option>
                                <option value="3" data-img-src="<?php get_url('assets/img/select/tiles/2.jpg'); ?>" data-img-label="Fancy Tiles<span>+ ₦1 Million</span>">Fancy Tiles</option>
                                <option value="4" data-img-src="<?php get_url('assets/img/select/tiles/3.jpg'); ?>" data-img-label="Wooden Tiles<span>+ ₦1 Million</span>">Wooden Tiles</option>
                                <option value="5" data-img-src="<?php get_url('assets/img/select/tiles/5.jpg'); ?>" data-img-label="Cream Nuace<span>+ ₦2 Million</span>">Cream Nuace</option>
                                <option value="6" data-img-src="<?php get_url('assets/img/select/tiles/6.jpg'); ?>" data-img-label="Marble Floor<span>+ ₦2 Million</span>">Marble Floor</option>
                              </select>


                                <div class="form-group">
                                  <div class="">
                                      <br><br>
                                      <button type="submit" class="btn btn-primary btn-lg">Save Selection</button>
                                  </div>
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

