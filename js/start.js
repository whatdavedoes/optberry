function isPriority(prod){
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            hasCurrentOption = false;
            g = c.groups[b];
           
                if (g.requireFirst == 1 && g.oneSelection == true) {
                    //for each option-------------
                    for (let c = 0; c < g.options.length; c++) {
                        o = g.options[c];

                        if (o.currentOption == true) {
                            hasCurrentOption = true;
                        }





                    //----------------------------
                    }
                    
                    
                     if (hasCurrentOption == false) {
                         return true;
                     }
                
                }
       
            
        //------------------------------------------------
        }
        
        
    //---------------------------------------------------------------------------    
    }
    return false;
}

//initializes prioritize
let prioritize = isPriority(product);

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
        return;
    }
    
    //console.log(prod + ", " + requireC + ", " + requireG);
    //gClick(prod, requireC, requireG);

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
            //console.log("---");
            
            hundredPercent = 100 / prod.categories.length;
            //console.log(c.groups.length);
            //console.log(hundredPercent);
            
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
        optionsFulfilled();
    }
    
}

updateProgress(product);



function closeHide(prod) {
     //let passOver = false;
     //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        passOver = false;
        c = prod.categories[a];
        //console.log(c.title);
        
        //close accordian             
        cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
        if (cCard.classList.contains('show') == true){
            cCard.classList.remove('show');
        }
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            g = c.groups[b];
            
               
                //hide card
                gTabId = "v-pills-" + toLower(g.title) + g.id;
                
                gTab = document.getElementById(gTabId);
                
                if ( gTab.classList.contains('show') == true) {
                    gTab.classList.remove('show');
                }
        
                if ( gTab.classList.contains('active') == true) {
                    gTab.classList.remove('active');
                }
                
                //DISABLES GROUP BTNS
               
                    gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                    console.log(gBtn);
                    gBtn.setAttribute("disabled", "");
            
            //DISABLES GROUP BTNS
                if (allowedGroups.includes(g.id) == false){
                    gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                    //console.log(gBtn);
                    gBtn.setAttribute("disabled", "");
                } else {
                    passOver = true;
                }
               
                
                //display notification
                pPillId = "p-pill-" + toLower(g.title) + g.id;
                
                pPill = document.getElementById(pPillId);
    
                if(pPill.classList.contains('priorityAni') == true){
                    pPill.classList.remove('priorityAni');
                }
    
                if(pPill.classList.contains('noVis') == false){
                    pPill.classList.add('noVis');
                }
            
        //------------------------------------------------
        }
        
        //DISABLES CATEGORY BTNS
       
        cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
        cBtn.setAttribute("disabled", "");
        //cBtn.removeAttribute("disabled");
        
        //DISABLES CATEGORY BTNS
       
            cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
            //cBtn.setAttribute("disabled", "");
            cBtn.removeAttribute("disabled");
        
     
       
        
        
    //---------------------------------------------------------------------------    
    }
}

//requireGroup start off true as global variable

function requireFirst(prod){
    if(requiredGroup == true) {
        //adds disabled attr to all nav btn not in allowed groups
        closeHide(prod);
    } else {
        return;
    }
       
    let cCard = "";
    let gTab = "";
    let groupAdvance = false;
     //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
       
        c = prod.categories[a];
        //console.log(c.title);
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            let groupAdvance = false;
            g = c.groups[b];
            
            //if display group is required first and one selection is true, loop through options
            if (g.requireFirst == 1 && g.oneSelection == true) {
            
                //for each option-------------
                for (let c = 0; c < g.options.length; c++) {

                    o = g.options[c];

                    if (o.currentOption == true) {
                        groupAdvance = true;
                    }                

                //----------------------------
            }
                
            } else {
                groupAdvance = true;
            }
            
            //groupAdvance is true when an option is selected
            if (groupAdvance == false) {
                
                
                //gClick
                gClick(prod, c, g);
                
                //open accordian    
                cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
                
                cCard.classList.add('show');
                
                //show card
                gTabId = "v-pills-" + toLower(g.title) + g.id;
                
                gTab = document.getElementById(gTabId);
                
                //console.log("v-pills-" + toLower(g.title) + g.id);
                
                gTab.classList.add('show');
                
                gTab.classList.add('active');
                
                //display notification
                pPillId = "p-pill-" + toLower(g.title) + g.id;
                
                pPill = document.getElementById(pPillId);
                
                pPill.classList.add('priorityAni');
                
                pPill.classList.remove('noVis');
                
                //add alert icon next to group btn in nav
                icoNo = document.getElementById("inner-n-" + toLower(g.title) + g.id);
                icoNo.setAttribute("src", "/img/alert-min.png");
                icoNo.classList.add("alertIcoAni");
                
                //ADDS TO GLOBAL ALLOWED GROUP ARRAY
                allowedGroups.push(g.id);
                
                gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                gBtn.removeAttribute("disabled");
                
                
                //escape function\
                return;
            } else {
                gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                gBtn.removeAttribute("disabled");
                
                pPillId = document.getElementById("p-pill-" + toLower(g.title) + g.id);
                pPillId.classList.add("noVis");
            }
            
            
        //------------------------------------------------
        }
        
        
    //---------------------------------------------------------------------------    
    }
    
    
    requiredGroup = false;
   
}




