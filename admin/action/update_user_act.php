<?php
include '../../config.php';
$usr = new Users;
$usr->storeValues( $_POST );
$photo=$_FILES['photo']['name'];
if (!$usr->updateData($photo)) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/user.php";
  </script>';
} else {
  $id = $_POST['id'];
  $u=$usr->getUser($id);
  $us=mysqli_fetch_array($u);
  $dirpath = dirname(getcwd());
  if(file_exists("photo/".$us['photo'])){
  	unlink("photo/".$us['photo']);
  	move_uploaded_file($_FILES['photo']['tmp_name'], $dirpath."/photo/".$_FILES['photo']['name']);
  	$usr->changePhoto($photo, $id);
  } else{
  	move_uploaded_file($_FILES['photo']['tmp_name'], $dirpath."/photo/".$_FILES['photo']['name']);
  	$usr->changePhoto($photo, $id);
  }
  echo '<script type="text/javascript">
  alert("Data successfully updated!");
  window.location.href="/store-management/admin/user.php";
  </script>';
}
?>
