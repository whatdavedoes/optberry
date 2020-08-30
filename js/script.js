

function clearActive() {
    var list = document.getElementsByClassName("inner-nav-txt");
    
    var i;
    for (i = 0; i < list.length; i++) {
      list[i].classList.remove("active");
    }
}

//let product = guitar;
    
function on(path) {
    path.addClick(new Click());
}
    
function off(path) {
    let index = path.clicks.length - 1;
    path.clicks[index].end = Date.now();
}

function cClick(product, path) {
    
    if (path.currentCategory == false) {
                on(path); //adds new click
                path.currentCategory = true; //sets current to true
                //console.log(path.title + " is the current category. \n" + path.title + " clicks:");
                //console.log(path.clicks);
        
                document.getElementById("bg-" + toLower(path.displayTitle) + "-" + path.id).classList.add("progress-bar-animated");
        
                //sets other categories to false
                for(i = 0; i < product.categories.length; i++) {
                    if (product.categories[i].title == path.title){ //if current category
                        //do nothing
                    } else if (product.categories[i].currentCategory == true) {//if it was the last current
                        off(product.categories[i]);//removes click
                                            
                        product.categories[i].currentCategory = false; //sets current to false;
                        
                        //console.log("(" + product.categories[i].title + " current: " + product.categories[i].currentCategory + ")");
                        //console.log(">>> " + product.categories[i].title + " clicks");
                        //console.log(product.categories[i].clicks);
                        for(a = 0; a < product.categories[i].groups.length; a++) {
                            if (product.categories[i].groups[a].currentGroup == true) {
                                product.categories[i].groups[a].currentGroup = false;
                                
                                progElement = document.getElementById("bg-" + toLower(product.categories[i].displayTitle) + "-" + product.categories[i].id);
                                
                                if(progElement.classList.contains("progress-bar-animated") == true) {
                                    progElement.classList.remove("progress-bar-animated");
                                }
                                
                                off(product.categories[i].groups[a]);
                            }
                        }
                    }
                }
                
                //clears the active class
                var list = document.getElementsByClassName("inner-nav-txt");
                var i;
                for (i = 0; i < list.length; i++) {
                  list[i].classList.remove("active");
                }
                
            } else {
                //do nothing b/c it's alreay clicked
            }
            
            //console.log('\n');
            
    
}

//path shapeC.groups[0]
function gClick(product, category, path) {
    
    //example path = shapeC.groups[0]
    if (path.currentGroup == false) {
        
        //if current category is false
        if (category.currentCategory == false) {
            
            //loops through categories
              for(let i = 0; i < product.categories.length; i++) {
                let cCurrent = product.categories[i];
                
                //if current category:
                if (cCurrent.currentCategory == true) {
                    for(let a = 0; a < cCurrent.groups.length; a++) {
                          //loop through groups
                          let gCurrent = cCurrent.groups[a];
                          if ( gCurrent.currentGroup == true ) {
                              //make false
                              gCurrent.currentGroup = false;
                              //off click
                              off(gCurrent);
                          }
                    }
                    
                    cCurrent.currentCategory = false; //make false
                    off(cCurrent); //off click category
                }
                  
                
                  
              }
            
              on(category); //adds new click on category
              category.currentCategory = true; //sets current to true
            
              on(path); //adds new click on group
              path.currentGroup = true; //sets current to true
            
        } else { //if current category is true
            
            for(let i = 0; i < category.groups.length; i++) {
                //loop through groups of category
                if (category.groups[i].currentGroup == true) { 
                    //if current, make not current
                    category.groups[i].currentGroup = false;
                    off(category.groups[i]); //off click
                }
            }
            
            path.currentGroup = true;
            on(path);
            //console.log(path.clicks);
        }
    
        
      
        
    } else {
        //do nothing b/c it's alreay clicked
    }
}

function hideBtn(cssId) {
    element = document.getElementById(cssId);
    if (element.classList.contains("noVis") == true) {
        return;
    }
    element.classList.add("noVis");
}

