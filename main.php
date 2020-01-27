<?php
    include_once("config.php");
    $usn=null;
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
        ?>
<title>Home Menu</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">

<header id="head" >
<p>Home</p>
</header>

<div id="main-wrapper">
<div id="login-wrapper">
<?php
    echo "Welcome ".$usr->encrypt_decrypt('decrypt',$_COOKIE["username"]);
    if($_COOKIE["name"] != null)
    {
        echo "<br/><br/><a href='admin/index.php'>Admin Menu";
    }
    ?>
<br/> <a href='password.php'>Change Password</a>
<br/> <a href='index.php'>Log Out</a>

</div>
</div>

</body>
</html>

<?php
    }

    else {
        //echo $_COOKIE['username'];
        echo '<script type="text/javascript">
            alert("You dont have permission to access the page");
        window.location.href="index.php";
        </script>';

    }
    ?>
