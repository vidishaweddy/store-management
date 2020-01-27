<?php
include '../../config.php';
$prod = new Products;
$prod->storeValues( $_GET );
if (!$prod->removeData()) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/product.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully deleted!");
  window.location.href="/store-management/admin/product.php";
  </script>';
}
header("location:../product.php");
?>
