<?php include __DIR__ . '/inc/header.php'; 

/***********REMOVE before flight in DATABASE.php****/
ini_set('display_errors', 'On');

echo addBtnStyles();
echo addOptionStyles();

?>

<?php include __DIR__ . '/inc/topSticky.php'; ?>

    <!-- HIDDEN BY DEFAULT CONTAINER WITH COMPLETED PRODUCT-->  
    <div id="completeProduct" class="container noVis">
        <div class="row">
        <div class="col-md-12 m-0 p-0">
            
            <div class="guitarCtn">
              <div class="guitarWpr">
                <div id="insertImgs" class=""></div>
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
                      //include __DIR__ . '/inc/img_paths.php' 
                    ?>
                </div> 
                  
                <img class="noVis" id="pBanner" src="img/banner3-min.png<?php //echo $bannerImg; ?>">
              </div>
          </div>
      
              
              
            <div id="finBtnCtn" class="row noVis">
              
                <a onclick="magicTouch()" class="fTouch btn btn-success btn-lg" role="button" aria-pressed="true"><img class="icoWand" src="/img/wand-ico-min.png"><span class="wandTxt">Add the Finishing Touches</span></a>
              
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