<?php include 'assets/inc/header.php'; ?><!-- Header Include Here -->
<!-- loader part  -->
<!-- <div class="loader-container">
    <img src="assets/images/loader.gif" alt="">
</div> -->
<section class="home" id="home">
    <!-- home section starts  -->    
<?php
    if(isset($_GET['noalert'])){
        $alert = $_GET['noalert'];
        echo "<br><br><br><br><h3 class='text-danger'>".$alert."</h3>";
    } 
    if(isset($_GET['searchAlert'])){
        $alert = $_GET['searchAlert'];
        echo "<br><br><br><br><h3 class='text-danger'>".$alert."</h3>";
    } ?>
    <div class="swiper-container home-slider">
        <div class="swiper-wrapper wrapper"> 
            <!-- //Alert Recive and show here  -->

             <div class="swiper-slide slide">
                <div class="content">
   

                    <span>our special dish</span>
                    <h3>hot pizza</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
                    <a href="#" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="assets/images/home-img-3.png" alt="">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home section ends -->

<!-- dishes section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading"> our dishes </h3>
    <h1 class="heading"> Latest dishes </h1>
    
    <!-- Display Food Posts From DataBase Dynamically -->
    <?php
     $selectQuery = "SELECT * FROM foodposts ORDER BY id DESC LIMIT 9";
     $queryResult = mysqli_query($connection, $selectQuery) or die(mysqli_error());
     $countQueryResult = mysqli_num_rows($queryResult);//Count The Existed Query Result Here

     // Display Query Result On The UI Using PHP if, else condition
     if($countQueryResult > 0){
   ?>
    <div class="box-container">
        <?php
        //Run the while loop and display foods from database to ui
        while($dataRow = mysqli_fetch_assoc($queryResult)){
        ?>        
        <div class="box">
            <?php
            // SaleBase Percentage Show PHP Code Here
            $regularPrice = $dataRow['regularPrice'];//Regular Price Store Here
            $salePrice = $dataRow['salePrice'];//Sale/Dsicount Price Store Here
            // Count Discount Percentage Using If, Else Condition
            if($regularPrice === "0"){
            }else{
               ?>
            <div class="saleBasePercentage" id="saleBadge">
            <?php
            $decimOfregularPrice = $regularPrice / 100; //Decim Of Regular Price
            $differencePrice = $regularPrice - $salePrice;// Calculate Difference Between Regular Price And Discount Price
            $percentageResult = round($differencePrice / $decimOfregularPrice);// Calculate Discount Percentage 
            echo "-".$percentageResult."%";// Finnaly Display Discount Percentage
            ?> </div><?php 
            }
             ?>
             
            <a href="productWishlist.php?wishlistId=<?php echo $dataRow['id'];//Product Id Here For Wishlist?>" class="fas fa-eye"></a>
            <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Single Product Page?>">
            <img style="border-radius: 100%;" src="c-pannel/pannel/assets/images/foodImages/<?php echo $dataRow['foodImage'];//FoodImage Here ?>" alt=""></a>
            <h3><?php echo $dataRow['foodName'];//Food Title Here ?></h3>
<!--             <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div> -->

             <?php 
              if($dataRow['regularPrice'] === "0"){
                  //Don't need to show regular price with out discount
              }else{
                  ?>
             <span id="regularPrice" style="text-decoration: line-through; color: #f9171785;">$<?php echo $dataRow['regularPrice'];//Food Price Here ?>
              </span>
              <?php 
              } ?>
              <!---<span style="margin-right: 1px;"></span>--><span id="salePrice">$<?php echo $dataRow['salePrice'];//Food Price Here ?></span>
            <br> 
             <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Cart Page?>" class="btn">Buy Now</a>
        </div>
    <?php } ?>
    </div>
    <?php
      }else{
        echo "<h3 class='text-danger'>No Food Posted Yet!</h3>";
      } 
     ?>
</section>

<!-- dishes section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h3 class="sub-heading"> about us </h3>
    <h1 class="heading"> why choose us? </h1>

    <div class="row">

        <div class="image">
            <img src="assets/images/about-img.png" alt="">
        </div>

        <div class="content">
            <h3>best food in the country</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, sequi corrupti corporis quaerat voluptatem ipsam neque labore modi autem, saepe numquam quod reprehenderit rem? Tempora aut soluta odio corporis nihil!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, nemo. Sit porro illo eos cumque deleniti iste alias, eum natus.</p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>easy payments</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
            </div>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- NewsLetter Section Starts From Here  -->
     <div class="box-container">
         <div class="newsletterSection">
             <div class="newsletterSubs">
                 <h3 style="font-size: 20px; color: var(--green);">Subscribe our newsletter.</h3>
                 <!-- <p style="width: 40%; font-size: 15px;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. -->
                    <!-- Ab, deleniti.</p> -->
                 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="email" placeholder="Enter Your Email Here" name="subscriptionEmail" style="padding:6px 10px; color:var(--green); font-size: 18px; border: 0px; border-radius: 5px; background:#ccc;">
                <button class="btn" name="subscribeBtn">Subscribe</button>
                <!-- Get Customers Email  -->
                <?php 
                if(isset($_POST['subscribeBtn'])){
                $emails = $_POST['subscriptionEmail'];

                //Set Email To DataBase 
                $queryToDb = "INSERT INTO customersemail SET emails = '$emails'";
                $resultQueryDb = mysqli_query($connection, $queryToDb);
                
                //Check The Query is true or false
                if($resultQueryDb){
                    echo "<h3 class='text-success'>Thanks. Subscription Added!</h3>";
                }else{
                    echo "<h3 class='text-danger'>Something wrong, Please try again!</h3>";
                }
                
                }else{}
                ?>
            </form>
             </div>
         </div>
     </div>
