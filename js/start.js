function showDefault(prod) {
    let o = "";
    let c = "";
    let g = "";
    let oParam = "";
    let gParam = "";
    let pParam = "";
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
                    
                    /*oParam = o.title.trim();
                    oParam = oParam.toLowerCase();
                    oParam = oParam.replace(/\s/g, '');
                    oParam = oParam + "O" + o.id;
                    //console.log(typeof oParam);
                    
                    gParam = g.title.trim();
                    gParam = gParam.toLowerCase();
                    gParam = gParam.replace(/\s/g, '');
                    gParam = gParam + "G" + g.id;
                    
                    pParam = prod.title.trim();
                    pParam = pParam.toLowerCase();
                    pParam = pParam.replace(/\s/g, '');*/
                    
                    oClick(prod, g, o, false, true);
                    
                    //oClick(pParam, gParam, oParam, false, true);
                    
                    
                    
                    console.log("oClick(" + prod + ", " + g + ", " + o + ", " + false + ", " + true + ");");
                    
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
    
    console.log(prod + ", " + requireC + ", " + requireG);
    gClick(prod, requireC, requireG);
    
    //oClick(guitar, modelG1, camilaO1, false, true);
    //oClick(guitar, bodyprofileG2, curvedcamilaO5, false, true);
}

showDefault(product);






