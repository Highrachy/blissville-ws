<?php

class Paginator{

		protected $current_page;

		protected $items_per_page;
		protected $total_returned_rows;
		protected $num_of_pages;

		protected $query_string;
		protected $page_name_in_query = 'p';

		//number of buttons to display
		protected $range = 10;
		//number of leading pages usually first and last buttons
		protected $leading_pages = 2;

		protected $button_prev = '&laquo;';
		protected $button_next = '&raquo';
		protected $button_dots = '...';


		#-############################################
		# Constructor
		#-############################################
		function __construct($total_returned_rows,$items_per_page=10){
				#-############################################
				# Set Initial Values From Parameters
				#-############################################
				$this->total_returned_rows = $total_returned_rows;
				$this->items_per_page = $items_per_page;

				// Calculate the number of pages to display
				$this->num_of_pages = ceil($total_returned_rows / $items_per_page);

				// set the query string from address bar
				$this->set_query_string();
		}

		#-############################################
		# Generate - Engine of the Class
		#-############################################
		function generate(){

			#-############################################
			# Initialize other values
			#-############################################

			//get current number from query
			$page_num = $this->get_current_page();


			// Get the total number of pages
			$num_of_pages = $this->num_of_pages;

			// Dont generate if there is only one page
			if ($num_of_pages <= 1)
				return;



			//Container to hold generated buttons
			$paginator_container = "";

			// Get number of buttons for first and last pages
			$leading_pages = $this->leading_pages;

			// Get the number of buttons to generate
			$range = $this->range;

			// Generate an equal number of button for current page
			$range_mid = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;

			//Minimum and Maximum page to display button
			$page_min = $page_num - $range_mid;
			$page_max = $page_num + $range_mid;

			#-############################################
			# Validate page_min and page max
			#-############################################

			//if the generate page_min is less than 1
			if ($page_min < 1){
				// Set page_min to 1
				$page_min = 1;

				// Set page max to the range
				$page_max = $range;
			}

			// For page numbers greater than number of pages
      if ($page_max > $num_of_pages) {
					// recalculate page min to last numbers within range
          $page_min = ($page_min > 1) ? $num_of_pages - $range + 1 : 1;

					// maximum page = num of pages
          $page_max = $num_of_pages;
      }
			// Make sure page min is always within limit
      $page_min = ($page_min < 1) ? 1 : $page_min;

			// $paginator_container .= "Page Num = $page_num<br>";
			// $paginator_container .= "Page Minimum = $page_min<br>";
			// $paginator_container .= "Page Max = $page_max<br>";
			// $paginator_container .= "Range = $range<br>";
			// $paginator_container .= "Range_mid = $range_mid<br>";
			// $paginator_container .= "No of Pages = $num_of_pages<br>";
			// $paginator_container .= "Leading Pages = $leading_pages<br>";

			// Generate the Move to First Page
			// if ( ($page_num > $range_mid) && ($num_of_pages > $range) ) {
			// 		$paginator_container .= $this->build_button(1,$this->button_first);
			// }

			#-############################################
			# Generate Previous Page
			#-############################################
			if ($page_num != 1) {
					$paginator_container .= $this->build_button($page_num - 1,$this->button_prev);;
			}

			#-############################################
			# Generate First Leading Page
			#-############################################
			// Generate Leading Pages e.g. 1,2 when page_num = 50
			// ($page_min >= $range_mid) || ($page_min >= $leading_pages)
			if ($page_num >= ($range_mid + $leading_pages) ){

				// Generate the buttons
				for ($i = 1;$i <= $leading_pages;$i++) {
						$paginator_container.= $this->build_button($i);
				}

				// Recalculate page_min to reflect the leading page
				$page_min = $page_min + $leading_pages;

				// Readjust page_min to start from the number after last first leading page
				if ($page_min <= $leading_pages)
					$page_min = $leading_pages + 1;

				// Show dots
				// BUT remove dots from closer pages like between 2 and 3
				if ($page_min != ($leading_pages + 1))
					$paginator_container.= $this->build_button(0,$this->button_dots);

			}


			#-############################################
			# Generate Last Leading Page
			#-############################################
			// Generate Leading Pages e.g. 99,100 when page_num = 50

			// Store result in a temp page to be display after range
			$temp_pagination = "";

			// if the generated range doesnt include last leading page
			if ($page_num <= ($num_of_pages - $leading_pages)){

				// Select the highest pages to select
				$page_to_display = $num_of_pages - $leading_pages + 1;

				// Show dots
				// Dont place dots in closer pages like between 98, 99
				if ($page_max <= ($page_to_display - 1))
					$temp_pagination.= $this->build_button(0,$this->button_dots);

				// Generate last leading page
				for ($i = $page_to_display;$i <= $num_of_pages;$i++) {
						$temp_pagination.= $this->build_button($i);
				}
				// Recalculate page_max not to include last leading pages
				$page_max = $page_max  - $leading_pages;

				// Readjust page_max not to include last leading pages
				if ($page_max >= $page_to_display)
					$page_max = $page_to_display - 1;

			}

			#-############################################
			# Generate Page Range
			#-############################################
			for ($i = $page_min;$i <= $page_max;$i++) {
					$paginator_container .= $this->build_button($i);
			}

			#-############################################
			# Add the Last Leading generated earlier
			#-############################################
			$paginator_container .= $temp_pagination;


			#-############################################
			# Generate Next Page
			#-############################################
			if ($page_num < $num_of_pages) {
					$paginator_container.= $this->build_button($page_num + 1,$this->button_next);
			}

			// Generate the Move to Last Page
			// if (($page_num< ($num_of_pages - $range_mid)) && ($num_of_pages > $range)) {
			// 		$paginator_container .= $this->build_button($num_of_pages,$this->button_last);
			// }

			return $paginator_container;

		}