function blanketDisableNav(prod) {
        //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            
            g = c.groups[b];
            //disable group
            
            gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
            gBtn.setAttribute("disabled", "");
            
       
            
        //------------------------------------------------
        }
        
        
        //disable category
        
        //close accordian             
        cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
        if (cCard.classList.contains('show') == true){
            cCard.classList.remove('show');
        }
        
        cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
        cBtn.setAttribute("disabled", "");
        
    //---------------------------------------------------------------------------    
    }
}

function blanketEnableNav(prod) {
        //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            
            g = c.groups[b];
            //enable group
            
            gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
            gBtn.removeAttribute("disabled", "");
            
            //IF GROUP REQUIRED FIRST
            if (g.requireFirst == 1 && g.oneSelection == true) {
                
                contBtn = document.getElementById("cont-" + toLower(g.title) + "-" + g.id);
                
                if (contBtn) {
                    contBtn.remove();
                }
                
            }
            
        //------------------------------------------------
        }
        
        
        //enable category
        
        //close accordian             
        /*cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
        if (cCard.classList.contains('show') == false){
            cCard.classList.add('show');
        }*/
        
        cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
        cBtn.removeAttribute("disabled", "");
        
    //---------------------------------------------------------------------------    
    }
}

function priorityOnLoad(prod) {
    if (prioritize == false){
        //console.log("no priorities");
        return;
    }
    
    blanketDisableNav(prod);
    
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            
            g = c.groups[b];
            
                if (g.requireFirst == 1 && g.oneSelection == true) {
                    
                //gClick
                gClick(prod, c, g);
            
                //open accordian         
                cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
                if (cCard.classList.contains('show') != true){
                    cCard.classList.add('show');
                }
                 
                //ENABLE CATEGORY BTN    
                /*cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
                cBtn.removeAttribute("disabled");*/
                    
                //show card
                gTabId = "v-pills-" + toLower(g.title) + g.id;
                
                gTab = document.getElementById(gTabId);
                
                if ( gTab.classList.contains('show') != true) {
                    gTab.classList.add('show');
                }
        
                if ( gTab.classList.contains('active') != true) {
                    gTab.classList.add('active');
                }
                
                //ENABLE GROUP BTN
                gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                //console.log(gBtn);
                gBtn.removeAttribute("disabled");
                    
                //display notification
                pPillId = "p-pill-" + toLower(g.title) + g.id;
                
                pPill = document.getElementById(pPillId);
    
                if(pPill.classList.contains('priorityAni') != true){
                    pPill.classList.add('priorityAni');
                }
    
                if(pPill.classList.contains('noVis') != false){
                    pPill.classList.remove('noVis');
                }
                    
                //add alert icon next to group btn in nav
                icoNo = document.getElementById("inner-n-" + toLower(g.title) + g.id);
                icoNo.setAttribute("src", "/img/alert-min.png");
                icoNo.classList.add("alertIcoAni");    
                
                //escape function\
                return;  
                
                }
            
      
            
            
        //------------------------------------------------
        }
        
        
    //---------------------------------------------------------------------------    
    }
    
}

priorityOnLoad(product);


