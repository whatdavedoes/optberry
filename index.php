<?php include __DIR__ . '/inc/header.php'; 

/***********REMOVE before flight in DATABASE.php****/
ini_set('display_errors', 'On');

echo addBtnStyles();
echo addOptionStyles();

?>

<nav class="pwrNav py-1 navbar navbar-light bg-light shadow">
    <div class="container justify-content-end">
        <p class="pwrTxt"><span class="pwrSpan">Powered by </span><img class="optLogo" src="img/optberry_logo-min.png"></p>
    </div>
</nav>


    <div class="container">
         <h1 id="hello"></h1>
        
        <div class="row">
          <!-- START NAV --> 
          <div class="col-md-4 nav-box">
            <div class="accordion" id="accordionNav">
                
                
                    <img class="icon-logo mt-2 mb-2" src="img/revomere_logo_sm-min.png">
                    <?php echo $profileName; ?>
                    
                    <?php echo addNav(); ?>

            </div>    
          </div>
          <!-- END NAV --> 
          
          <!-- START GUITAR/OPTION CONTAINER -->   
          <div class="col-md-8 m-0 p-0">
              
          <div id="guitarCtn">
              <div id="guitarWpr">
                  

                <?php include __DIR__ . '/inc/modal.php'; ?>   
                  
                <?php echo addImgElements();
                  //include __DIR__ . '/inc/img_paths.php' 
                ?>
                  
                <img class="noVis" id="pBanner" src="img/banner3-min.png<?php //echo $bannerImg; ?>">
              </div>
          </div>
            <div class="row">
                <div class="col-md-8 row-ctn shadow">
                    <?php echo addTabContent(); ?>
                </div>
                
                
                <div class="col-md-4">
                    <?php include __DIR__ . '/inc/price_table.php'; ?>
                </div>
                
                
            </div>
          </div>
          <!-- END GUITAR/OPTION CONTAINER -->   


        </div>
        <!-- END ROW -->



<?php        
//echo getProductTitle($productId); 
//echo getAllCategories($productId);
//echo print_r(optionWithView());
?>


        
        
       
    </div>
    <!-- END CONTAINER -->







      
<?php include __DIR__ . '/inc/footer.php'; ?>