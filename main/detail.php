<?php
session_start();
require_once('product_function.php');
// Set Variables for featured products
$featuredProductsNames = array();
$featuredProducts = readFeaturedProducts();
$featuredProductsCount = 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="detail.css">
    <title>Product Detail</title>
</head>
<body>
    <?php
        require_once('header.php')
    ?>
    <h2>Product detail</h2>
    <?php
            foreach ($featuredProducts as $featuredProduct) {
                if($featuredProduct['id'] == $_GET['id']){
                $name = $featuredProduct['name'];
                $price = $featuredProduct['price'];
                $description = $featuredProduct['description'];
                $image = $featuredProduct['image'];
                break;
            }}
            echo '
            <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <img class="shop-item-image" src="../img-product/'.$image.'" alt="" width="100%" id="MainImg">
                <div class="small-image-group">
                </div>
            </div>
    
            <div class="single-pro-details">
                <h4 class="shop-item-title">'.$name.'</h4>
                <h2 class="shop-item-price">'.$price.'</h2>
                <input class="quantity-input" type="number" value="1">
                <button class="normal shop shop-item-button">Add To Cart</button>
                <h4>Product Details</h4>
                <span>'.$description.'</span>
            </div>
        </section>  
            ';

            ?>
    <?php
        require_once('footer.php')
    ?>

<script src="main.js">
    </script>

</body>
</html>