<?php 

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */

/*
    the Request() function initializes a new Request Object, which is is an object-oriented representation of the HTTP request message.
*/
function request() {
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function camelCase($input) {
    $output = str_replace("-", "", lcfirst(str_replace(" ", "", ucwords(strtolower($input)))));
    return $output;
}

function lowerCase($input) {
    $output = str_replace("-", "", str_replace(" ", "", strtolower($input)));
    return $output;
}

function dollarFormat($amount) {
    $amount = $amount / 100;
    $output = number_format($amount, 2);
    $output = lowercase($output);
    if ( strpos($output,'.00') ) {
        $output = str_replace(".00", "", $output);
        return '$' . $output;
    } else {
        return '$' . $output;
    }
}

function getGenSettings() {
    global $db;
   try {
        $query = "SELECT * FROM General";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getProduct($productId) {
   global $db;
   try {
        $query = "SELECT * FROM Products WHERE id = :productId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        $output = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
    return $output;
}

//fetch is used to get one row
//$productId currently set in header
function getProductTitle($productId) {
   global $db;
   try {
        $query = "SELECT * FROM Products WHERE id = :productId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        $productRow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
    return camelCase($productRow['title']);
}

function getCategoryTitle($id) {
   global $db;
    
   try {
        $query = "SELECT category_title FROM Category WHERE id = :categoryId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categoryId', $id);
        $stmt->execute();
        $cTitle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
    return $cTitle;
}  

function getGroupTitle($id) {
   global $db;
    
   try {
        $query = "SELECT group_title FROM Display_Group WHERE id = :groupId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':groupId', $id);
        $stmt->execute();
        $groupTitle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
    return $groupTitle;
}    

//fetchAll() is used b/c returning multiple rows
function getAllCategories($productId) {
    global $db;
    
   try {
        $query = "SELECT * FROM Category WHERE product_id = :productId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

//fetchAll() is used b/c returning multiple rows
function getAllDisplayGroups($productId) {
   global $db;
    
  try {
        $query = "SELECT *, Display_Group.id AS dg_id FROM Display_Group JOIN Category on Display_Group.category_id = Category.id WHERE product_id = :productId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

//fetchAll() is used b/c returning multiple rows
/*function getDisplayGroupIds() {
   global $db;
    
   $input = getCategoryIds();
    
   try {
        $query = "SELECT * FROM Display_Group WHERE category_id IN (:input)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':input', $input);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}*/

//fetchAll() is used b/c returning multiple rows
function getAllOptions() {
    global $db;
    
   try {
        $query = "SELECT * FROM Options";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function addBtnStyles() {
    global $productId;
    global $colorNav;
    $categories = getAllCategories($productId);
    $btnStyle = '<style>';
    foreach ($categories as $category) {
        
        //TOP NAV
        $className = '.top-nav-' . str_replace(' ', '', strtolower($category['category_title'])) . '-' . $category['id'];
        $btnStyle .= $className . ' {  ';
        
        if ($colorNav == 1) {
            $btnStyle .= 'background-color: #' . $category['btn_clr'] . '; ';
        }
        
        if ($colorNav == 0) {
            $btnStyle .= 'background-color: none; ';
        }
        
        if (!empty($category['btn_txt_clr'])) {
        $btnStyle .= 'color: #' . $category['btn_txt_clr'] . '; ';
        }
        
        $btnStyle .= ' } ';
        
        $btnStyle .= $className . ':hover, ' . $className . ':focus { ';
        
        if (!empty($category['btn_txt_hvr_clr'])) {
        $btnStyle .= 'color: #' . $category['btn_txt_hvr_clr'] . '; ';
        }
        
        $btnStyle .= 'text-decoration:none; ';
        
        if (!empty($category['btn_hvr_clr'])) {
            $btnStyle .= 'background-color: #' . $category['btn_hvr_clr'] . '; ';
        }
        
        $btnStyle .= ' } ';
        
        //INSIDE NAV
        $className = '.inside-nav-' . str_replace(' ', '', strtolower($category['category_title'])) . '-' . $category['id'];
        $btnStyle .= $className . ' {  ';
        
        if (!empty($category['btn_clr'])) {
            $btnStyle .= 'background-color: #' . $category['btn_clr'] . '; ';
        }
        
        if (!empty($category['btn_txt_clr'])) {
        $btnStyle .= 'color: #' . $category['btn_txt_clr'] . '; ';
        }
        
        $btnStyle .= ' } ';
        
        $btnStyle .= $className . ':hover, ' . $className . ':focus { ';
        
        if (!empty($category['btn_txt_hvr_clr'])) {
        $btnStyle .= 'color: #' . $category['btn_txt_hvr_clr'] . '; ';
        }
        
        $btnStyle .= 'text-decoration:none; ';
        
        if (!empty($category['btn_hvr_clr'])) {
            $btnStyle .= 'background-color: #' . $category['btn_hvr_clr'] . '; ';
        }
        
        $btnStyle .= ' } ';
        
        
    }
    
    $btnStyle .= '</style>';
    return $btnStyle;
}

function addOuterBtn($category, $yesNo = 'no') {
    global $pName;
    $label = str_replace(' ', '', strtolower($category['category_title'])) . '-' . $category['id'];
    
    $btnHtml = '<div class="top-nav" id="heading';
    $btnHtml .= $label . '"> ';
    
    //ADD ONCLICK FUNCTION FOR CATEGORY BELOW---------------------
    $btnHtml .= '<button onclick="cClick(' . $pName . ', ' . lowerCase($category['category_title']) . 'C)" id="top-id-' . $label . '" class="btn text-left collapsed top-nav-' . $label;
    $btnHtml .= ' nav-txt mt-2" type="button" data-toggle="collapse" data-target="#collapse' . $label . '" aria-expanded="true" aria-controls="collapse' . $label . '">';
    $btnHtml .= '<img class="marker mr-2" src="/img/';
    $btnHtml .= $yesNo;
    $btnHtml .= '-min.png">';
    $btnHtml .= $category['category_title'];
    $btnHtml .= '</button></div>';

    
    return $btnHtml;
}

function addCollapse($category, $yesNo = 'no') {
    global $db;
    $categoryId = $category['id'];
    try {
        $query = "SELECT * FROM Display_Group WHERE category_id = :categoryId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->execute();
        $displayGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
    //echo print_r($displayGroups);
    
    $categoryLabel = str_replace(' ', '', strtolower($category['category_title'])) . '-' . $category['id'];
    
        
    $groupHtml = '<div id="collapse' . $categoryLabel . '" class="collapse m-0 p-0" aria-labelledby="heading' . $categoryLabel . '" data-parent="#accordionNav"> ';
    $groupHtml .= '<div class="card-body m-1 p-1"> <div style="display:block;" class="nav top-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical"> ';
    $a = 0;
    foreach ($displayGroups as $displayGroup) {
        global $pName;
        //echo print_r($displayGroup);
        $displayGroupLabel = str_replace(' ', '', strtolower($displayGroup['group_title'])) . $displayGroup['id'];
        
        //ADD ONCLICK FUNCTION FOR GROUP BELOW
        $groupHtml .= '<button onclick="gClick(' . $pName . ', ' . lowerCase($category['category_title']) . 'C, ' . lowerCase($category['category_title']) . 'C.groups[' . $a . '])" id="id-' . $displayGroupLabel . '" style="display:block;" class="btn top-nav-' . $categoryLabel . ' inner-nav-txt mb-2" id="v-pills-';
        $groupHtml .= $displayGroupLabel . '-tab" data-toggle="pill" href="#v-pills-';
        $groupHtml .= $displayGroupLabel . '"><img class="inner-marker mr-2" src="/img/';
        $groupHtml .= $yesNo . '-min.png">' . $displayGroup['group_title'] . '</button>';
        $a++;
    }
    
    $groupHtml .= '</div></div></div>';
    return $groupHtml;
}

function addNav() {
    global $productId;
    $categories = getAllCategories($productId);
    $navHtml= '';
    foreach ($categories as $category) {
        $navHtml .= addOuterBtn($category, 'yes');
        
        $navHtml .= addCollapse($category, 'yes');
    }
    return $navHtml;
}

function getTabArray($dgId) {
    global $db;
   try {
        $query = "SELECT * FROM Options WHERE display_group_id = :dgId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dgId', $dgId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getTabOneSelect($dgId) {
    global $db;
   try {
        $query = "SELECT Options.*, Select_Group.one_select FROM Options 
	    LEFT JOIN Select_Group on Options.select_group_id = Select_Group.id
		WHERE display_group_id = :dgId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dgId', $dgId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getSelectRow($select) {
    global $db;
   try {
        $query = "SELECT * FROM Select_Group WHERE id = :select";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':select', $select);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}


function getCategory($cId) {
    global $db;
   try {
        $query = "SELECT category_title FROM Category WHERE id = :cId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':cId', $cId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getAllOptionsFromSelect($selectId) {
    global $db;
   try {
        $query = "SELECT category_id, display_group_id, group_title, Options.id as option_id, option_title, added_price, depends_one, depends_two FROM Options
		JOIN Display_Group on Options.display_group_id = Display_Group.id
        WHERE select_group_id = :selectId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':selectId', $selectId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

//fetch was used to return a single row
function getOptionViews($optionId) {
    global $db;
   try {
        $query = "SELECT * FROM Option_Views WHERE options_id = :optionId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':optionId', $optionId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

//$optionWithView is an array with all options in a specific display group
function buildStyle($optionArray) {
        $output = '';
    
    for($i = 0; $i < count($optionArray); $i++) {
        
        $output .= '#' . lowerCase($optionArray[$i]['option_title']) . '_' . $optionArray[$i]['id'] . ' { ';
        
        $output .= ' position: absolute; ';
        
        $output .= 'top: ' . $optionArray[$i]['top1'] . '%; ';
            
        $output .= 'left: ' . $optionArray[$i]['left1'] . '%; ';
            
        $output .= 'max-width: ' . $optionArray[$i]['max_width1'] . 'px; ';
            
        $output .= 'width: ' . $optionArray[$i]['width1'] . '%; ';
            
        $output .= 'z-index: ' . $optionArray[$i]['z_index1'] . '; ';
            
        $output .= 'opacity: 0; ';
        
        $output .= '} ';
        
    }
    
    return $output;
    //echo print_r($optionArray);
}

function addOptionStyles() {
    global $productId;
    $displayGroups = getAllDisplayGroups($productId);
    $output = '<style> ';
//FOR EACH DISPLAY GROUP - ASSOCIATIVE ARRAY
    foreach ($displayGroups as $displayGroup) {
    global $db;
        
    $dgId = $displayGroup['dg_id'];
    
    try {
        $query = "SELECT * FROM Options 
        JOIN Option_Views on Options.option_views_id = Option_Views.options_id
        WHERE display_group_id = :dgId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dgId', $dgId);
        $stmt->execute();
        $optionWithView = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
        
        //this function is defined above
        $output .= buildStyle($optionWithView);
        //echo print_r($OptionWithView);
        //echo $optionWithView[0]['option_title'];
        
        //echo '<br/></br>';
        
       
        
    }
    $output .= '</style> ';
    return $output;
    
}

function categoryFromDG($digId) {
    global $db;
   try {
        $query = "SELECT category_id, category_title FROM Display_Group 
            JOIN Category ON Display_Group.category_id = Category.id
            WHERE Display_Group.id = :digId";
        $stmt = $db->prepare($query);
        $stmt->bindParam('digId', $digId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
    
}

//<img id="camila_1" src="img/camila_template.svg">
function buildElement($arrayIn) {
    $output = '';
    
    for($i = 0; $i < count($arrayIn); $i++) {
        
        $title = $arrayIn[$i]['option_title'];
        $imgSrc = $arrayIn[$i]['img_src1'];
        $imgId = $arrayIn[$i]['id'];
    
        $output .= '<img id ="' . lowerCase($title) . '_' . $imgId . '" ';
        $output .= 'src="' . $imgSrc . '"> ';
    }
    return $output;
}


function addImgElements() {
    global $productId;
    $displayGroups = getAllDisplayGroups($productId);
    $output = '';
//FOR EACH DISPLAY GROUP - ASSOCIATIVE ARRAY
    foreach ($displayGroups as $displayGroup) {
    global $db;
        
    $dgId = $displayGroup['dg_id'];
    
    try {
        $query = "SELECT id, option_title, img_src1 FROM Options 
        JOIN Option_Views on Options.option_views_id = Option_Views.options_id
        WHERE display_group_id = :dgId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dgId', $dgId);
        $stmt->execute();
        $optArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
        
        //this function is defined above
        $output .= buildElement($optArray);
       
        
    }
    
    return $output;
    
}

/*******************

$selectRowArray: (enabled, title, required)
    is a single row in the Select_Group table 
    
$selectContents:
    is an array of multiple rows is the Options table
    
<div class="btn-group">

  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  
  <div class="dropdown-menu">
    <a onclick="oClick(revomereguitar, modelG1, camilaO1)" class="dropdown-item dropBtn">Action</a>
    <a class="dropdown-item dropBtn">Another action</a>
    <a class="dropdown-item dropBtn">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item dropBtn">No Selection</a>
  </div>
  
</div>


<a class="dropdown-item" href="#"><div class="circle-ctn">
        <div class="circle"></div><div class="inside-circle"></div>
    </div><span class="btn-txt">Action</span></a>
    
*/
function buildSelectInput($selectRowArray, $selectContents, $groupOneSelection) {
    global $pName;
    //$selectRowArray is a single row in Select Group table
    //echo print_r($selectRowArray);
    //echo $selectRowArray['one_select'];
    //echo '<br><br>';

    //echo print_r($selectContents);
    //echo '<br><br>';
    
    $cId = $selectContents[0]['category_id'];
    $categoryArray = getCategory($cId);
    $category = lowerCase($categoryArray['category_title']) . '-' . $cId;
    $group = lowerCase($selectContents[0]['group_title']) . 'G' . $selectContents[0]['display_group_id'];
    $oneSelect = $selectRowArray['one_select'];
    //echo '<br><br>';
    //echo $category;
    
    //THE SELECT BUTTON-------------------------------------------------------
    $output = '<div id="select_' . $selectRowArray['id'] . '" ';
        
    $output .= 'class="btn-group';
    
    if( !empty($selectRowArray['depends_one']) || !empty($selectRowArray['depends_two']) ){
        $output .= ' noVis ';
    } 
        
    $output .= '"><button type="button" class="btn opt-btn inside-nav-'; 
    $output .= $category;
    $output .= ' dropdown-toggle mx-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    //$output .= $selectRowArray['id'] . ' - ';
    $output .= $selectRowArray['select_title'] . '</button>';
    
    $output .= '<div class="dropdown-menu">';
    
    //ADD ADDED PRICE PILLS
    foreach($selectContents as $option) {
        
        $output .= '<a onclick="oClick(' . $pName . ', ' . $group . ', ';
        $output .= lowerCase($option['option_title']) . 'O' . $option['option_id'];
        $output .= ')" id="';
        
        $output .= lowerCase($option['option_title']) . '_btn_' . $option['option_id'];
        
        $output .= '" class="';
        
        //DEPENDANTS HIDE ON PAGE LOAD ----------------------------------
        /*if (!empty($option['depends_one']) || !empty($option['depends_two'])) {
            $output .= "noVis ";
        }*/
        
        $output .= 'dropdown-item dropBtn">';
        
        if ( $groupOneSelection == 0 && $oneSelect == 0) {
            //CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN 
            $output .= '<div class="circle-ctn"><div class="box"></div><img id="';
            $output .= lowerCase($option['option_title']) . '_check_' . $option['option_id'];
            $output .= '" src="inc/check_sm-min.png" class="inside-box noVis';
            $output .= '"></div> ';
        } else {
            //Radio Button
            $output .= '<div class="circle-ctn">
            <div class="circle"></div><div id="';
            $output .= lowerCase($option['option_title']) . '_radio_' . $option['option_id'];
            $output .= '" class="inside-circle noVis"></div>
            </div>';
        } 
        
        $output .= '<span class="btn-txt">';
        $output .= $option['option_title'] . '</span>';
        
        if (!empty($option['added_price'])) {
            $output .= '<span class="badge badge-pill badge-light ml-2">+';
            $output .= dollarFormat($option['added_price']);
            $output .= '</span>';
        }
        $output .= '</a> ';
        //$views = getOptionViews($option['option_views_id']);
        //$output .= $option['id'] . ' - top1:' . $views['top1'];
        //$output .= $option['option_title'] . '</br></br></br></br>';
    }
    $output .= '</div></div>';
    
    return $output;
}


/*<button onclick="oClick(revomereguitar, fretboardG5, rosewoodO11)" id="rosewood_btn_11" class="btn inside-nav-wood-2 mx-2 " type="submit">
    
    <div class="circle-ctn">
        <div class="circle"></div><div class="inside-circle noVis"></div>
    </div> 
    
    <span class="btn-txt">Rosewood</span>
    
</button>*/
        


/********************
$tabOption:
    is a single row in the Options table 
*/
function buildButton($tabOption, $groupObject, $groupOneSelection) {
    //echo print_r($tabOption['display_group_id']);
    //echo '<br><br>';
    
    global $pName;
    
    $dgrId = $tabOption['display_group_id'];
    //echo $dgrId;
    $category = categoryFromDG($dgrId);
    //echo print_r($category);
    
    $output = '';
    
    //IF GROUP ONE SELECTION TRUE, BUILD BUTTON
    if ($groupOneSelection == 1) {
        
        $output .= '<button onclick="';
        $output .= 'oClick(';
        
        //product
        $output .= $pName . ', ';
        
        
        //group
        $output .= $groupObject . ', ';
    
        
        //path
        //shapeC.groups[0].options[0]
        $output .= lowerCase($tabOption['option_title']) . 'O' . $tabOption['id'];
        
        $output .= ')" id = "';
        $output .= lowerCase($tabOption['option_title']) . '_btn_' . $tabOption['id']; 
        $output .= '" class="btn opt-btn inside-nav-';
        $output .= lowerCase($category['category_title']) . '-' . $category['category_id'];
        $output .= ' mx-2 ';
        
        //DEPENDANTS HIDE ON PAGE LOAD ----------------------------------
        if (!empty($tabOption['depends_one']) || !empty($tabOption['depends_two'])) {
            $output .= "noVis";
        }
        
        $output .= '" type="button">';
        
        //RADIO BUTTON RADIO BUTTON RADIO BUTTON RADIO BUTTON RADIO BUTTON 
        
        $output .= '<div class="circle-ctn"><div class="circle"></div><div id="'; 
        $output .= lowerCase($tabOption['option_title']) . '_radio_' . $tabOption['id'];
        $output .= '" class="inside-circle noVis"></div>
        </div> <span class="btn-txt">';
        
        $output .= $tabOption['option_title'];
        
        $output .= '</span>';

        if (!empty($tabOption['added_price'])) {
            $output .= '<span class="badge badge-pill badge-light ml-2">+';
            $output .= dollarFormat($tabOption['added_price']);
            $output .= '</span>';
        }
    
        $output .= '</button>';
        
        
    //IF GROUP ONE SELECTION FALSE, BUILD TOGGLE
    } else {
/*<button onclick="oClick(revomereguitar, fretboardG5, rosewoodO11)" id="rosewood_btn_11" class="btn inside-nav-wood-2 mx-2 " type="submit">
    
    <div class="circle-ctn">
        <div class="box"></div><img src="inc/check_sm-min.png" class="inside-box">
    </div> 
    
    <span class="btn-txt">Rosewood</span>
    
</button>*/
        
    
    $output .= '<button onclick="oClick(';
    //product
    $output .= $pName . ', ';
          
    //group
    $output .= $groupObject . ', ';
      
    //path
    //shapeC.groups[0].options[0]
    $output .= lowerCase($tabOption['option_title']) . 'O' . $tabOption['id'];
        
    $output .= ')" id = "';
    $output .= lowerCase($tabOption['option_title']) . '_btn_' . $tabOption['id']; 
    $output .= '" class="btn opt-btn inside-nav-';
    $output .= lowerCase($category['category_title']) . '-' . $category['category_id'];
    $output .= ' mx-2 ';
        
    //DEPENDANTS HIDE ON PAGE LOAD ----------------------------------   
    if (!empty($tabOption['depends_one']) || !empty($tabOption['depends_two'])) {
            $output .= "noVis";
    }
        
    $output .= '" type="button">';
        
    //CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN CHECK BOX BTN 
    $output .= '<div class="circle-ctn"><div class="box"></div><img id="';
    $output .= lowerCase($tabOption['option_title']) . '_check_' . $tabOption['id'];
    $output .= '" src="inc/check_sm-min.png" class="inside-box noVis';
    $output .= '"></div> <span class="btn-txt">';
    
    $output .= $tabOption['option_title'];   
        
     if (!empty($tabOption['added_price'])) {
            $output .= '<span class="badge badge-pill badge-light ml-2">+';
            $output .= dollarFormat($tabOption['added_price']);
            $output .= '</span>';
    }
    
    $output .= '</button>';   
        
    }
    
    $output .= '';
    
    return $output;
}




//BUILDS JS ONCLICK FUNCTION TO:
    //search options for dependancy on this id
        //if true and only dependancy
            //select option and remove noVis class
        //if false and has OR depends case
            //select option and remove noVis class
        //if flase and has AND depends case,
            //
/*function btnOptionOnclick($tabOption) {
    
    $groupId = $tabOption['display_group_id'];
    $groupAttr = getGroupAttr($groupId);
    
    //DOES GROUP ALLOW ONE OR MULTIPLE SELECTIONS?
    $one_selection = $groupAttr[0]['one_selection'];
    
    //IS GROUP REQUIRED FIRST? 0 = false, lower numbers required first
    $require_first =  $groupAttr[0]['require_first'];
    
    //DEPENDS ON TO SHOW
    $d1 =  $tabOption['depends_one'];
    $dc =  $tabOption['depends_case'];
    $d2 =  $tabOption['depends_two'];
    
    $cssId = lowerCase($tabOption['option_title']) . '_' . $tabOption['id'];
    
    echo 'title: ' . $tabOption['option_title'] . '<br>';
    echo 'id: ' . $cssId . '<br>';
    echo 'one_selection: ' . $one_selection . '<br>';
    echo 'require_first: ' . $require_first . '<br>';
    echo 'depends_one: ' . $d1 . '<br>';
    echo 'depends_case: ' . $dc . '<br>';
    echo 'depends_one: ' . $d2 . '<br>';
    echo '<br></br>';
}*/



function addTabContent() {
    global $productId;
    $displayGroups = getAllDisplayGroups($productId);
    
    $tabHtml = '<div class="tab-content" id="v-pills-tabContent"> ';
    
//FOREACH display group with product ID
    foreach ($displayGroups as $displayGroup) {
        $tabLabel = lowerCase($displayGroup['group_title']) . $displayGroup['dg_id'];
        
        $groupObject = lowerCase($displayGroup['group_title']) . 'G' . $displayGroup['dg_id'];
    
        $groupOneSelection = $displayGroup['one_selection'];
        
//MAKE TAB HTML
        $tabHtml .= '<div class="tab-pane fade" id="v-pills-';
        $tabHtml .= $tabLabel;
        $tabHtml .= '" role="tabpanel">';
        
        //add tab content below:
        $tabHtml .= '<h4>' . $displayGroup['group_title'] . ' Content</h4><br/><br/>';
        
        //$tabHtml .= 'HELLO' . $displayGroup['id'];
        
//GETS ALL OPTIONS FROM DISPLAY GROUP IDS
        $tabOptions = getTabArray($displayGroup['dg_id']);
        //echo print_r($tabOptions) . '<br><br>';
        
        
        $selectArray = [];
        
        //for each tab option, build the input
        foreach ($tabOptions as $tabOption) {
            //$tabHtml .= gettype($tabOption['select_group_id']);
            
            
/*if: 
    select_group_id
            AND
              select_group_id not in the array
*/
            if ( !empty($tabOption['select_group_id']) && !in_array( $tabOption['select_group_id'], $selectArray) ) {
                
                $selectArray[] .= $tabOption['select_group_id'];
                
                //echo implode(' ,', $selectArray) . "<br></br>";
                    
                //array contain all options inside a single Select input
                $selectContents = getAllOptionsFromSelect($tabOption['select_group_id']);
                //echo print_r($tabOption['select_group_id']);
                //**************************
                $selectRowArray = getSelectRow($tabOption['select_group_id']);
                
                //$tabHtml.= selectOptionOnclick($tabOption);
                $tabHtml .= buildSelectInput($selectRowArray, $selectContents, $groupOneSelection);
                
                
            /*elseif: 
                select_group_id
                    AND
                        select_group_id in the array
            */    
            } elseif ( !empty($tabOption['select_group_id']) && in_array( $tabOption['select_group_id'], $selectArray) ) {
                //do nothing
            } else {
                //$tabHtml.= btnOptionOnclick($tabOption);
                $tabHtml.= buildButton($tabOption, $groupObject, $groupOneSelection);
                //echo $tabOption['select_group_id'] . 'has no select group<br/><br/>';
            }
             
           
            
        }
        
    
                      
        //$tabHtml .= getInputs($displayGroup['id']);
        
        $tabHtml .= '</div>';                  
    }
    
    $tabHtml .= '</div> ';         
    return $tabHtml;
}




/*
<div class="tab-content" id="v-pills-tabContent">
                  
        
                <div class="tab-pane fade" id="v-pills-model1" role="tabpanel">Model Content</div>


                <div class="tab-pane fade" id="v-pills-PROFILE" role="tabpanel">Profile Content</div>

                <div class="tab-pane fade" id="v-pills-BODY" role="tabpanel">Body Content</div>


                <div class="tab-pane fade" id="v-pills-NECK" role="tabpanel">Neck Content</div>
      
                  
          </div>
*/




/*
<div id="collapseShape" class="collapse m-0 p-0" aria-labelledby="headingShape" data-parent="#accordionNav">
      <div class="card-body m-1 p-1">
        
          <!-- START INSIDE BUTTONS -->
          <div style="display:block;" class="nav top-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
                    <button style="display:block;" class="btn top-nav-shape-1 inner-nav-txt mb-2" id="v-pills-MODEL-tab" data-toggle="pill" href="#v-pills-MODEL"><img class="inner-marker mr-2" src="/img/no-min.png">Model</button>
        
                    
                    <button style="display:block;" class="btn top-nav-shape-1 inner-nav-txt my-1" id="v-pills-PROFILE-tab" data-toggle="pill" href="#v-pills-PROFILE"><img class="inner-marker mr-2" src="/img/no-min.png">Profile</button>

          </div>    
              
   
          <!-- END INSIDE BUTTONS -->
     
          
      </div>
    </div>
*/


/*<div class="top-nav" id="headingShape">
    <button class="btn text-left collapsed top-nav-shape-1 nav-txt mt-2" type="button" data-toggle="collapse" data-target="#collapseShape" aria-expanded="true" aria-controls="collapseShape">
    <img class="marker mr-2" src="/img/yes-min.png">Shape
    </button>
</div>*/




/* SHAPE BTN CSS 

.top-nav-shape {
    background-color: green;
}

.top-nav-shape:hover,
.top-nav-shape:focus {
    color: #FFF;
    text-decoration: none;
    background-color: #1D9CF2;
} */