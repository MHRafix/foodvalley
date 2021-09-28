<?php include 'assets/inc/header.php'; //Header include here ?>
<?php
    //  Get The Clocked Blog Id 
    if(isset($_GET['blogId'])){
    $singleBlogId =$_GET['blogId'];
    $blogQuery = "SELECT * FROM blogposts WHERE id = '$singleBlogId'";
    $blogQueryResult = mysqli_query($connection, $blogQuery) or die(mysqli_error()); 
    $countBlogQueryResult = mysqli_num_rows($blogQueryResult);
    // Display Query Result On The UI Using PHP if, else condition
    if($countBlogQueryResult > 0){
    //Run the while loop and display foods from database to ui
    while($blogDataRow = mysqli_fetch_assoc($blogQueryResult)){
   ?>

<!-- Page Banner and breadcrumb Starts From Here  -->
<br>
<br>
<br>
<br>
<br>
<div class="box-container">
    <div class="home-food-banner">
        <div class="bannerDet">
            <h1>Single Blog Page</h1>
            <span><a href="index.php">Home</a> / </span>
           <span>Single-Blog / </span><span><?php echo $blogDataRow['blogName']; ?></span>
        </div>
    </div>
</div>
<!-- Page Banner and breadcrumb Ends To Here  -->
<!-- Single blog section starts from here  -->
<section class="menu" id="menu">

    <div class="box-container">
           
        <div class="box">
            <div class="image" style="height: 40rem;">
                <img src="c-pannel/pannel/assets/images/blogImages/<?php echo $blogDataRow['blogImage'];//FoodImage Here ?>" alt="blogImage">
            </div>
            <div class="content">
                <h3><?php echo $blogDataRow['blogName'];//Blog Title Here ?></h3>
                <span style="color:var(--green); font-size:17px;">Author: <?php echo $blogDataRow['blogAuthor']; ?>, </span>
                <span style="color:var(--green); font-size:17px;"> Published Date: <?php echo substr_replace($blogDataRow['date'], "", 10); ?></span>
                <p><?php echo $blogDataRow['blogDesc'];//Blog Description ?></p>
            </div>
        </div>
    </div>
</section>
<?php
 } 
    } 
 }else{
    header("location:index.php?noalert=Please click on a blog first! ");
} ?>
<!-- Single blog section ends to here  -->
<?php include 'assets/inc/footer.php'; //Footer include here ?>