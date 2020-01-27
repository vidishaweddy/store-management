<?php
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Password</h3>

<br/>
<div class="col-md-5 col-md-offset-3">
	<form action="action/change_pass_act.php" method="post">
		<div class="form-group">
			<input name="username" type="hidden" value="<?php echo $_COOKIE['username']; ?>">
		</div>
		<div class="form-group">
			<label>New Password</label>
			<input name="password" type="password" class="form-control" placeholder="New Password ..">
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input name="conpassword" type="password" class="form-control" placeholder="Confirm Password ..">
		</div>
		<div class="form-group">
			<label></label>
			<input type="submit" class="btn btn-info" value="Save">
			<input type="reset" class="btn btn-danger" value="Reset">
		</div>
	</form>
</div>


<?php
include 'footer.php';

?>
