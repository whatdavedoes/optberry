<script>

function toggleInsights(){
    const down = document.getElementById("downIco");
    const dTxt = document.getElementById("downTxt");
    
    if (down.classList.contains("downIconAni") == true) {
        
        down.classList.add("downIconAniOff");
        down.classList.remove("downIconAni");
        dTxt.innerHTML = "Hide Click Insights";
        
    } else {
        down.classList.remove("downIconAniOff");
        down.classList.add("downIconAni");
        dTxt.innerHTML = "Show Click Insights";
    }
}

</script>

<!--<div id="iLink" class="insightLinkCtn noVis">
    <a onclick="toggleInsights()" class="insightLink" data-toggle="collapse" href="#collapseSun" role="button">
        <img class="insightIco" src="/img/insight-ico-min.png"> <span id="downTxt">View Click Insights</span>
        
        <img id="downIco" class="downIconAni" src="/img/down-ico-min.png">
    </a>
</div>
    
<div class="collapse" id="collapseSun">-->
  
<div id="insightContent" class="insightAppear noVis">
<div class="optWhite pb-2 shadow optTopContent">
<div class="container mb-4">
    
    <div class="row border-bottom pb-4">
            <div class="col-md-8">
                <div style="max-width: 600px; margin: 0 auto;">
                    <img class="optLogoBg mt-4" src="img/optberry_logo-min.png">
                    <h1 class="insightPara">Powerful insights into your customer's preferences.</h1>
                    <div class="optPill">
                        <span class="badge badge-pill badge-dark greenPill">Product Customization eCommerce</span>
                        <span class="badge badge-pill badge-dark purplePill">Product Development Insights</span>
                        <!--<span class="badge badge-pill badge-dark greenPill">Product Option Managment</span>-->
                    </div>
                    <p class="">Optberry is a web application currently in development by <a class="nb-link" href="https://www.nibtrek.com" target="_blank"> <img class="nb-sm" src="/img/nibtrek_logo_sm-min.png">NibTrek</a>. It is being designed for product option management. Below is a sequence sunburst chart that represents your personal guitar option click density.</p><span class="text-muted">Privacy Statement: Your click data from this page will not be collected.</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mt-4">
                <div class="lead card-header optback2">Features Under Development:</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Updated Database for More Guitar Options</li>
                    <li class="list-group-item">Active Category/Group/Option Timeline Chart</li>
                    <li class="list-group-item">Sequence Sunburst Chart for Clicks</li>
                    <li class="list-group-item">Admin Area To Adapt Application to Any Product</li>
                    <li class="list-group-item">OptBerry Website Launch</li>
                </ul>
                </div>
            </div>
    </div>
    
</div>
</div>
    

