<?php include 'assets/inc/header.php'; ?><!-- Header include here -->
<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Edit Foods</h2>
        </div>
    </div>
    <?php
    
    // Edit Foods Here 
    if(isset($_GET['editId'])){
    $editId = $_GET['editId'];
    $selQuery = "SELECT * FROM foodposts WHERE id = '$editId'";
    $selQueryResult = mysqli_query($connection, $selQuery) or die(mysqli_error());
    while($dataRow = mysqli_fetch_assoc($selQueryResult)){

?>
    <!-- Add Food Form Here  -->
    <div class="container">
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                 <input type="hidden" value="<?php echo $editId; ?>" name="updateId">
                <input value="<?php echo $dataRow['foodName'] ?>" class="px-3 py-2" type="text" placeholder="Enter Your Food Name" name="foodName" id="inputTag" required><br><br><!--fullName -->
                <input class="px-3 py-2" type="text" value="<?php echo $dataRow['regularPrice']; ?>" placeholder="Enter Food Regular Price (Optional)" name="regularprice" id="inputTag" ><br><br><!--userName -->
                <input class="px-3 py-2" type="text" value="<?php echo $dataRow['salePrice']; ?>" placeholder="Enter Food Sale Price (Mandetory)" name="salePrice" id="inputTag" required><br><br><!--email -->
                <!-- <input class="px-3 py-2" type="file" name="foodPic" id="inputTag" required><br><br>foodPic -->
                <textarea class="px-3 py-2 w-100" style="border: 1px solid var(--green); color: var(--green); border-radius: 5px; font-size: 20px;" placeholder="Enter Food Description" name="foodDesc" id="inputTag" cols="30" rows="5"><?php echo $dataRow['foodDesc']; ?></textarea>
                <button class="btn btn-success" name="updateFoodsBtn" >Update Now</button>
            </form>
        </div>
    </div>

<?php }

 }
?>
   <!-- Main Content Ends To Here  -->

   <!-- Food Details Update Now -->
   <?php
   if(isset($_POST['updateFoodsBtn'])){
   $updateId = $_POST['updateId'];
   $foodName = mysqli_real_escape_string($connection, $_POST['foodName']);
   $regularPrice = mysqli_real_escape_string($connection, $_POST['regularprice']);
   $slaePrice = mysqli_real_escape_string($connection, $_POST['salePrice']);
   $foodDesc = mysqli_real_escape_string($connection, $_POST['foodDesc']);

   $finalQuery = "UPDATE foodposts SET foodName = '$foodName', regularPrice = '$regularPrice', salePrice = '$slaePrice', foodDesc = '$foodDesc' WHERE id = '$updateId'";

   $finalQueryResult = mysqli_query($connection, $finalQuery);
   if($finalQueryResult){
       ?>
       <script>
           window.location.href = 'foods.php';
       </script>
       <?php
   }else{
       echo "<h3 class='text-danger'>Something wring to editing food, please try again latter.</h3>";
   }
   } ?>

   </div>
   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>