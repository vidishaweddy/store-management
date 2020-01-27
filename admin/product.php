<?php
include 'header.php';
$prod = new Products;
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Product List</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Add product</button>
<br/>
<br/>

<?php
$checka=$prod->getData();
while($q=mysqli_fetch_array($checka)){
	if($q['quantity']<=3){
		?>
		<script>
			$(document).ready(function(){
				$('#quantity_notification').css("color","red");
				$('#quantity_notification').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stock  <a style='color:red'>". $q['name']."</a> is less than 3 . Please reorder!!</div>";
	}
}
?>
<?php
$per_page=10;
$total= $prod->countData();
$page= ceil($total / $per_page);
$current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($current_page - 1) * $per_page;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Records</td>
			<td><?php echo $total; ?></td>
		</tr>
		<tr>
			<td>Pages</td>
			<td><?php echo $page; ?></td>
		</tr>
	</table>
	<a style="margin-bottom:10px" href="product_report.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Print</a>
</div>
<form action="search_product.php" method="get">
	<div class="input-group col-md-5">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Search here..." aria-describedby="basic-addon1" name="search">
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-4">Name</th>
		<th class="col-md-3">Price</th>
		<th class="col-md-1">Quantity</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Action</th>
	</tr>
	<?php
	if(isset($_GET['search'])){
		$search=$mysql->real_escape_string($_GET['search']);
		$prod=$prod->searchData($search);
	}else{
		$prod=$prod->getData($start, $per_page);
	}
	$no=1;
	while($b=mysqli_fetch_array($prod)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['name'] ?></td>
			<td>$ <?php echo number_format($b['price']) ?></td>
			<td><?php echo $b['quantity'] ?></td>
			<td>
				<a href="show_product.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
				<a href="edit_prod.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Are you sure?')){ location.href='action/delete_prod_act.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Delete</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<ul class="pagination">
			<?php
			for($x=1;$x<=$page;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>
		</ul>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">New Product</h4>
			</div>
			<div class="modal-body">
				<form action="action/add_prod_act.php" method="post">
					<div class="form-group">
						<label>Name</label>
						<input name="name" type="text" class="form-control" placeholder="Name...">
					</div>
					<div class="form-group">
						<label>Type</label>
						<input name="type" type="text" class="form-control" placeholder="Type...">
					</div>
					<div class="form-group">
						<label>Supplier</label>
						<input name="supplier" type="text" class="form-control" placeholder="Supplier...">
					</div>
					<div class="form-group">
						<label>Price</label>
						<input name="price" type="text" class="form-control" placeholder="Price...">
					</div>
					<div class="form-group">
						<label>Quantity</label>
						<input name="quantity" type="text" class="form-control" placeholder="Quantity">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>



<?php
include 'footer.php';

?>
