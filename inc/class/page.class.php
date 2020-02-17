<?php
class Page extends Base{

  #-- Pages Table
  const TBL_HOME = 'homepages';
  const TBL_ABOUT_US = 'abouts';
  const TBL_PORTFOLIO = 'portfolios';
  const TBL_INVESTORS = 'investors';
  const TBL_PAGE = 'pages';


	# -- Overwrite
  public static $table = self::TBL_PAGE;
  protected static $name = "pages";
	protected static $upload_directory = "pages";
  protected static $order_by = " ORDER BY name ASC";
  public static $default_sort_item = "id";
  public static $default_sort_order = "ASC";


  # -- Name of Pages
  // const HOME = 0;
  // const ABOUT_US = 1;
  // const PORTFOLIO = 2;
  // const FAQS = 3;
  // const INVESTORS = 4;
  // const CONTACT_US = 5;

	
  #-############################################
  # Add a New Page
  #-############################################
  public static function add(){

  }


  #-############################################
  # Edit existing Page
  #-############################################
  public static function update(){
    # -- Make Database connection
    global $db;

    # -- Page Name
    $data['name'] = Form::validate('name',array(
      'xters=6-100' => 'The name should be between 6 to 100 characters',
      'name'=>'Enter a Valid name')
    );

    # -- Content
    $data['content'] = Form::validate('content', array('minlen=10' => 'Enter a valid content'));

    
    # -- Modified
    $data['updated_at'] = "NOW()";

    # -- Page ID
    $page_id = Form::assign('page_id','req');
   
    # -- Get Form Errors
    $errors = array_merge(Form::get_errors(),self::$errors);
    if (empty($errors)) { # -- No Errors

      # -- Check if the name exist in the database
      if (!self::exist_in_database('name',$data['name']," AND id <> '$page_id'")){ # --No problem, name does not exist in the database

        return self::update_database($data,$page_id);

      } else {
        $errors['error'] = 'The page name exists in the database';
      }

    }

    # -- Failed
    self::set_errors($errors);
    return 0;
  }




  #-############################################
  # Delete existing Page
  #-############################################
  public static function delete(){
    # -- Make Database connection
    global $db;

    if (isset($_POST['Delete'])){
      $page_id = $_POST['Delete'];

      # -- Use exist_in_database 
      # -- Get the name with the id
      if (self::exist_in_database('id',$page_id,"",'name')) { # -- No problems! You can delete, file exist;

        # -- Get the row to be deleted
        $page = self::$results;

        if (self::delete_in_database($page_id,$page['name'])) { # -- If it ran OK.
          $value = $db->delete_row($query);
        }

        # -- Successful
        return true;

      }
    }

    # -- Failed
    return 0;
  }

  public static function active_menu($page_name="home", $word = "active",$no_class=true){
    global $title;

    if ($title == $page_name){
          if ($no_class)
        echo 'class = "'.$word.'"';
          else
              echo $word;
    }

  }

  #-############################################
  # Display Side Menu
  #-############################################
 public static function side_menu($current_id=0,$current_parent=0){
    # -- Make Database connection
    global $db;

    $output = array();

    # -- Get all other pages
    self::$order_by = " ORDER BY id ASC ";
    $parent = self::get_parent();
    self::$order_by = " ORDER BY parent_id ASC, name ASC ";
    $pages = self::get_all();

    # Get the Page Name
    $page_name = 'page';
   
    $parent_header = array();


    foreach ($pages as $page) {

      extract($page);  


      # -- if the page is a parent
      # -- set its id as the parent id
      if ($parent_id == 0){
        $parent_id = $id;
      } 

      # -- Change the Page based on the parent
      # -- The School
      if ($parent_id == self::THE_SCHOOL) {
        $page_name = 'the-school';
      } else if ($parent_id == self::PROGRAMMES) {
        $page_name = 'programmes';
      }

       
      # -- if this is the first time the header is used
      # -- save it in an array to show that the header 
      # -- has been used.
      if (!in_array($parent[$parent_id], $parent_header)){

          # -- Add the heading to the array
          $parent_header[] = $parent[$parent_id];

          # --Get the Current Parent
          $in = "";
          if ($current_parent == $parent_id) {
            $in = ' in';
          }


          # -- Output the Header Code
          $output[$parent_id] = ' <!-- '.$parent[$parent_id].' -->
                                <a href="#collapse'.$parent_id.'" class="list-group-item header" data-toggle="collapse"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;'. $parent[$parent_id].'</a>

                                <div id="collapse'.$parent_id.'" class="collapse'.$in.'">
            ';
      }
      # -- Get the Active page
      $active = "";
      if ($current_id == $id) {
        $active = ' active';
      }

      $output[$parent_id] .= '<a href="'.URL::href($page_name.'/'.$page['url_name']).'" class="list-group-item small'.$active.'"><span class="fa fa-caret-right"></span> &nbsp;&nbsp;'.$page['name'].'</a>';


    }   

    $final_output = "";

    ksort($output);
    foreach ($output as $result) {
     $final_output .= $result;
    # -- Close the last Header 
    $final_output .= '</div>';

    }

    # -- Display all the pages
    echo '<aside class="sidebar">
            <div class="list-group">
              <span class="list-group-item top header">Side Menu</span>
          '. $final_output.'
            </div>
         </aside>';
    return;
  }  


