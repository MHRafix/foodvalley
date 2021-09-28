<?php include 'assets/inc/header.php';//Header include here ?>
<!-- HomeSection Starts From Here -->
<br>
<br>
<br>
<br>
<br>
<?php 

if (isset($_POST['Searchbtn'])){

$search_keyword = mysqli_real_escape_string($connection, $_POST['searchData']);
$searcQuery = "SELECT * FROM foodposts WHERE foodName LIKE '%$search_keyword%' OR foodDesc LIKE '%$search_keyword%' ORDER BY id DESC"; ?>
<div class="box-container">
    <div class="home-food-banner">
        <div class="bannerDet">
            <h1>Search Foods Page</h1>
            <span>Result on your search keyword <a>"<?php echo $search_keyword; ?>"</a></span>
        </div>
    </div>
</div>
<!-- HomeSection Ends To Here -->

<!-- dishes section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading"> our dishes </h3>
    <h1 class="heading"> all dishes </h1>
    
    <!-- Display Food Posts From DataBase Dynamically -->
    <?php
     $queryResult = mysqli_query($connection, $searcQuery) or die(mysqli_error());
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
             
            <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Wishlist?>" class="fas fa-eye"></a>
            <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Single Product Page?>"><img style="border-radius: 100%;" src="c-pannel/pannel/assets/images/foodImages/<?php echo $dataRow['foodImage'];//FoodImage Here ?>" alt=""></a>
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
            <br>  <a href="singleProduct.php?productId=<?php echo $dataRow['id'];//Product Id Here For Cart Page?>" class="btn">Buy Now</a>
        </div>
    <?php } ?>
    </div>
    <?php
      }else{
        echo "<h3 class='text-danger'>No Result Match With Your Search Query!</h3>";
      } 
     ?>
</section>
<?php }else{
        header("location:index.php?searchAlert=Sorry, with out searching food you can't access this page!");
    } ?>
<!-- dishes section ends -->
<?php include 'assets/inc/footer.php';//footer include here ?>