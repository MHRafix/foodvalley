<?php include 'assets/inc/header.php'; ?><!-- Header include here -->



<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Edit Admins</h2>
        </div>
    </div>
    
    <!-- Add Admins Form Here  -->
    <div class="container">
        <?php 
        //Edit Admins recived admin id
        if(isset($_GET['editId'])){
        $editId = $_GET['editId'];
        $selQuery = "SELECT * FROM admins WHERE id = '$editId'";
        $selQueryResult = mysqli_query($connection, $selQuery) or die(mysqli_error());

        while($dataRow = mysqli_fetch_assoc($selQueryResult)){
        
        ?>
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="adminId" value="<?php echo $editId; ?>">
                <input class="px-3 py-2" type="text" value="<?php echo $dataRow['fullname']; ?>" placeholder="Enter Your Full Name" name="fullName" id="inputTag" class="p-3" required><br><br><!--fullName -->
                <input class="px-3 py-2" type="text" value="<?php echo $dataRow['username']; ?>" placeholder="Enter Your User Name" name="userName" id="inputTag" class="p-3" required><br><br><!--userName -->
                <input class="px-3 py-2" type="email" value="<?php echo $dataRow['email']; ?>" placeholder="Enter Your Eamil" name="email" id="inputTag" class="p-3" required><br><br><!--email -->
                <!-- Current profile pic  -->
                <button class="btn btn-success" name="editAdminsBtn" style="text-align:center;">Update Now</button>
            </form>
        </div>
        <?php }
                 }else{
                     header("location:admins.php?idNotset=Please hit click the edit button, otherwise you cannot edit admin info!");
                 } ?>
    </div>

   </div>

   <?php
    //Edit Admins reassign value to database
    if(isset($_POST['editAdminsBtn'])){
    $adminId = $_POST['adminId'];
    $fullName = mysqli_real_escape_string($connection, $_POST['fullName']);
    $userName = mysqli_real_escape_string($connection, $_POST['userName']);
    $userEmail = mysqli_real_escape_string($connection, $_POST['email']);

    $updateQuery = "UPDATE admins SET fullname = '{$fullName}', username = '{$userName}', email = '{$userEmail}' WHERE id = '$adminId'";
    $updateQueryResult = mysqli_query($connection, $updateQuery);
    if($updateQueryResult){
    ?>
    <script>
        window.location.href = 'admins.php';
    </script>
    <?php
    }else{
    echo "<h3 class='text-danger'>Something wrong to edit admin info!</h3>";
    }
}
    
?>

   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>