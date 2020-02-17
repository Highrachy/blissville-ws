<?php
/**
 * Form Class
 *
 * @author Haruna Popoola
 *
 * Form::open($action, $method="get", $attributes=false, $upload_file = false)
 * Form::close()
 * Form::text($name, $value="",$attributes=false)
 * Form::email($name, $value="",$attributes=false)
 * Form::password($name, $value="",$attributes=false)
 * Form::file($name, $attributes=false)
 * Form::hidden($name, $value)
 * Form::text($search, $value="",$attributes=false)
 * Form::tel($name, $value="",$attributes=false)
 * Form::url($name, $value="",$attributes=false)
 * Form::range($name, $value="",$attributes=false)
 * Form::number($name, $value="",$attributes=false)
 * Form::time($name, $value="",$attributes=false)
 * Form::date($name, $value="",$attributes=false)
 * Form::textarea($name, $value="",$attributes=false)
 * Form::radio($name, $value,$attributes=false)
 * Form::checkbox($name, $value,$attributes=false)
 * Form::select($name, $data, $attributes=false,$default_value)
 * Form::button($name, $value="Button",$attributes=false,$type='button')
 * Form::submit($name, $value="Submit",$attributes=false)
 * Form::reset($name, $value="Reset",$attributes=false)
 *
 * Form::validate($name,$type=array())
 *                       req
 *                       email
 *                       url
 *                       num
 *                       name
 *                       alphanum
 *                       username
 *                       password/strong_password
 *                       minlen=?
 *                       maxlen=?
 *                       range=?-?/num_range=?-?
 *                       xters=?-?/strlen=?-?/str_range=?-?
 *                       image/picture/pics
 *                       file/upload
 *
 * Form::is_posted
 *
 *
 */
class Form
{

  /**
   * Save the errors associated with field
   * @var array
   */
    private static $errors = array();

    /**
     * Get the current form method
     * Default is $_POST
     * @var string
     */
    private static $form_method = "";

    private static $form_enctype = false;

    public static function open($action, $method="get", $attributes=false, $upload_file = false)
    {
        $output = "";


        //Start Creating the Form Start
        $output .= "\n".' <form action="'.$action.'" method="' . $method . '"';

        // Get the other attributes public static function
        $output .= self::get_attributes('form', $attributes);

        // If the form would upload file
        if ($upload_file) {
            // Set the encoding type of the form to true
            self::$form_enctype = true;
            $output .=  '  enctype="multipart/form-data"';
        }


        //append the ending tag to the text element
        $output .= '>';

        echo $output;
        return;
    }

    public static function close()
    {
        self::$form_enctype = false;
        echo "\n".'</form>';
        return;
    }
    /**
     * Private Static Input: Base class for all input fields
     * @param  [string]  $input_type      [Get the type of input]
     * @param  [string]  $name            [Get the name of the field]
     * @param  boolean $value           [Get current value]
     * @param  boolean $attributes [Get other defined attributes]
     * @return [void]                   [Writes out the form element]
     */
    private static function _input($input_type, $name, $value=false, $attributes=false)
    {
        $output = "";

        //Check the Value
        $value = self::get_posted_value($name, $value);

        //Start Creating the Input
        $output .= "\n".' <input type="'.$input_type.'" name="' . $name . '" id="' . $name . '"';

        // Get the value if present
        if ($value == 0 || $value) {
            $output .=  ' value="' . htmlspecialchars($value) . '"';
        }

        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the text element
        $output .= '>';

        echo $output;
        return true;
    }

    public static function text($name, $value="", $attributes=false)
    {
        return self::_input('text', $name, $value, $attributes);
    }

    public static function email($name, $value="", $attributes=false)
    {
        return self::_input('email', $name, $value, $attributes);
    }

    public static function password($name, $value="", $attributes=false)
    {
        return self::_input('password', $name, $value, $attributes);
    }

    public static function file($name, $attributes=false)
    {

    // Check if the form encoding type is set
        // in the form. Give a warning error
        if (!self::$form_enctype) {
            self::set_errors($name, 'Form Encoding is not set for the form.');
        }

        return self::_input('file', $name, false, $attributes);
    }

    public static function hidden($name, $value="")
    {
        return self::_input('hidden', $name, $value);
    }

    public static function search($name, $value="", $attributes=false)
    {
        return self::_input('search', $name, $value, $attributes);
    }

