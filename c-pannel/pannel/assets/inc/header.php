<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodValley - Dashboard</title>
    <!-- Bootstrap CDN Linkup Here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Fontawesome CDN lonk up here  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Jquery CDN Here  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom Css Linkup Here -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
<!-- header section starts-->

<header>
    <!-- Logo  -->
 <a href="index.php" class="logo"><i class="fas fa-utensils"></i> foodValley.</a>

 <!-- MenuBar Toggler Here  -->
<i class="fas fa-stream" id="menu-bars"></i>
<i class="fas fa-times" id="menu-barsCross"></i>

<!-- HeaderContent MenuBars Here  -->
<div id="headerContent">
<div class="profile">
    <!-- Config Include Here  -->
<?php include 'config.php'; ?>

<?php
    session_start();
    if (isset($_SESSION['user_name'] )) {
    //If The User Is Already Logged In, Then Show The Profile Info Here
    $profileId = $_SESSION['user_id']; 
    $profileName = $_SESSION['user_name'];
    ?>
    <span id="profileDet" class="fs-3 ml-2">
    <?php $query = "SELECT Profilepic FROM admins WHERE id='{$profileId}'";
    $res = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($res)){
    ?>
    <img src="assets/images/adminsImages/<?php echo $row['Profilepic'] ?>" width="40" height="40" style="border-radius:100%;" alt="profilePic">
    <?php
    }
    ?>
    &nbsp; <?php echo $profileName; ?></span>
    
    </div>
    <!-- Profile Content Here  -->
    <div id="profileModal" class="text-center">
    <span id="crossModal" class="active fas fa-times text-right"></span>
    <?php 
    $query = "SELECT Profilepic FROM admins WHERE id='{$profileId}'";
    $res = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($res)){
    ?>
    <img src="assets/images/adminsImages/<?php echo $row['Profilepic']; ?>" width="60" height="60" style="border-radius:100%;" alt="profilePic">
    <br><br>
    <h3><?php echo $profileName; ?></h3>  
       
         <?php
    }
    ?>
       
    <br>
    <!-- Logout Button Here  -->
    <a href="logout.php" class="active">Log Out  &nbsp;<i class="fas fa-sign-out-alt"></i></a>
    <?php }
      ?>
    </div>
    <!-- Nav Menus Here  -->
    <nav class="navbar">
        <a class="active" href="index.php"> <i class="fas fa-tachometer-alt"> </i> &nbsp;Dashboard</a>
        <a href="admins.php"> <i class="fas fa-users"></i> &nbsp;admins</a>
        <a href="foods.php"> <i class="fas fa-hamburger"></i> &nbsp;foods</a>
        <a href="categories.php"> <i class="fas fa-clipboard-list"></i> &nbsp;category</a>
        <a href="blogPosts.php"> <i class="fas fa-blog"></i> &nbsp;blogs</a>
        <a href="orders.php"> <i class="fab fa-first-order-alt"></i> &nbsp;order</a>
    </nav>
    <!-- Stay Tuned SocialIcon Here   -->
    <div class="icons">
        <a href="https://www.facebook.com/profile.php?id=100069940274273" class="fab fa-facebook" id="search-icon"></a>
        <a href="https://www.linkedin.com/in/mh-rafix-42772a21b/" class="fab fa-linkedin"></a>
        <a href="https://www.github.com/mhrafix" class="fab fa-github"></a>
    </div>
</div>
</header>

<!-- Escape The Users With Out Log In -->
<?php
      if (!isset($_SESSION['user_name'] )) {
        ?>
      <!-- If The User Is Already Logged In, Then Redirect The User To The Dashboard Using JavaScript Window.location.href -->
      <script>
      window.location.href = '../index.php';
      </script>
      <?php
      }
      ?>

<!-- header section ends-->