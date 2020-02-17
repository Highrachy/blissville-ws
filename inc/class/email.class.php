<?php

class Email
{
    private static $send_email_to = 'nnamdi@highrachy.com';
    private static $email_from= 'no-reply@blissville.com.ng';
    private static $autoreply_email= 'nnamdi@highrachy.com';

    public static function send_message()
    {
        # -- Make Database connection
        global $db;

        # -- Name
        $data['name'] = Form::validate(
            'name',
            array(
            'xters=6-100' => 'The name should be between 6 to 100 characters',
            'name'=>'Enter a Valid name')
        );

        # -- Phone
        if (Form::has_value('phone')) {
            $data['phone'] = Form::validate('phone', array('minlen=6' => 'Please enter a valid phone number'));
        }

        #- Spam Bot
        if (isset($lname) && (!empty($lname))) {
            $errors['lname'] = "The Last Name field must be empty";
        }

        # -- Email
        $data['email'] = Form::validate('email', array('email' => 'Enter a valid Email Address'));

        # -- Subject
        $data['subject'] = Form::validate('subject', array('minlen=5' => 'Enter a valid Subject'));

        # -- Message
        $data['message'] = Form::validate('message', array('minlen=5' => 'Enter a valid Message'));

        # -- Get Form Errors
        $errors = array_merge(Form::get_errors(), $errors);

        if (empty($errors)) { //no errors

            # -- Build content of the mail
            $additional_content = 'Name: '.$data['name'].'<br>Email: '.$data['email'].'<br>Phone: '.$data['phone'];

            # -- Send the mail
            return self::send_mail($data['email'], $data['subject'], $data['message'], $additional_content);
        }

        # -- Failed
        return 0;
    }

    public static function send_mail($reply_email_to, $subject, $message, $additional_content="", $second_email="")
    {

        # -- load email HTML template
        $html_template = file_get_contents(INCLUDE_DIR.'email_template.html');

        # -- replace appropriate placeholders
        $html_template = str_replace('{{subject}}', $subject, $html_template);
        $html_template = str_replace('{{message}}', $message, $html_template);
        $html_template = str_replace('{{additional_content}}', $additional_content, $html_template);
        $html_template = str_replace('{{date}}', date('F j, Y h:i a'), $html_template);

        # -- Build the mail
        $custom_headers = "";
        $custom_headers .= "From: ". self::$email_from."\r\n";
        $custom_headers .= "Reply-To: ".$reply_email_to."\r\n";
        $custom_headers .= "Return-Path: ".$reply_email_to." \r\n";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= $custom_headers;

        # -- Save Email in the content
        $email_content = $html_template;

        # -- Send Mail
        global $local;
        if ($local) {
            echo $email_content;
        } else {
            if (isset($second_email) && !empty($second_email)) {
                @mail($second_email, $subject, $email_content, $headers);
            }
            @mail(self::$send_email_to, $subject, $email_content, $headers);
        }

        return true;
    }

    public static function autoreply($email, $subject="Auto-reply: We have received your email")
    {

        # -- load email HTML template
        $html_template = file_get_contents(INCLUDE_DIR.'email_template.html');

        $autoreply_subject = "Thank you for contacting Blissville";
        $autoreply_message = "<p>We have received your email and our Customer Service team will respond to you within 24 hours.</p>
                            <p>You may also refer to our <a href='http://blissville.com/faqs.php'>FAQs</a> for more information.</p>
                            <p>Please note that our working hours are between 09:00AM to 5:00PM (GMT +0100) from Monday to Friday excluding public holidays. We regret any delays due to non-working hours.</p>

                            <br>
                            <p>Best Regards,</p>
                            <strong>Nnamdi Ijei</strong><br>
                            nnamdi@highrachy.com<br>
                            Tel: 0802-833-7440



        ";

        # -- replace appropriate placeholders
        $html_template = str_replace('{{subject}}', $autoreply_subject, $html_template);
        $html_template = str_replace('{{message}}', $autoreply_message, $html_template);
        $html_template = str_replace('{{additional_content}}', "", $html_template);
        $html_template = str_replace('{{date}}', date('F j, Y h:i a'), $html_template);

        # -- Build the mail
        $custom_headers = "";
        $custom_headers .= "From: ". self::$autoreply_email."\r\n";
        $custom_headers .= "Reply-To: ".self::$autoreply_email."\r\n";
        $custom_headers .= "Return-Path: ".self::$autoreply_email." \r\n";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= $custom_headers;

        # -- Save Email in the content
        $email_content = $html_template;

        # -- Send Mail
        global $local;
        if ($local) {
            echo $email_content;
        } else {
            @mail($email, $subject, $email_content, $headers);
        }

        return true;
    }
}
