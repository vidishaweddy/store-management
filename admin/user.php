<?php
include 'header.php';
$user = new Users;
?>

<h3><span class="glyphicon glyphicon-user"></span> User List</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Add user</button>
<br/>
<br/>
<?php
$per_page=10;
$total= $user->countData();
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
</div>
<form action="search_user.php" method="get">
	<div class="input-group col-md-5">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Search here..." aria-describedby="basic-addon1" name="search">
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-4">Photo</th>
		<th class="col-md-3">Name</th>
		<th class="col-md-3">Username</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Action</th>
	</tr>
	<?php
	if(isset($_GET['search'])){
		$search=$mysql->real_escape_string($_GET['search']);
		$usr=$user->searchData($search);
	}else{
		$usr=$user->getUsers($start, $per_page);
	}
	$no=1;
	while($b=mysqli_fetch_array($usr)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>
        <?php if ($b['photo'] != '') {
          echo "<a class='thumbnail'>
  					<img class='img-responsive' src='photo/".$b['photo']."'>
            </a>";
        }?>
      </td>
			<td><?php echo $b['name'] ?></td>
      <td><?php echo $b['username'] ?></td>
			<td>
				<a href="edit_user.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Are you sure?')){ location.href='action/delete_user_act.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Delete</a>
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
				<h4 class="modal-title">New user</h4>
			</div>
			<div class="modal-body">
				<form action="action/add_user_act.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Name</label>
						<input name="name" type="text" class="form-control" placeholder="Name...">
					</div>
					<div class="form-group">
						<label>Photo</label>
						<input name="photo" type="file" class="form-control" placeholder="Photo...">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" placeholder="Username...">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="password" type="password" class="form-control" placeholder="Password...">
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
