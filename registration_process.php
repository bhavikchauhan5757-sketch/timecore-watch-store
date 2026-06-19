<?php

if(!empty($_POST))
{
    extract($_POST);
    $error = array();

    if(empty($fnm))
    {
        $error[] = "Please Enter Full Name";
    }

    if(empty($mn))
    {
        $error[] = "Please Enter Mobile Number";
    }

    else if (strlen($mn) != 10) {
        $error[] = "Please Enter Valid Mobile Number";
    }

    else if(! is_numeric($mn))
    {
        $error[] = "Enter Numbers Only";
    }

    if(empty($em))
    {
        $error[] = "Please Enter Email";
    }

    if(empty($pass) || empty($cpass))
    {
        $error[] = "Please Enter Password";
    }

    else if($pass !== $cpass)
    {
        $error[] = "don't Match Password";
    }

    else if(strlen($pass) < 6)
    {
        $error[] = "Enter 6 digits";
    }    

    if(! empty($error))
    {
        foreach($error as $er)
        {
            echo $er;
            echo '<br>';
        }
    }

    else
    {
        include('inc/conn.php');

        $t=time();

        $sql = "INSERT INTO user 
        (u_fnm,u_mn,u_email,u_pass,u_time) 
        VALUES ('".$fnm."','".$mn."','".$em."','".$pass."','".$t."')";

        mysqli_query($conn,$sql);

        header('location:index.php');
    }
    

}

else
{
    header('location:registration.php');

}
?>