//runs at the end of oClick function
function updatePriorityNav(prod, cont = false) {
    prioritize = true;
    let endableNav = true;
    let enableC = false;
    let currO = false;
    
    //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        enableC = false;
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            currO = false;
            
            g = c.groups[b];
           
            //IF GROUP REQUIRED FIRST
            if (g.requireFirst == 1 && g.oneSelection == true) {

                //LOOP THROUGH THE OPTIONS-------------
                for (let c = 0; c < g.options.length; c++) {
                    o = g.options[c];
                    
                    //IF GROUP REQUIRED AND SATISFIED:
                        //REMOVES DISABLED ATTRIBUTE
                        
                    if (o.currentOption == true) {
                        gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                        //console.log(gBtn);
                        gBtn.removeAttribute("disabled");
                        
                        //ENABLE CATEGORY LINK VARIABLE
                        enableC = true;
                        
                        //SET CURRRENT OPTION VARIABLE TO TRUE
                        currO = true;
                        //console.log(currO + "current option: " + g.title);
                        
                        if(cont == true) {
                            //hide card
                            gTabId = "v-pills-" + toLower(g.title) + g.id;

                            gTab = document.getElementById(gTabId);
                            
                            if(gTab.classList.contains('show') == true){
                                gTab.classList.remove('show');
                            }
                            
                            if(gTab.classList.contains('active') == true){
                                gTab.classList.remove('active');
                            }
                        }
                    }

                //----------------------------
                }
                
                //IF NO CURRENT OPTIONS
                if (currO == false) {
                    endableNav = false;
                    
                    if(cont == true){
                        //gClick
                        gClick(prod, c, g);

                        //open accordian    
                        cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);

                        cCard.classList.add('show');

                        //show card
                        gTabId = "v-pills-" + toLower(g.title) + g.id;

                        gTab = document.getElementById(gTabId);
                        
                        gTab.classList.add('show');
                
                        gTab.classList.add('active');
                    }
                    
                    //console.log("no current options for " + g.title);
                    //open accordian         
                    cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
                    if (cCard.classList.contains('show') != true){
                        cCard.classList.add('show');
                    }

                    //ENABLE CATEGORY BTN    
                    cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
                    cBtn.removeAttribute("disabled");

                    //ENABLE GROUP BTN
                    gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                    //console.log(gBtn);
                    gBtn.removeAttribute("disabled");

                    //display notification
                    pPillId = "p-pill-" + toLower(g.title) + g.id;

                    pPill = document.getElementById(pPillId);

                    if(pPill.classList.contains('priorityAni') != true){
                        pPill.classList.add('priorityAni');
                    }

                    if(pPill.classList.contains('noVis') != false){
                        pPill.classList.remove('noVis');
                    }

                    //add alert icon next to group btn in nav
                    icoNo = document.getElementById("inner-n-" + toLower(g.title) + g.id);
                    icoNo.setAttribute("src", "/img/alert-min.png");
                    icoNo.classList.add("alertIcoAni");    
                        
                    prioritize = true;
                    
                    //console.log("Prioritize is true, escaping function.");
                    //escape function\
                    return;
                    
                }
                    
            }
                
        
        //------------------------------------------------
        }
        
        if (enableC == true) {
            cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
            
            cBtn.removeAttribute("disabled");
        }
        
    //---------------------------------------------------------------------------    
    }
    
    if (endableNav == true) {
        //console.log("All Nav is Enabled, prioritize false, blanket Enable");
        prioritize = false;
        blanketEnableNav(prod);
    }
    
}

function allowNoClassify(prod, oId) {
    let cssId = "";
     //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        c = prod.categories[a];
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
            
            g = c.groups[b];
            //enable group
            
            //for each option-------------
                for (let c = 0; c < g.options.length; c++) {

                    o = g.options[c];
                    
                    if (oId == o.id && o.currentOption == true) {
                        return true;
                    }
                    
                    
                }
            //----------------------------

            
        //------------------------------------------------
        }
      
        
        
    //---------------------------------------------------------------------------
    }
    
    return false;
}

function showNoClassify(prod, arrayIn, finish) {
    let dependId = 0;
    let allow = false;
    //inputs noCalssify array
    
    //for each item, select the id
        //set opacity to 1;
    
    //["id", depends_on, default]
    
    if (finish == false) {
        for(i = 0; i < arrayIn.length; i++) {
            
            //if default option
            if (arrayIn[i][2] == 1){
                
                //if depends_on equals false
                if (arrayIn[i][1] == false) {
                    document.getElementById(arrayIn[i][0]).style.opacity = 1;
                } else {
                    dependId = arrayIn[i][1];
                    allow = allowNoClassify(prod, dependId);
                    
                    if (allow == true) {
                       document.getElementById(arrayIn[i][0]).style.opacity = 1; 
                    }
                }
                
            }
        }
    } else if (finish == true) {
        for(i = 0; i < arrayIn.length; i++) {
            //if not a default option
            if (arrayIn[i][2] == 0){
                //if depends_on equals false
                if (arrayIn[i][1] == false) {
                    document.getElementById(arrayIn[i][0]).style.opacity = 1;
                } else {
                    dependId = arrayIn[i][1];
                    allow = allowNoClassify(prod, dependId);
                    
                    if (allow == true) {
                       document.getElementById(arrayIn[i][0]).style.opacity = 1; 
                    }
                }
            }
        }
    }
    
}

showNoClassify(product, noClassify, false);






















