<?php include 'assets/inc/header.php'; ?><!-- Header include here -->



<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Add BlogPosts</h2>
        </div>
    </div>
    <!-- Add Blog Form Here  -->
    <div class="container">
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input class="px-3 py-2" type="text" placeholder="Enter Blog Caption" name="blogCaption" id="inputTag" required><br><br><!--fullName -->
                <input class="px-3 py-2" type="text" placeholder="Enter Blog Author Name" name="blogAuthor" id="inputTag"><br><br><!--userName -->
                <input class="px-3 py-2" type="file" name="blogPic" id="inputTag" required><br><br><!--blogPic-->
                <textarea class="px-3 py-2 w-100" style="border: 1px solid var(--green); color: var(--green); border-radius: 5px; font-size: 20px;" placeholder="Enter Blog Description" name="blogDesc" id="inputTag" cols="30" rows="5"></textarea>
                <button class="btn btn-success" name="addBlogBtn" >Add Now</button>
            </form>
        </div>
    </div>
   <!-- Main Content Ends To Here  -->
   
   <!-- PHP Code Starts From Here For Insertting Blog Data  -->
    <?php 
    if(isset($_POST['addBlogBtn'])){
    $blogCaption = mysqli_real_escape_string($connection, $_POST['blogCaption']);
    $blogAuthor = mysqli_real_escape_string($connection, $_POST['blogAuthor']);
    $blogDescription = mysqli_real_escape_string($connection, $_POST['blogDesc']);

    // Take The Blog Thumbnail and Insert That Into DataBase
    if (isset($_FILES['blogPic'])){
    $file_name = $_FILES['blogPic']['name'];
    $file_size = $_FILES['blogPic']['size'];
    $file_tmp = $_FILES['blogPic']['tmp_name'];
    $file_type = $_FILES['blogPic']['type'];
    
    // Set The File Size Limitation Using If, Else Condition 
    if($file_size > 2097152){ 
    echo "<br><h5 class='text-danger bg-dark p-3'>File Size Must Be 2MB Or Lower.</h5>";
    }
    // Make The File Name Uniquify 
    $new_name = time(). "_" .basename($file_name);
    $upload_folder = "assets/images/blogImages/".$new_name;
    move_uploaded_file($file_tmp, $upload_folder);
    }
    
    // Check Existed Blog Using If, Else Condition 
    $checkExistedQuery = "SELECT blogName FROM blogposts WHERE blogName = '$blogCaption'";
    $existedQueryResult = mysqli_query($connection, $checkExistedQuery) or die(mysqli_error());
    $countExistedQueryResult = mysqli_num_rows($existedQueryResult);
    
    // Insert Query Using If, Else Condition 
    if($countExistedQueryResult > 0){
    echo "<h3 class='text-danger fs-3'>Please Change Something From Blog Caption!</h3>";
    }else{
    $insertQuery = "INSERT INTO blogposts SET blogName = '$blogCaption', blogAuthor = '$blogAuthor', blogDesc = '$blogDescription', blogImage = '$new_name'";
    $insertQueryResult = mysqli_query($connection, $insertQuery) or die(mysqli_error());

    // Finally Insert Blog Query Using Ef, Else Condition
    if($insertQueryResult){
    ?>
    <script>
        window.location.href = "blogPosts.php";
    </script>
    <?php
    }else{
        echo 'Something Wrong To Insert Data Into DataBase!';
       }
    }
    }
    ?>
   <!-- PHP Code Ends To Here For Insertting Blog Data  -->

   </div>
   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>