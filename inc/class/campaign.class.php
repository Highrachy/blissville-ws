<?php
class Campaign extends Base{

	# -- Overwrite
	public static $table = "ism_campaigns";
	protected static $name = "campaigns";
	protected static $upload_directory = "campaigns";

	#-############################################
	# Email Extractor
	#-############################################
	public static function progress($percentage = 0, $size = 'xs', $active = true){

		$result = "";

		if ($percentage >= 60){
			$progress_class = "progress-bar-success";
		} else if ($percentage >= 25){
			$progress_class = "progress-bar-info";
		} else {
			$progress_class = "progress-bar-warning";;
		}



		if ($progress_class){
			if ($active){
						$progress_class .= ' active';}

			$result = '
					    <div class="progress progress-'.$size.'">
		                  <div class="progress-bar '.$progress_class.' progress-bar-striped" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'%">
		                    '.$percentage.'%
		                  </div>
		                </div>';

		}

		return $result;
	}
	#-############################################
	# Email Extractor
	#-############################################
	public static function extract_email(){

		$text = Form::assign('email','req','Please enter the content you wish to extract email addresses');

		if (empty($errors)) {

		    $extracted_email = "";
		    $count = 0;

		    if (!empty($text)) {
		      $result = preg_match_all(
		        "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i",
		        $text,
		        $matches
		      );

		      if ($result) {
		        foreach(array_unique($matches[0]) as $email) {

		          //Check if the email is valid
		          if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
		            $extracted_email .= $email . ", \n";
		            $count++;
		          }
		        }

		        # -- Successful
		        $_POST = array();
		        self::$results = $extracted_email;
		        self::$counter = $count;
		        return $count;
		      }

		      else {
		        $errors['error'] = "No emails found.";
		      }

			}
		}

		# -- Failed
		self::set_errors($errors);
		return 0;
	}



} //end class
