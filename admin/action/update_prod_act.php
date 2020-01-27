<?php
include '../../config.php';
$prod = new Products;
$prod->storeValues( $_POST );
if (!$prod->updateData()) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/product.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully updated!");
  window.location.href="/store-management/admin/product.php";
  </script>';
}
?>