    public static function tel($name, $value="", $attributes=false)
    {
        return self::_input('tel', $name, $value, $attributes);
    }

    public static function url($name, $value="", $attributes=false)
    {
        return self::_input('url', $name, $value, $attributes);
    }

    public static function range($name, $value="", $attributes=false)
    {
        return self::_input('range', $name, $value, $attributes);
    }

    // Spinners
    public static function number($name, $value="", $attributes=false)
    {
        return self::_input('number', $name, $value, $attributes);
    }
    public static function time($name, $value="", $attributes=false)
    {
        return self::_input('time', $name, $value, $attributes);
    }
    public static function date($name, $value="", $attributes=false)
    {
        return self::_input('date', $name, $value, $attributes);
    }


    public static function textarea($name, $value=false, $attributes=false)
    {
        $output = "";

        //Check the Value
        $value = self::get_posted_value($name, $value);

        //Start Creating the Input
        $output .= "\n". '<textarea name="' . $name . '" id="' . $name . '"';

        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the text element
        $output .= '>';

        // Get the value if present
        if ($value) {
            $output .=  htmlspecialchars($value);
        }

        // Complete the textarea:
        $output .= '</textarea>';

        echo $output;
        return;
    }

    public static function radio($name, $value, $attributes=array(), $default_value=false)
    {
        $output = "";

        // Assume radio is not marked by default
        $checked_by_default = false;
        //check if the field is checked by default
        if ((!empty($attributes)) && array_key_exists('checked', $attributes)) {
            $checked_by_default = true;
            //remove it
            unset($attributes['checked']);
        }



        //Check if the value has been posted,
        // Values of radio button are entered by default
        // False is used to get the default posted value
        $selected_value = self::get_posted_value($name, $default_value);

        //Start Creating the Radio Button
        $output .= "\n".'<input type="radio" name="' . $name . '" id="' . $value . '" value="' . htmlspecialchars($value) . '"';

        //If there is a posted value
        if (!empty($selected_value) && ($selected_value == $value)) {
            // the posted value is this value
            if (($selected_value == $value)) {
                $output .= ' checked="checked"';
            }
        }

        // if there is no posted or selected value
        // check the field if checked by default
        elseif ($checked_by_default) {
            $output .= ' checked="checked"';
        }


        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the password element
        $output .= '>';

        echo $output;
        return;
    }

    public static function checkbox($name, $value, $attributes=array(), $default_value=false)
    {
        $output = "";

        // get the name aspect of the checkbox only
        $name = preg_replace('/[^a-zA-Z\d_]/', '', $name);
        //if square bracket is given in name
        // append the square bracket to make it an array
        // if (strpos($name, '[]') === false)
        //    $name = $name.'[]';


        //Assume check box is not marked by default
        $marked_by_default = false;
        if ((!empty($attributes)) && array_key_exists('checked', $attributes)) {
            $marked_by_default = true;
            //remove it
            unset($attributes['checked']);
        }


        $form_method = self::get_form_method();

        $selected_value = array();
        // //Get the values passed into the checkbox
        if (!empty($form_method[$name])) {
            //Get all the values sent from the form
            for ($i=0;$i<count($form_method[$name]);$i++) {
                //Assign them into teh chosen value
                $selected_value[] = $form_method[$name][$i];
            }
        }


        //Start Creating the Checkbox
        $output .= "\n".'<input type="checkbox" name="' . $name . '[]" id="' .$value . '" value="' . htmlspecialchars($value) . '"';

        //If there is a posted value and the posted value is this value
        if (!empty($selected_value) && in_array($value, $selected_value)) {
            $output .= ' checked="checked" ';
        }
        // No posted value, but it is in the default value
        elseif ($default_value) {
            if (is_array($default_value)) {
                if (in_array($value, $default_value)) {
                    $output .= ' checked="checked" ';
                }
            } else {
                if ($value == $default_value) {
                    $output .= ' checked="checked" ';
                }
            }
        }
        //if there is no posted value but this value is checked by default
        elseif ($marked_by_default && empty($selected_value)) {
            $output .= ' checked="checked" ';
        }

        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the password element
        $output .= '>';

        echo $output;
        return;
    }

