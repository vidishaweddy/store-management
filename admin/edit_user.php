<?php
include 'header.php';
$user = new Users;
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit User</h3>
<a class="btn" href="sales.php"><span class="glyphicon glyphicon-arrow-left"></span>  back</a>

<?php
$id_prod=$mysql->real_escape_string($_GET['id']);

$det=$user->getUser($id_prod);
while($d=mysqli_fetch_array($det)){
	?>
	<form action="action/update_user_act.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>

			<tr>
				<td>Username</td>
				<td><input name="username" type="text" class="form-control" value="<?php echo $d['username'] ?>"></td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					<input name="name" type="text" class="form-control" value="<?php echo $d['name'] ?>">
				</td>
			</tr>

			<tr>
				<td>Photo</td>
				<td><input type="file" name="photo" value="<?php echo $d['photo'] ?>"></td>
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
<?php
include 'footer.php';

?>
