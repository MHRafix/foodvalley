<?php include 'assets/inc/header.php'; ?><!-- Header include here -->

<!-- Main Content Starts From Here  -->
<div class="main">
    <div class="row">
        <div class="col-lg-6">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Total Foods</h2>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:right;">
            <a href="addFoods.php" class="btn btn-success">Add Foods ++</a><br><br>
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
    
    <!-- Dynamic Alerts Are Show Here Dynamically Using PHP  -->
    <?php
    // if(isset($_GET['foodsAdded'])){
    // $foodsAdded = $_GET['foodsAdded'];
    // echo "<h3 class='text-success'>".$foodsAdded."</h3>";
    // }
    ?>

    <!-- Display Foods On The Table Using PHP Code Starts Here -->
    <?php 

    $displayQuery = "SELECT * FROM foodposts ORDER BY id DESC"; //show query from database
    $displayResult = mysqli_query($connection, $displayQuery) or die(mysqli_error());
    $dataCount = mysqli_num_rows($displayResult);
    if ($dataCount > 0) {
 ?>
    <!-- Display Foods On The Table Using PHP Code Ends to Here  -->

    <!-- Foods List Show Here In The Table  -->
<table class="table fs-3">
  <thead class="bg-info">
    <tr>
      <th scope="col">Sl NO.</th>
      <th scope="col">Food Name</th>
      <th scope="col">Regular Price</th>
      <th scope="col">Sale Price</th>
      <th scope="col">Food Category</th>
      <th scope="col">Food Rating</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="bg-dark text-white">

  <!-- Run while Loop For Getting All Data From Database  -->
  <?php
  $serial_no = 1;
  while ($dataRow = mysqli_fetch_assoc($displayResult)) {
  ?>
<tr>
      <th scope="row"><?php echo $serial_no++; ?></th>
      <td><?php echo $dataRow['foodName']; ?></td>
      <td>$ <?php echo $dataRow['regularPrice']; ?></td>
      <td>$ <?php echo $dataRow['salePrice']; ?></td>
      <td><?php
      if($dataRow['foodCategory'] === ''){
      echo '<h3 class="text-danger">Uncategorize</h3>';
      }else{
      echo $dataRow['foodCategory']; 
      }
       ?></td>
      <td><?php
      if($dataRow['rattings'] === ''){
      echo '<h3 class="text-danger">No Ratting Yet!</h3>';
      }else{
      echo $dataRow['rattings'];
      }
       ?></td>
      <td>
          <a href="editFoods.php?editId=<?php echo $dataRow['id']; ?>" ><i class="fas fa-edit text-info fs-4"></i></a> 
          || 
          <a onclick="return confirm('Are You Sure ?')" href="deleteFoods.php?deleteId=<?php echo $dataRow['id']; ?>">
          <i style="color: #ff6b81; font-size: 25px;" class="far fa-trash-alt"></i>
        </a></td>
    </tr>
    <?php } ?>
 </tbody>
</table>
<?php }else{
   echo "<h3 class='text-danger'>No Foods Found!</h3>";
} ?>
</div>

<!-- Main Content Ends To Here  -->


<!-- Footer include here -->
<?php include 'assets/inc/footer.php'; ?>