function showBtn(cssId) {
    element = document.getElementById(cssId);
    if (element.classList.contains("noVis") == true) {
        element.classList.remove("noVis");
        return;
    }
    return;
}

function show(cssId) {
    
    element = document.getElementById(cssId);
    if (element.classList.contains("noVis") == true) {
        element.classList.remove("noVis");
    }
}

function hide(cssId) {
    element = document.getElementById(cssId);
    if (element.classList.contains("noVis") == true) {
        return;
    }
    element.classList.add("noVis");
}

//example optionObject is camilaO1
function isCurrentOption(optionObject) {
    if (optionObject.currentOption == false) {
        optionObject.currentOption = true;
    }
}

function notCurrentOption(optionObject) {
    if (optionObject.currentOption == true) {
        optionObject.currentOption = false;
    }
}

function hideImg(input) {
    element = document.getElementById(input);
    element.style.opacity = "0";
}

function showImg(input) {
    element = document.getElementById(input);
    element.style.opacity = "1";
}

//loops through all options and lists clicks
/*function listClicks(product) {
    
    let clickArray = [];
        
        for (let a = 0; a < product.categories.length; a++) {
            
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    
                    let clicks = product.categories[a].groups[b].options[c].clicks;
                    
                   
                    clickArray.push(clicks);
                    
                }
                    
            }
            
        }
   
    return clickArray;
}*/

function askCurrentOption(dependsId) {
    for (let a = 0; a < product.categories.length; a++) {
            
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    
                    let opt = product.categories[a].groups[b].options[c];
                    
                    if (opt.id == dependsId) {
                        if (opt.currentOption == true) {
                            //return toId(opt.title) + "_btn_" + opt.id;
                            return true;
                        } else {
                            return false;
                        }
                    }                  
                    
                    
                }
                    
            }
            
        }
    //return false;
}

function listInnerDependancies(product, optionId) {
    let opArray = "";
    let current = "";
    let ca = "";
    let gr = "";
    let op = "";
    let ininHtml = "";
    let cSpanClass = "";
        
        for (let a = 0; a < product.categories.length; a++) {
            cSpanClass = "bg-" + toLower(product.categories[a].displayTitle) + product.categories[a].id;
            
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    ca = product.categories[a].displayTitle;
                    gr = product.categories[a].groups[b].title;
                    op = product.categories[a].groups[b].options[c];
                    //product.categories[a].groups[b].options[c].id;
                    
                    if( optionId == op.dependsOne && op.currentOption == true) {
                        ininHtml = ca + " > " +  gr + " > " + "<span class=\"badge badge-dark\">" + op.displayTitle + "</span><br>";
                        opArray += ininHtml;
                        
                        
                        
                        //console.log("Adding to INSIDE Option Array...");
                        //console.log(opArray);
                    }
                    
                                        
                    //optionArray += product.categories[a].groups[b].options[c].title;
                    
                    /*optionArray += product.categories[$a].groups[$b].options[$c].title + "\n";*/
                    
                    
                }
                    
            }
            
        }
   
    return opArray;
}

//loops through all options and adds dependancies to array
function listDependancies(product, optionId) {
    //console.log("ALERT!");
    let optArray = "";
    let current = "";
    let ca = "";
    let gr = "";
    let op = "";
    let inHtml = "";
        
        for (let a = 0; a < product.categories.length; a++) {
            
            
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    ca = product.categories[a].displayTitle;
                    gr = product.categories[a].groups[b].title;
                    op = product.categories[a].groups[b].options[c];
                    //product.categories[a].groups[b].options[c].id;
                    
                    if( optionId == op.dependsOne && op.currentOption == true) {
                        inHtml = ca + " > " +  gr + " > " + "<span class=\"badge badge-dark\">" + op.displayTitle + "</span><br>"
                        optArray += inHtml;
                        
                        let $out = [];
                        $out = listInnerDependancies(product, op.id);
                        
                        optArray += $out;
                        
                        
                        //console.log("Adding to Option Array...");
                        //console.log(optArray);
                    }
                    
                                        
                    //optionArray += product.categories[a].groups[b].options[c].title;
                    
                    /*optionArray += product.categories[$a].groups[$b].options[$c].title + "\n";*/
                    
                    
                }
                    
            }
            
        }
   
    return optArray;
}

