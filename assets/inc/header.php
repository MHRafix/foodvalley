<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Valley</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
<!-- header section starts -->

<header>

    <a href="index.php" class="logo"><i class="fas fa-utensils"></i>foodValley.</a>

    <nav class="navbar">
        <a class="active" href="index.php">home</a>
        <a href="foods.php">foods</a>
        <a href="blogs.php">Blogs</a>
        <a href="discountFoods.php">Hot Sale</a>
        <a href="order.php">Order</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <!-- <a href="wishlist.php" class="fas fa-heart"></a> -->
        <!-- <a href="cart.php" class="fas fa-shopping-cart"></a> -->
    </div>

</header>



<!-- search form  -->

<form action="searchFoods.php" id="search-form" method="POST">
    <input type="search" placeholder="Search Your Favourite Foods Here..." name="searchData" id="search-box">
    <button for="search-box" name="Searchbtn" class="fas fa-search"></button>
    <i class="fas fa-times" id="close"></i>
</form>
<!-- header section ends-->

<!-- Include Database Connection Here -->
<?php include 'config.php'; ?>
