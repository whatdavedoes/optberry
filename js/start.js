function showDefault(prod) {
    let o = "";
    let c = "";
    let g = "";
    let defaultTotal = 0;
    let requireGroup = "";
    let x = 0;
    
    //for each category
    for (let a = 0; a < prod.categories.length; a++) {
        
        c = prod.categories[a];
            
        for (let b = 0; b < prod.categories[a].groups.length; b++) {
            
            g = prod.categories[a].groups[b];
                
            for (let c = 0; c < prod.categories[a].groups[b].options.length; c++) {
                
                o = prod.categories[a].groups[b].options[c];
                
                if ( o.defaultOption == 1 ) {
                    defaultTotal++;

                    oClick(prod, g, o, false, true);
                                        
                    
                    
                    //console.log("oClick(" + prod + ", " + g + ", " + o + ", " + false + ", " + true + ");");
                    
                    //console.log( o.title + " has been initialized.");
                  
                }
                
                   
            } 
            
            if (g.requireFirst > 0 & x == 0) {
                requireG = g;
                requireC = c;
                x++;
            }
        }            
    }
    
    if (defaultTotal == 0) {
        document.getElementById("pBanner").classList.remove("noVis");
    }
    
    //console.log(prod + ", " + requireC + ", " + requireG);
    gClick(prod, requireC, requireG);

}

showDefault(product);


function toLower(input) {
    let out = input.toLowerCase();
    out = out.trim();
    out = out.replace(/\s/g, '');
    
    return out;
}



function enabledOption(requiredOption, prod) {
    if (requiredOption == null){
        return true;
    } else {
            //for each category
    for (let a = 0; a < prod.categories.length; a++) {
        
        c = prod.categories[a];
            
        for (let b = 0; b < prod.categories[a].groups.length; b++) {
            
            g = prod.categories[a].groups[b];
                
            for (let c = 0; c < prod.categories[a].groups[b].options.length; c++) {
                
                o = prod.categories[a].groups[b].options[c];
                if (requiredOption == o.id && o.currentOption == true){
                    return true;
                }

            } 
          }
        }            
       return false; 
    }
}


