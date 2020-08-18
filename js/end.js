
function optionsFulfilled() {
    const completeBtn = document.getElementById("finBtnCtn");
    
    completeBtn.classList.remove("noVis");
    completeBtn.classList.add("finBtnAni");
    
    document.getElementById("beforeBuyBtn").classList.add("noVis");
    document.getElementById("afterBuyBtn").classList.remove("noVis");
}

function magicTouch() {
    /*document.getElementById("pwrBerry").classList.add("noVis");
    document.getElementById("iLink").classList.remove("noVis");*/
   /* document.getElementById("insightContent").classList.remove("noVis");
    document.getElementById("insightContent").classList.add("insightAppear");*/
    
    const completeBtn = document.getElementById("finBtnCtn");
    
    completeBtn.classList.remove("finBtnAni");
    completeBtn.classList.add("finBtnAniOff");
    
    /*document.getElementById("mainSelect").classList.add("fadeAll");
    document.getElementById("mainSelect").classList.add("my-0");*/
    
    document.getElementById("mainSelect").classList.add("noVis");

    document.getElementById("completeProduct").classList.remove("noVis");
    document.getElementById("completeProduct").classList.add("fadeInComplete");
    
    let finalImgs = document.getElementById("removeImgs").innerHTML;
    document.getElementById("removeImgs").innerHTML = "";
    console.log(finalImgs);
    document.getElementById("insertImgs").innerHTML = finalImgs;
    
    document.getElementById("insightContent").classList.remove("noVis");
    
}

function clickData(prod) {
    let oOutput = 0;
    let output = "";
    let nowStamp = Date.now();
    let clickDuration = 0;
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        
        c = prod.categories[a];
       
        cName = c.displayTitle;
        
        cClicks = 0;
        
        //ending category click if null
            for (let cc = 0; cc < c.clicks.length; cc++) {
                if (c.clicks[cc].end == null) {
                    c.clicks[cc].end = nowStamp;
                }
            }
        
    
        //calculating total duration of category clicks
        for (let cc = 0; cc < c.clicks.length; cc++) {
            clickDuration = c.clicks[cc].end - c.clicks[cc].start;
            cClicks += clickDuration;
        }
        console.log("CATEGORY:");
        console.log(cName);
        console.log(cClicks);
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            
            g = c.groups[b];
            
            gName = g.title;
            
            gClicks = 0;
            
            //ending group click if null
            for (let gc = 0; gc < g.clicks.length; gc++) {
                if (g.clicks[gc].end == null) {
                    g.clicks[gc].end = nowStamp;
                }
            }
            
            
            //calculating total duration of group clicks
            for (let gc = 0; gc < g.clicks.length; gc++) {
                clickDuration = g.clicks[gc].end - g.clicks[gc].start;
                gClicks += clickDuration;
            }
            console.log("GROUP:");
            console.log(gName);
            console.log(gClicks);
            
            
            
            
            //for each option-------------
            for (let c = 0; c < g.options.length; c++) {
                
                o = g.options[c];
                
                oName = o.displayTitle;
            
                oClicks = 0;
                
                //ending group click if null
                for (let oc = 0; oc < o.clicks.length; oc++) {
                    if (o.clicks[oc].end == null) {
                        o.clicks[oc].end = nowStamp;
                    }
                }


                //calculating total duration of group clicks
                for (let oc = 0; oc < o.clicks.length; oc++) {
                    clickDuration = o.clicks[oc].end - o.clicks[oc].start;
                    oClicks += clickDuration;
                }
                console.log("OPTION:");
                console.log(oName);
                console.log(oClicks);
                
                
                if (o.clicks.length > 0) {
                    oOutput = cName + "-" + gName + "-" + oName + "," + " " + oClicks + "\n";
                }
                
            }
            //----------------------------
            
            if (g.clicks.length > 0) {
                    gOutput = cName + "-" + gName + "," + " " + gClicks + "\n";
            }

        }
        //------------------------------------------------
          
        if (c.clicks.length > 0) {
                    cOutput = cName + "," + " " + cClicks + "\n";
        }
        
        output += cOutput + "\n" + gOutput + "\n" + oOutput + "\n";
        
   }
   //------------------------------------------------------------------------------------
    console.log(output);
}

function sunburst() {
    clickData = clickData(product);
}