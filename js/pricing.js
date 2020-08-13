function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function dollarFormat(amount) {
    amount = amount / 100;
    amount = amount.toFixed(2);
    amount.toString();
    
    if ( amount.endsWith(".00") ) {
        output = amount.replace(".00", "");
        return '$' + numberWithCommas(output);
    } else {
        return '$' + numberWithCommas(amount);
    }
    
    
    return amount;
    
    
    /*amount = amount / 100;
    output = number_format($amount, 2);
    output = lowercase($output);
    if ( strpos($output,'.00') ) {
        $output = str_replace(".00", "", $output);
        return '$' . $output;
    } else {
        return '$' . $output;
    }*/
}

function toId(input) {
    let output = input.toLowerCase();
    output = output.trim();
    output = output.replace(/\s/g,'');
    return output;
}

function truncate(input, num) {
    output = input.trim();
    if (output.length > num) {
        output = output.substring(0, num) + "...";
    }
    return output;
}

function buildOptHtml(title, price) {
    /*<tr>
        <td><span class="border-left pl-4">Camila</span></td>
        <td class="text-right"><?php echo dollarFormat(180); ?></td>
    </tr> */
    
    title = truncate(title, 11);
    
    //creates table row element
    let tr = document.createElement("tr");
    
    //adds table row to table
    document.getElementById("addOnTbl").appendChild(tr);
    
    //creates title cell
    let tdTitle = document.createElement("td");   
    
    //appends title cell to row
    tr.appendChild(tdTitle);
    
    //creates span
    let sTxt = document.createElement("span");
    sTxt.classList.add("border-left", "pl-3");
    sTxt.innerHTML = title;
    
    //appends inside title cell
    tdTitle.appendChild(sTxt);
    
    //creates price cell
    let tdPrice = document.createElement("td");
    tdPrice.classList.add("text-right");
    tdPrice.innerHTML = dollarFormat(price);
    
    //appends price cell to row
    tr.appendChild(tdPrice);
}
 
function buildGHtml(title) {
    /*<tr>
        <td class="text-muted m-0" colspan="2"><span class="border-left pl-2">Model</span></td>
    </tr>*/
    
    title = truncate(title, 14);
    
    //creates table row element
    let tr = document.createElement("tr");
    
    //adds table row to table
    document.getElementById("addOnTbl").appendChild(tr);
    
    //creates title cell
    let tdTitle = document.createElement("td");
    tdTitle.classList.add("text-muted", "m-0");
    tdTitle.setAttribute("colspan", "2");
    
    //appends title cell to row
    tr.appendChild(tdTitle);
    
     //creates span
    let sTxt = document.createElement("span");
    sTxt.classList.add("border-left", "pl-2");
    sTxt.innerHTML = title;
    
    //appends inside title cell
    tdTitle.appendChild(sTxt);
}

function buildCHtml(title, a) {
    /*<tr>
        <td colspan="2"><span class="pl-0">Shape</span></td>
    </tr>*/
    titleInner = truncate(title, 14);
    
    
    //creates table row element
    let tr = document.createElement("tr");
    
    //adds table row to table
    document.getElementById("addOnTbl").appendChild(tr);
    
    //creates title cell
    let tdTitle = document.createElement("td");
    
    //add ID
    let tdTitleId = toId(title) + "-" + a;
    tdTitle.setAttribute("id", tdTitleId);
    
    //appends title cell to row
    tr.appendChild(tdTitle);
    
    //creates span
    let sTxt = document.createElement("span");
    sTxt.classList.add("pl-0");
    sTxt.innerHTML = titleInner;
    
    //appends inside title cell
    tdTitle.appendChild(sTxt);
}

function removeChildren() {
    
    let list = document.getElementById("addOnTbl");
        
    while ( list.childNodes.length > 0 ) {
        list.removeChild(list.childNodes[0]);
    }
}

function getAddOns() {
    
    removeChildren();
    
    if (document.getElementById("addOn").classList.contains("noVis") == true) {
        //do nothing
    } else {
        document.getElementById("addOn").classList.add("noVis");
    }
    
    if (document.getElementById("addOnCtrl").classList.contains("noVis") == true) {
        //do nothing
    } else {
        document.getElementById("addOnCtrl").classList.add("noVis");
    }
    
    
    let addOnTotal = null;
    let addOnFeatures = false;
    let listCategory = false;
    
    //FOR EACH CATEGORY
    for (let a = 0; a < product.categories.length; a++) {
        listCategory = false
        let oHtml = [];
        let cHtml = null;
        let gHtml = null;
        
        let category = product.categories[a];
        buildCHtml(category.displayTitle, a);
        
       
            //console.log("----------");
            //console.log(category);
        
            listCategory = false;
            //FOR EACH GROUP IN CATEGORY
            for (let b = 0; b < product.categories[a].groups.length; b++) {
                
                oHtml = [];
                let group = product.categories[a].groups[b];
                //console.log(group);
                 let d = 0;
                
                //FOR EACH OPTION IN GROUP
                for (let c = 0; c < product.categories[a].groups[b].options.length; c++) {
                    
                    let option = product.categories[a].groups[b].options[c];
                    //console.log(option);
                    if (option.addedPrice != null && option.currentOption == true) {
                        //console.log("added price not null and current");
                        addOnFeatures = true;
                        listCategory = true;
                        //console.log(addOnFeatures);
                        oHtml[d] = [option.displayTitle, option.addedPrice];
                        addOnTotal += option.addedPrice;
                        d++;
                    }
                 
                }
                
                if (oHtml.length > 0) {
                    //console.log(oHtml.length);
                    //buildCHtml(category.title);
                    buildGHtml(group.title);
                    
                    for (let e = 0; e < oHtml.length; e++) {
                        //console.log("trying to build option");
                        buildOptHtml(oHtml[e][0], oHtml[e][1]); 
                    }
                }
                 
            }
             
            if ( listCategory == false ) {
                let cTitle = product.categories[a].displayTitle;
                let tdTitleId = toId(cTitle) + "-" + a;
                //console.log(tdTitleId);
                document.getElementById(tdTitleId).remove();
            }
            
        }
    
    if (addOnFeatures == true) {
        //console.log("removing noVis class")
        //makes dropdown & btn control visible and in DOM
        document.getElementById("addOn").classList.remove("noVis");
        document.getElementById("addOnCtrl").classList.remove("noVis");
      
    }
    
    let subtotal = addOnTotal + basePrice;
    
    if (addOnTotal == null) {
        document.getElementById("addOnPrice").innerHTML = "--";
    } else {
        addOnTotal = dollarFormat(addOnTotal);
        document.getElementById("addOnPrice").innerHTML = addOnTotal;
    }
    
    subtotal = dollarFormat(subtotal);
    
    
    document.getElementById("subtotal").innerHTML = subtotal;
    
    //console.log("add on total: " + addOnTotal);
    //console.log("base price: " + basePrice);
    //console.log(subtotal);
    //subtotal Id.innerHtml = subtotal
    
}















