<!-- NewsLetter Section Ends To Here  -->

<!-- sale product section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading"> discount dishes </h3>
    <h1 class="heading"> Sale dishes </h1>
    
    <!-- Display Food Posts From DataBase Dynamically -->
    <?php
     $saleQuery = "SELECT * FROM foodposts ORDER BY id DESC LIMIT 10";
     $saleQueryResult = mysqli_query($connection, $saleQuery);
     $countSaleQueryResult = mysqli_num_rows($saleQueryResult);//Count The Existed Query Result Here

     // Display Query Result On The UI Using PHP if, else condition
     if($countSaleQueryResult > 0){
   ?>
    <div class="box-container">
        <?php
        //Run the while loop and display foods from database to ui
        while($saleDataRow = mysqli_fetch_assoc($saleQueryResult)){
        ?> 
        <?php
        //if the food has discount then show otherwise no
        $regularPrice = $saleDataRow['regularPrice'];//Regular Price Store Here
        $salePrice = $saleDataRow['salePrice'];//Sale/Dsicount Price Store Here
        // using if else condition for getting and displaying discount food data 
        if($regularPrice === '0'){}else{
            ?>
        <div class="box">
        <?php
            // Count Discount Percentage Using If, Else Condition
            if($regularPrice === "0"){
            }else{
               ?>
            <div class="saleBasePercentage" id="saleBadge">
            <?php
            $decimOfregularPrice2 = $regularPrice / 100; //Decim Of Regular Price
            $differencePrice2 = $regularPrice - $salePrice;// Calculate Difference Between Regular Price And Discount Price
            $percentageResult2 = round($differencePrice2 / $decimOfregularPrice2);// Calculate Discount Percentage 
            echo "-".$percentageResult2."%";// Finnaly Display Discount Percentage
            ?> </div><?php 
            }
             ?>
             
            <a href="productWishlist.php?wishlistId=<?php echo $saleDataRow['id'];//Product Id Here For Wishlist?>" class="fas fa-eye"></a>
            <a href="singleProduct.php?productId=<?php echo $saleDataRow['id'];//Product Id Here For Single Product Page?>"><img style="border-radius: 100%;" src="c-pannel/pannel/assets/images/foodImages/<?php echo $saleDataRow['foodImage'];//FoodImage Here ?>" alt=""></a>
            <h3><?php echo $saleDataRow['foodName'];//Food Title Here ?></h3>
<!--             <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div> -->

             <?php 
              if($saleDataRow['regularPrice'] === "0"){
                  //Don't need to show regular price with out discount
              }else{
                  ?>
             <span id="regularPrice" style="text-decoration: line-through; color: #f9171785;">$<?php echo $saleDataRow['regularPrice'];//Food Price Here ?>
              </span>
              <?php 
              } ?>
              <!---<span style="margin-right: 1px;"></span>--><span id="salePrice">$<?php echo $saleDataRow['salePrice'];//Food Price Here ?></span>
            <br> <a href="singleProduct.php?productId=<?php echo $saleDataRow['id'];//Product Id Here For Cart Page?>" class="btn">Buy Now</a>
        </div>
    <?php } ?>
    <?php } ?>
    </div>
    <?php
      }else{
        echo "<h3 class='text-danger'>No Food Posted Yet!</h3>";
      } 
     ?>
</section>
<!-- sale product section ends -->

<!-- Latest blog section starts from here  -->
<section class="menu" id="menu">

    <h3 class="sub-heading"> Healthy life </h3>
    <h1 class="heading"> letest blogs </h1>
 <!-- Display Blog Posts From DataBase Dynamically -->
 <?php
     $blogQuery = "SELECT * FROM blogposts ORDER BY id DESC LIMIT 3";
     $blogQueryResult = mysqli_query($connection, $blogQuery) or die(mysqli_error());
     $countBlogQueryResult = mysqli_num_rows($blogQueryResult);//Count The Existed Query Result Here

     // Display Query Result On The UI Using PHP if, else condition
     if($countBlogQueryResult > 0){
   ?>
    <div class="box-container">
    <?php
        //Run the while loop and display foods from database to ui
        while($blogDataRow = mysqli_fetch_assoc($blogQueryResult)){
        ?>        
        <div class="box">
            <div class="image">
                <a href="singleBlog.php?blogId=<?php echo $blogDataRow['id']; ?>"><img src="c-pannel/pannel/assets/images/blogImages/<?php echo $blogDataRow['blogImage'];//FoodImage Here ?>" alt="blogImage"></a>
            </div>
            <div class="content">
                <h3><?php echo $blogDataRow['blogName'];//Blog Title Here ?></h3>
                <span style="color:var(--green); font-size:15px;">Author: <?php echo $blogDataRow['blogAuthor']; ?>, </span>
                <span style="color:var(--green); font-size:15px;"> Published Date: <?php echo substr_replace($blogDataRow['date'], "", 10); ?></span>
                <p><?php echo substr_replace($blogDataRow['blogDesc'], "...", 200);//Blog Description ?></p>
                <a href="singleBlog.php?blogId=<?php echo $blogDataRow['id'];//Blog DataBase Id ?>" class="btn">read more</a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <?php } ?>

</section>
<!-- Latest blog section ends to here  -->
<?php include 'assets/inc/footer.php'; ?><!-- Footer Include Here -->