<div class="optback3">
<div class="container">
    <div class="row">
        <div class="col-md-12 border-bottom">
        
            <h2 style="text-align: center; color: #898F89; font-size: 48px; display: block; margin 0 auto;" class="mt-4 mb-4">Click Density Analytics</h2>
    
        </div>
    </div>
    <div class="row mb-4 pb-2 pt-4 border-bottom">
        <div class="col-md-6">
            <div style="max-width:440px; display: block; margin: 0 auto;">
                <p style="color: #FFF;">Categories contain groups and groups contain options.</p>
                <p style="color: #FFF;">Category click totals are inclusive of group and option clicks. In other words, if you click on a group or option within a group, it adds a click to the category. In this regard, group total clicks are inclusive of option clicks.</p><p style="color: #FFF;">Category bar width(as seen below) is based on total category clicks, which represents the actual total clicks. Group bar width is based on total group clicks. Option bar width is based on the highest number of clicks on an individual option independant of it's category or group.</p>
            </div>
        </div>
        <div class="col-md-6 pb-4 mb-1">
            
        <div class="shadow pb-3 mt-1" style="max-width: 400px; background-color: #898F89; padding: 8px; border-radius: 4px;">
        <span style="background-color: #4F4D4F; color:#FFF; display: block; position: relative;  font-size: 20px;" class="badge badge-light mb-2 p-2">Bar Chart Key</span>
        <!--<p class="mb-0" style="text-align: center; color:#FFF;">Bar Chart Key</p>-->
        
            
        <div class="mt-1" style="max-width: 250px; display block; margin: 0 auto;">
            
            <img style="position: relative; top: -4px;" class="optPinKey mr-1 mt-1" src="/app_img/pin-min.png">
            
            <p class="mt-1" style="color: #FFF; display: inline-block">= current option</p><div style="display: block;"></div>
             <span style="display: block; position: relative;  font-size: 16px;" class="badge badge-light mb-2">Product</span>
            <span style="display: inline-block; position: relative;  font-size: 16px;" class="badge badge-light mb-2">Category</span><span style="position: relative; font-size: 16px;" class="badge badge-light ml-2 mb-2"># of Clicks</span>
            
            <div style=" border-left: solid 2px #FFF;" class="groupBars">    
                <span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light">Group</span><span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light ml-2"># of Clicks</span>

                <div class="optionBars">
                 <span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light">Option(s)</span><span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light ml-2"># of Clicks</span>
                </div>    
            </div>


            <div style=" border-left: solid 2px #FFF;" class="groupBars">    
                <span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light">Group</span><span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light ml-2"># of Clicks</span>

                <div class="optionBars">
                 <span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light">Option(s)</span><span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light ml-2"># of Clicks</span>
                </div>    
            </div>
        </div>
            
        </div>    
        </div>
        
        
        
        
    </div>
    <div class="row pb-5">
            <div class="col-md-12">            
           
                <!--<div style="display: block; margin: 0 auto; text-align: center;">
                    <h2 class="mb-0 mt-4" style="font-size: 40px; color: #FFF; display:inline-block;">Guitar</h2><span style="position: relative; top: -8px; left: 6px; font-size: 20px;" class="badge badge-light ml-2">86 Total Clicks</span>
                    </div>

                    <h3 class="mb-0 mt-4" style="color: #ffac1f; display:inline-block;">Shape</h3>
                    <span style="position: relative; top: -6px; left: 6px; font-size: 16px;" class="badge badge-light">25</span>
                    <div class="progress mb-2" style="height: 35px;">
                      <div class="progress-bar" role="progressbar" style="width: 99%; background-color: #ffac1f;"></div>
                    </div>

                    <div style="border-left: solid 2px #FFF;" class="groupBars mt-0 mb-0 pb-">

                        <h3 class="mb-0 groupBarH" style="color: #FFF; display:inline-block;">Model</h3>
                        <span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light">5</span>
                        <div class="progress mb-2" style="height: 25px;">
                          <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #ffac1f;"></div>
                        </div>


                        <div class="optionBars">
                            <h3 class="mb-0 optBarH" style="color: #17BF60; display:inline-block;">Camila</h3>
                            <span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light">3</span>
                            <span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-success">Current Option</span>
                            <div class="progress mb-2" style="height: 8px;">

                                <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #17BF60;"></div>
                            </div>
                        </div>



                    </div>


                    <h3 class="mb-0 mt-4" style="color: #FFF; display:inline-block;">Shape</h3>
                    <span style="position: relative; top: -6px; left: 6px; font-size: 16px;" class="badge badge-light">25</span>
                    <div class="progress mb-2" style="height: 35px;">
                      <div class="progress-bar" role="progressbar" style="width: 25%;"></div>
                    </div>


                    <div style="border-left: solid 2px #FFF;" class="groupBars mt-0 mb-0 pb-">

                        <h3 class="mb-0 groupBarH" style="color: #FFF; display:inline-block;">Model</h3>
                        <span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light">5</span>
                        <div class="progress mb-2" style="height: 25px;">
                          <div class="progress-bar" role="progressbar" style="width: 25%;"></div>
                        </div>
                    </div> -->
                <!--CLICK DATA IS APPENDED BELOW:------------------------------------>

                <div style="max-width: 750px; display: block; margin: 0 auto;" id="appendClickData"></div>
           
            </div>    
    </div>
</div>
</div> 
    
    
    
    
    
    
    

<!--<div class="optback2">
<div class="container">
    <div class="row">
            <div class="col-md-12">
                <div id="svgSun">
                
                <script type="module">
                    import define from "/d3/sunburst/sunburst.js";
                    import {Runtime, Library, Inspector} from "/d3/sunburst/runtime.js";

                    const runtime = new Runtime();
                    const intoDiv = document.getElementById("svgSun");
                    const main = runtime.module(define, Inspector.into(intoDiv));
                </script>
                    
                </div>
                
            </div>
    </div>
</div>
</div>-->

<div class="optWhite pb-5 mb-2 shadow optback1">
<div class="container">
    <div class="row">
            <div class="col-md-12">
                <img class="mt-3" style="display: block; margin: 0 auto;" src="/img/nibtrek_logo_sm-min.png">
                <h1 style="text-align: center; display: block; margin: 0 auto; max-width: 600px;" class="text-shadow">Choose Nibtrek For Websites, Graphic Design, &amp; Data-Driven Insights</h1>
                <div class="my-4 btn-txt" style="text-align:center; display:block; margin: 0 auto">
                    <a href="https://www.nibtrek.com" target="_blank" type="button" class="btn btn-lg nb-btn">Visit Website</a>
                    <a href="https://www.nibtrek.com/inquiry.php" target="_blank" type="button" class="btn btn-outline-secondary btn-lg">Project Request</a>
                </div>
            </div>
    </div>
    </div>
</div>
    
</div>
    
<!--</div>-->
    
    