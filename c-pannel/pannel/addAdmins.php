<?php include 'assets/inc/header.php'; ?><!-- Header include here -->



<!-- Main Content Starts From Here  -->
<div class="main">
    <!-- PAge Title Here  -->
    <div class="row">
          <div class="pageName">
            <h2 class="title" style="color: #bbb; font-size: 30px; font-weight: 700;">Add Admins</h2>
        </div>
    </div>
    
    <!-- Add Admins Form Here  -->
    <div class="container">
        <div class="formDiv w-50 mx-auto">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input class="px-3 py-2" type="text" placeholder="Enter Your Full Name" name="fullName" id="inputTag" class="p-3" required><br><br><!--fullName -->
                <input class="px-3 py-2" type="text" placeholder="Enter Your User Name" name="userName" id="inputTag" class="p-3" required><br><br><!--userName -->
                <input class="px-3 py-2" type="email" placeholder="Enter Your Eamil" name="email" id="inputTag" class="p-3" required><br><br><!--email -->
                <input class="px-3 py-2" type="password" placeholder="Enter Your Password" name="password" id="inputTag" class="p-3" required><br><br><!--password-->
                <input class="px-3 py-2" type="password" placeholder="Enter Confirm Your Password" name="cnfPassword" id="inputTag" class="p-3" required><br><br><!--confirmpassword -->
                <input class="px-3 py-2" type="file" placeholder="Enter Your Full Name" name="profilepic" id="inputTag" class="p-3" required><br><br><!--profilepic-->
                <button class="btn btn-success" name="addAdminsBtn" style="text-align:center;">Add Now</button>
            </form>
        </div>
    </div>


<!-- Main Content Ends To Here  -->

   <!-- PHP code starts from here for send data to database  -->
        <?php  
        if(isset($_POST['addAdminsBtn'])){
        $fullName = mysqli_real_escape_string($connection, $_POST['fullName']);
        $userName = mysqli_real_escape_string($connection, $_POST['userName']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['email']);
        $userPassword = sha1(md5($_POST['password']));
        $cnfPassword = sha1(md5($_POST['cnfPassword']));
        
        // Let's Take The Profile Pic Of Users and Upload It On The DataBase
        if (isset($_FILES['profilepic'])){
        $file_name = $_FILES['profilepic']['name'];
        $file_size = $_FILES['profilepic']['size'];
        $file_tmp = $_FILES['profilepic']['tmp_name'];
        $file_type = $_FILES['profilepic']['type'];
        
        // Set The File Size Limitation Using If, Else Condition 
        if($file_size > 2097152){ 
            echo "<br><h5 class='text-danger bg-dark p-3'>File Size Must Be 2MB Or Lower.</h5>";
        }
        // Make The File Name Unique 
        $new_name = time(). "_" .basename($file_name);
        $upload_folder = "assets/images/adminsImages/".$new_name;
        move_uploaded_file($file_tmp, $upload_folder);
        }

        // Check Users Availability and Connect To The Database Table 
        $check_users_availability = "SELECT username FROM admins WHERE username = '$userName'";//Check USers Availability Query
        $users_avilability_result = mysqli_query($connection, $check_users_availability);//Connect To The Database
        $count_users_avilability = mysqli_num_rows($users_avilability_result);//Count Existed Users

        // Add Admins Data Using If, Else Condition For More Security
        if($count_users_avilability > 0){
           echo "Data IS Already Exist!";
        }else if($userPassword !== $cnfPassword){
         echo "Password && Confirm Password Do Not Mathced!";
        }else{
        $setQuery =  "INSERT INTO admins SET fullname = '$fullName', username ='$userName', email = '$userEmail', userpassword	 = '$userPassword', Profilepic = '$new_name'";
        $setAsData = mysqli_query($connection, $setQuery);//Set As Data To Database
         
        // Check The Set Data True Or False And Redirect To Admin Listing Page
        if($setAsData){
        ?>
        <!-- Redirect To Admins Listing Page Using JavaScript Location href Attribute -->
        <script>
            window.location.href = "admins.php";
        </script>
        <?php
        }else{
            echo 'Sorry, SomeThing Wrong to Query!';
        }
    
    }
        }?>
   
   </div>
   <!-- Footer include here -->
   <?php include 'assets/inc/footer.php'; ?>