    public static function select($name, $data, $attributes=false, $default_key=false, $empty_option=false)
    {
        $output = "";

        $value = $default_key;

        //Check the Value
        $selected_value = self::get_posted_value($name, $value);

        // if there is no selected value
        // make the default value the selected value
        if (!$selected_value && $selected_value != 0) {
            $selected_value = $default_key;
        }

        //Start Creating the Select Field
        $output .= '<select name="' . $name . '" id="' . $name . '"';

        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the password element
        $output .= '>';

        // create an empty option
        if ($empty_option) {
            $output.= '<option value="">'.$empty_option.'</option>';
        }

        //count to make the key unique with number
        $count = 1;

        //Start Creating the Option Field
        foreach ($data as $key => $val) {

    # -- Deal with Select Group
            if ((string)$key == "open-group$count") {
                $output .= '<optgroup label="'.$val.'">';
            } elseif ((string)$key == "close-group$count") {
                $output .= '</optgroup>';
                $count++;
            } else {

      // Do something with $value.
                $output .= '<option value="'.$key.'"';

                if ($selected_value == $key) {
                    $output .= ' selected';
                }

                $output .= '>'.$val.'</option>';
            }
        }


        //Close the select
        $output .= "</select>";

        echo $output;
        return;
    }

    public static function button($name, $value="Button", $attributes=false, $type='button')
    {
        $output = "";

        //Check the Value
        // $value = self::get_posted_value($name,$value);

        //Start Creating the Input
        $output .= "\n". '<button name="' . $name . '" id="' . $name . '" type=' . $type . '"';

        // Get the other attributes public static function
        $output .= self::get_attributes($name, $attributes);

        //append the ending tag to the text element
        $output .= '>';

        // Write the Value
        $output .=  $value;

        // Complete the textarea:
        $output .= '</button>';

        echo $output;
        return true;
    }
    public static function submit($name, $value="Submit", $attributes=false)
    {
        return self::button($name, $value, $attributes, 'submit');
    }

    public static function reset($name, $value="Reset", $attributes=false)
    {
        return self::button($name, $value, $attributes, 'reset');
    }


    public static function get_posted_value($name, $value)
    {

    #get the form method
        $form_method = self::get_form_method();

        //Check if the value has been posted
        if (isset($form_method[$name])) {

      //Assign posted value
            $value = $form_method[$name];

            // Strip slashes if Magic Quotes is enabled:
            if (get_magic_quotes_gpc()) {
                $value = stripslashes($value);
            }
        }

        return $value;
    }

    public static function clear_values()
    {
        $_POST = array();
        self::$form_method = array();
    }

    public static function get_attributes($name, $attributes)
    {

    // 1. Is attributes empty, yes-> 10
        // 2. Is attributes an array, no -> 8
        // 3. check error is present
        // 4. is error present in atrr, no -> 7
        // 5. if class is present, add class, append error
        // 6. if error is present but class is absent, add other attr
        // 7. error is not present, just output all value
        // 8. Is attributes a string, no -> 11
        // 9. Output attributes value
        // 10. if error is present, output=class=error


        $other_values = "";
        $error_is_present = false;
        $class_is_present = false;

        # -- 3. is error associated with the field
        if (isset($errors[$name])) {
            $error_is_present = true;
        }


        # -- 1. Is attributes empty
        if (!empty($attributes)) {

      # -- 2. Is attributes an array
            if (is_array($attributes)) {

        # -- 4. Error is present for the field
                if ($error_is_present) {
                    // get the values of present attributes
                    foreach ($attributes as $key => $value) {
                        // if the class attribute is found
                        if (strtolower($key) == "class") {
                            # -- 5. add class error with defined value to the class value
                            $other_values .= " class =\"error $value\"";
                        } else {
                            # -- 6. add other attributes
                            $other_values .= " $key =\"$value\"";
                        }
                    } # -- end foreach
                } else {
                    # -- 7. Error is not present, Output all attributes
                    foreach ($attributes as $key => $value) {
                        // get other attributes
                        $other_values .= " $key =\"$value\"";
                    } // end foreach
                } // end if error is present
            } else { // $attributes is not an array
        # -- 8. attributes is defined as a string
        # -- 9. just add the $attributes value
        $other_values .= " ".$attributes;
            } // end is_array
        } else {
            # -- 11. $attributes is empty
            # -- Output class=error if error is present
            if ($error_is_present) {
                // assign error class
                $other_values .= 'class="error"';
            }
        } // end empty $attributes


        return $other_values;
    }//end public static function



