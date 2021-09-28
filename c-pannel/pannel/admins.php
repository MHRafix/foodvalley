<?php include 'assets/inc/header.php'; ?><!-- Header include here -->

<!-- Main Content Starts From Here  -->
<div class="main">
    <div class="row">
        <div class="col-lg-6">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Admin Managers</h2>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:right;">
            <a href="addAdmins.php" class="btn btn-success">Add Admin ++</a><br><br>
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

    <!-- Display Admins On The Table Using PHP Code Starts Here -->
    
    <?php 
    $displayQuery = "SELECT * FROM admins ORDER BY id DESC"; //show query from database
    $displayResult = mysqli_query($connection, $displayQuery) or die(mysqli_error());
    $dataCount = mysqli_num_rows($displayResult);
    if ($dataCount > 0) {
 ?>
    <!-- Display Admins On The Table Using PHP Code Ends to Here  -->

    <!-- ADmin List Show Here In The Table  -->
<table class="table fs-3">
  <thead class="bg-info">
    <tr>
      <th scope="col">Sl NO.</th>
      <th scope="col">Full Name</th>
      <th scope="col">User Name</th>
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
      <td><?php echo $dataRow['fullname']; ?></td>
      <td><?php echo $dataRow['username']; ?></td>
      <td>
          <a href="editAdmins.php?editId=<?php echo $dataRow['id']; ?>" ><i class="fas fa-edit text-info fs-4"></i></a> 
          || 
          <a onclick="return confirm('Are You Sure ?')" href="deleteAdmins.php?deleteId=<?php echo $dataRow['id']; ?>">
          <i style="color: #ff6b81; font-size: 25px;" class="far fa-trash-alt"></i>
        </a></td>
    </tr>
    <?php } ?>
 </tbody>
</table>
<?php } ?>
</div>

<!-- Main Content Ends To Here  -->


<!-- Footer include here -->
<?php include 'assets/inc/footer.php'; ?>