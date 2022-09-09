<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link type="text/css" rel="stylesheet" href="header_footer.css">

</head>
<body>
    <header id="header-bar" class="header-bar">
        <div class="logo">
            <a href="index.html">
                <img src="..\img-product\Logo.png" alt="logo"/>
            </a> 
        </div>
        <ul class="topnav">
            <?php
            if(!isset($_SESSION['user'])){
            echo'<li><a href="index.php" class="active">Login</a></li>';}
            ?>

            <?php
            if($_SESSION['role'] == 'vendor'){
            echo'<li><a href="add_product.php">Add Product</a></li>';
            echo'<li><a href="view_product.php">View Products</a></li>';}
            ?>

            <li><a href="my_account.php">My Account</a></li>
            <li><a href="Customer.php">Home</a></li>
            <?php
            if($_SESSION['role'] == 'customer'){
                echo'<li><a href="cart.php">Cart</a></li>';}
            ?>
            <?php
            if($_SESSION['role'] == 'shipper'){
                echo'<li><a href="shipper.php">Shipper</a></li>';}
            ?>
        </ul>
    </header>
</body>
</html>