    #-############################################
    # Form Validation
    #-############################################


    #-############################################
    # Unassigned public static functions
    #-############################################

    public static function exist($name)
    {
        $form_method = self::get_form_method();
        //Get the submitted form
        if (isset($form_method[$name]) && (!empty($form_method[$name]))) {
            return true;
        }

        return false;
    }

    public static function has_value($name)
    {
        return self::exist($name);
    }



    public static function is_required($field_name)
    {
        #check if a field is required
        if (isset($field_name) && (!empty($field_name))) {
            return true;
        } else {
            return false;
        }
    }


    public static function is_valid_email($email)
    {
        #checks if an email is valid.
        if (PHP_VERSION >= 5.2) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i', $email);
        }
    }

    public static function contains_no_url($content)
    {

        //Check if the content contains url
        if ((strpos($content, "http://") !== false) || (strpos($content, "https://") !== false) || (strpos($content, "www") !== false)) {
            return false;
        }

        return true;
    }

    public static function is_valid_url($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function is_number($value)
    {
        #Check if the value is a valid number
        return is_numeric($value);
    }

    public static function is_alphanum($string)
    {
        #return if it is an alphabet or number
        return ctype_alnum($string);
    }

    public static function is_valid_name($name)
    {
        #alphabet, digit, _, spaces and . are allow. Minimum 6 character. Maximum 255 characters (email address may be more)
        return preg_match('/^[a-zA-Z\d_.\(\)\-\& ]{6,255}$/i', $name);
    }


    public static function is_valid_username($username, $length="6-50")
    {
        //if dash is present in the length
        if (strpos($length, '-') !== false) {
            list($start, $end) = explode("-", $length);
            if (!is_numeric($start)) {
                $start = 6;
            }
            if (!is_numeric($end)) {
                $end = 50;
            }
        } else {
            //if dash is not present, assign the end as 250
            if (!is_numeric($length)) {
                $start = 6;
            } else {
                $start= $length;
            }
            $end=50;
        }
        #alphabet, digit, @, _ and . are allow. Minimum 6 character. Maximum 50 characters (email address may be more)
        return preg_match('/^[a-zA-Z\d_@.]{'.$start.','.$end.'}$/i', $username);
    }


    public static function strong_password($password)
    {
        #must contain 8 characters, 1 uppercase, 1 lowercase and 1 number
        return preg_match('/^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/', $password);
    }

    public static function equals($pass1, $pass2)
    {
        #compares two values together
        if ($pass1 == $pass2) {
            return true;
        } else {
            return false;
        }
    }

    public static function minimum_length($value, $length=1)
    {
        #if the length is not a number, or less than 1 assume that the length is 1
        if ((!is_numeric($length)) or ($length < 1)) {
            $length = 1;
        }

        #Do the comparison
        if (strlen($value) >= $length) {
            return true;
        } else {
            return false;
        }
    }

    public static function maximum_length($value, $length=1)
    {
        #if the length is not a number, or less than 1 assume that the length is 1
        if ((!is_numeric($length)) or ($length < 1)) {
            $length = 1;
        }

        #Do the comparison
        if (strlen($value) <= $length) {
            return true;
        } else {
            return false;
        }
    }

    public static function number_range($value, $length="0-10")
    {
        #List the value returned from the array into $start and end
        list($start, $end) = explode("-", $length);
        if (!is_numeric($start)) {
            $start = 0;
        }
        if (!is_numeric($end)) {
            $start = 10;
        }
        if (is_numeric($value)) {
            if ($value >= $start && $value <= $end) {
                return true;
            }
        }

        return false;
    }

    public static function string_range($name, $length="1-50")
    {
        #List the value returned from the array into $start and end
        list($start, $end) = explode("-", $length);
        if (!is_numeric($start)) {
            $start = 1;
        }
        if (!is_numeric($end)) {
            $start = 50;
        }
        if (strlen($name) < $start || strlen($name) > $end) {
            return false;
        } else {
            return true;
        }
    }


    public static function is_valid_file($file)
    {
        // if the valid field is set and a valid file
        if ((isset($_FILES[$file])) && (is_file($_FILES[$file]['tmp_name']))) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_valid_image($picture)
    {
        if (self::is_valid_file($picture)) {
            // if the end of the file doesnt match jpeg, gif or png
            if (!((preg_match('/^image\/p?jpeg$/i', $_FILES[$picture]['type']) or
            preg_match('/^image\/gif$/i', $_FILES[$picture]['type']) or
            preg_match('/^image\/(x-)?png$/i', $_FILES[$picture]['type'])))) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }


    public static function is_valid_ddmmyy($date)
    {
        #05/12/2109
        #05-12-0009
        #05.12.9909
        #05.12.99
        return preg_match('/^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.][0-9]?[0-9]?[0-9]{2})*$/', $date);
    }


    public static function is_valid_yymmdd($date)
    {
        #2009/12/11
        #2009-12-11
        #2009.12.11
        #09.12.11
        return preg_match('#^([0-9]?[0-9]?[0-9]{2}[- /.](0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01]))*$#', $date);
    }


    public static function is_later_date($date, $is_later_date=true)
    {
        $date = strtotime($date);
        $year = date('Y', $date);
        $month = date('m', $date);
        $day = date('j', $date);


        // depending on the year, calculate the number of days in the month
    if ($year % 4 == 0) {      // LEAP YEAR
      $days_in_month = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    } else {
        $days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    }


        // first, check the incoming month and year are valid.
        if (!$month || !$day || !$year) {
            return false;
        }
        if (1 > $month || $month > 12) {
            return false;
        }
        if ($year < 0) {
            return false;
        }
        if (1 > $day || $day > $days_in_month[$month-1]) {
            return false;
        }


        // if required, verify the incoming date is LATER than the current date.
        if ($is_later_date) {
            // get current date
            $today = date("U");
            $date = mktime(0, 0, 0, $month, $day, $year);
            if ($date < $today) {
                return false;
            }
        }

        return true;
    }



    public static function set_form_method($method=array())
    {
        self::$form_method = $method;
    }
    public static function get_form_method()
    {
        // Set the default to POSt
        if (empty(self::$form_method)) {
            self::$form_method = $_POST;
        }
        return self::$form_method;
    }

    /**
     * is_file_command($command)
     * Used to verify if a command is for a file input
     * @param  string  $command the command to verify
     * @return boolean          Return true if it is a file command
     */
    public static function is_file_command($command)
    {
        $upload_command = array('image','picture','pics','file','upload');

        // get the format of the method
        if (in_array($command, $upload_command)) {

      // if form enctype is false
            // Set an error as a reminder
            // if (!self::$form_enctype)
            //   self::set_errors('error','Please set the form enctype to upload files');

            return true;
        } else {
            return false;
        }
    }

    public static function valid_input($name, $command)
    {
        $length = "";
        #if = is in the command, assign it into the command and length
        if (strpos($command, "=") !==  false) {
            list($command, $length) = explode("=", $command);
        }

        // Check if the command is a file command
        // Assume false as default
        $file_command = false;

        // Verify that the command a file command
        if (self::is_file_command($command)) {
            $file_command = true;
        } else {
            $form_method = self::get_form_method();
        }


        //Get the submitted form or if the file is a file command
        if (isset($form_method[$name]) || $file_command) {

    #Check if to use $_FILE OR $_POST OR $_GET
            if ($file_command) {
                $input_value = $name;
            } else {
                $input_value = $form_method[$name];
            }


            #Assume the $result returned is true or valid
            $result=true;

            switch ($command) {
            case 'req':
                        {
                            $result = self::is_required($input_value);
                            break;
                        }

        case 'email':
              {
                $result = self::is_valid_email($input_value);
                break;
              }
        case 'url':
              {
                $result = self::is_valid_url($input_value);
                break;
              }
            case 'no_url':
                        {
                            $result = self::contains_no_url($input_value);
                            break;
                        }

            case 'num':
                        {
                            $result = self::is_number($input_value);
                            break;
                        }

            case 'name':
              {
                $result = self::is_valid_name($input_value);
                break;
              }
            case 'alphanum':
                        {
                            $result = self::is_alphanum($input_value);
                            break;
                        }

        case 'username':
                        {
                            $result = self::is_valid_username($input_value, $length);
                            break;
                        }

            case 'password':
            case 'strong_password':
                        {
                            $result = self::strong_password($input_value);
                            break;
                        }

            case 'minlen':
                        {
                            $result = self::minimum_length($input_value, $length);
                            break;
                        }

            case 'maxlen':
                        {
                            $result = self::maximum_length($input_value, $length);
                            break;
                        }

            case 'range':
            case 'num_range':
                        {
                            $result = self::number_range($input_value, $length);
                            break;
                        }

            case 'xters':
            case 'strlen':
            case 'str_range':
                        {
                            $result = self::string_range($input_value, $length);
                            break;
                        }

        case 'image':
        case 'picture':
        case 'pics':
              {
                $result = self::is_valid_image($input_value);
                break;
              }

        case 'ddmmyy':
              {
                $result = self::is_valid_ddmmyy($input_value);
                break;
              }

        case 'yymmdd':
              {
                $result = self::is_valid_yymmdd($input_value);
                break;
              }

        case 'later':
            case 'later_date':
                        {
                            $result = self::is_later_date($input_value);
                            break;
                        }

            case 'file':
            case 'upload':
                        {
                            $result = self::is_valid_file($input_value);
                            break;
                        }
            default: $result = false;

        }//switch
            return $result;
        }
    }

    public static function assign($name, $command="", $error_msg="")
    {
        if (empty($command)) {
            $command = $name;
        }
        if (empty($error_msg)) {
            $error_msg = "Please enter a valid ".ucfirst($name);
        }

        if (self::valid_input($name, $command)) { #if the Validation is correct
            #get the form method
            $form_method = self::get_form_method();

            # -- Sucessful
            # -- Return the name if the command is a file command
            # -- Else return the value of the posted field
            if (self::is_file_command($command)) {
                return $_FILES[$name]['name'];
            } else {
                return $form_method[$name];
            }
        } else { #if the validation fails
            self::set_errors($name, $error_msg);
        }
    }

    public static function validate($name, $type=array())
    {
        $file_command = "empty";

        // Run command if only the type is an array
        if (is_array($type)) {
            foreach ($type as $command => $error) {
                if (self::is_file_command($command)) {
                    $file_command = $command;
                }

                if (!self::valid_input($name, $command)) { #if the validation fails
                    self::set_errors($name, $error);
                    return;
                }
            }
        } else {
            self::set_errors($name, 'Invalid Parameter: Must be an array');
        }


        #get the form method
        $form_method = self::get_form_method();


        # -- Sucessful
        # -- Return the name if the command is a file command
        # -- Else return the value of the posted field
        if (self::is_file_command($file_command)) {
            return $_FILES[$name]['name'];
        } else {
            return $form_method[$name];
        }
    }



    public static function set_errors($name, $message="")
    {
        if (is_array($name) && (!empty($name))) {
            static::$errors = $name;
        } elseif (!empty($message)) {
            static::$errors[$name] = $message;
        }
    }

    public static function get_errors($name="")
    {
        //Return all errors if a name is not given
        if (empty($name)) {
            return self::$errors;
        } else {
            // if form_field has error, return error
            if (isset(self::$errors[$name]) && (!empty(self::$errors[$name]))) {
                return self::$errors[$name];
            }
        }

        # -- Error doesnt exist
        return false;
    }

    //show_error -> show_info
    public static function show_info($name, $help_text="", $error_class="error help-block with-errors", $help_class="help-block")
    {
        $error_exist = self::get_errors($name);
        if ($error_exist) {
            echo '<div class="'.$error_class.'">'.$error_exist.'</div>';
        } else {
            if (!empty($help_text)) {
                echo '<div class="'.$help_class.'">'.$help_text.'</div>';
            } else {
                echo '<div class="help-block with-errors"></div>';
            }
        }
    }


    public static function is_posted($button_name = "")
    {

    # -- is the request from post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # -- if the button name is defined
            # -- Verify if the button is clicked
            if (!empty($button_name)) {
                # -- if the button is clicked
                if (isset($_POST[$button_name])) {
                    return true;
                } else {
                    # -- the button is not clicked
                    return false;
                }
            }

            # -- No Value is defined
            # -- But the request is from post
            return true;
        }

        # -- Request is not from post
        else {
            return false;
        }
    }

    public static function is_get()
    {

    # -- is the request from get
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

      # -- No Value is defined
            # -- But the request is from get
            return true;
        }

        # -- Request is not from get
        else {
            return false;
        }
    }
}//end class

