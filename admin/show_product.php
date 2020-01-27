<?php
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Product Detail</h3>
<a class="btn" href="product.php"><span class="glyphicon glyphicon-arrow-left"></span>  Back</a>

<?php
$id_prod=$mysql->real_escape_string($_GET['id']);


$det=$mysql->query("select * from product where id='$id_prod'")or die(mysql_error());
while($d=mysqli_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<td>Name</td>
			<td><?php echo $d['name'] ?></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><?php echo $d['type'] ?></td>
		</tr>
		<tr>
			<td>Supplier</td>
			<td><?php echo $d['supplier'] ?></td>
		</tr>
		<tr>
			<td>Price</td>
			<td>$ <?php echo number_format($d['price']) ?></td>
		</tr>
		<tr>
			<td>Quantity</td>
			<td><?php echo $d['quantity'] ?></td>
		</tr>
	</table>
	<?php
}
?>
<?php include 'footer.php'; ?>