function updateProgress(prod) {
    let pStatus = false;
    
    let c = "";
    let cStatus = false;
    let cCheckY = "";
    let cCheckN = "";
    let cComplete = 0;
    
    let g = "";
    let gStatus = false;
    let gOneSelect = false;
    let gCheckY = "";
    let gCheckN = "";
    let groupsComplete = 0;
    
    let o = "";
    let completeOptions = 0;
    let notEnabled = 0;
    let selectArray = [];
    let totalBtns = 0;
    
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        groupsComplete = 0;
        c = prod.categories[a];
        //console.log(c.title);
        
        if (c.currentCategory == true) {
            //grab progress bar class & animate
        }
        
        //category - yes check id
        cCheckY = "outer-y-" + toLower(c.displayTitle) + "-" + c.id;
        
        //category - no check id
        cCheckN = "outer-n-" + toLower(c.displayTitle) + "-" + c.id;
        
        
        
        
        
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            completeOptions = 0;
            notEnabled = 0;
            selectArray = [];
            totalBtns = 0;
            
            g = c.groups[b];
            
            //group - yes check id
            gCheckY = "inner-y-" + toLower(g.title) + g.id;
            
            //group - no check id
            gCheckN = "inner-n-" + toLower(g.title) + g.id;
            
            
            //IF GROUP ALLOWS ONE SELECTION, TRUE
            if (g.oneSelection == true) {
                gOneSelect = true;
            }
            
            //for each option-------------
            for (let c = 0; c < g.options.length; c++) {
                
                o = g.options[c];
                
                if ( enabledOption(o.dependsOne, product) == true ) {        
                
                    if (gOneSelect == true && o.currentOption == true) {
                        gStatus = true;
                        
                    //IF GROUP ALLOWS MULTIPLE SELECTIONS    
                    } else if ( gOneSelect == false ) {
                        
                        //IF NOT IN SELECT
                        if (o.selectId == null) {
                            completeOptions++;
                            
                        //IF IN SELECT
                        } else if (o.selectId != null) {
                            
                            //IF NOT REQUIRED
                            if (o.required == null) { //optional
                               completeOptions++;

                            // IF REQUIRED, NOT IN ARRAY, & CURRENT
                            } else if (o.required == 1 && selectArray.includes(o.selectId) == false && o.currentOption == true){

                                    //add select id
                                    selectArray.push(o.selectId);
                                    //console.log(selectArray);
                            }

                        }

                    }
                    
                } else {
                    notEnabled++;
                    completeOptions++;
                }
                
            }
            //----------------------------
            //for each option-------------
            for (let c = 0; c < g.options.length; c++) {
                
                o = g.options[c];
                /*if ( enabledOption(o.dependsOne, product) == true ) {*/
                    if ( selectArray.includes(o.selectId) == true) {
                        completeOptions++;
                    }
                /*} else {
                    completeOptions++;
                }*/
            }
            //----------------------------
            //console.log(g.title + " options length: " + g.options.length);
            //console.log(g.title + " complete options: " + completeOptions);
            
            if ( completeOptions == g.options.length && notEnabled != g.options.length ) {
                gStatus = true;
                selectArray = [];
            }
            
            
            if (gStatus == true) {
                groupsComplete++;
                //console.log(gCheckY);
                elementY = document.getElementById(gCheckY).classList;
                elementN = document.getElementById(gCheckN).classList;
                
                if (elementY.contains('noVis') == true) {
                    elementY.remove('noVis');
                    //console.log("removed noVis class with id: " + gCheckY);
                }
                
                if (elementN.contains('noVis') == false) {
                    elementN.add('noVis');
                }
                
            } else {
                elementY = document.getElementById(gCheckY).classList;
                elementN = document.getElementById(gCheckN).classList;
                
                if (elementN.contains('noVis') == true) {
                    elementN.remove('noVis');
                    //console.log("removed noVis class with id: " + gCheckY);
                }
                
                if (elementY.contains('noVis') == false) {
                    elementY.add('noVis');
                }
            }
            
            gStatus = false;
            gOneSelect = false;
            
        }
        //-------------------------------------------------
        
        
        
        
        
        
        
        
        
        cProgId = "bg-" + toLower(prod.categories[a].displayTitle) + "-" + prod.categories[a].id;
        
        // IF ALL GROUPS COMPLETED IN CATEGORY
        if (groupsComplete == c.groups.length) {
            cStatus = true;
            /*console.log(prod.categories[a].title);
            console.log(100);*/
            console.log("---");
            
            hundredPercent = 100 / prod.categories.length;
            console.log(c.groups.length);
            console.log(hundredPercent);
            
            document.getElementById(cProgId).style.width = hundredPercent + "%";
            document.getElementById(cProgId).innerHTML = prod.categories[a].displayTitle + "(100%)";
            
        } else {
            
            if (groupsComplete != 0) {
                
                cPercent = groupsComplete / c.groups.length;
                cPercent = cPercent * 100;
                pPercent = cPercent / prod.categories.length;
                
                
                cPercent = Math.round(cPercent);
            } else {
                cPercent = "0";
                pPercent = "0";
            }
            
            /*console.log(prod.categories[a].title);
            console.log("percent of category: " + cPercent);
            console.log("percent of product: " + pPercent);
            console.log("---");*/
            
            document.getElementById(cProgId).style.width = pPercent + "%";
            document.getElementById(cProgId).innerHTML = prod.categories[a].displayTitle +  "(" + cPercent + "%)";
        }
        
        
        
        
        //update category checkmark here
        if ( cStatus == true ) {
            
            //console.log(cCheckY);
            
                elementY = document.getElementById(cCheckY).classList;
                elementN = document.getElementById(cCheckN).classList;
                
                if (elementY.contains('noVis') == true) {
                    elementY.remove('noVis');
                    //console.log("removed noVis class with id: " + cCheckY);
                }
                
                if (elementN.contains('noVis') == false) {
                    elementN.add('noVis');
                }
            
            cComplete++;
            
        } else {
            elementY = document.getElementById(cCheckY).classList;
                elementN = document.getElementById(cCheckN).classList;
                
                if (elementN.contains('noVis') == true) {
                    elementN.remove('noVis');
                    //console.log("removed noVis class with id: " + cCheckY);
                }
                
                if (elementY.contains('noVis') == false) {
                    elementY.add('noVis');
                }
        }
        
        cStatus = false;  
    }
    //--------------------------------------------------------------------------------
    if (cComplete == prod.categories.length) {
        pStatus = true;
    }
    
    if (pStatus == true) {
        alert("PRODUCT COMPLETE!");
    }
    
}

updateProgress(product);
