//true allows dependants & false restricts dependants
function toggleDependants(id, allow) {
    //FOR EACH CATEGORY
    for (let a = 0; a < product.categories.length; a++) {
            //FOR EACH GROUP
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                //LOOP THROUGH OPTIONS
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    
                    let option = product.categories[a].groups[b].options[c];
                    let cssBId = "";
                    let cssImgId = "";
                    
                        //IF CURRENT LOOPED OPTION DEPENDS-ONE == ID & DEPENDS-TWO == NULL 
                        if (option.dependsOne == id /*&& option.dependsTwo == null*/) {
                            
                            
                            //CHECKS IF PART OF A SELECT BOX
                            if (option.selectId == null) { //IS NOT PART OF A SELECT BOX
                                cssBId = toId(option.title) + "_btn_" + option.id;
                                
                            } else { //IS A PART OF A SELECT BOX
                                cssBId = "select_" + option.selectId;
                            }
                            
                            //if being clicked on:
                            if (allow == true) {
                                //show btn of this dependancy
                                show(cssBId);
                                
                            //if being clicked off:
                            } else {
                                
                                //------------------------------------------------------                        
                                if (option.currentOption == true) {
                                /*console.log(option.title + ' is current, clicking off...');
                                console.log(product);
                                console.log(product.categories[a].groups[b]);
                                console.log(option);
                                console.log("--------");*/
                                oClick(product, product.categories[a].groups[b], option, true);
                                }
                                //console.log(product);
                                //console.log(product.categories[a].groups[b]);
                                //console.log(option);
                                
                                //-----------------------------------------------------
                                
                                hide(cssBId);
                            }
                                
                            //console.log(cssBId);

                        } 
                    
                        
                    
                    
                }
                    
            }
            
        }
    
    //noClassify Here
    
    
}

/*function modalDependants(arrayIn) {
    let output = "";
    for (i = 0; i < arrayIn.length; i++) {
        output .= arrayIn[i][0] + " > " + arrayIn[i][1] + " <span class=\"badge badge-warning\""> + arrayIn[i][2] + "\"</span><br>";
    }
    return output;
}*/

/*function continueRequire(prod) {
    if(requiredGroup == false) {
        //adds disabled attr to all nav btn not in allowed groups
        return;
    }
    
     //for each category-----------------------------------------------------------
    for (let a = 0; a < prod.categories.length; a++) {
        let passOver = false;
        c = prod.categories[a];
        //console.log(c.title);
        
        //close accordian             
        cCard = document.getElementById("collapse" + toLower(c.displayTitle) + "-" + c.id);
        
        
        //for each group----------------------------------
        for (let b = 0; b < c.groups.length; b++) {
                g = c.groups[b];
            
               
                
                
                //DISABLES GROUP BTNS
                if (allowedGroups.includes(g.id) == false){
                    gBtn = document.getElementById("id-" + toLower(g.title) + g.id);
                    console.log(gBtn);
                    gBtn.setAttribute("disabled", "");
                    
                    
                    if (g.oneSelection == true && g.requireFirst == 1) {
                    
                        //add alert icon next to group btn in nav
                        icoNo = document.getElementById("inner-n-" + toLower(g.title) + g.id);
                        icoNo.setAttribute("src", "/img/alert-min.png");
                        icoNo.classList.add("alertIcoAni");
                        
                        //remove disabled
                        gBtnId = document.getElementById("id-" + toLower(g.title) + g.id);
                        gBtnId.removeAttribute("disabled")
                        
                    }
                } else {
                    passOver = true;
                }
                
                
            
        //------------------------------------------------
        }
        
        //DISABLES CATEGORY BTNS
        if (passOver == true) {
            cBtn = document.getElementById("top-id-" + toLower(c.displayTitle) + "-" + c.id);
            //cBtn.setAttribute("disabled", "");
            cBtn.removeAttribute("disabled");
        }
        passOver = false;
        
        
    //---------------------------------------------------------------------------    
    }
}*/



