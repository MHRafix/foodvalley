<?php include 'assets/inc/header.php'; ?><!-- Header include here -->



<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Add Foods</h2>
        </div>
    </div>
    <!-- Add Food Form Here  -->
    <div class="container">
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input class="px-3 py-2" type="text" placeholder="Enter Your Food Name" name="foodName" id="inputTag" required><br><br><!--fullName -->
                <input class="px-3 py-2" type="text" placeholder="Enter Food Regular Price (Optional)" name="regularprice" id="inputTag" ><br><br><!--userName -->
                <input class="px-3 py-2" type="text" placeholder="Enter Food Sale Price (Mandetory)" name="salePrice" id="inputTag" required><br><br><!--email -->
                <!--<select name="foodCategory" id="inputTag">
                   <option value="">Fast Food</option>
                   <option value="">Last Food</option>
                   <option value="">Second Food</option>
                   <option value="">Third Food</option>
                </select><br><br>password-->
                <input class="px-3 py-2" type="file" name="foodPic" id="inputTag" required><br><br><!--foodPic-->
                <textarea class="px-3 py-2 w-100" style="border: 1px solid var(--green); color: var(--green); border-radius: 5px; font-size: 20px;" placeholder="Enter Food Description" name="foodDesc" id="inputTag" cols="30" rows="5"></textarea>
                <button class="btn btn-success" name="addFoodsBtn" >Add Now</button>
            </form>
        </div>
    </div>
   <!-- Main Content Ends To Here  -->

   <!-- PHP code starts from here for send data to database  -->
    <?php  
    if(isset($_POST['addFoodsBtn'])){
    $foodName = mysqli_real_escape_string($connection, $_POST['foodName']);
    $regularPrice = mysqli_real_escape_string($connection, $_POST['regularprice']);
    $salePrice = mysqli_real_escape_string($connection, $_POST['salePrice']);
    // $foodCategory = mysqli_real_escape_string($connection, $_POST['foodCategory']);
    $foodDescription = mysqli_real_escape_string($connection, $_POST['foodDesc']);

    // Food Price Validation Here 
    if($regularPrice !== "" && $regularPrice < $salePrice){
    echo "<h3 class='text-danger'>Main Price Can't Be Less Than Discount Price!</h3>";
    }else if($regularPrice == $salePrice){
    echo "<h3 class='text-danger'>Main Price && Discount Price Can't Be Same!</h3>";
    }else{
      // :et's Take The Food Pic and Upload It On The Database
    if (isset($_FILES['foodPic'])){
    $file_name = $_FILES['foodPic']['name'];
    $file_size = $_FILES['foodPic']['size'];
    $file_tmp = $_FILES['foodPic']['tmp_name'];
    $file_type = $_FILES['foodPic']['type'];
    
    // Set The File Size Limitation Using If, Else Condition 
    if($file_size > 2097152){ 
    echo "<br><h5 class='text-danger bg-dark p-3'>File Size Must Be 2MB Or Lower.</h5>";
    }
    // Make The File Name Uniquify 
    $new_name = time(). "_" .basename($file_name);
    $upload_folder = "assets/images/foodImages/".$new_name;
    move_uploaded_file($file_tmp, $upload_folder);
    }
    
    // Let's check The Existed Food Data
    $checkQuery = "SELECT foodName FROM foodposts WHERE foodName = '$foodName'";//DataBase Query Here
    $checkQueryResult = mysqli_query($connection, $checkQuery) or die(mysqli_error());//Connect With Database Table Or Throw An Error
    $countQueryResult = mysqli_num_rows($checkQueryResult);//Count The Existed Data On The DataBase
    
    // Check The Existed Data Count With If, Else Condition 
    if($countQueryResult > 0){
       echo "<h3 class='text-danger'>This Food Is Already Exist!</h3>";
    }else{
    $setQuery = "INSERT INTO foodposts SET foodName = '$foodName', regularPrice = '$regularPrice', salePrice = '$salePrice', foodDesc = '$foodDescription', 	foodImage = '$new_name'";//Finall Query With DataBase
    $finallResult = mysqli_query($connection, $setQuery) or die(mysqli_error());//Finally Insert Data Into DataBase
    
    // Check The Inserted Query Success Or Failed
    if($finallResult){
    ?>
    <!-- Redirect To The Food Listing Page Using JavaScript Location Href  -->
    <script>
        window.location.href = 'foods.php';
    </script>
    <?php
    }else{
     echo '<h3 class="text-danger">Something Wrong To Insert Data Into DataBase!</h3>';
    }
    }      
    }

    }?>
   
   </div>
   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>