<?php
    include_once("config.php");
    $usr = new Users;
    $usr->storeValues( $_POST );
    $maxattempt = 4;
    $usr->addattempt();
    if(0 >= $maxattempt)
    {

        echo '<script type="text/javascript">
        alert("You cannot login because you fail to log in 3 times in 5 minutes");
        window.location.href="index.php";
        </script>';
    }
    else
    {
        if((empty($_POST["username"]) && empty($_POST["password"])))
            echo '<script type="text/javascript">
            alert("You should fill all the information");
            window.location.href="index.php";
            </script>';
        else
        {
            $admin=null;
            $admin=$usr->userLogin();
            if($admin!=null)
            {
                $encryptedusr=$usr->encrypt_decrypt('encrypt',$_POST["username"]);
                setcookie("username",$encryptedusr,time() + 300);
                setcookie("name",$admin,time() + 300);
                echo '<script type="text/javascript">
                window.location.href="admin/index.php";
                </script>';
            }
            else
            {
                echo $usr->checkattempt();
                echo '<script type="text/javascript">
                alert("Incorrect Username/Password");
                window.location.href="index.php";
                </script>';
            }
        }
    }
?>
