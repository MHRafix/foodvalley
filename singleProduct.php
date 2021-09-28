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
    <!-- Bootstrap cdn here  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
<?php include 'assets/inc/config.php'; ?>

<br>
<br>
<br>
<br>
   
   <?php
    //  Get The Clocked Blog Id 
    if(isset($_GET['productId'])){
    $singleProductId =$_GET['productId'];
    $productQuery = "SELECT * FROM foodposts WHERE id = '$singleProductId'";
    $productQueryResult = mysqli_query($connection, $productQuery) or die(mysqli_error()); 
    $countProductQueryResult = mysqli_num_rows($productQueryResult);
    // Display Query Result On The UI Using PHP if, else condition
    if($countProductQueryResult > 0){
    //Run the while loop and display foods from database to ui
    while($productDataRow = mysqli_fetch_assoc($productQueryResult)){
   ?>
  <div class="box-container">
    <div class="home-food-banner">
        <div class="bannerDet">
            <h1>Single Food Page</h1>
            <span><a href="index.php">Home</a> / </span>
           <span>Single Food</span> / </span><span><?php echo $productDataRow['foodName']; ?></span>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
      <!-- Main content starts from here  -->
           <main>
           	<div class="container">
           		<div class="imageModal" id="imgModal" style="width: 50%; height: 400px; position: absolute; left: 45%; display: none;">
           			<img src="c-pannel/pannel/assets/images/foodImages/<?php echo $productDataRow['foodImage']; ?>" alt="" style="width: 100%; height: 100%;">
           		</div>
           		<div class="row justify-content-between">
           			<div onmouseover="onmouseOverEffect()" onmouseout="onmouseOutEffect()" class="col-lg-5 col-md-5 col-sm-10" style="text-align: center; padding: 50px; box-shadow: 0px 0px 1px 1px #c6c8cc; height: 350px;">
           				<!-- <div class="saleBasePercentage" id="saleBadge">45%</div> -->
           				<img src="c-pannel/pannel/assets/images/foodImages/<?php echo $productDataRow['foodImage']; ?>" alt="images" style="height: 100%; width: 100%;">
           			</div>
           			<div class="col-lg-7 col-md-7 colsm-10" style="padding-left: 40px;">
           				<h2 style="font-size: 35px; font-weight: 700;"><?php echo $productDataRow['foodName']; ?></h2>
           				<span id="salePrice" style="font-weight: 700; font-size: 30px;">$<?php echo $productDataRow['salePrice'];//Food Price Here ?></span>
           				<?php 
                          if($productDataRow['regularPrice'] === "0"){
                              //Don't need to show regular price with out discount
                          }else{
                         ?>
                         <span id="regularPrice" style="margin-left: 8px; font-weight: 600; font-size: 25px; text-decoration: line-through; color: #f9171785;">$<?php echo $productDataRow['regularPrice'];//Food Price Here ?>
                          </span>
                          <?php 
                         } ?>
                         
                         <p style="font-size: 17px;"><?php echo substr_replace($productDataRow['foodDesc'], "...", 200); ?></p> <br>
                       <form action="checkOut.php" method="POST">
                        <input type="hidden" value="<?php echo $productDataRow['id'];  ?>" name="productId">
                          <input type="number" name="qnty" style="border: 1px solid #c6c8cc; width: 60px; padding: 7px 0px; font-size: 20px;" max="10000" min="1" value="1"> <br>
                        <button style="font-size: 20px;" name="checkoutBtn" class="btn">Proceed To Checkout</button>   
                         </form>

              
           			</div>
           		</div><br><br><br><br><br><br>

           		<div class="row" style="box-shadow: 0px 0px 1px 1px #c6c8cc;">
           			<div class="col-lg-2 col-md-2 col-sm-12">
           				<button style="font-size: 20px;" class="btn" id="description">Description</button><br>
<!--            				<button style="font-size: 20px;" class="btn" id="addInfo">Additional Info</button><br>
           				<button style="font-size: 20px;" class="btn" id="review">Review</button> -->
           			</div>
           			<div class="col-lg-10 col-md-10 col-sm-9" style="box-shadow: 0px 0px 1px 1px #c6c8cc;">
           				<p class="mt-2" style="font-size: 17px; padding: 15px;"><?php echo $productDataRow['foodDesc']; ?></p>
           			</div>
           			 <?php } ?>
       <?php } ?>
       <?php } ?><br><br><br><br>
           			<div class="col-lg-9 col-md-9 col-sm-9" style="display: none;">
           				<h2>Additional Info</h2>
           				<p style="font-size: 17px;">Lorem ipsum dolor sit amet consectetur adipisicing, elit. Dignissimos nostrum laboriosam voluptates porro dolorum ipsam in ipsa sed, non expedita provident, corrupti. Voluptas aliquid nemo iure ipsum corrupti, sed nam, eos quaerat consectetur explicabo tempore sit, enim quasi repudiandae veniam inventore quod veritatis voluptatibus expedita dignissimos sunt blanditiis voluptatum dicta. Voluptatibus voluptas distinctio accusamus magnam esse. Incidunt nisi qui soluta eius aperiam, numquam voluptatem fugit veritatis minima error optio non, fuga rem. Excepturi recusandae sit quas non quos dicta consequuntur ut, accusamus, iste cumque unde? Quibusdam cupiditate aliquid quis ipsum dolor ex at illum numquam sint doloremque, commodi consequuntur animi unde eaque totam assumenda veniam, optio esse officia ipsa iure maiores quod veritatis? Voluptas, facilis tempora in quo, voluptates labore saepe sequi cumque placeat perferendis dolor maiores reprehenderit, excepturi repellat officiis distinctio id ratione eaque mollitia pariatur porro. Aperiam perspiciatis impedit tempore ipsum excepturi tempora nobis voluptatem soluta in, sed provident maiores et molestias consectetur vitae eos nisi at, quae delectus debitis, quisquam officiis accusamus fugiat facere aspernatur! Tempora odit assumenda ullam iure illum repellat amet alias dignissimos. Velit vero, eligendi dolor tempora neque numquam atque non, quod amet tenetur vel beatae consequuntur necessitatibus repudiandae, saepe odio aut cum! Magnam!</p>
           			</div>
           			<div class="col-lg-11 col-md-11 col-sm-12" style="display: none;">
           				<h2>Place Review Here</h2>
           				<p style="font-size: 17px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus illum similique aut fugiat odit, minima rerum iure harum voluptate quo laboriosam excepturi aliquid sint natus consectetur hic nam autem qui corrupti sed obcaecati officiis tenetur voluptatibus quidem! Dolor, aspernatur! Exercitationem nobis perspiciatis architecto, eos voluptatem? Laborum sed eaque facere vitae amet magnam quod, blanditiis nemo quibusdam commodi placeat rem, minus officia nesciunt totam facilis suscipit, sit ducimus iusto vero. Consectetur similique distinctio suscipit repudiandae minima in quidem possimus natus laborum esse porro iusto nulla accusantium aut maiores, accusamus veniam ullam vero deserunt? Doloremque necessitatibus, nostrum optio explicabo ipsum nesciunt quos?</p>
           			</div>
           		</div>
           	</div>   
           </main><br><br><br>


      <!-- Main content ends to here  -->




    
<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>locations</h3>
            <a href="#">lakshmipur</a>
            <a href="#">noakhali</a>
            <a href="#">dhaka</a>
            <a href="#">chattagram</a>
            <a href="#">cumilla</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">dishes</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">reivew</a>
            <a href="#">order</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#">+88 01611859722</a>
            <a href="#">+88 01707168261</a>
            <a href="#">webdevrafix@gmail.com</a>
            <a href="#">webdevrafix@gmail.com</a>
            <a href="#">Lakshmipur, Bangladesh - 3703</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/profile.php?id=100069940274273">facebook</a>
            <a href="https://www.twitter.com">twitter</a>
            <a href="https://www.linkedin.com/in/mh-rafix-42772a21b/">linkedin</a>
            <a href="https://www.github.com/mhrafix">github</a>
        </div>

    </div>

    <div class="credit"> copyright @ 2021 by <span><a href="https://www.rafix.netlify.app">MH Rafix</a></span> </div>

</section>

<!-- footer section ends -->

<!-- Bootstrap js cdn here  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- custom js file link  -->
<script src="assets/js/script.js"></script>

</body>
</html>