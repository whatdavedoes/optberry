let clickCtn = "";

function optionsFulfilled() {
    const completeBtn = document.getElementById("finBtnCtn");
    
    completeBtn.classList.remove("noVis");
    completeBtn.classList.add("finBtnAni");
    
    document.getElementById("beforeBuyBtn").classList.add("noVis");
    document.getElementById("afterBuyBtn").classList.remove("noVis");
}

function productHtml(title, totalClicks) {
    let output='';
    output += '<div style="display: block; margin: 0 auto; text-align: center;"><h2 class="mb-0 mt-4" style="font-size: 40px; color: #FFF; display:inline-block;">';
    output += title;
    output += '</h2><span style="position: relative; top: -8px; left: 6px; font-size: 20px;" class="badge badge-light ml-2">';
    output += totalClicks;
    output += ' Total Clicks</span></div>';
    
    return output;
}

function categoryHtml(title, clr, cClicks, totalClicks) {
    let output='';
    let percentValue = (cClicks * 100) / totalClicks;
    
    output += '<h3 class="mb-0 mt-4" style="color: #';
    output += clr;
    output += '; display:inline-block;">';
    output += title;
    output += '</h3><span style="position: relative; top: -6px; left: 6px; font-size: 16px;" class="badge badge-light">';
    output += cClicks;
    output += '</span><div class="progress mb-2" style="height: 35px;"><div class="progress-bar" role="progressbar" style="width: ';
    output += percentValue;
    output += '%; background-color: #';
    output += clr;
    output += ';"></div></div>';
    
    return output;
}

function groupHtml(title, clr, gClicks, totalGClicks) {
    let output='';
    let percentValue = (gClicks * 100) / totalGClicks;
    
    output += '<div style="border-left: solid 2px #FFF;" class="groupBars mt-0 mb-0 pb-0"><h3 class="mb-0 groupBarH" style="color: #';
    output += clr;
    output += '; display:inline-block;">';
    output += title;
    output += '</h3><span style="position: relative; top: -2px; left: 6px; font-size: 14px;" class="badge badge-light">';
    output += gClicks;
    output += '</span><div class="progress mb-2" style="height: 25px;"><div class="progress-bar" role="progressbar" style="width: ';
    output += percentValue;
    output += '%; background-color: #';
    output += clr;
    output += ';"></div></div>';
    
    return output;
}

function optionHtml(title, oClicks, topOClick, clr, current) {
    let output = "";
    let percentage = (oClicks * 100) / topOClick;
    
    output = '<div class="optionBars pb-1">';
    
    if (current == true) {
    output += '<div class="pinCtn"><img class="optPin" src="/app_img/pin-min.png"></div>';
    }
    
    output += '<h3 class="mb-0 optBarH" style="color: #';
    output += clr;
    output += '; display:inline-block;">';
    output += title;
    output += '</h3><span style="position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light">';
    output += oClicks;
    output += '</span>';
 
    output += '<div class="progress mb-2" style="height: 8px;"><div class="progress-bar" role="progressbar" style="width: ';
    output += percentage;
    output += '%; background-color: #';
    output += clr;
    output += ';"></div></div></div>';
    
    return output;
    
}