function oClick( product, group, path, offClick, modal = false ) {
    
    if (prioritize == true) {
        let createBtn = true;
        
        let pillSelect = document.getElementById("p-pill-" + toLower(group.title) + group.id);
        pillSelect.children[1].innerHTML = "- good choice!";
        
        
        for (i = 0; i < group.options.length; i++){
            if(group.options[i].currentOption == true){
                createBtn = false;
            }
        }
        
        if (createBtn == true) {
            node = document.createElement("div");
            node.setAttribute("style", "display: inline-block");
            contBtnId = "cont-" + toLower(group.title) + "-" + group.id;
            node.setAttribute("id", contBtnId);

            pillSelect.appendChild(node);
            pillSelect.children[2].innerHTML = '<button onclick="updatePriorityNav(product, true)" style="display: inline-block" type="button" class="ml-2 btn btn-outline-dark btn-sm">Continue <strong class="contAni">>>></strong></button>';
        }

    }
    
    if (modal == true) {
        blanketDisableNav(product);
        if (document.getElementById("finBtnCtn").classList.contains("noVis") == false) {
            document.getElementById("finBtnCtn").classList.add("noVis");
        }
    }
    

    if (document.getElementById("pBanner").classList.contains("noVis") == false) {
        document.getElementById("pBanner").classList.add("noVis");
    }
    
    //console.log("oClick has been run with " + path);
    //console.log(product.title);
    
    if (modal == false) {
        $('#dependsModal').modal("hide");
    }

    
    let imgId = "";
    //console.log(path.radio + ", " + group.oneSelection);
    //IF BTN - TOGGLE SELECT & NOT SELECT BOX - radio
    if (path.radio == false && group.oneSelection == false) {
        
        
        
        let input = path.title.toString() + "_" + path.id.toString();
        let checkInput = path.title.toString() + "_check_" + path.id.toString();
        
        if(path.currentOption == false) {
        //MAKE CURRENT
            isCurrentOption(path);
            
        //ADD CLICK
            on(path);
            
        //SHOW IMG
            showImg(input);
            
        //ADD TOGGLE ON CLASS
            show(checkInput);
         
        //allowDependants
            toggleDependants(path.id, true);
        
        
        
            
        } else {
            
        //---------------------
        if (modal == false) {

        let inputProduct = product;
        let inputPath = path.id;

        dependsOnArray = listDependancies(inputProduct, inputPath);    

            if (dependsOnArray.length > 0) {

                document.getElementById("dependsModalTitle").innerHtml = "Remi " + path.displayTitle + " Option:";

                $('#dependsModalTitle').html("You have unselected <b>" + path.displayTitle + "</b>.");

                $('#dependsModalBody').html("This will clear <b>" + path.displayTitle + "</b> and the following options that rely on it's selection:<br><br> " + dependsOnArray);

                $('#saveModal').click(function(){
                    oClick(product, group, path, offClick, true)
                });
                

                $('#dependsModal').modal("show");

                return;
            }
        }
        //--------------
            
        //MAKE NOT CURRENT
            notCurrentOption(path);
            
        //REMOVE CLICK
            off(path);
            
        //HIDE IMG
            hideImg(input);
            
        //REMOVE TOGGLE ON CLASS
            hide(checkInput);
            
        
        //restrictDependants
            toggleDependants(path.id, false);
        
            
        }
        
        
    //IF BTN - RADIO
    } else if (path.selectId == null && group.oneSelection == true) {
        
            if (path.currentOption == true && offClick != true) {
                //do nothing b/c already clicked
            } else if (offClick == true) {
                
                for (let a = 0; a < group.options.length; a++) {
                
                    //IF CURRENT:
                    if (group.options[a].currentOption == true){
                        //MAKE NOT CURRENT
                        notCurrentOption(group.options[a]);
                        //END CLICK
                        off(group.options[a]);

                        //HIDE IMG
                        imgId = group.options[a].title + "_" + group.options[a].id;
                        hideImg(imgId);

                        //HIDE RADIO
                        let radioInput = group.options[a].title + "_radio_" + group.options[a].id;
                        hide(radioInput);
                        
                        
                        //toggleDependants
                        toggleDependants(group.options[a].id, false);
                        
                    }
                }    
                
            } else {
                //LOOP THROUGH GROUP PARAM
                for (let a = 0; a < group.options.length; a++) {
                    
                    
                    //IF CURRENT:
                    if (group.options[a].currentOption == true){
                        
                            //---------------------
                            if (modal == false) {
                                
                            let inputProduct = product;
                            let inputPath = group.options[a].id;

                            dependsOnArray = listDependancies(inputProduct, inputPath); 
                                
                            if (dependsOnArray.length > 0) {

                                document.getElementById("dependsModalTitle").innerHtml = "You have selected " + path.displayTitle + ".";

                                $('#dependsModalTitle').html("<b>" + path.displayTitle + "</b> Option:");

                                $('#dependsModalBody').html("This selection will clear <b>" + group.options[a].displayTitle + "</b> and the following options that rely on this selection:<br><br>" + dependsOnArray + "<br><br><b>Do you wish to continue?</b>");

                                $('#saveModal').click(function(){
                                    oClick(product, group, path, offClick, true)
                                });

                                $('#dependsModal').modal("show");

                                return;
                            }
                            }
                            //--------------
                        
                        //MAKE NOT CURRENT
                        notCurrentOption(group.options[a]);
                        //END CLICK
                        off(group.options[a]);

                        //HIDE IMG
                        imgId = group.options[a].title + "_" + group.options[a].id;
                        hideImg(imgId);

                        //HIDE RADIO
                        let radioInput = group.options[a].title + "_radio_" + group.options[a].id;
                        hide(radioInput);
                        
                        
                        //restrictDependants
                        toggleDependants(group.options[a].id, false);
                        
                        //unnotify
                        //unnotify(group.options[a]);
                        
                    }
                }
                
            //MAKE CURRENT
            isCurrentOption(path);
            
            //ADD CLICK
            on(path);
            
            //SHOW IMG
            let input = path.title.toString() + "_" + path.id.toString();
            showImg(input);
            
            //SHOW RADIO
            let radioInput = path.title.toString() + "_radio_" + path.id.toString();
            show(radioInput);
            
           
            //allowDependants
            toggleDependants(path.id, true);
                
            //notify
            //notify(path);
            
            }
               
    //IF SELECT BOX        
    } else if (path.selectId != null) {
        
        //IF SELECT BOX - RADIO (ONE SELECTION GROUP)
        if (group.oneSelection == true && path.radio == true) {
            //LOOP THROUGH GROUP PARAM
            for (let a = 0; a < group.options.length; a++) {
                
                //IF CURRENT:
                if (group.options[a].currentOption == true){
                    
                    //---------------------
                    if (modal == false) {

                    let inputProduct = product;
                    let inputPath = group.options[a].id;

                    dependsOnArray = listDependancies(inputProduct, inputPath);    

                    if (dependsOnArray.length > 0) {

                        document.getElementById("dependsModalTitle").innerHtml = "You have selected " + path.displayTitle + ".";

                        $('#dependsModalTitle').html("You have selected <b>" + path.displayTitle + "</b>.");

                        $('#dependsModalBody').html("This will clear the <b>" + group.options[a].displayTitle + "</b> selection and the following options that rely on it's selection:<br><br> " + dependsOnArray);

                        $('#saveModal').click(function(){
                            oClick(product, group, path, offClick, true)
                        });

                        $('#dependsModal').modal("show");

                        return;
                    }
                    }
                    //--------------

                    //MAKE NOT CURRENT
                    notCurrentOption(group.options[a]);
                    //END CLICK
                    off(group.options[a]);
                    
                    //HIDE IMG
                    imgId = group.options[a].title + "_" + group.options[a].id;
                    
                    hideImg(imgId);
                    
                    //HIDE RADIO
                    let radioInput = group.options[a].title + "_radio_" + group.options[a].id;
                    hide(radioInput)
                    
                    
                    //console.log(radioInput);
                    
                    /*let radioInput = "noR_select_" + group.options[a].id;
                    hide(radioInput);*/
                    
                    
                    
                    //restrictDependants
                    toggleDependants(group.options[a].id, false);
                    
                }
            }
            
            if (offClick != true) {
            
                //MAKE CURRENT
                isCurrentOption(path);

                //ADD CLICK
                on(path);

                //SHOW IMG
                let input = path.title.toString() + "_" + path.id.toString();
                showImg(input);
                
                
                //SHOW RADIO
                let radioInput = path.title.toString() + "_radio_" + path.id.toString();
                console.log(radioInput + " is going into show function");
                show(radioInput);


                //allowDependants
                toggleDependants(path.id, true);
            
            }
            
            
        //IF SELECT BOX - CHECK (MULTIPLE SELECTION GROUP)    
        //IF ONE SELECTION IS FALSE:  //group.oneSelection == false
        } else if (group.oneSelection == false && path.radio == true && path.currentOption == false) {
          
            if (path.required != 1) {
                    let sId = "noR_select_" + path.selectId.toString();
                
                    if (document.getElementById(sId).classList.contains("noVis") == false ){
                        document.getElementById(sId).classList.add("noVis");
                    }           
            }
            
            let selectId = path.selectId;
            //LOOP THROUGH GROUP PARAM
            for (let a = 0; a < group.options.length; a++) {
                
                radioNone = "noR_select_" + group.options[a].selectId;
                
                if (document.getElementById(radioNone)) {
                    if (group.options[a].selectId == selectId) {
                        hide(radioNone);
                    }
                }
                
                //console.log("looping through options...");
                //LOOP THROUGH SELECT PARAM                
                if (group.options[a].selectId == selectId && group.options[a].currentOption == true) {
                //IF CURRENT:
                //if (group.options[a].currentOption == true){
                    
                    //---------------------
                    if (modal == false) {

                    let inputProduct = product;
                    let inputPath = path.id;

                    dependsOnArray = listDependancies(inputProduct, inputPath);    

                        if (dependsOnArray.length > 0) {

                            document.getElementById("dependsModalTitle").innerHtml = "You have selected " + path.displayTitle + ".";

                            $('#dependsModalTitle').html("You have unselected <b>" + path.displayTitle + "</b>.");

                            $('#dependsModalBody').html("This will clear the <b>" + path.displayTitle + "</b> selection and the following options that rely on it's selection:<br><br> " + dependsOnArray);

                            $('#saveModal').click(function(){
                                oClick(product, group, path, offClick, true)
                            });

                            $('#dependsModal').modal("show");

                            return;
                        }
                    }
                    //--------------
                    
                    //MAKE NOT CURRENT
                    notCurrentOption(group.options[a]);
                    //END CLICK
                    off(group.options[a]);
                    
                    //HIDE IMG
                    imgId = group.options[a].title + "_" + group.options[a].id;
                    hideImg(imgId);
                    
                    let radioInput = group.options[a].title.toString() + "_radio_" + group.options[a].id.toString();
                    
                    
                    
                    hide(radioInput);
                    
                    
                   
                    //restrictDependants
                    toggleDependants(group.options[a].id, false);
                    
                    
            
                    
                }
            }
            
            
            
            //MAKE CURRENT
            isCurrentOption(path);
            
            //ADD CLICK
            on(path);
            
            //SHOW IMG
            let input = path.title.toString() + "_" + path.id.toString();
            showImg(input);
            
            //SHOW CHECK BOX BTN
            let radioInput = path.title.toString() + "_radio_" + path.id.toString();
            show(radioInput);
            
            
            //allowDependants
            toggleDependants(path.id, true);
            
            
        } else if (group.oneSelection == false && path.radio == true && path.currentOption == true) {
            //do nothing b/c already selected
        } /*else if (group.oneSelection == false && path.radio == false) {}*/
    }
    
    getAddOns();
    updateProgress(product);
    
    updatePriorityNav(product);
}

