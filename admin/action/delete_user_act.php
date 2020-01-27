<?php
include '../../config.php';
$usr = new Users;
$usr->storeValues( $_GET );
if (!$usr->removeData()) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/user.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully deleted!");
  window.location.href="/store-management/admin/user.php";
  </script>';
}
?>
