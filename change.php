<?php
    include_once("config.php");
$usr = new Users;
$usr->storeValues( $_POST );
$username=$usr->encrypt_decrypt('decrypt',$_COOKIE["username"]);
$usr->storeUname ($username);
if(empty($_POST["password"]))
echo '<script type="text/javascript">
alert("You should fill all the information");
window.location.href="password.php";
</script>';
else
{
    if($usr->has_letters() && $usr->has_numbers() && $usr->has_special_chars())
    {
        if( $_POST["password"] == $_POST["conpassword"] ) {
            if($usr->changepass() == 'Success')
            {
                echo '<script type="text/javascript">
                alert("Update Success");
                window.location.href="main.php";
                </script>';
            }
            else
                echo $usr->changepass();
        } else {
            echo '<script type="text/javascript">
            alert("Password and Confirm Password do not match");
            window.location.href="password.php";
            </script>';
        }
    }
    else
    {
        echo '<script type="text/javascript">
        alert("Password should contain at least 1 number, 1 letter and 1 special character");
        window.location.href="password.php";
        </script>';
    }
}
?>