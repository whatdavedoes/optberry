<?php if ($progBar) { ?>

<div id="productProgress" class="progress shadow" style="height: 24px;">
    

<?php 
function buildProgressBar () { 
    global $productId;
    $categories = getAllCategories($productId);
    $output = "";                    
    
    foreach ($categories as $category) {
        $output .= '<div id="';
        $output .= 'bg-' . lowercase($category['category_title']) . '-' . $category['id'];
        $output .= '" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" >';
        
        $output .= '</div>';
    }  
    return $output;
}

echo buildProgressBar();
?>
    
</div>

<?php } ?>