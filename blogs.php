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
            <h1>Blog Page</h1>
            <span><a href="index.php">Home</a> / </span>
           <span>Blogs</span>
        </div>
    </div>
</div>
<!-- Page Banner and breadcrumb Ends To Here  -->
<!-- Blog List Starts From Here -->
<section class="menu" id="menu">

    <h3 class="sub-heading"> Healthy life </h3>
    <h1 class="heading"> All blogs </h1>
 <!-- Display Blog Posts From DataBase Dynamically -->
 <?php
     $blogQuery = "SELECT * FROM blogposts ORDER BY id DESC";
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
<!-- Blog List Ends To Here -->

<?php include "assets/inc/footer.php"; //Footer Include Here ?>