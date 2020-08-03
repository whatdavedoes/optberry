
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
            
            console.log('\n');
    
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
            console.log(path.clicks);
        }
    
        
      
        
    } else {
        //do nothing b/c it's alreay clicked
    }
}



















    
function clicker(product, path, C = null, O = null, S = null) {
        
        if(path.label == 'category') {  //if path is a category:
        //console.log('This is a category.');
            
            if (path.currentCategory == false) {
                on(path); //adds new click
                path.currentCategory = true; //sets current to true
                console.log(path.title + " is the current category. \n" + path.title + " clicks:");
                console.log(path.clicks);
                
                //sets other categories to false
                for(i = 0; i < product.categories.length; i++) {
                    if (product.categories[i].title == path.title){ //if current category
                        //do nothing
                    } else if (product.categories[i].currentCategory == true) {//if it was the last current
                        off(product.categories[i]);//removes click
                                            
                        product.categories[i].currentCategory = false; //sets current to false;
                        
                        console.log("(" + product.categories[i].title + " current: " + product.categories[i].currentCategory + ")");
                        console.log(">>> " + product.categories[i].title + " clicks");
                        console.log(product.categories[i].clicks);
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
                //this.currentCategory == true;
            }
            
            console.log('\n');
            
        } else if (path.label == 'group') {
            //console.log('This is a group.');
            
            //for example, path may be shapeC.modelG
            if (path.currentGroup == false) {
                on(path); //adds new click
                path.currentGroup = true; //sets current to true
                console.log(path.title + " is the current group. \n" + path.title + " clicks:");
                console.log(path.clicks);
            }
            
            //sets other groups to false
                for(i = 0; i < product.path.length; i++) {
                    if (product.path[i].title == path.title){ //if current category
                        //do nothing
                    } else if (product.categories[i].currentCategory == true) {//if it was the last current
                        off(product.categories[i]);//removes click
                                            
                        product.categories[i].currentCategory = false; //sets current to false;
                        
                        console.log("(" + product.categories[i].title + " current: " + product.categories[i].currentCategory + ")");
                        console.log(">>> " + product.categories[i].title + " clicks");
                        console.log(product.categories[i].clicks);
                    }
                }
            
        } else {
            console.log('This is an option.');
        }
    }