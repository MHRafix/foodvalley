<?php include 'assets/inc/header.php'; ?><!-- Header Include Here -->
<!-- Main Content Starts From Here  -->
<div class="main">
    <div class="row">
        <div class="col-lg-6">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Blog Posts</h2>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:right;">
            <a href="addBlogPosts.php" class="btn btn-success">Add Blog ++</a><br><br>
        </div>
    </div>
    <!-- Dynamic Success And Failed Alerts Are Display Code Starts From Here  -->
    <?php
    //  Alerts Show Using Condition 
    if(isset($_GET['deletedAlert'])){
    $dltSuccessAlert = $_GET['deletedAlert'];//Delete Alert Id Store Here
    echo '<h2 class="text-success fs-3">'.$dltSuccessAlert.'</h2>';

    }else if(isset($_GET['deleteFailedAlert'])){
    $deleteFailedAlert = $_GET['deleteFailedAlert'];//Delete Failed Alert Store Here
    echo '<h2 class="text-danger fs-3">'.$deleteFailedAlert.'</h2>';

    }else if(isset($_GET['deleteIdNotSet'])){
    $deleteIdNotSet = $_GET['deleteIdNotSet'];//Delete Failed Alert Store Here
    echo '<h2 class="text-danger fs-3">'.$deleteIdNotSet.'</h2>';

    }else if(isset($_GET['dataLower'])){
    $dataLower = $_GET['dataLower'];
    echo '<h2 class="text-danger fs-3">'.$dataLower.'</h2>';
    }
    ?>
    <!-- Dynamic Success And Failed Alerts Are Display Code Cnds To Here  -->


     <!-- BlogPosts List Show Here In The Table  -->

     <!-- PHP Code Starts From Here To Show The BlogPosts  -->
     <?php
    $selectQuery = "SELECT * FROM blogposts ORDER BY id DESC";
    $selectQueryResult = mysqli_query($connection, $selectQuery) or die(mysqli_error());
    $countQueryResult = mysqli_num_rows($selectQueryResult);
    if($countQueryResult > 0){
    ?>
<table class="table fs-3">
  <thead class="bg-info">
    <tr>
      <th scope="col">Sl NO.</th>
      <th scope="col">Blog Caption</th>
      <th scope="col">Blog Author</th>
      <th scope="col">Blog Thumbnail</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="bg-dark text-white">
 <?php
 $serialNo = 1;
 while($dataRow = mysqli_fetch_assoc($selectQueryResult)){
?>
  <tr>
      <th scope="row"><?php echo $serialNo++; ?></th>
      <td><?php echo $dataRow['blogName']; ?></td>
      <td><?php echo $dataRow['blogAuthor']; ?></td>
      <td><img src="assets/images/blogImages/<?php echo $dataRow['blogImage']; ?>" class="" style="border-radius:100%;" width="70" height="70" alt="BlogImage"></td>
      <td>
          <a href="editBlogs.php?editId=<?php echo $dataRow['id']; ?>" ><i class="fas fa-edit text-info fs-4"></i></a> 
          || 
          <a onclick="return confirm('Are You Sure ?')" href="deleteBlogPosts.php?deleteId=<?php echo $dataRow['id']; ?>">
          <i style="color: #ff6b81; font-size: 25px;" class="far fa-trash-alt"></i>
        </a></td>
    </tr>
    <?php } ?>
 </tbody>
</table>
<?php
     }else{
         echo "<h3 class='text-danger'>No Blog Posted Yet! </h3>";
     }
     ?>
</div>

<!-- Main Content Ends To Here  -->


<?php include 'assets/inc/footer.php'; ?><!-- Footer Include Here -->