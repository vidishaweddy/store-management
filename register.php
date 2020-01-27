<?php
	include_once("config.php");
?>
<script>
window.history.forward();
function noBack()
{
    window.history.forward();
}
</script>
<?php if( !(isset( $_POST['register'] ) ) ) { ?>


<!DOCTYPE html>
<html>
    <head>
        <title>Register Menu</title>
				<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
				<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
				<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
				<script type="text/javascript" src="assets/js/jquery.js"></script>
				<script type="text/javascript" src="assets/js/bootstrap.js"></script>
				<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
    </head>

    <body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
        <header id="head" >
        	<p>Registration</p>
        </header>

        <div id="main-wrapper">
        	<div id="register-wrapper">
            	<form method="post">
								<div class="row">
									<div class="col-sm-12">
										<label for="usn">Username : </label>
									</div>
									<div class="col-sm-12">
										<input class="details" id="usn" type="text" maxlength="30" required autofocus name="username" />
									</div>
									<div class="col-sm-12">
										<label for="usn">Name : </label>
									</div>
									<div class="col-sm-12">
										<input class="details" id="usn" type="text" maxlength="30" required autofocus name="name" />
									</div>
									<div class="col-sm-12">
										<label for="passwd">Password : </label>
									</div>
									<div class="col-sm-12">
										<input class="details" type="password" id="passwd" maxlength="30" required name="password" />
									</div>
									<div class="col-sm-12">
										<label for="passwd">Confirm Password : </label>
									</div>
									<div class="col-sm-12">
										<input class="details" type="password" id="conpasswd" maxlength="30" required name="conpassword" />
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<input type="submit" name="register" value="Register" />
										<input type="button" name="cancel" value="Cancel" onclick="location.href='index.php'" />
									</div>
								</div>
            	</form>
            </div>
        </div>

    </body>
</html>
<?php
} else {
	$usr = new Users;
	$usr->storeValues( $_POST );

    if(empty($_POST["username"]) && empty($_POST["password"]))
        echo '<script type="text/javascript">
        alert("You should fill all the information");
        window.location.href="register.php";
    </script>';
    else
    {
        if($usr->has_letters() && $usr->has_numbers() && $usr->has_special_chars())
        {
        if( $_POST["password"] == $_POST["conpassword"] ) {
            echo $usr->register($_POST);
        } else {
            echo '<script type="text/javascript">
            alert("Password and Confirm Password do not match");
            window.location.href="register.php";
            </script>';
        }
        }
        else
        {
            echo '<script type="text/javascript">
            alert("Password should contain at least 1 number, 1 letter and 1 special character");
            window.location.href="register.php";
            </script>';
        }
    }
}
?>
