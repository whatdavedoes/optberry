<?php include __DIR__ . '/inc/header.php'; 

/***********REMOVE before flight in DATABASE.php****/
ini_set('display_errors', 'On');

echo addBtnStyles();
echo addOptionStyles();
echo addOStylesNoDGId();

?>

<?php include __DIR__ . '/inc/topSticky.php'; ?>

    <!-- HIDDEN BY DEFAULT CONTAINER WITH COMPLETED PRODUCT-->  
    <div style="" id="completeProduct" class="noVis optback1">
        <img id="star1" style="left: 35%; animation-delay: 2s;" class="shootingStar" src="/app_img/blue_star-min.png">
        <img id="star2" style="left: 47%; animation-delay: 8s;"  class="shootingStar" src="/app_img/yellow_star-min.png">
        <img id="star3" style="left: 20%; animation-delay: .5s;"  class="shootingStar" src="/app_img/purple_star-min.png">
        <img id="star4" style="left: 40%; animation-delay: 6s;"  class="shootingStar" src="/app_img/red_star-min.png">
        <img id="star5" style="left: 50%; animation-delay: .8s;"  class="shootingStar" src="/app_img/green_star-min.png">
        <img id="star6" style="left: 60%; animation-delay: 4s;" class="shootingStar" src="/app_img/blue_star-min.png">
        <img id="star7" style="left: 70%; animation-delay: 3s;"  class="shootingStar" src="/app_img/yellow_star-min.png">
        <img id="star8" style="left: 63%; animation-delay: 10s;"  class="shootingStar" src="/app_img/purple_star-min.png">
        <img id="star9" style="left: 27%; animation-delay: 5s;"  class="shootingStar" src="/app_img/red_star-min.png">
        
        <div Class="container">
        <div class="row">
        <div class="col-md-12 m-0 p-0">
            
            <div style="position: relative; z-index: 1000;" id="gCtnId" class="guitarCtn">
              <div id="gWprId" class="guitarWpr">
                <div id="insertImgs"></div>
              </div>
            </div>
            
            <div id="endAlert" class="alert alert-primary shadow mt-2" role="alert">
                <strong>That's one good looking guitar!</strong> <small>We've been working very hard on this project. <a href="https://www.nibtrek.com/feedback.php" target="_blank">Drop us a line</a> to give us some feedback or just say hello.</small>
            </div>
        </div>
        </div>
        </div>
    </div>

    <!-- INSIGHTS CONTAINER-->  
    <?php include __DIR__ . '/inc/optberry.php'; ?>



<!-- MAIN CONTAINER WITH NAV, PRODUCT, & OPTIONS ON PAGE LOAD-->
    <div id="mainSelect" class="container mainCtn">
        
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
          <div class="col-md-8 m-0 p-0 ">
              
            
          <div class="guitarCtn">
              <div class="guitarWpr">
                  

                <?php include __DIR__ . '/inc/modal.php'; ?>   
                
                <div id="removeImgs">
                    <?php echo addImgElements();
                          echo addImgNoDGId();
                      //include __DIR__ . '/inc/img_paths.php' 
                    ?>
                </div> 
                  
                <img class="noVis" id="pBanner" src="img/banner3-min.png<?php //echo $bannerImg; ?>">
              </div>
          </div>
      
            <!--ALERT-->  
            <div class="alertCtn noVis">
                <div class="alert alert-info alertTop" role="alert">
                  
                </div>
            </div>
              
              
            <!--FINISHING TOUCH BTN-->
            <div id="finBtnCtn" class="row noVis">
              
                <a onclick="magicTouch(product)" class="fTouch btn btn-success btn-lg" role="button" aria-pressed="true"><img class="icoWand" src="/img/wand-ico-min.png"><span class="wandTxt">Add the Finishing Touches</span></a>
              
            </div>
              
            <div class="row">
                <div class="col-md-8 row-ctn shadow card">
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
        
    
        
        
        <!--<div class="row">
            <div class="col-md-12">
                <div id="svgSun">
                <script type="module">
                    import define from "/sunburst.js";
                    import {Runtime, Library, Inspector} from "/runtime.js";

                    const runtime = new Runtime();
                    const intoDiv = document.getElementById("svgSun");
                    const main = runtime.module(define, Inspector.into(intoDiv));
                </script>
                </div>
            </div>
        </div>-->



<?php        
//echo getProductTitle($productId); 
//echo getAllCategories($productId);
//echo print_r(optionWithView());
?>


        
        
       
    </div>
    <!-- END CONTAINER -->







      
<?php include __DIR__ . '/inc/footer.php'; ?>