function clickData(prod) {
    
    let totalClicks = 0;
    let nowStamp = Date.now();
    let totalOptionClicks = 0;
    let highestOClick = 0;
    let totalGroupClicks = 0;
    
    //for each category-----------------------------------------------------------
    //ends clicks, gets total clicks, total group clicks, highest option clicks
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        //ending category click if null
        for (let a = 0; a < c.clicks.length; a++) {
                if (c.clicks[a].end == null) {
                    c.clicks[a].end = nowStamp;
                }
            }
        
        totalClicks += c.clicks.length;
        
        //console.log(totalClicks);
        
        //for each group----------------------------------
        for (let a = 0; a < c.groups.length; a++) {
            g = c.groups[a];
            
            //ending group click if null
            for (let a = 0; a < g.clicks.length; a++) {
                if (g.clicks[a].end == null) {
                    g.clicks[a].end = nowStamp;
                }
            }
            
            totalGroupClicks += g.clicks.length;
            totalClicks += g.clicks.length;
            
            //for each option-------------
            for (let a = 0; a < g.options.length; a++) {
                o = g.options[a];
                
                //ending group click if null
                for (let a = 0; a < o.clicks.length; a++) {
                    if (o.clicks[a].end == null) {
                        o.clicks[a].end = nowStamp;
                    }
                }
                
                totalClicks += o.clicks.length;
                totalGroupClicks += o.clicks.length;
                
                if (o.clicks.length > highestOClick) {
                    highestOClick = o.clicks.length;
                }
                
            }
            //----------------------------
            
            if (g.clicks.length > 0) {
                
            }
            
        }
        //------------------------------------------------
        
    }
    //----------------------------------------------------------------------------
    //console.log('hightest o click: ' + highestOClick);
    
    let clickDuration = 0;
    let cName = "";
    let gName = "";
    let oName = "";
    let currentCTotal = 0;
    let currentGTotal = 0;
    let currentOTotal = 0;
    let cHtml = "";
    let gHtml = "";
    let oHtml = "";
    let gPlusOout = "";
    let oZero = [];
    
    let gOutput = "";
    let oOutput = "";
    let output = "";
    
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        cName = c.displayTitle;
        //ending category click if null
        for (let cc = 0; cc < c.clicks.length; cc++) {
                if (c.clicks[cc].end == null) {
                    c.clicks[cc].end = nowStamp;
                }
            }
        currentCTotal = c.clicks.length;
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            g = c.groups[b];
            oHtml = "";
            
            gName = g.title;
            //ending group click if null
           
            
            
            currentGTotal = g.clicks.length;
            currentCTotal += g.clicks.length;
            
            //for each option-------------
            for (let a = 0; a < g.options.length; a++) {
                o = g.options[a];
        
                currentCTotal += o.clicks.length;
                currentGTotal += o.clicks.length;
             
            }
            
            //for each option-------------
            for (let a = 0; a < g.options.length; a++) {
                o = g.options[a];
                
                if (o.selectTitle == null){
                    oName = o.displayTitle;
                } else {
                    oName = o.selectTitle + " / " + o.displayTitle;
                }
                
                
                currentOTotal = o.clicks.length;                
                
                if (o.clicks.length == 0) {
                    oZero.push(oName);
                } else {
                    oHtml += optionHtml(oName, currentOTotal, highestOClick, c.label_clr, o.currentOption);
                }

            }
            //----------------------------
            
            gHtml += groupHtml(gName, c.label_clr, currentGTotal, totalGroupClicks);
            gHtml += oHtml;
            gHtml += '<div class="optionBars mt-2">';
            
            for (let i = 0; i < oZero.length; i++) {
                gHtml += '<h3 class="mb-0 optBarH pr-1" style="color: #898F89; display:inline-block;">' + oZero[i];
                
                if (i != oZero.length - 1) {
                    gHtml += ',</h3>';
                } else {
                    gHtml += '</h3>';
                }
                
            }
            
            if (oZero.length > 0) {
                gHtml += '<span style="background-color: #898F89; color: #404040; position: relative; top: -2px; left: 6px; font-size: 12px;" class="badge badge-light">0</span></div>';
            }
            
            
            oZero = [];
            
            gHtml += '';
            
            gHtml += '</div>';
            
            gPlusOout += gHtml;
            
            gHtml = "";
            oHtml = "";
            
            
            if (g.clicks.length > 0) {
                //gOutput += cName + "-" + gName + "-end," + " " + currentGTotal + "\n";
            }
            
        }
        //------------------------------------------------
        
       
        
       if (c.clicks.length > 0) {
            
           
        }
        //console.log("Category Total: " + currentCTotal);
        //categoryHtml(title, clr, cClicks, totalClicks)
        cHtml += categoryHtml(cName, c.label_clr, currentCTotal, totalClicks);
        output += cHtml;
        output += gPlusOout;
        cHtml = "";
        gPlusOout = "";
        
       
        
   }
   //------------------------------------------------------------------------------------
    
    pHtml = productHtml(prod.title, totalClicks);
    
    output = pHtml.concat(output);
    
    document.getElementById("appendClickData").innerHTML = output; 
}






