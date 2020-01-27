 <?php
 include '../../config.php';
 $sale = new Sales;
 $sale->storeValues( $_POST );
 if(!$sale->updateData()) {
   echo '<script type="text/javascript">
   alert("Data failed to save. Please try again!");
   window.location.href="/store-management/admin/sales.php";
   </script>';
 } else {
   echo '<script type="text/javascript">
   alert("Data successfully updated!");
   window.location.href="/store-management/admin/sales.php";
   </script>';
 }
 ?>
