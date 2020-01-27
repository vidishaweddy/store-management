<?php
include '../../config.php';
$sale = new Sales;
$sale->storeValues( $_GET );
if (!$sale->removeData()) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/sales.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully deleted!");
  window.location.href="/store-management/admin/sales.php";
  </script>';
}
?>
