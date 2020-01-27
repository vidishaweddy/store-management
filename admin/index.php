<?php
include 'header.php';
$prod = new Products;
?>
<div class="col-md-10">
	<h3>Welcome to Store!</h3>
	<h4>Notification Board</h4>
	<?php
	$check=$prod->getRestock();
	if($check != null) {
		echo "<h5>List of products that needs your immediate attention: </h5><ul>";
		while($q=mysqli_fetch_array($check)) {
			if($q['quantity']<=3){
				echo "<li> <span style='color:red'>". $q['name']."</a> only has ". $q['quantity']." in stock</div>";
			}
		}
		echo "</ul>";
	} else {
		echo "<h5>There is no notification</h5>";
	}
	?>
</div>
