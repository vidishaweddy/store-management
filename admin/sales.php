<?php
include 'header.php';
$prod = new Products;
$sale = new Sales;
$date = null;
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Sales Details</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="date" class="form-control" onchange="this.form.submit()">
			<option>Choose a Date ..</option>
			<?php
			$pil=$mysql->query("select distinct date from sales order by date desc");
			while($p=mysqli_fetch_array($pil)){
				?>
				<option><?php echo $p['date'] ?></option>
				<?php
			}
			?>
		</select>
	</div>

</form>
<br/>
<?php
if(isset($_GET['date'])){
	$date=$mysql->real_escape_string($_GET['date']);
	$tg="sales_report.php?date=$date";
}
?>
<a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Print</a>
<br/>
<?php
if(isset($_GET['date'])){
	echo "<h4> Sales Details on <a style='color:blue'> ". $_GET['date']."</a></h4>";
	$date=$mysql->real_escape_string($_GET['date']);
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Date</th>
		<th>Name</th>
		<th>Price/pc</th>
		<th>Total Price</th>
		<th>Quantity</th>
		<th>Profit</th>
		<th>Action</th>
	</tr>
	<?php
	$data=$sale->getData($date);
	$no=1;
	while($b=mysqli_fetch_array($data)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['date'] ?></td>
			<td><?php echo $b['name'] ?></td>
			<td>$ <?php echo number_format($b['price']) ?></td>
			<td>$ <?php echo number_format($b['total']) ?></td>
			<td><?php echo $b['quantity'] ?></td>
			<td><?php echo "$ ".number_format($b['profit'])?></td>
			<td>
				<a href="edit_sales.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Are you sure ??')){ location.href='action/delete_sales_act.php?id=<?php echo $b['id']; ?>&quantity=<?php echo $b['quantity'] ?>&name=<?php echo $b['name']; ?>' }" class="btn btn-danger">Delete</a>
			</td>
		</tr>

		<?php
	}
	?>
	<tr>
		<td colspan="7">Total Price</td>
		<?php
		$x=$sale->sumTotalPrice($date);
		$xx=mysqli_fetch_array($x);
		echo "<td><b> $ ". number_format($xx['total'])."</b></td>";
		?>
	</tr>
	<tr>
		<td colspan="7">Total Profit</td>
		<?php
		$x=$sale->sumProfit($date);
		$xx=mysqli_fetch_array($x);
		echo "<td><b> $ ". number_format($xx['total'])."</b></td>";

		?>
	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add Sales
				</div>
				<div class="modal-body">
					<form action="action/add_sales_act.php" method="post">
						<div class="form-group">
							<label>Date</label>
							<input name="date" type="text" class="form-control" id="sale_date" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Name</label>
							<select class="form-control" name="id">
								<?php
								$prod_list=$prod->getData();
								while($b=mysqli_fetch_array($prod_list)){
									?>
									<option value="<?php echo $b['id']; ?>"><?php echo $b['name'] ?></option>
									<?php
								}
								?>
							</select>

						</div>
						<div class="form-group">
							<label>Price/Unit</label>
							<input name="price" type="text" class="form-control" placeholder="Price" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Quantity</label>
							<input name="quantity" type="text" class="form-control" placeholder="Quantity" autocomplete="off">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#sale_date").datepicker({dateFormat : 'yy/mm/dd'});
		});
	</script>
	<?php include 'footer.php'; ?>
