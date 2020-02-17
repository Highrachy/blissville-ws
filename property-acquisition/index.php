<?php
include('../config.php');

# -- Page Configuration
$title = "forms";
$page_title = "Property Acquisition";
$page_desc = "Individual Appliacation Form";
$register_footer = false;
$validator = true;

# -- Form Submission
 $data = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    $data['title'] = Form::assign('title', 'req');
    $data['first_name'] = Form::assign('first_name', 'req', 'First Name');
    $data['surname'] = Form::assign('surname', 'req');
    if (Form::exist('other_names')) {
        $data['other_names'] = Form::assign('other_names', 'req', 'Other Names');
    }
    $data['email'] = Form::assign('email');
    $data['phone'] = Form::assign('phone', 'req', 'Phone');
    $data['occupation'] = Form::assign('occupation', 'req');
    $data['address'] = Form::assign('address', 'req');

    $data['next_of_kin'] = Form::assign('next_of_kin', 'req', 'Next of Kin');
    $data['next_of_kin_email'] = Form::assign('next_of_kin_email', 'req', 'Next of Kin Email');
    $data['next_of_kin_phone'] = Form::assign('next_of_kin_phone', 'req', 'Next of Kin Phone');

    $data['resident_type'] = Form::assign('resident_type', 'req', 'Resident Type');
    $data['intended_use'] = Form::assign('intended_use', 'req', 'Intended Use');
    if (Form::exist('previous_transaction')) {
        $data['previous_transaction'] = Form::assign('previous_transaction', 'req', 'Previous Transaction');
    }
    $data['name_on_document'] = Form::assign('name_on_document', 'req', 'Name on Document');

    if (Form::exist('available_payment')) {
        $data['available_payment'] = Form::assign('available_payment', 'req', 'Available Payment');
    }

    if (Form::exist('name_of_banker')) {
        $data['name_of_banker'] = Form::assign('name_of_banker', 'req', 'Name of Banker');
    }


    # -- Get Form Errors
    $errors = array_merge(Form::get_errors(), $errors);

    if (empty($errors)) {
        extract($data);

        $page_name = "Property Acquisition Page";
        $ourEmail = "nnamdi@highrachy.com"; //TODO: change to nnamdi email
        $ourName = "Highrachy Investment and Technology";


        //Compulsory Variables
        //1. $name   2. $email  3.subject   4. $message
        // $message is set to empty in this file

        $details = "";

        $details .= "<strong>Title :</strong> ".$title. "<br>";
        $details .= "<strong>First Name :</strong> ".$first_name. "<br>";
        $details .= "<strong>Surname :</strong> ".$surname. "<br>";
        if (isset($other_names)) {
            $details .= "<strong>Other Names :</strong> ".$other_names. "<br>";
        }

        $details .= "<strong>Email  :</strong> ".$email. "<br>";
        $details .= "<strong>Phone  :</strong> ".$phone . "<br>";
        $details .= "<strong>Occupation  :</strong> ".$occupation. "<br>";
        $details .= "<strong>Address  :</strong> ".$address . "<br>";

        $details .= "<strong>Next of Kin  :</strong> ".$next_of_kin . "<br>";
        $details .= "<strong>Next of Kin (Email)  :</strong> ".$next_of_kin_email. "<br>";
        $details .= "<strong>Next of Kin (Phone)  :</strong> ".$next_of_kin_phone . "<br>";

        $details .= "<strong>Resident Type  :</strong> ".$resident_type. "<br>";
        $details .= "<strong>Intended Use  :</strong> ".$intended_use. "<br>";
        if (isset($previous_transaction)) {
            $details .= "<strong>Previous Highrachy Transaction :</strong> ".$previous_transaction. "<br>";
        }
        if (isset($available_payment)) {
            $details .= "<strong>Available Payment :</strong> ".$available_payment. "<br>";
        }
        if (isset($name_of_banker)) {
            $details .= "<strong>Name of Banker :</strong> ".$name_of_banker. "<br>";
        }
        $subject = "Property Acquisition ($title $first_name $surname)";
        $message="";
        //End of Compulsory

        //Second email address to send to
        $second_email = "blissville@highrachy.com";

        if (Email::send_mail($email, $subject, $message, $details, $second_email)) {
            $success = "Your form has been successfully submitted. We will get back to you within 24 hours";
            $_POST = array();
            Form::clear_values();
        }
    }
}

