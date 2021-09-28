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

<style>
	button.orderBtn:hover{
		background: #08582a;
		transition: .5s;
	}
</style>
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
<br>
<br>
<br>
<br>


  
  <!-- Order Summary and Checkout Summary Starts From Here -->
<div class="main">
	<div class="container">
	    <div class="row">
        <div class="col-lg-6">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Order Summary</h2>
            </div>
        </div>
    </div>	
	</div>

   <!-- PHP code starts from here to make the dynamic info  -->
   <?php 
    
    if(isset($_POST['checkoutBtn'])){
    	$productQnt = $_POST['qnty'];
    	$productId = $_POST['productId'];

    	// include database connection here 
    	include 'assets/inc/config.php';

    	$selQuery = "SELECT * FROM foodposts  WHERE id = '{$productId}'";
    	$selQueryRes = mysqli_query($connection, $selQuery);
    	while($dataRow = mysqli_fetch_assoc($selQueryRes)){

?>

    <div class="container">
    	<div class="row justify-content-between">
    		<!-- Order summary starts from here  -->
    		<div class="col-lg-5">
    			<table class="table fs-3">
  <thead style="background: #27ae60; color: white;">
    <tr>
      <th scope="col">Food Info</th>
      <th scope="col">Values</th>
    </tr>
  </thead>
  <tbody class="bg-dark text-white" style=" font-weight: 700;">

 <tr>
      <td>Food Name : </td>   
      <td><?php echo $dataRow['foodName']; ?></td>   
  </tr>
   <tr>
      <td>Food Quantity : </td>   
      <td><?php echo $productQnt; ?> Piece</td>   
  </tr>
  <tr>
      <td>Unit Price : </td>   
      <td>$ <?php echo $dataRow['salePrice']; ?></td>   
  </tr>

  <tr>
      <td>Total Price : </td>   
      <td>$ <?php echo round($dataRow['salePrice'] * $productQnt, 2); ?></td>   
  </tr>  
  <tr>
      <td>Payment Type : </td>   
      <td>Cash On Delivery</td>   
  </tr>  
  <tr>
      <td>Delivery Time : </td>   
      <td>Up to 2 hours</td>   
  </tr>
 </tbody>
</table>
    		</div>
    		<!-- Ordr summary table ends to here  -->

    <!-- Check out table starts from here  -->
    	<div class="col-lg-5">
    		<table class="table fs-3">
  <thead style="background: #27ae60; color: white; font-weight: 700;">
    <tr>
      <th scope="col">Checkout</th>
      <th scope="col">Balance</th>
    </tr>
  </thead>
  <tbody class="bg-white text-dark" style=" font-weight: 700;">

 <tr>
      <td>Sub Total : </td>   
      <td>$ <?php echo round($dataRow['salePrice'] * $productQnt, 2); ?></td>   
  </tr>
   <tr>
      <td>Estimated Tax : </td>   
      <td>$ <?php echo round((($dataRow['salePrice'] * $productQnt) / 100) * 10, 2); ?></td>   
  </tr>
  <tr>
      <td>Shipping : </td>   
      <td>$ <?php echo round((((($dataRow['salePrice'] * $productQnt) / 100) * 10) / 100) * 80, 2); ?></td>   
  </tr>

  <tr>
      <td>Grand Total : </td>   
      <td>$ <?php echo round(($dataRow['salePrice'] * $productQnt) + ((($dataRow['salePrice'] * $productQnt) / 100) * 10) + ((((($dataRow['salePrice'] * $productQnt) / 100) * 10) / 100) * 80), 2); ?></td>  
  </tr>
 </tbody>
</table>
    		</div>
    		<!-- Cheack out table ends to here  -->
    	</div>
    </div> 
    <br><br><br>

</div>

    <!-- Customer form starts from here -->
          <div class="customerData">
              <div class="container">
                  <div class="row text-center">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <input type="hidden" name="foodName" value="<?php echo $dataRow['foodName']; ?>">
                                <input type="hidden" name="foodPrice" value="<?php echo $dataRow['salePrice']; ?>">
                                <input type="hidden" name="foodImage" value="<?php echo $dataRow['foodImage']; ?>">
                                <input type="hidden" name="proQnt" value="<?php echo $productQnt; ?>">
                                <?php
                                  }           
                              } 
                              // else{
                              //     header("location:foods.php ?alert=Please Select Your Food First. Otherwise you can't access to checkout page.");
                              //   }
                                
                                 ?>
                              <input name="firstName" style="width: 30%;padding: 10px 5px; font-size: 20px; color: var(--green); border: 1px solid var(--green); margin-right: 15px" type="text" placeholder="Enter your first name" required>
                              <input name="lastName" style=" width: 30%;padding: 10px 5px; font-size: 20px; color: var(--green); border: 1px solid var(--green)" type="text" placeholder="Enter your last name" required><br><br>
                              <input name="cmEmail" style=" width: 30%;padding: 10px 5px; font-size: 20px; color: var(--green); border: 1px solid var(--green); margin-right: 15px;" type="email" placeholder="Enter your email" required>
                              <input name="cmPhone" style="width: 30%;padding: 10px 5px; font-size: 20px; color: var(--green); border: 1px solid var(--green)" type="tel" placeholder="Enter your phone number" required><br><br>
                              <textarea name="cmAddress" style="width: 62%; padding: 10px 5px; font-size: 20px; color: var(--green); border: 1px solid var(--green)" name="" id="" cols="45" placeholder="Enter your address" rows="3"></textarea required><br><br>
                              <button name="orderBtn" class="orderBtn" style="padding: 10px 35px; font-size: 20px; background: #26aa5e;color: white;">Place Order</button>
                          </form>

                          <!-- Send Customer Data To Database   -->
                          <?php
                           if (isset($_POST['orderBtn'])) {
                               // Collect Customer data 
                               $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
                               $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
                               $cmEmail = mysqli_real_escape_string($connection, $_POST['cmEmail']);
                               $cmPhone = $_POST['cmPhone'];
                               $cmAddress = mysqli_real_escape_string($connection, $_POST['cmAddress']);
                               // Collect selected food data
                               $foodName = $_POST['foodName'];
                               $foodPrice = $_POST['foodPrice'];
                               $foodImage = $_POST['foodImage'];
                               // Collect proQnt
                               $productQnt = $_POST['proQnt'];
                               // Make full name 
                               $fullName = $firstName . $lastName;

                               // Calculate Grand Total Price 
                               $subTotalPrice = $foodPrice * $productQnt;
                               $estimatedTax = ($subTotalPrice / 100) * 10;
                               $shippingCharge = ($estimatedTax / 100) * 80;

                               $grandTotal = round($subTotalPrice + $estimatedTax + $shippingCharge, 2);

                               // Order send Query
                               $orderCnfQuery = "INSERT INTO orders SET cmName='$fullName', cmEmail='$cmEmail', cmPhone='$cmPhone', cmAddress='$cmAddress', foodName='$foodName', unitPrice='$foodPrice', tax='$estimatedTax', shipping='$shippingCharge', foodQuantity='$productQnt', grandTotal='$grandTotal', foodImage='$foodImage', status='ordered'";

                               $orderCnfQueryRes = mysqli_query($connection, $orderCnfQuery);

                               // Redirect food page after ordering
                                
                                if ($orderCnfQueryRes) {
                                    ?>
                                    <script>
                                        window.location.href = 'thankyou.php';
                                    </script>
                                    <?php
                                }else{
                                    echo "<h3 class='text-danger'>Order Failed. Please Try Again!</h3>";
                                }

                           }
                           ?>


                      </div>
                  </div>
              </div>
     
          </div><br><br><br><br>
    <!-- Customer form ends to here -->











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