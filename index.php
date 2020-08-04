<?php include __DIR__ . '/inc/header.php'; 

/***********REMOVE before flight in DATABASE.php
ini_set('display_errors', 'On');****/

echo addBtnStyles();
echo addOptionStyles();
?>



<script>
    
    
    
    <?php $product = getProduct($productId); ?>
    
    const <?php echo lowerCase($product['title']); ?> = new Product(<?php echo '"' . $product['id'] . '" , "' . $product['title'] . '"'; ?>);
    
    
    //SAVES ALL CATEGORIES TO JAVASCRIPT OBJECTS AND ADDS TO PRODUCT'S CATEGORY ARRAY
    <? $categories = getAllCategories($productId);
    //title, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    foreach ($categories as $category) { ?>
        <?php echo 'const ' . lowercase($category['category_title']) . 'C = new Category(';
            //title                            
            $output = '"' . lowercase($category['category_title']);
            $output.= 'C", ';
                                        
            //label_clr                             
            $output.= '"' . lowerCase($category['label_clr']);
            $output.= '", ';
                                        
            //btn_clr
            if (empty($category['btn_clr'])){
              $output.= 'null, ';
            } else {
              $output.= '"' . lowerCase($category['btn_clr']);
              $output.= '", ';    
            }
                                        
            //btn_hvr_clr                            
            $output.= '"' . lowerCase($category['btn_hvr_clr']);
            $output.= '", ';
                                        
            //btn_txt_clr
            $output.= '"' . lowerCase($category['btn_txt_clr']);
            $output.= '", ';
                                        
            //btn_txt_hvr_clr
            $output.= '"' . lowerCase($category['btn_txt_hvr_clr']) . '"';
            echo $output;                                         ?>); <?php 
                                       
    $output = lowerCase($product['title']) . '.addCategory(';                               $output .=  lowercase($category['category_title']) . 'C';
    $output .= '); ';
    echo $output;
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
        ?>);
        
    <?php } ?>
    
    //logs product
    console.log(<?php echo lowerCase($product['title']) ?>);
    
    //logs categories
    //console.log(<?php echo lowerCase($product['title']) ?>.categories);
    
    
    /*//ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  
    //title, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    const shapeC = new Category('shape', '1D9CF2', null, '1D9CF2', '000000', 'FFFFFF');
    //console.log(shape);
    
    guitar.addCategory(shapeC);
    //----------------------------------------------------------
    
    //ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  
    //title, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    const woodC = new Category('wood', '1D9CF2', null, '1D9CF2', '000000', 'FFFFFF');
    //console.log(shape);
    
    guitar.addCategory(woodC);
    //----------------------------------------------------------
    
     //ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  
    //title, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    const hardwareC = new Category('hardware', '1D9CF2', null, '1D9CF2', '000000', 'FFFFFF');
    //console.log(shape);
    
    guitar.addCategory(hardwareC);
    //----------------------------------------------------------
    
     //ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  ADDS CATEGORY  
    //title, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr
    const finishC = new Category('finish', '1D9CF2', null, '1D9CF2', '000000', 'FFFFFF');
    //console.log(shape);
    
    guitar.addCategory(finishC);
    //----------------------------------------------------------  
    
    
    
    
    
    //title, category, description, oneSelection, requireFirst
    const modelG1 = new Group(1, 'model', 'There are three types of models', 1, 1);
    //console.log(model);
    shapeC.addGroup(modelG1);
    
    const profileG2 = new Group(2, 'profile', '', 1, 1);
    //console.log(model);
    shapeC.addGroup(profileG2);
    
    const bodyG3 = new Group(3, 'body', '', 1, 1);
    //console.log(model);
    woodC.addGroup(bodyG3);
    
   
    
    
    
    //id, selectId, title, addedPrice, position, dependsOne, dependsCase, dependsTwo, notifyText, notifyType
    const camila = new Option(1, null, 'camila', null, 1, null, null, null, null, null);
    //console.log(camila);
    
    const remi = new Option(2, null, 'remi', null, 2, null, null, null, null, null);
    
    modelG1.addOption(camila);
    modelG1.addOption(remi);*/
  
    
    //console.log(<?php //echo lowerCase($product['title']); ?>);
   
    
    
    
    


</script>

    <div class="container">
         <h1 id="hello"></h1>
        
        <div class="row">
          <!-- START NAV --> 
          <div class="col-md-4 nav-box">
            <div class="accordion" id="accordionNav">
                
                
                    <img class="icon-logo mt-2 mb-2" src="img/revomere_logo_sm-min.png">
                    <?php echo getProductTitle($productId); ?>
                    
                    <?php echo addNav(); ?>

            </div>    
          </div>
          <!-- END NAV --> 
          
          <!-- START GUITAR/OPTION CONTAINER -->   
          <div class="col-md-8 m-0 p-0">
              
          <div id="guitarCtn">
              <div id="guitarWpr">
                <?php //include __DIR__ . '/inc/img_paths.php' ?>
              </div>
          </div>                
              
            <?php echo addTabContent(); ?>
              
          </div>
          <!-- END GUITAR/OPTION CONTAINER -->   
            

        </div>
        <!-- END ROW -->
        
        
        
        
        
        

<?php        
//echo getProductTitle($productId); 
//echo getAllCategories($productId);
//echo print_r(optionWithView());
?>

<script>
let <?php echo getProductTitle($productId); ?> = {};
</script>    
        
        
        
        
        
        
        
        
        
        
        
        
        
       
    </div>
    <!-- END CONTAINER -->












      
<?php include __DIR__ . '/inc/footer.php'; ?>