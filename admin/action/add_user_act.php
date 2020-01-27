<?php
include '../../config.php';
$user = new Users;
$user->storeValues( $_POST );
$photo=$_FILES['photo']['name'];
if (!$user->register($photo)) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/user.php";
  </script>';
} else {
  $dirpath = dirname(getcwd());
  if(file_exists("photo/".$photo)){
  	unlink("photo/".$photo);
  	move_uploaded_file($_FILES['photo']['tmp_name'], $dirpath."/photo/".$_FILES['photo']['name']);
  } else{
  	move_uploaded_file($_FILES['photo']['tmp_name'], $dirpath."/photo/".$_FILES['photo']['name']);
  }
  echo '<script type="text/javascript">
  alert("Data successfully saved!");
  window.location.href="/store-management/admin/user.php";
  </script>';
}
 ?>
