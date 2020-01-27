<?php
    include_once("config.php");
    ?>
<script>
window.history.forward();
function noBack()
{
    window.history.forward();
}
function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
}
</script>

<!DOCTYPE html>
<html>
<head>
<?php if( !(empty( $_COOKIE["username"] ) )  && $_COOKIE["id"]=='1')
    {
        $usr = new Users;
        $user = $usr->encrypt_decrypt('decrypt',$_GET['id']);
        $usr->storeUname ($user);
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
<title>User Management Menu</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
<header id="head" >
<p>User Management</p>
</header>
<?php if( !(isset( $_POST['submit'] ) ) ) { ?>
<div id="main-wrapper">
<div id="register-wrapper">
<form method="post">
<ul>

<li>
<label for="passwd">New Password : </label>
<input type="password" id="passwd" maxlength="30" value="Same as Old" onfocus="inputFocus(this)" onblur="inputBlur(this)" required name="password" />
</li>

<li>
<label for="conpasswd">Confirm Password : </label>
<input type="password" id="conpasswd" maxlength="30" value="Same as Old" onfocus="inputFocus(this)" onblur="inputBlur(this)" required name="conpassword" />
</li>

<li class="buttons">
<input type="submit" name="submit" value="Submit" />
<input type="button" name="cancel" value="Cancel" onclick="location.href='admin.php'" />
</li>

</ul>
</form>
</div>
</div>

</body>
</html>

<?php
    } else {
        $pass=null;
        $admin=null;
        $usr->storeValues( $_POST );
        $username=$usr->encrypt_decrypt('decrypt',$_GET['id']);
        $usr->storeUname ($username);
        if($_POST["password"] != 'Same as Old')
         {
         if(empty($_POST["password"]))
         echo '<script type="text/javascript">
         alert("You should fill all the information");
         window.location.href="admin.php";
         </script>';
         else
         {
         if($usr->has_letters() && $usr->has_numbers() && $usr->has_special_chars())
         {
         if( $_POST["password"] == $_POST["conpassword"] ) {
         if($usr->changepass() == 'Success')
         {
         $pass=1;

         }
         else
         echo $usr->changepass();
         } else {
         echo '<script type="text/javascript">
         alert("Password and Confirm Password do not match");
         window.location.href="admin.php;
         </script>';
         }
         }
         else
         {
         echo '<script type="text/javascript">
         alert("Password should contain at least 1 number, 1 letter and 1 special character");
         window.location.href="admin.php";
         </script>';
         }
         }
         }
            if($pass == 1 || $admin ==1)
            {
                echo '<script type="text/javascript">
                alert("Update Success");
                window.location.href="main.php";
                </script>';
            }
    }
        ?>
