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
  

<div id="insightContent" class="container insightAppear noVis mb-4">
    
    <div class="row">
            <div class="col-md-6">
                <img class="optLogoBg mt-4" src="img/optberry_logo-min.png">
                <h1 class="insightPara">Powerful insights into your customer's preferences.</h1>
                <div class="optPill">
                    <span class="badge badge-pill badge-dark greenPill">Product Customization eCommerce</span>
                    <span class="badge badge-pill badge-dark purplePill">Product Development Insights</span>
                    <!--<span class="badge badge-pill badge-dark greenPill">Product Option Managment</span>-->
                </div>
                <p class="">Optberry is a web application currently in development by <a class="nb-link" href="https://www.nibtrek.com" target="_blank"> <img class="nb-sm" src="/img/nibtrek_logo_sm-min.png">NibTrek</a>. It is being designed for product option management.</p><span class="text-muted">Privacy Statement: Your click data from this page will not be collected.</span>
            
            </div>
            <div class="col-md-6">
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
    </div>
</div>
    
<!--</div>-->
    
    