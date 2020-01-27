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
<?php if( !(empty( $_COOKIE["username"] )) && $_COOKIE["id"] == '1' )
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
<title>Admin Menu</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">

<header id="head" >
<p>Admin Menu</p>
</header>

<div id="main-wrapper">
<div id="admin-wrapper">
<a href="main.php">Back To main Menu</a></br></br>
<table id="usertable">
<tr>
<th>ID</th>
<th>Username</th>
<th>Update Details</th>
</tr>

<?php
    $usr = new Users;
    $ID=1;
    $username = $usr->encrypt_decrypt('decrypt',$_COOKIE["username"]);
    $usr->storeUname ($username);
    $result=$usr->getUsers();
    foreach($result as $row)
    {
        echo "</td><td>";
        echo $ID;
        echo "</td><td>";
        echo $row['username'];
        echo "</td><td>";
        $user=$usr->encrypt_decrypt('encrypt',$row['username']);
        print '<center><a href="edit.php?id='.$user.'" class="buttonize">Edit</a></center>';
        echo "</td></tr>";
        $ID=$ID+1;
    }
    ?>
</div>
</div>

</body>

</html>
