<?php include "assets/inc/header.php"; //Header Include Here ?>

<!-- Page Banner and breadcrumb Starts From Here  -->
<br>
<br>
<br>
<br>
<br>
<div class="box-container">
    <div class="home-food-banner">
        <div class="bannerDet">
            <h1>Sale Foods Page</h1>
            <span><a href="index.php">Home</a> / </span>
           <span>Sale</span>
        </div>
    </div>
</div>
<!-- Page Banner and breadcrumb Ends To Here  -->

<!-- sale product section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading"> discount dishes </h3>
    <h1 class="heading"> Sale dishes </h1>
    
    <!-- Display Food Posts From DataBase Dynamically -->
    <?php
     $saleQuery = "SELECT * FROM foodposts ORDER BY id DESC";
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
             
            <a href="singleProduct.php?productId=<?php echo $saleDataRow['id'];//Product Id Here For Wishlist?>" class="fas fa-eye"></a>
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
            <br> <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Cart Page?>" class="btn">Buy Now</a>
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

<?php include "assets/inc/footer.php"; //Footer Include Here ?>