// $data = array();
// if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//   $data['name'] = Form::validate('name',array(
//                     'req' => 'Required Field',
//                     'minlen=6' => 'Minimum Length is 6 characters',
//                     'maxlen=10' => 'Maximum Length is 10 characters',
//                     'username' => 'Enter a valid Username'
//                    ));

  // $data['email'] = Form::assign('email');
  // $data['password'] = Form::assign('password');
  // $data['search'] = Form::assign('search','minlen=3','Minimum Length is 3');
  // if (Form::exist('tel'))
  //   $data['tel'] = Form::assign('tel','req');
  // $data['url'] = Form::assign('url','str_range=0-5','Range is btw 0 - 5');
  // $data['range'] = Form::assign('range','range=0-10','Range is btw 0 - 5');
  // $data['num'] = Form::assign('num');
// }
// echo '<form action="#" method="post">';
// Form::text('name','',"class = 'form-control'");echo "<br><br>";
// Form::show_info('name','Help Bl0ck');echo "<br><br>";
// Form::email('email','', array('class' => 'form-control' , 'placeholder' => 'Enter the Email'));echo "<br><br>";
// Form::password('password','', array('class' => 'form-control' , 'placeholder' => 'Enter the Password'));echo "<br><br>";
// Form::hidden('hidden','');echo "<br><br>";
// Form::search('search','', array('class' => 'form-control' , 'placeholder' => 'Enter Search'));echo "<br><br>";
// Form::tel('tel','', array('class' => 'form-control' , 'placeholder' => 'Enter Telephone'));echo "<br><br>";
// Form::url('url','', array('class' => 'form-control' , 'placeholder' => 'Enter URL'));echo "<br><br>";
// Form::range('range','', array('class' => 'form-control' , 'placeholder' => 'Enter Range', 'min'=> '1','max'=>'10'));echo "<br><br>";
// Form::number('number','', array('class' => 'form-control' , 'placeholder' => 'Enter Number', 'min'=> '1','max'=>'10'));echo "<br><br>";
// Form::time('time','', array('class' => 'form-control' , 'placeholder' => 'Enter the Time'));echo "<br><br>";
// Form::date('date','', array('class' => 'form-control' , 'placeholder' => 'Enter Date'));echo "<br><br>";
// Form::datetime('datetime','', array('class' => 'form-control' , 'placeholder' => 'Enter DateTime'));echo "<br><br>";
// Form::month('month','', array('class' => 'form-control' , 'placeholder' => 'Enter Month'));echo "<br><br>";
// Form::radio('sex','male', array('class' => 'form-control'));echo "Male<br><br>";
// Form::radio('sex','female', array('class' => 'form-control'));echo "Female<br><br>";
// Form::checkbox('food[]','rice', array('class' => 'form-control', 'checked' => 'checked'));echo "Rice<br><br>";
// Form::checkbox('food[]','dodo', array('class' => 'form-control'));echo "Dodo<br><br>";
// Form::checkbox('food[]','fish', array('class' => 'form-control'));echo "Fish<br><br>";
// Form::checkbox('food[]','ponmo', array('class' => 'form-control'));echo "Ponmo<br><br>";
// Form::checkbox('food[]','beans', array('class' => 'form-control'));echo "Beans<br><br>";
// Form::textarea('Message','', array('class' => 'form-control' , 'placeholder' => 'Enter your message here'));echo "<br><br>";
// $country_list['nig'] = 'Nigeria';
// $country_list['niger'] = 'Niger';
// $country_list['ghana'] = 'Ghana';
// Form::Select('country',$country_list, array('class' => 'form-control'));echo "<br><br>";
// Form::file_upload('picture', array('class' => 'form-control'));echo "<br><br>";
// echo '<input type="submit">';
// var_dump(Form::get_errors());
// var_dump($data);
// echo '</form>';
// // $string = "";
// // $test = ctype_alnum ($string);
// // echo var_dump($test);
// $name = 'testing[]';
// if (strpos($name, '[]') === false)
//   $name = $name.'[]';
// echo $name;
//
// if (Form::is_posted()){
//   $picture = Form::assign('picture','picture','Upload a valid image');
//   echo $picture;
// }
// Form::open('#','post',false,true);
// Form::file('picture');
// Form::show_info('picture');
// Form::submit('Submit');
