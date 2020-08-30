<?php
//POPULATES JAVASCRIPT PRODUCT OBJECT AND OPTIONS NOT CLASSIFIED

?>

<script>
 
    <?php $product = getProduct($productId); ?>
    
    let <?php echo lowerCase($product['title']); ?> = new Product(<?php echo '"' . $product['id'] . '" , "' . $product['title'] . '"'; ?>);
    
    let product = <?php echo lowerCase($product['title']); ?>
        
    //SAVES OPTIONS NOT CLASSIFIED TO AN ARRAY
    
    /*let noClassify = [<?php var_dump($noClassify); echo implode(" ,", $noClassify); ?>];*/
    
    //SAVES ALL CATEGORIES TO JAVASCRIPT OBJECTS AND ADDS TO PRODUCT'S CATEGORY ARRAY
    <? $categories = getAllCategories($productId);
    //title, displayTitle, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    foreach ($categories as $category) { ?>
        <?php echo 'const ' . lowercase($category['category_title']) . 'C = new Category(';
            //title                            
            $output = '"' . lowercase($category['category_title']);
            $output .= 'C", ';
                                        
            //id                            
            $output .= '"' . lowercase($category['id']);
            $output .= '", ';
                                        
            //display title                            
            $output .= '"' . $category['category_title'];
            $output .= '", ';
                                        
            //label_clr                             
            $output .= '"' . lowerCase($category['label_clr']);
            $output .= '", ';
                                        
            //btn_clr
            if (empty($category['btn_clr'])){
              $output .= 'null, ';
            } else {
              $output .= '"' . lowerCase($category['btn_clr']);
              $output .= '", ';    
            }
                                        
            //btn_hvr_clr                            
            $output .= '"' . lowerCase($category['btn_hvr_clr']);
            $output .= '", ';
                                        
            //btn_txt_clr
            $output .= '"' . lowerCase($category['btn_txt_clr']);
            $output .= '", ';
                                        
            //btn_txt_hvr_clr
            $output .= '"' . lowerCase($category['btn_txt_hvr_clr']) . '"';
            echo $output;                                         ?>); <?php 
                                       
    $output = lowerCase($product['title']) . '.addCategory(';                               $output .=  lowercase($category['category_title']) . 'C';
    $output .= '); ';
    echo $output;
    
    echo " \r\n ";
    } 
    
    
    //SAVES ALL GROUPS TO JAVASCRIPT OBJECTS AND ADDS TO CATEGORY'S GROUP ARRAY
    $groups = getAllDisplayGroups($productId);
        
    //echo print_r($groups);
    
    foreach ($groups as $group) { ?>
        <?php 
            $output = 'const ' . lowerCase($group['group_title']) . 'G';
            $output .= lowerCase($group['dg_id']) . ' = ';
            $output.= 'new Group(';
        
            //id
            $output .= $group['dg_id'] . ' ,';
        
            //title
            $output .= '"' . $group['group_title'] . '" ,';
        
        
            //description
            if (empty($group['description'])) {
              $output .= 'null ,';  
            } else {
              $output .= '"' . $group['description'] . '" ,';
            }
        
            //oneSelection
            $output .= '"' . $group['one_selection'] . '" ,';
        
            //requireFirst
            $output .= $group['require_first'];
        
            $output .= ');';
            echo $output;
                                 
            echo ' ' . lowerCase($group['category_title']) . 'C'; ?>.addGroup(<?php
            $output = lowerCase($group['group_title']) . 'G';
            $output .= lowerCase($group['dg_id']);
            echo $output;
        
            echo " \r\n "; echo " \r\n "; 
        ?>);
        
    <?php } 
    
    //id, selectId, selectTitle, title, radio, addedPrice, position, dependsOne, dependsCase, dependsTwo, notifyText, notifyType
    //const camila = new Option(1, null, null, 'camila', null, 1, null, null, null, null, null);
    //console.log(camila);
    //modelG1.addOption(camila);
    
    //SAVES ALL OPTIONS TO JAVASCRIPT OBJECTS AND ADDS TO GROUPS'S OPTION ARRAY
    foreach ($groups as $group) {
        $dgId = $group['dg_id'];
        $dgObject = lowerCase($group['group_title']) . 'G' . $group['dg_id'];
        
        global $product;
        
        $options = getTabOneSelect($dgId);
        
        foreach ($options as $option) {
            $output = 'const ' . lowerCase($option['option_title']) . 'O' . $option['id'] .  ' = ';
            $output .= 'new Option(';
            
            //id
            $output .= $option['id'] . ', ';
            
            //select group id
            if (empty($option['select_group_id'])){
                $output .= 'null, ';
            } else {
                $output .= $option['select_group_id'] . ', "';
            }
            
            //select group title
            if (empty($option['select_title'])){
                $output .= 'null, ';
            } else {
                $output .= $option['select_title'] . '", ';
            }
            
            //title
            $output .= '"' . lowerCase($option['option_title']) . '", ';
            
            //display title
            $output .= '"' . $option['option_title'] . '", ';
            
            //radio
            if ($option['one_select'] == 0) {
                $output .= 'false, ';
            } else {
                $output .= 'true, ';
            }
            
            //added price
            if (!empty($option['added_price'])) {
                $output .= $option['added_price'] . ', ';
            } else {
                $output .= 'null, ';
            }
            
            //position
            if (!empty($option['position'])) {
                $output .= $option['position'] . ', ';
            } else {
                $output .= 'null, ';
            }
            
            //depends_one
            if (!empty($option['depends_one'])) {
                $output .= $option['depends_one'] . ', ';
            } else {
                $output .= 'null, ';
            }
            
            
            //default_option
            if (!empty($option['default_option'])) {
                $output .= $option['default_option'] . ', ';
            } else {
                $output .= 'null, ';
            }
            
            //notify txt
            if (!empty($option['notify_txt'])) {
                $output .= '"' . $option['notify_txt'] . '", ';
            } else {
                $output .= 'null, ';
            }
            
            //notify type
            if (!empty($option['notify_type'])) {
                $output .= '"' . $option['notify_type'] . '", ';
            } else {
                $output .= 'null,';
            }
            
            //required
            if (!empty($option['required'])) {
                $output .= $option['required'] . '); ';
            } else {
                $output .= 'null' . '); ';
            }
            
            echo $output;
            
            
            $output = $dgObject . '.addOption(' . lowerCase($option['option_title']) . 'O' . $option['id'] . '); ';
                
            echo $output;
            
            echo " \r\n ";
        }
        
    }

    ?>
    
    //logs product
    console.log(<?php echo lowerCase($product['title']) ?>);
    
    //logs categories
    //console.log(<?php echo lowerCase($product['title']) ?>.categories);
            
    </script>