function magicTouch(prod) {
    /*document.getElementById("pwrBerry").classList.add("noVis");
    document.getElementById("iLink").classList.remove("noVis");*/
   /* document.getElementById("insightContent").classList.remove("noVis");
    document.getElementById("insightContent").classList.add("insightAppear");*/
    
    const completeBtn = document.getElementById("finBtnCtn");
    
    
    //removes finishing touch btn
    completeBtn.classList.remove("finBtnAni");
    completeBtn.classList.add("finBtnAniOff");
    
    /*document.getElementById("mainSelect").classList.add("fadeAll");
    document.getElementById("mainSelect").classList.add("my-0");*/
    
    //hide footer
    document.getElementById("wholeFoot").classList.add("noVis");
    
    
    document.getElementById("mainSelect").classList.add("noVis");

    document.getElementById("completeProduct").classList.remove("noVis");
    document.getElementById("completeProduct").classList.add("fadeInComplete");
    
    let finalImgs = document.getElementById("removeImgs").innerHTML;
    document.getElementById("removeImgs").innerHTML = "";
    //console.log(finalImgs);
    document.getElementById("insertImgs").innerHTML = finalImgs;
    
    document.getElementById("insightContent").classList.remove("noVis");
    
    //hides progress bar
    document.getElementById("productProgress").classList.add("noVis");
    
    //adds animation classes for finished guitar
    document.getElementById("gCtnId").classList.add("slowTiltAni");  
    //document.getElementById("gWprId").classList.add("slowTiltAni");  
    //document.getElementById("endAlert").classList.add("downIconAni"); 
    
    
    //star animations
    document.getElementById("star1").classList.add("starAni"); 
    document.getElementById("star2").classList.add("starAni"); 
    document.getElementById("star3").classList.add("starAni"); 
    document.getElementById("star4").classList.add("starAni"); 
    document.getElementById("star5").classList.add("starAni"); 
    document.getElementById("star6").classList.add("starAni"); 
    document.getElementById("star7").classList.add("starAni"); 
    document.getElementById("star8").classList.add("starAni"); 
    document.getElementById("star9").classList.add("starAni"); 
    
    showNoClassify(product, noClassify, true);
    
    clickData(prod);
    

}

/*function clickData(prod) {
    let oOutput = "";
    let gOutput = "";
    let cOutput = "";
    let output = "";
    let oClicksTotal = 0;
    let gClicksTotal = 0;
    let nowStamp = Date.now();
    let clickDuration = 0;
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        cName = c.displayTitle;
        
        cClicks = c.clicks.length;
        
        gClicksTotal = 0;
        //ending category click if null
        for (let cc = 0; cc < c.clicks.length; cc++) {
                if (c.clicks[cc].end == null) {
                    c.clicks[cc].end = nowStamp;
                }
            }

        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            oClicksTotal = 0;
            g = c.groups[b];
            
            gName = g.title;
            
            gClicks = g.clicks.length;
            
            //ending group click if null
            for (let gc = 0; gc < g.clicks.length; gc++) {
                if (g.clicks[gc].end == null) {
                    g.clicks[gc].end = nowStamp;
                }
            }

            
            //for each option-------------
            for (let c = 0; c < g.options.length; c++) {
                
                o = g.options[c];
                
                oName = o.displayTitle;
            
                oClicks = o.clicks.length;
                oClicksTotal += oClicks;
                //ending group click if null
                for (let oc = 0; oc < o.clicks.length; oc++) {
                    if (o.clicks[oc].end == null) {
                        o.clicks[oc].end = nowStamp;
                    }
                }

                
                if (o.clicks.length > 0) {
                    oOutput += cName + "-" + gName + "-" + oName + "," + " " + oClicks + "\n";
                }
                
            }
            //----------------------------
            
            gClicks += oClicksTotal;
            gClicksTotal += gClicks;
            if (g.clicks.length > 0) {
                    gOutput += cName + "-" + gName + "," + " " + gClicks + "\n";
            }

        }
        //------------------------------------------------
        
        cClicks += gClicksTotal;
          
        if (c.clicks.length > 0) {
                    cOutput += cName + "," + " " + cClicks + "\n";
        }
        
        output += cOutput + "\n" + gOutput + "\n" + oOutput + "\n";
        
   }
   //------------------------------------------------------------------------------------
    console.log(output);
    
}*/














