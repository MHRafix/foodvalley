<?php
// Let's Get The Delete Admins Id
if (isset($_GET['deleteId'])) {
include 'assets/inc/config.php';
// Check Data 
$checkQuery = "SELECT * FROM admins";
$checkResult = mysqli_query($connection, $checkQuery);
$countDltRes = mysqli_num_rows($checkResult);//Count The Current Admins

// Check Data For Site Authentication
if($countDltRes > 1){
// Delete Data If Data Is Bigger Than 1
$deleteAdminId = $_GET['deleteId'];
$deleteQuery = "DELETE FROM admins WHERE id = '{$deleteAdminId}'";
$deleteResult = mysqli_query($connection, $deleteQuery);
// Check Delete Admins Success Or Failed
if ($deleteResult) {
// Redirect To The Admin Listing Page After Success Using Header Location
header('location:admins.php?deletedAlert= Admin Successfully Deleted!');
}else{
// Redirect To The Admin Listing Page After Failed Using Header Location
header('location:admins.php?deleteFailedAlert= SomeThing Wrong To Deleting Admin!');
}
}else{
// Redirect To The Admin Listing Page If Data Is Amunt Is Lower Than 1 Using Header Location
header('location:admins.php?dataLower= You can not delete this data before adding another data!');
}
}else{
    // Redirect To The Admin Listing Page Delete Id Is Not Set Using Header Location
    header('location:admins.php?deleteIdNotSet= Please click The Delete Button!');
    }