		#-############################################
		# Set Query String
		#-############################################
		function set_query_string($get = true){

			#-############################################
		 	# Get the values from $_GET or $_POST
		 	#-############################################
			if($get) {
				$args = explode("&",$_SERVER["QUERY_STRING"]);
				foreach($args as $arg) {
					$keyval = explode("=",$arg);
					if($keyval[0] != $this->page_name_in_query)
						$this->query_string .= "&" . $arg;
				}
			}  else  {
				foreach($_POST as $key=>$val) {
					if($key != $this->page_name_in_query)
						$this->query_string .= "&$key=$val";
				}
			}


			//Use substr to omit first &
			$this->query_string = substr($this->query_string,1);

			// Add the & to join the page number
			if(!empty($this->query_string))
					$this->query_string .= '&';

		}

		#-############################################
		# Get Query String
		#-############################################
		function get_query_string($page_num){
			// Build the Query string
			// Combine ?, current_page_query & page_number
			return "?" . $this->query_string . $this->page_name_in_query . "=" . $page_num;
		}

		#-############################################
		# Get Current Page
		#-############################################
		function get_current_page(){

			//Set default value
			$current_page = 1;

			// is the current page defined in query string && is it a number
			if (isset($_GET[$this->page_name_in_query]) && (is_numeric($_GET[$this->page_name_in_query]))){

				// Get teh current page from the query string
				$current_page = $_GET[$this->page_name_in_query];

				// Correct invalide page number
				if ($current_page < 1)
					$current_page = 1;

				if ($current_page > $this->num_of_pages)
					$current_page = $this->num_of_pages;

			}

			// Set the current page of the class
			$this->current_page = $current_page;

			return $this->current_page;
		}

		#-############################################
		# Get Starting Item Position
		#-############################################
		function get_start_position(){
			return ($this->current_page - 1) * $this->items_per_page;
		}
		#-############################################
		# Get Ending Item Position
		#-############################################
		function get_end_position(){
			// get the starting position first
			$start = $this->get_start_position();
			$end = $start + $this->items_per_page;

			// End must not exceed the total returned rows
			if ($end > $this->total_returned_rows)
				$end = $this->total_returned_rows;

			return $end;

		}
		#-############################################
		# Set Range - Default Range is 9 buttons
		#-############################################
		function set_range($range){
			$this->range = $range;
		}

		#-############################################
		# Build a Single Button
		#-############################################
		function build_button($page_num,$page_value=""){

			// Get current page without query
			$self = $_SERVER['PHP_SELF'];

			// Use page number as value if not defined
			if ($page_value == ""){
				$page_value = $page_num;
			}

			// Generate the dots for leading pages
			if (($page_num == 0) && ($page_value == $this->button_dots))
				return '<li class="disabled"><a href="#">...</a></li>';

			#-############################################
			# Change here to build button
			#-############################################
			if ($this->current_page == $page_num){

				# -- Current Page Button############################################
				$button = ' <li class="active"><a href="#">' . $page_value . '</a></li> ';

			} else {
				# -- Other Buttons ############################################
				$href = $self.$this->get_query_string($page_num);
				$button = ' <li><a href='.$href.'>' . $page_value . '</a></li>';
			}

			return $button;

		}

} // end class

// $paginate = new Paginator(500,2);
// echo $paginate->generate();
// echo "<p> Query String : " . $paginate->get_query_string($paginate->get_current_page()) ."</p>";
// echo "<p> Start Position : " . $paginate->get_start_position() ."</p>";
// echo "<p> End Position : " . $paginate->get_end_position() ."</p>";
