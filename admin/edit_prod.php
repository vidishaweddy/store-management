<?php
include 'header.php';
$prod = new Products;
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit product</h3>
<a class="btn" href="product.php"><span class="glyphicon glyphicon-arrow-left"></span>  Back</a>
<?php
$id_prod=$mysql->real_escape_string($_GET['id']);
$det=$prod->getProduct($id_prod);
while($d=mysqli_fetch_array($det)){
?>
	<form action="action/update_prod_act.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" class="form-control" name="name" value="<?php echo $d['name'] ?>"></td>
			</tr>
			<tr>
				<td>Type</td>
				<td><input type="text" class="form-control" name="type" value="<?php echo $d['type'] ?>"></td>
			</tr>
			<tr>
				<td>Supplier</td>
				<td><input type="text" class="form-control" name="supplier" value="<?php echo $d['supplier'] ?>"></td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input type="text" class="form-control" name="price" value="<?php echo $d['price'] ?>"></td>
			</tr>
			<tr>
				<td>Quantity</td>
				<td><input type="text" class="form-control" name="quantity" value="<?php echo $d['quantity'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Save"></td>
			</tr>
		</table>
	</form>
	<?php
}
?>
<?php include 'footer.php'; ?>
