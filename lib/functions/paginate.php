<?php
function paginate($total_returned_rows,$limit=3,$present_page=0,$append=""){


# -- Variables ########################################################################################

	//define the other varialbles	
	$targetpage = $_SERVER['PHP_SELF']; 	
	$stages = 2;

	// Initial page num setup
	if ($present_page == 0){$present_page = 1;}
	$prev = $present_page - 1;	
	$next = $present_page + 1;							
	$lastpage = ceil($total_returned_rows/$limit);		
	$LastPagem1 = $lastpage - 1;
	
# -- HTML Structure ########################################################################################

	//Define the html Structure

	//Write the Ul class
	$ul_class = "pagination pagination-sm";

	//All the classes present in li
	$li_class = "";
	$li_current = "active";
	$li_prev= "";
	$li_next = "";
	$li_disabled = 'disabled'; //used to disable the prev and next class

	$a_class = "";
	$a_current ="";
	$a_prev = "";
	$a_next = "";

	//What it should write on the prev and next button
	$prev_btn = "&laquo;";
	$next_btn = "&raquo;";

	//Convert the first and last page to their respective number 

	//Write the separator html out in full
	$dots = "<li class='$li_class'><a href='#' class='a_class a_current'> ... </a></li>";


# -- Control Structure ########################################################################################

	$listPaginage = '';
	if($lastpage > 1)
	{


		$listPaginage .= "<ul class='$ul_class'>";
		// Previous
		if ($present_page > 1){
			$listPaginage.= "<li class='$li_class $li_prev'><a href='$targetpage?p=$prev$append' class='$a_class $a_prev'>$prev_btn</a></li>";
		}else{
			$listPaginage.= "<li class='$li_class $li_prev $li_disabled'><a href='#' class='$a_class $a_prev $a_current'>$prev_btn</a></li>";
		}
	
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $present_page){
					$listPaginage.= "<li class='$li_class $li_current'><a href='#' class='a_class a_current'> $counter</a></li>";
				}else{
					$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$counter$append' class='$a_class'>$counter</a></li>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($present_page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $present_page){
						$listPaginage.= "<li class='$li_class $li_current'><a href='#' class='$a_class $a_current'>$counter</a></li>";
					}else{
						$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$counter$append' class='$a_class'>$counter</a></li>";}					
				}
				$listPaginage.= $dots;
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$LastPagem1$append' class='$a_class'>$LastPagem1</a></li>";
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$lastpage$append' class='$a_class'>$lastpage</a></li>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $present_page && $present_page > ($stages * 2))
			{
				$listPaginage.= "<li class='$li_class' class='$li_class'><a href='$targetpage?p=1' class='$a_class'>1</a></li>";
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=2' class='$a_class'>2</a></li>";
				$listPaginage.= $dots;
				for ($counter = $present_page - $stages; $counter <= $present_page + $stages; $counter++)
				{
					if ($counter == $present_page){
						$listPaginage.= "<li class='$li_class $li_current'><a href='#' class='$a_class $a_current'>$counter</a></li>";
					}else{
						$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$counter$append' class='$a_class'>$counter</a></li>";}					
				}
				$listPaginage.= $dots;
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$LastPagem1$append' class='$a_class'>$LastPagem1</a></li>";
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$lastpage$append' class='$a_class'>$lastpage</a></li>";		
			}
			// End only hide early pages
			else
			{
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=1$append' class='$a_class'>1</a></li>"; 
				$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=2$append' class='$a_class'>2</a></li>";
				$listPaginage.= $dots;
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $present_page){
						$listPaginage.= "<li class='$li_class $li_current'><a class='$a_class $a_current'>$counter</a></li>";
					}else{
						$listPaginage.= "<li class='$li_class'><a href='$targetpage?p=$counter$append' class='$a_class'>$counter</a></li>";}					
				}
			}
		}
					
				// Next
		if ($present_page < $counter - 1){ 
			$listPaginage.= "<li class='$li_class $li_next'><a href='$targetpage?p=$next$append' class='$a_class $a_next'>$next_btn</a></li>";
		}else{
			$listPaginage.= "<li class='$li_class $li_current $li_next $li_disabled'><a href='#' class='$a_class $a_current $a_next'>$next_btn</a></li>";
		}
			
		$listPaginage.= "</ul>";
	}
	return $listPaginage;
}
?>