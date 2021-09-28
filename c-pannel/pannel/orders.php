<?php include 'assets/inc/header.php'; //Header include here ?>
<!-- Main Content Starts From Here  -->
<div class="main">
    <div class="row">
        <div class="col-lg-6">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Order Recived</h2>
            </div>
        </div>
        <div class="col-lg-6" style="text-align:right;">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <select name="filterType" id="inputTag" style="color: var(--green); border: 1px solid var(--green); padding: 0px 20px 15px 20px;font-size: 15px;">
            <option selected disabled>Select Order Type</option>
            <option name="ordered">Ordered</option>
            <option name="inprogress">In-progress</option>
            <option name="completed">Completed</option>
            <option name="cancel">Cancel</option>
        </select>
        <a name="filterOrders" class="btn btn-success">Filter Orders</a><br><br>
        </form>
        </div>
     
    </div>
<!-- Order List Show Here In The Table  -->

<?php

    $query = "SELECT * FROM orders ORDER BY id DESC";
    $queryRes = mysqli_query($connection, $query); 
    
    $countQueryRes = mysqli_num_rows($queryRes);
    if ($countQueryRes > 0) {
       
       
 ?>

<table class="table fs-3">
  <thead class="bg-info">
    <tr>
      <th scope="col">Sl NO.</th>
      <th scope="col">CM Name</th>
      <th scope="col">CM Phone</th>
      <th scope="col">Food Name</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  
  <?php
  $serialNo = 1;
    while ($dataRow = mysqli_fetch_assoc($queryRes)) {
         ?>
       
  <tbody class="bg-dark text-white">

<tr>
      <td scope="row"><?php echo $serialNo++; ?></td>
      <td><a href="orderDetails.php?orderId=<?php echo $dataRow['id']; ?>"><?php echo $dataRow['cmName']; ?></a></td>
      <td><?php echo $dataRow['cmPhone']; ?></td>
      <td><?php echo $dataRow['foodName']; ?></td>
      <td><?php echo $dataRow['unitPrice']; ?></td>
      <td><?php echo $dataRow['status']; ?></td>
      <td>
          <a href="editAdmins.php?editId=<?php //echo $dataRow['id']; ?>" ><i class="fas fa-edit text-info fs-4"></i></a> 
          || 
          <a onclick="return confirm('Are You Sure ?')" href="deleteAdmins.php?deleteId=<?php echo $dataRow['id']; ?>">
          <i style="color: #ff6b81; font-size: 25px;" class="far fa-trash-alt"></i>
        </a>
    </td>
    </tr>
 </tbody>
<?php } ?>
</table>
<?php } ?>
<!-- Footer include here -->
<?php include 'assets/inc/footer.php'; ?>
<?php include 'assets/inc/footer.php'; //Footer include here ?>