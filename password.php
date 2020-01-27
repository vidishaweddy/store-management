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

<!DOCTYPE html>
<html>
<head>
<?php if( !(empty( $_COOKIE["username"] ) ) )
    {
        $usr = new Users;
        echo '<script type="text/javascript">
        setTimeout( function(){window.location.href="index.php"},300000)</script>';
        
    }
    
    else {
        //echo $_COOKIE['username'];
        echo '<script type="text/javascript">
        alert("You dont have permission to access the page");
        window.location.href="index.php";
        </script>';
        
    }
        ?>
<title>Change Password Menu</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
<header id="head" >
<p>User Management</p>
</header>

<div id="main-wrapper">
<div id="login-wrapper">
<form method="post" action="change.php">
<ul>

<li>
<label for="passwd">Password : </label>
<input type="password" id="passwd" maxlength="30" required name="password" />
</li>

<li>
<label for="conpasswd">Confirm Password : </label>
<input type="password" id="conpasswd" maxlength="30" required name="conpassword" />
</li>
<li class="buttons">
<input type="submit" name="submit" value="Submit" />
<input type="button" name="cancel" value="Cancel" onclick="location.href='main.php'" />
</li>

</ul>
</form>
</div>
</div>

</body>
</html>