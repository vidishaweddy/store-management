<?php
include '../../config.php';
$prod = new Products;
$prod->storeValues( $_POST );
if (!$prod->addData()) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/product.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully saved!");
  window.location.href="/store-management/admin/product.php";
  </script>';
}
 ?>