include(INCLUDE_DIR.'header.php');
?>
<style>
  select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }
</style>

<section class="page-content">
  <div class="container">
    <div class="row mt-80">
      <div class="col-xs-12">
        <div class="col-md-12">
          <div class="col-md-offset-1 col-md-10">
            <?php Alert::display(); //Necessary for get_action to work effectively?>
          </div>
        </div>
      </div>
      <form role="form" method="post" action="#" data-toggle="validator" class="col-md-offset-1 col-md-10">
        <section>
          <div class="normal-header col-xs-12">
            <h3 class="col-xs-12">Client Details</h3>
          </div>

          <!-- Title and FirstName -->
          <div class="col-xs-12">

            <div class="form-group col-md-6">
              <label class="control-label">Title <span class="mandatory">*</span></label>
              <div>
                <?php
                  $title_list['Mr'] = 'Mr';
                  $title_list['Mrs'] = 'Mrs';
                  $title_list['Ms'] = 'Ms';
                  $title_list['Miss'] = 'Miss';
                  $title_list['Chief'] = 'Chief';
                  $title_list['Alhaji'] = 'Alhaji';
                  $title_list['Alhaja'] = 'Alhaja';
                  $title_list['Others'] = 'Others';
                ?>
                <?php Form::select('title', $title_list, array("class" => "form-control", "required" =>"true"), false, 'Select a Title') ?>
                <?php Form::show_info('title') ?>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">First Name <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('first_name', '', array("class" => "form-control", "placeholder" =>"Your First Name", "required" =>"true")) ?>
                <?php Form::show_info('first_name') ?>
              </div>
            </div>
          </div>

          <!-- Surname and Other Names -->
          <div class="col-xs-12">

            <div class="form-group col-md-6">
              <label class="control-label">Surname <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('surname', '', array("class" => "form-control", "placeholder" =>"Your Surname", "required" =>"true")) ?>
                <?php Form::show_info('surname') ?>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Other Names</label>
              <div>
                <?php Form::text('other_names', '', array("class" => "form-control", "placeholder" =>"Other Names")) ?>
                <?php Form::show_info('other_names') ?>
              </div>
            </div>

          </div>

          <!-- Email and Phone -->
          <div class="col-xs-12">

            <div class="form-group col-md-6">
              <label class="control-label">Email <span class="mandatory">*</span></label>
              <div>
                <?php Form::email('email', '', array("class" => "form-control", "placeholder" =>"Your Email Address", "required" =>"true")) ?>
                <?php Form::show_info('email') ?>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Phone Number <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('phone', '', array("class" => "form-control", "placeholder" =>"Your phone number", "required" =>"true")) ?>
                <?php Form::show_info('phone') ?>
              </div>
            </div>
          </div>

          <!-- Occupation -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Occupation / Nature of Business<span class="mandatory">*</span></label>
              <div>
                <?php Form::text('occupation', '', array('class' => 'form-control' , 'placeholder' => 'Occupation / Nature of Business', "required" =>"true")) ?>
                <?php Form::show_info('occupation') ?>
              </div>
            </div>
          </div>

          <!-- Address -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Address<span class="mandatory">*</span></label>
              <div>
                <?php Form::textarea('address', '', array('class' => 'form-control' , 'placeholder' => 'Your Address', "required" =>"true")) ?>
                <?php Form::show_info('address') ?>
              </div>
            </div>
          </div>

          <!-- Next of Kin -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Next of Kin<span class="mandatory">*</></label>
              <div>
                <?php Form::text('next_of_kin', '', array('class' => 'form-control' , 'placeholder' => 'Next of Kin', "required" =>"true")) ?>
                <?php Form::show_info('next_of_kin') ?>
              </div>
            </div>
          </div>

          <!-- Next of Kin Phone Number and Email -->
          <div class="col-xs-12">
            <div class="form-group  col-md-6">
              <label class="control-label">Phone Number (Next of Kin)<span class="mandatory">*</span></label>
              <div>
                <?php Form::text('next_of_kin_phone', '', array('class' => 'form-control' , 'placeholder' => 'Phone Number (Next of Kin)', "required" =>"true")) ?>
                <?php Form::show_info('next_of_kin_phone') ?>
              </div>
            </div>
            <div class="form-group  col-md-6">
              <label class="control-label">Email (Next of Kin)<span class="mandatory">*</span></label>
              <div>
                <?php Form::text('next_of_kin_email', '', array('class' => 'form-control' , 'placeholder' => 'Email (Next of Kin)', "required" =>"true")) ?>
                <?php Form::show_info('next_of_kin_email') ?>
              </div>
        </section>

        <section>
          <div class="normal-header col-xs-12 mt-50">
            <h3 class="col-xs-12">Interest and Relationship</h3>
          </div>

          <!-- Resident Type -->
          <div class="col-xs-12">
            <div class="form-group col-md-6">
              <label class="control-label">Resident Type <span class="mandatory">*</span></label>
              <div>
                <?php $resident_type_list['3 bedroom Apartment - Flat'] = '3 bedroom Apartment - Flat'; ?>
                <?php Form::select('resident_type', $resident_type_list, array("class" => "form-control", "required" =>"true"), false, 'Select a Resident Type') ?>
                <?php Form::show_info('resident_type') ?>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Intended use of property <span class="mandatory">*</span></label>
              <div>
                <?php $intended_use_list['Owner occupation'] = 'Owner occupation'; ?>
                <?php $intended_use_list['Sublease'] = 'Sublease'; ?>
                <?php Form::select('intended_use', $intended_use_list, array("class" => "form-control", "required" =>"true"), false, 'Select the intended use of property') ?>
                <?php Form::show_info('intended_use') ?>
              </div>
            </div>
          </div>

          <!-- Previous Highrachy Transaction -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Previous Highrachy Transaction</label>
              <div>
                <?php Form::text('previous_transaction', '', array('class' => 'form-control' , 'placeholder' => 'Any other Office, House or Flat bought or rented from Highrachy')) ?>
                <?php Form::show_info('previous_transaction') ?>
              </div>
            </div>
          </div>

          <!-- Name to be written on Title Document -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Name to be written on Title Document<span class="mandatory">*</span></label>
              <div>
                <?php Form::text('name_on_document', '', array('class' => 'form-control' , 'placeholder' => 'Name to be written on Title Document', "required" =>"true")) ?>
                <?php Form::show_info('name_on_document') ?>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="normal-header col-xs-12 mt-50">
            <h3 class="col-xs-12">Transaction Details</h3>
          </div>

          <!-- Payment Plan -->
          <div class="col-xs-12">
            <div class="form-group col-md-6">
              <label class="control-label">Payment Plan <span class="mandatory">*</span></label>
              <div>
                <?php $payment_plan_list['One Off'] = 'One Off'; ?>
                <?php $payment_plan_list['6 Months'] = '6 Months'; ?>
                <?php $payment_plan_list['Customized'] = 'Customized'; ?>
                <?php Form::select('payment_plan', $payment_plan_list, array("class" => "form-control", "required" =>"true"), false, 'Select your Preferred Payment Plan') ?>
                <?php Form::show_info('payment_plan') ?>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Amount immediately available for payment</label>
              <div>
                <?php Form::text('available_payment', '', array('class' => 'form-control' , 'placeholder' => 'Amount')) ?>
                <?php Form::show_info('available_payment') ?>
              </div>
            </div>
          </div>

          <!-- Name to be written on Title Document -->
          <div class="col-xs-12">
            <div class="form-group col-md-12">
              <label class="control-label">Name of Banker</label>
              <div>
                <?php Form::text('name_of_banker', '', array('class' => 'form-control' , 'placeholder' => 'Name of Banker')) ?>
                <?php Form::show_info('name_of_banker') ?>
              </div>
            </div>
          </div>
        </section>

        <div class="col-xs-12 mb-50">
          <div class="col-md-12">
            <button type="submit" class="btn btn-lg btn-primary">Submit Form</button>
          </div>
          <br />
          <br />
          <br />
        </div>

        <!-- /.Form -->
      </form>
    </div>
  </div>
</section>

<?php include(INCLUDE_DIR.'footer.php');
