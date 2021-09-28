<?php include 'assets/inc/header.php'; ?><!-- Header include here -->



<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Edit BlogPosts</h2>
        </div>
    </div>
    <!-- Add Blog Form Here  -->
    <?php 
    //Edit Blogs Here 
    if(isset($_GET['editId'])){
    $editId = $_GET['editId'];
    $selQuery = "SELECT * FROM blogposts WHERE id = '$editId'";
    $selQueryResult = mysqli_query($connection, $selQuery) or die(mysqli_error());
    while($dataRow = mysqli_fetch_assoc($selQueryResult)){
    
    ?>

    <div class="container">
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="blogId" value="<?php echo $editId; ?>" >
                <input class="px-3 py-2" value="<?php echo $dataRow['blogName']; ?>" type="text" placeholder="Enter Blog Caption" name="blogCaption" id="inputTag" required><br><br><!--fullName -->
                <input class="px-3 py-2" value="<?php echo $dataRow['blogAuthor']; ?>"  type="text" placeholder="Enter Blog Author Name" name="blogAuthor" id="inputTag"><br><br><!--userName -->
                <!-- <input class="px-3 py-2" type="file" name="blogPic" id="inputTag" required><br><br>blogPic -->
                <textarea class="px-3 py-2 w-100" style="border: 1px solid var(--green); color: var(--green); border-radius: 5px; font-size: 20px;" placeholder="Enter Blog Description" name="blogDesc" id="inputTag" cols="30" rows="5"><?php echo $dataRow['blogDesc']; ?></textarea>
                <button class="btn btn-success" name="updateBlogBtn" >Update Now</button>
            </form>
        </div>
    </div>
<?php
  }
    }
    ?>
   <!-- Main Content Ends To Here  -->
   <?php 
   //Update blog here
   if(isset($_POST['updateBlogBtn'])){
   $editId = $_POST['blogId'];
   $blogName = mysqli_real_escape_string($connection, $_POST['blogCaption']);
   $blogAuthor = mysqli_real_escape_string($connection, $_POST['blogAuthor']);
   $blogDesc = mysqli_real_escape_string($connection, $_POST['blogDesc']);

   $editQuery = "UPDATE blogposts SET blogName = '$blogName', blogAuthor = '$blogAuthor', blogDesc = '$blogDesc' WHERE id = '$editId'";
   $editQueryResult = mysqli_query($connection, $editQuery);
   if($editQueryResult){
    ?>
    <script>
        window.location.href = "blogPosts.php"; 
    </script>
    <?php
   }else{
       echo "<h3 class='text-danger'>Something wrong to editing blog info!</h3>";
   }

   }
   ?>
   </div>
   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>