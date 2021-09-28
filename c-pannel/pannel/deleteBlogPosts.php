<?php
// Let's Get The Delete BlogPosts Id
if (isset($_GET['deleteId'])) {
include 'assets/inc/config.php';
// Check Data 
$checkQuery = "SELECT * FROM blogposts";
$checkResult = mysqli_query($connection, $checkQuery);
$countDltRes = mysqli_num_rows($checkResult);//Count The Current blogPosts

// Check Data For Site Authentication
if($countDltRes > 1){
// Delete Data If Data Is Bigger Than 1
$deleteBlogPostsId = $_GET['deleteId'];
$deleteQuery = "DELETE FROM blogposts WHERE id = '{$deleteBlogPostsId}'";
$deleteResult = mysqli_query($connection, $deleteQuery);
// Check Delete blogPosts Success Or Failed
if ($deleteResult) {
// Redirect To The Admin Listing Page After Success Using Header Location
header('location:blogPosts.php?deletedAlert= Blog Post Successfully Deleted!');
}else{
// Redirect To The Admin Listing Page After Failed Using Header Location
header('location:blogPosts.php?deleteFailedAlert= SomeThing Wrong To Deleting Blog Post!');
}
}else{
// Redirect To The Admin Listing Page If Data Is Amunt Is Lower Than 1 Using Header Location
header('location:blogPosts.php?dataLower= You can not delete this data before adding another data!');
}
}else{
    // Redirect To The Admin Listing Page Delete Id Is Not Set Using Header Location
    header('location:blogPosts.php?deleteIdNotSet= Please click The Delete Button!');
    }