  public static function generate_main_menu($all_pages,$page_id,$page_url='page'){

    $pages = $all_pages[$page_id];
    $output = "";

    if (count($pages) >= 6){
      # --generate dropdown
      $output .= "\n\n".'<li class="'. self::current_menu($page_id) .'dropdown yamm-fw">
                  <a href="'.URL::href($page_url.'/'.URL::readable($pages[0])).'" class="dropdown-toggle" data-toggle="dropdown">'.$pages[0].' <span class="caret"></span></a>';

      $total = count($pages);
      $limit = floor($total / 3);

      $count = 0;
      $present_column = 1;

      $parent_header = array();

      # -- Start the Mega Menu
      $output .= "\n\n".'<div class="dropdown-menu">
                            <div class="mega-menu">
                            <h4>'.$pages[0].'</h4>
                                <div class="row">';

      $output .= "\n\n".'<div class="col-sm-4">';
      $output .= "\n\t".'<ul class="list-unstyled">';

      sort($pages);
      foreach ($pages as $page) {


        # -- Should it break into a new column
        if ($count >= $limit && $present_column <= 3){
        
          $output .= "\n\t"."</ul>";

          # --reset count
          $count = 0;
          $present_column++;
          # -- close column
          $output .= "\n"."</div>";
          # -- Introduce new column 
          $output .= "\n\n".'<div class="col-sm-4">';

          $output .= "\n\t".'<ul class="list-unstyled">';
        } 

        $output .= "\n\t\t".'<li><a href="'.URL::href($page_url.'/'.URL::readable($page)).'"><i class="fa fa-caret-right"></i> &nbsp;&nbsp; '.$page.'</a></li>';

        $count++;
      
      }


      $output .= '</ul></div>';


      $output .= '
                                                </div>
                                            </div>
                                        </div>
                                        </li>';
    }
    else if (count($pages) > 1){
      # --generate dropdown
      $output .= "\n\n".'<li class="'. self::current_menu($page_id) .'dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$pages[0].' <span class="caret"></span></a>';

      $output .= "\n\t".'<ul class="dropdown-menu" role="menu">';
      foreach ($pages as $page) {
        $output .= "\n\t\t".'<li><a href="'.URL::href($page_url.'/'.URL::readable($page)).'">'.$page.'</a></li>';
      }           
      $output .= "\n\n\t".'</ul>
                  </li>';
    } else if (!empty($pages)) {
      $output = '<li class="'. self::current_menu($page_id) .'"><a href="'.URL::href($page_url.'/'.URL::readable($pages[0])).'">'.$pages[0].'</a></li>';
    }

    echo $output;
    return;

  }
  public static function all_menu_pages(){
    global $db;
    # -- Start Query
    $query = "SELECT id,name,parent_id FROM ".self::$table;
    $pages = $db->fetch_all_rows($query);

    $output = array();

    foreach ($pages as $page) {
      extract($page);
      if ($parent_id == 0){
        $parent_id = $id;
      }

      $output[$parent_id][] = $name;
    }

    return $output;
  } 

  #-############################################
  # Live Edit
  #-############################################
  public static function live_edit_url($url_name,$page_id,$parent_id){
    # -- Make Database connection
    global $db;

    $output = "";
    # -- if the page is a parent
    # -- set its id as the parent id
    if ($parent_id == 0){
      $parent_id = $page_id;
    }

    $page_name = 'page.php';

    # -- Get the parent page
    $editable_url = URL::href($page_name.'?p='.$url_name.'&editable=1');
    echo $editable_url;
    return;
  }
  #-############################################
  # Display Page Description
  #-############################################
  public static function description($content){
    $content = strip_tags($content);
    $content = trim($content);
    $content = Text::truncate($content,500,"."," ");

    return $content;
  }

  #-############################################
  # Generate Breadcrumb
  #-############################################
  public static function breadcrumb($name,$pages=array(),$alumni=false){

    $breadcrumb = '
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6"><h2>'.$name.'</h2></div>
                        <div class="col-sm-6 hidden-xs">
                            <ol class="breadcrumb text-right">';

                              if (isset($alumni) && ($alumni)){
                                $breadcrumb .= '<li><a href="'.URL::href('alumni').'">Alumni</a></li>';
                              } else {
                                $breadcrumb .= '<li><a href="#">Home</a></li>';
                              }

               foreach ($pages as $page_name => $page_url){
                          if ($page_url == "#"){
                            $breadcrumb .= '<li class="active"><a href="#">'.$page_name.'</a></li>';
                          } else {
                            $breadcrumb .= '<li><a href="'.URL::href($page_url).'">'.ucwords($page_name).'</a></li>';
                          }

                        }
                        $breadcrumb .= '

                      </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    echo $breadcrumb;

    return;
  }


  public static function current_menu($page){
    global $title;

    if (isset($title) && ($title == $page))
      return "active ";

    return;
  }


} # --end class
