<?php
class Upload{

	protected static $errors  = array();


	public static function image($file_upload,$destination="images/",$resizeto="300",$resizeby="w"){
		
		define('QUALITY', 80);
		
		$new_image_name = self::rename_file($_FILES[$file_upload]['name'],$destination);
		
		$image = new Image($_FILES[$file_upload]['tmp_name']);
		
		$image->destination = $destination.$new_image_name;
		$image->constraint = $resizeby;
		$image->size = $resizeto;
		$image->quality = QUALITY;
		
		$image->render();
		return $new_image_name;
	}


	public static function file($file_upload,$destination="./images"){
		
		# - Check if the file exist on the server, rename if necessary
		$new_file_name = self::rename_file($_FILES[$file_upload]['name'],$destination);
		
		$path = $destination.$new_file_name;
		
		if (is_uploaded_file($_FILES[$file_upload]['tmp_name'])){ 
			if (move_uploaded_file($_FILES[$file_upload]['tmp_name'],$path)){
				return $new_file_name;
			} else {
				self::set_errors("Could not move the file!");
				return false;
			}
		
		} else { // The file could not be uploaded
			self::set_errors("Could not save file as $new_file_name");
			return false;
		}
	}



	public static function rename_file($file_upload, $destination="images/"){

			//Set the overall base name for the files
			# - Assign the base name as the new_file_name given
			$base = self::get_filename($file_upload);
			
			# - Get the extension of the uploaded file
			$extension = '.'. self::get_extension($file_upload);
					
			$fileName = $base.$extension;
			
			//Set the Destination and scan if the file is present.
		    $existing = scandir($destination);
			
			//If the file is present, rename the file by appending _1, _2 e.t.c
		    if (in_array($fileName, $existing)) {			
				$i = 1;
				do {
				  $fileName = $base.'_'.$i++.$extension;
				} while (in_array($fileName, $existing));
			}
			
			return $fileName;	
	}


	public static function get_extension($file_upload){
		return pathinfo($file_upload,PATHINFO_EXTENSION);
	}


	public static function get_filename($file_upload){
		return pathinfo($file_upload,PATHINFO_FILENAME);
	}

	#-############################################
	# Set the Error in other methods
	#-############################################
	public static function set_errors($errors){
		static::$errors = $errors;
	}
	#-############################################
	# Get the Error in other methods
	#-############################################
	public static function get_errors(){
		return static::$errors;
	}


}



class Image
{
	var $max_file_size = 2097152; #10MB
	var $allow_types = array('image/jpeg', 'image/png', 'image/gif');
	var $errors;
	
	public $destination = 'uploaded.jpeg';
	
	public $constraint = 'w';
	
	public $size = 200;
	
	public $quality = 100;
	
	public $cropwidth = false;
	public $cropheight = false;
	
	public $align;
	 
	public function __construct($imagefilepath)
	{
		$this->tmp_name = $imagefilepath;
		
		$this->image_size = filesize($this->tmp_name);
		
		$imagedata = getimagesize($this->tmp_name);
		
		
		$this->width = $imagedata[0];
		$this->height = $imagedata[1];
		
		$this->type = $imagedata['mime'];
		
		$this->is_valid = $this->is_valid_type();
		$this->is_valid = $this->is_valid_size();
		
	}
	
	
	public function is_valid_type()
	{
		if (in_array($this->type, $this->allow_types))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function is_valid_size()
	{
		if ($this->image_size['size'] <= $this->max_file_size)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function render()
	{		
		$destname = $this->destination;
		$constraint = $this->constraint;
		$new_side = $this->size;
		$cropw = $this->cropwidth;
		$croph = $this->cropheight;
		$quality = $this->quality;
		
		
		
		if ($constraint == "h") 
		{
			$new_w = ($new_side / $this->height) * $this->width;
			$new_h = $new_side;	
			
			$canvasw = ($cropw!=false) ? $cropw : $new_w;
			$canvash = ($croph!=false) ? $croph : $new_h;
		
			$canvas = imagecreatetruecolor($canvasw, $canvash);
			
			$x = ($cropw==false) ? 0 : -(($new_w - $cropw)/2);
			$y = ($croph==false) ? 0 : -(($new_h - $croph)/2);
			
		} 
		else if ($constraint == "w") 
		{
			$new_h = ($new_side / $this->width) * $this->height;
			$new_w = $new_side;
			
			$canvasw = ($cropw!=false) ? $cropw : $new_w;
			$canvash = ($croph!=false) ? $croph : $new_h;
		
			$canvas = imagecreatetruecolor($canvasw, $canvash);
			
			$x = ($cropw==false) ? 0 : -(($new_w - $cropw)/2);
			$y = ($croph==false) ? 0 : -(($new_h - $croph)/2);
		} 
		else if ($constraint == "t") 
		{
			if($this->height > $this->width)
			{
				$new_h = ($new_side / $this->width) * $this->height;
				$new_w = $new_side;

				$x = 0;
				$y = -(($new_h-$new_side)/2);
			}
			else if($this->height <= $this->width)
			{
				$new_w = ($new_side / $this->height) * $this->width;
				$new_h = $new_side;	
				
				$x = -(($new_w-$new_side)/2);
				$y = 0;
			}
			
			$canvas = imagecreatetruecolor($new_side, $new_side);
		}
		else 
		{
			$new_h = $this->height;
			$new_w = $this->width;
			
			$x = $y = 0;
			
			$canvas = imagecreatetruecolor($new_w, $new_h);
		}
		
		switch($this->type)
		{
			case 'image/jpeg':
				$ic = imagecreatefromjpeg($this->tmp_name);
				break;
				
			case 'image/gif':
				$ic = imagecreatefromgif($this->tmp_name);			
				break;
				
			case 'image/png':
				$ic = imagecreatefrompng($this->tmp_name);				
				break;
		}
		
		imagecopyResampled($canvas, 
							$ic, 
							$x, $y, 0, 0, 
							$new_w, $new_h, 
							$this->width, $this->height);
		
		imagejpeg($canvas, $destname, $quality);
		
		imagedestroy($canvas);
	}	
	
	public function done()
	{
		unlink($this->tmp_name);
	}
	
}


