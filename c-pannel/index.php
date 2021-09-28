<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Valley C-PANNEL</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/images/favIcon/favicon.ico" />
    <!-- Custom Css Link Up Here -->
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">   
    <!-- FontAwesome CDN Here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<!-- Login Page Markup Starts From Here  -->
         
         <!-- header starts from here -->
         <header></header>
         <!-- header ends to here -->


<!-- Main content starts from here -->
     <div class="center">
      <h1>Login To Dashboard</h1>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="txt_field">
          <input type="text" name="userName" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="userPassword" required>
          <span></span>
          <label>Password</label>
        </div>
        <!-- <div class="pass">Forgot Password?</div> -->
        <input type="submit" name="loginBtn" value="Login"><br><br>
<!--         <div class="signup_link">
          Not a member? <a href="#">Signup</a>
        </div> -->
      <!-- Escape The Logged In User -->
      <?php
      session_start();
      if (isset($_SESSION['user_name'] )) {
        ?>
      <!-- If The User Is Already Logged In, Then Redirect The User To The Dashboard Using JavaScript Window.location.href -->
      <script>
      window.location.href = 'pannel/index.php';
      </script>
      <?php
      }
      ?>

        <!-- Login Form Validation Code Starts From Here -->
        <?php
      if(isset($_POST['loginBtn'])){
      //Config.php File Include Here
      include 'pannel/assets/inc/config.php';
      
      // Let's Take All Input Value For Validation
      $userName = mysqli_real_escape_string($connection, $_POST['userName']);
      $userPassword = sha1(md5($_POST['userPassword']));
      
      // Check The User Input Using If, Else Condition
      $loginQuery = "SELECT id, username FROM admins WHERE username = '{$userName}' AND userpassword = '{$userPassword}'";
      $loginResult = mysqli_query($connection, $loginQuery);
      $countResult = mysqli_num_rows($loginResult);
      if($countResult > 0) {
      while($dataRow = mysqli_fetch_assoc($loginResult)){
      $_SESSION['user_id'] = $dataRow['id'];
      $_SESSION['user_name'] = $dataRow['username'];
      ?>
      
      <script>
      window.location.href  = 'pannel/index.php';
      </script>
      
      <?php
      }
    }else{
      echo '<h3 class="text-danger">Your Info Is Not Correct.</h3>';
    }
  }
        ?>
        <!-- Login Form Validation Code Ends To Here -->
      </form>
    </div>
 <!-- Main content ends to here -->


         <!-- footer starts from here  -->
         <footer></footer>
         <!-- footer starts from here  -->

    <!-- Login Page Markup Ends To Here  -->
</body>
</html>