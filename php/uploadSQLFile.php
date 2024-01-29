<?php
session_start();
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["sqlScript"]["name"]);
$uploadOk = 1;
$sqlFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$resultMsg = "";
$continueSelection = 1;
$_SESSION['resultMsg'] = "";

// Check if file already exists
// if (file_exists($target_file)) {
//   $resultMsg = "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["sqlScript"]["size"] > 500000) {
  $resultMsg = "Sorry, your file is too large.";
  $uploadOk = 0;
  $continueSelection = 0;
}

// Allow certain file formats
if($sqlFileType != "sql") {
  $resultMsg = "Sorry, only SQL files are allowed.";
  $uploadOk = 0;
  $continueSelection = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {
  if (move_uploaded_file($_FILES["sqlScript"]["tmp_name"], $target_file)) {
    // $resultMsg = "The file ". htmlspecialchars( basename( $_FILES["sqlScript"]["name"])). " has been uploaded!";
  } else {
    if($resultMsg == "")
      $resultMsg = "Sorry, there was an error uploading your file.";
    $continueSelection = 0;
  }
}

$_SESSION['resultMsg'] = $resultMsg;

if(!$continueSelection){
  header("Location: ../index.php");
  exit();
}

require_once "loadDatabase.php";

exit();

?>