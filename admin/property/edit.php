<?php
include('../../config.php');

//Check for the id
if (isset($_GET['property'])){
  $property_id = $_GET['property'];

  //If the property id is set but it is not defined
  if ($property_id == ""){
    URL::redirect('admin/property');
  }  else {
    //The property id is defined

    //Check if the user clicks on the submit button
    if (Form::is_posted()) {
      // Update the Property
      if (Property::update()) {
        URL::redirect('admin/property/?action=update');
      } else {
        $errors = Property::get_errors();
      }
    }

    # -- Get Property Info
    $property = Property::get_one("WHERE id = '$property_id' ");

    //Check if the total_rows is less than 1
    if (Property::affected_rows() < 1) {
      URL::redirect('admin/property/?action=not-found');
    } else {
      //Get All the information from the database.
      extract($property);
    }
  }
}


# -- Page Configuration ########################################################################################
$dashboard = true;
$editor = true;
$title = "propertys";
$page_title = "Edit Property";

include(SERVER_DIR.'inc/header.php');
?>


    <section class="right-panel">

      <div class="container-fluid">

            <div class="row">
                <!-- content  start -->
                <div id="content">


                    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">

                      <h3 class="page-title"> Edit Property
                      <small><?php echo "$name" ?></small>
                      </h3>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Name <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                                  <?php Form::text('name',$name,array('class' => "form-control", 'placeholder' => "Name of the property Area")) ?>
                                  <?php Form::show_info('name') ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Content</label>
                      <div class="col-sm-7">
                        <?php Form::textarea('content',$content,array("class" => 'editor')) ?>
                        <?php Form::show_info('content','Enter your Property Content here') ?>
                      </div>
                  </div>

                   <div class="form-group">
                      <label class="col-sm-2 control-label">Picture<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="max-width: 100%; height: 150px;">
                            <img src="<?php URL::display('assets/uploads/property/' . $picture); ?>" data-src="<?php URL::display('assets/uploads/property/' . $picture); ?>" alt="Placeholder">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%px; max-height: 140px;"></div>
                          <div>
                            <span class="btn btn-default btn-sm btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="picture"></span>
                            <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                        <?php Form::show_info('picture') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Price </label>
                      <div class="col-sm-7">
                          <?php Form::text('price',$price,array('class' => "form-control", 'placeholder' => "Price of Property (One-Off) E.g 10000000")) ?>
                          <?php Form::show_info('price') ?>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Portfolio <span class="mandatory">*</span></label>
                    <div class="col-sm-7">
                      <?php
                        Form::select('portfolio_id',Portfolio::form_select(),array('class' => "form-control"),$portfolio_Id);
                        Form::show_info('portfolio_id');
                      ?>
                    </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Property Type </label>
                      <div class="col-sm-7">
                          <?php Form::text('property_type',$property_type,array('class' => "form-control", 'placeholder' => "Type of Property")) ?>
                          <?php Form::show_info('property_type') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Floor <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php

                            $floor_value = array();
                            $floor_value[$floor] = $floor;
                            $floor_value['Ground & 1st Floor'] = "Ground & 1st Floor";
                            $floor_value['2nd & 3rd Floor'] = "2nd & 3rd Floor";

                            Form::select('floor',$floor_value,array('class' => "form-control"));
                          ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Location <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::text('location',$location,array('class' => "form-control", 'placeholder' => "Property Location")) ?>
                          <?php Form::show_info('location') ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Size <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::text('size',$size,array('class' => "form-control", 'placeholder' => "E.g 255 Msq")) ?>
                          <?php Form::show_info('size') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Bedroom <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('bedroom',$bedroom,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('bedroom','Max. 10') ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Living Room <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('living_room',$living_room,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('living_room','Max. 10') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kitchen <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('kitchen',$kitchen,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('kitchen','Max. 10') ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Toilet <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('toilet',$toilet,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('toilet','Max. 10') ?>
                      </div>
                  </div>




                  <div class="form-group">
                      <label class="col-sm-2 control-label">Bathroom <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('bathroom',$bathroom,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('bathroom','Max. 10') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Parking Lot <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('parking_lots',$parking_lots,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('parking_lots','Max. 10') ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Cable TV <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $cable_tv_value = array();
                              $cable_tv_value[$cable_tv] = $cable_tv;
                              $cable_tv_value['YES'] = 'YES';
                              $cable_tv_value['NO'] = 'NO';
                              $cable_tv_value['PRE'] = 'PREMIUM';


                              Form::select('cable_tv',$cable_tv_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Core Fibre<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $core_fibre_value = array();
                              $core_fibre_value[$core_fibre] = $core_fibre;
                              $core_fibre_value['YES'] = 'YES';
                              $core_fibre_value['NO'] = 'NO';
                              $core_fibre_value['PRE'] = 'PREMIUM';


                              Form::select('core_fibre',$core_fibre_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Inverter<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $inverter_value = array();
                              $inverter_value[$inverter] = $inverter;
                              $inverter_value['YES'] = 'YES';
                              $inverter_value['NO'] = 'NO';
                              $inverter_value['PRE'] = 'PREMIUM';


                              Form::select('inverter',$inverter_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Security Fence<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $security_fence_value = array();
                              $security_fence_value[$security_fence] = $security_fence;
                              $security_fence_value['YES'] = 'YES';
                              $security_fence_value['NO'] = 'NO';
                              $security_fence_value['PRE'] = 'PREMIUM';


                              Form::select('security_fence',$security_fence_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Car Port<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $car_port_value = array();
                              $car_port_value[$car_port] = $car_port;
                              $car_port_value['YES'] = 'YES';
                              $car_port_value['NO'] = 'NO';
                              $car_port_value['PRE'] = 'PREMIUM';


                              Form::select('car_port',$car_port_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Guest Toilet<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $guest_toilet_value = array();
                              $guest_toilet_value[$guest_toilet] = $guest_toilet;
                              $guest_toilet_value['YES'] = 'YES';
                              $guest_toilet_value['NO'] = 'NO';
                              $guest_toilet_value['PRE'] = 'PREMIUM';


                              Form::select('guest_toilet',$guest_toilet_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Guest Room<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $guest_room_value = array();
                              $guest_room_value[$guest_room] = $guest_room;
                              $guest_room_value['YES'] = 'YES';
                              $guest_room_value['NO'] = 'NO';
                              $guest_room_value['PRE'] = 'PREMIUM';


                              Form::select('guest_room',$guest_room_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Maid Room<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $maid_room_value = array();
                              $maid_room_value[$maid_room] = $maid_room;
                              $maid_room_value['YES'] = 'YES';
                              $maid_room_value['NO'] = 'NO';
                              $maid_room_value['PRE'] = 'PREMIUM';


                              Form::select('maid_room',$maid_room_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Surveillance<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $surveillance_value = array();
                              $surveillance_value[$surveillance] = $surveillance;
                              $surveillance_value['YES'] = 'YES';
                              $surveillance_value['NO'] = 'NO';
                              $surveillance_value['PRE'] = 'PREMIUM';


                              Form::select('surveillance',$surveillance_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Smart Solar<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $smart_solar_value = array();
                              $smart_solar_value[$smart_solar] = $smart_solar;
                              $smart_solar_value['YES'] = 'YES';
                              $smart_solar_value['NO'] = 'NO';
                              $smart_solar_value['PRE'] = 'PREMIUM';


                              Form::select('smart_solar',$smart_solar_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Panic Alarm<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $panic_alarm_value = array();
                              $panic_alarm_value[$panic_alarm] = $panic_alarm;
                              $panic_alarm_value['YES'] = 'YES';
                              $panic_alarm_value['NO'] = 'NO';
                              $panic_alarm_value['PRE'] = 'PREMIUM';


                              Form::select('panic_alarm',$panic_alarm_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Intercom<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $intercom_value = array();
                              $intercom_value[$intercom] = $intercom;
                              $intercom_value['YES'] = 'YES';
                              $intercom_value['NO'] = 'NO';
                              $intercom_value['PRE'] = 'PREMIUM';


                              Form::select('intercom',$intercom_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Video Door<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $video_door_value = array();
                              $video_door_value[$video_door] = $video_door;
                              $video_door_value['YES'] = 'YES';
                              $video_door_value['NO'] = 'NO';
                              $video_door_value['PRE'] = 'PREMIUM';


                              Form::select('video_door',$video_door_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Fire Detection<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $fire_detection_value = array();
                              $fire_detection_value[$fire_detection] = $fire_detection;
                              $fire_detection_value['YES'] = 'YES';
                              $fire_detection_value['NO'] = 'NO';
                              $fire_detection_value['PRE'] = 'PREMIUM';


                              Form::select('fire_detection',$fire_detection_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Water Treatment System<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $swimming_pool_value = array();
                              $swimming_pool_value[$swimming_pool] = $swimming_pool;
                              $swimming_pool_value['YES'] = 'YES';
                              $swimming_pool_value['NO'] = 'NO';
                              $swimming_pool_value['PRE'] = 'PREMIUM';


                              Form::select('swimming_pool',$swimming_pool_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Rooftop Gym<span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                            <?php
                              $rooftop_gym_value = array();
                              $rooftop_gym_value[$rooftop_gym] = $rooftop_gym;
                              $rooftop_gym_value['YES'] = 'YES';
                              $rooftop_gym_value['NO'] = 'NO';
                              $rooftop_gym_value['PRE'] = 'PREMIUM';


                              Form::select('rooftop_gym',$rooftop_gym_value,array('class' => "form-control")) ;
                            ?>
                      </div>
                  </div>



                  <div class="form-group">
                      <label class="col-sm-2 control-label">Priority <span class="mandatory">*</span></label>
                      <div class="col-sm-7">
                          <?php Form::number('priority',$priority,array('class'=>"form-control", 'min'=>'1','max'=>'10')); ?>
                          <?php Form::show_info('priority','Higher Priority will be displayed first (Max. 10)') ?>
                      </div>
                  </div>




                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <?php Alert::display_error(); ?>
                            <?php Form::hidden('property_id',$property_id) ?>
                            <?php Form::hidden('old_picture',$picture) ?>
                            <?php Form::submit('submit','Update Property',array('class'=>"btn btn-primary")) ?>
                            <a href="<?php URL::display("property") ?>" class="btn btn-default">Cancel</a>
                          </div>
                        </div>
                    </form>

                </div>
                <!-- content  end -->
            </div>


      </div>

    </section>

<?php
  include(SERVER_DIR.'inc/footer.php');
?>
