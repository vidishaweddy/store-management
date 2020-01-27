<?php
	include_once("config.php");
    setcookie("username","",time() - 300);
    setcookie("id","",time() - 300);
?>
<script>
window.history.forward();
function noBack()
{
    window.history.forward();
}
</script>


<!DOCTYPE html>
<html>
    <head>
        <title>Store Example</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
				<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
				<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
				<script type="text/javascript" src="assets/js/jquery.js"></script>
				<script type="text/javascript" src="assets/js/bootstrap.js"></script>
				<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
    </head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">

        <header id="head" >
        	<p>Login</p>
        </header>

        <div id="main-wrapper">
        	<div id="login-wrapper">
						<form method="post" action="check.php">
							<div class="row">
								<div class="col-sm-12">
									<label for="usn">Username : </label>
								</div>
								<div class="col-sm-12">
									<input class="details" type="text" maxlength="30" required autofocus name="username" />
								</div>
								<div class="col-sm-12">
									<label for="passwd">Password : </label>
								</div>
								<div class="col-sm-12">
									<input class="details" type="password" maxlength="30" required name="password" />
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<input type="submit" name="login" value="Log in" />
								</div>
							</div>
						</form>
        </div>
			</div>
    </body>
</html>
