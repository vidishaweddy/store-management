<?php
include '../../config.php';
$prod = new Products;
$sale = new Sales;
$prod->storeValues( $_POST );
$sale->storeValues( $_POST );

$dt=$prod->searchById();
$data=mysqli_fetch_array($dt);
$current_quantity=$data['quantity']-$_POST['quantity'];
$prod_list = $prod->getProduct($_POST['id']);
$name = mysqli_fetch_array($prod_list)['name'];
if(!$prod->updateQty($current_quantity) && !$sale->addData($name)) {
  echo '<script type="text/javascript">
  alert("Data failed to save. Please try again!");
  window.location.href="/store-management/admin/sale.php";
  </script>';
} else {
  echo '<script type="text/javascript">
  alert("Data successfully saved!");
  window.location.href="/store-management/admin/sales.php";
  </script>';
}

?>
