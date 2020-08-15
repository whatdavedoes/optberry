<?php 

require_once('database.php');
require_once('inc/functions.php');

//$categories = getAllCategories();
//$options = getAllOptions();

//This variable sets all display groups and options for the given product
$productId = '1';

$product = getProduct($productId);
$pName = lowercase($product['title']);
$genSettings = getGenSettings();


//echo print_r($genSettings);
$bannerImg = $product['product_banner'];
$basePrice = dollarFormat($product['base_price']);
$profileName = $genSettings['profile_name'];
$colorNav = $genSettings['color_nav'];
$profileIcon = $genSettings['profile_icon'];
$profileLogo = $genSettings['profile_logo'];
//prints each row as an array separted by line break
/*foreach (array_keys($categories) as $category) {
    echo print_r($categories[$category]);
    echo '<br/><br/>';
}*/

/*foreach ($options as $option) {
    echo print_r($option);
    //echo '<br/><br/>';
}*/

/*foreach ($categories as $category) {
    echo $category['btn_hvr_clr'];
    echo '<br/><br/>';
}*/

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <!--jquery also in footer-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Montserrat&display=swap" rel="stylesheet">
    
 
    <script src="js/_product.js"></script>
    <script src="js/category.js"></script>
    <script src="js/group.js"></script>
    <script src="js/option.js"></script>
    <script src="js/click.js"></script>
    
    
    <script src="js/pricing.js"></script> 
    <script src="js/script.js"></script>
      

    <?php include __DIR__ . '/populate.php'; ?>  
     
      
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="parts_place.css">
  

    <title>Revomere Custom Guitars</title>

    <link rel="shortcut icon" type="image/jpg" href="/img/logo_sm-min.png"/>
  </head>
  <body onload="getAddOns();">
