<?php
if(!isset($_COOKIE['username'])){
		echo '<script type="text/javascript">
				alert("You dont have permission to access the page");
		</script>';
		header('location:../index.php');
} else {
	echo '<script type="text/javascript">
	setTimeout( function(){window.location.href="index.php"},300000)</script>';
}
?>
