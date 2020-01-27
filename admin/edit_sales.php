<?php
include 'header.php';
$prod = new Products;
$sale = new Sales;
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Sale</h3>
<a class="btn" href="sales.php"><span class="glyphicon glyphicon-arrow-left"></span>  back</a>

<?php
$id_prod=$mysql->real_escape_string($_GET['id']);

$det=$sale->getSale($id_prod);
while($d=mysqli_fetch_array($det)){
	?>
	<form action="action/update_sales_act.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>

			<tr>
				<td>date</td>
				<td><input name="date" type="text" class="form-control" id="sale_date" autocomplete="off" value="<?php echo $d['date'] ?>"></td>
			</tr>
			<tr>
				<td>name</td>
				<td>
					<select class="form-control" name="name">
						<?php
						$prod=$prod->getData();
						while($b=mysqli_fetch_array($prod)){
							?>
							<option <?php if($d['name']==$b['name']){echo "selected"; } ?> value="<?php echo $b['name']; ?>"><?php echo $b['name'] ?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Price</td>
				<td><input type="text" class="form-control" name="price" value="<?php echo $d['price'] ?>"></td>
			</tr>
			<tr>
				<td>Quantity</td>
				<td><input type="text" class="form-control" name="quantity" readonly=true value="<?php echo $d['quantity'] ?>"></td>
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
 <script type="text/javascript">
        $(document).ready(function(){

            $('#sale_date').datepicker({dateFormat: 'yy/mm/dd'});

        });
    </script>
<?php
include 'footer.php';

?>
