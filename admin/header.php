<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	include 'permission.php';
	include '../config.php';
	?>
	<title>Admin Menu</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Admin Menu</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="quantity_notification" href="#" data-toggle="modal" data-target="#notif_modal"><span class='glyphicon glyphicon-comment'></span>  Message</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hi, <?php echo $_COOKIE['name']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="notif_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Notification</h4>
				</div>
				<div class="modal-body">
					<?php
					$check=$mysql->query("select * from product where quantity <=3");
					while($q=mysqli_fetch_array($check)){
						if($q['quantity']<=3){
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stock  <a style='color:red'>". $q['name']."</a> is less than 3 . Please restock !!</div>";
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<div class="col-sm-2">
		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>
			<li><a href="product.php"><span class="glyphicon glyphicon-briefcase"></span>  Product</a></li>
			<li><a href="sales.php"><span class="glyphicon glyphicon-briefcase"></span>  Sales</a></li>
			<li><a href="user.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
			<li><a href="change_pass.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
		</ul>
	</div>
	<div class="col-md-10">
