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
    $output = lcfirst(str_replace(" ", "", ucwords(strtolower($input))));
    return $output;
}

function lowerCase($input) {
    $output = str_replace(" ", "", strtolower($input));
    return $output;
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
    $categories = getAllCategories($productId);
    $btnStyle = '<style>';
    foreach ($categories as $category) {
        $className = '.top-nav-' . str_replace(' ', '', strtolower($category['category_title'])) . '-' . $category['id'];
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

function getAllOptionsFromSelect($selectId) {
    global $db;
   try {
        $query = "SELECT * FROM Options WHERE select_group_id = :selectId";
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


/*#bridge_chrome {
    position: absolute;
    top: 44.6%;
    left: 12.2%;
    max-width: 73px;
    width: 5.051903114186851%;
    z-index: 35;
    opacity: 0;
}*/
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




/*******************

$selectRowArray: (enabled, title, required)
    is a single row in the Select_Group table 
    
$selectContents:
    is an array of multiple rows is the Options table
    
*/
function buildSelectInput($selectRowArray, $selectContents) {
    $output = '<h4>This is a select box:</h4>';
    $output .= $selectRowArray['id'] . ' - ';
    $output .= $selectRowArray['select_title'] . '</br></br>';
    
    $output .= 'It has the following options:</br></br>';
    foreach($selectContents as $option) {
        $views = getOptionViews($option['option_views_id']);
        $output .= $option['id'] . ' - top1:' . $views['top1'];
        $output .= $option['option_title'] . '</br></br></br></br>';
    }
    return $output;
}


/********************

$tabOption:
    is a single row in the Options table 

*/
function buildButton($tabOption) {
    $views = getOptionViews($tabOption['option_views_id']);
    
    $output = 'This is a button with the following options:</br></br>';
    $output .= $tabOption['id'] . ' - top1:' . $views['top1'];
    $output .= $tabOption['option_title'] . '<br/><br/>';
    return $output;
}


function addTabContent() {
    global $productId;
    $displayGroups = getAllDisplayGroups($productId);
    
    $tabHtml = '<div class="tab-content" id="v-pills-tabContent"> ';
    
//FOREACH display group with product ID
    foreach ($displayGroups as $displayGroup) {
        $tabLabel = str_replace(' ', '', strtolower($displayGroup['group_title'])) . $displayGroup['dg_id'];
        
//MAKE TAB HTML
        $tabHtml .= '<div class="tab-pane fade" id="v-pills-';
        $tabHtml .= $tabLabel;
        $tabHtml .= '" role="tabpanel">';
        
        //add tab content below:
        $tabHtml .= '<h4>' . $displayGroup['group_title'] . ' Content</h4><br/><br/>';
        
        //$tabHtml .= 'HELLO' . $displayGroup['id'];
        
//GETS ALL OPTIONS FROM DISPLAY GROUP IDS
        $tabOptions = getTabArray($displayGroup['dg_id']);
        
        
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
                
                $selectArray[] = $tabOption['select_group_id'];
                
                //echo implode(' ,', $selectArray) . "<br></br>";
                    
                //array contain all options inside a single Select input
                $selectContents = getAllOptionsFromSelect($tabOption['select_group_id']);
                
                //**************************
                $selectRowArray = getSelectRow($tabOption['select_group_id']);
                
                $tabHtml.= buildSelectInput($selectRowArray, $selectContents);
                
                
            /*elseif: 
                select_group_id
                    AND
                        select_group_id in the array
            */    
            } elseif ( !empty($tabOption['select_group_id']) && in_array( $tabOption['select_group_id'], $selectArray) ) {
                //do nothing
            } else {
                $tabHtml.= buildButton($tabOption);
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