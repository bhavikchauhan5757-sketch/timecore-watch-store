<?php
session_start();

if(!empty($_POST))
{
    extract($_POST);
    $error = array();
    $_SESSION['old'] = ['fnm'=>$fnm];

    if(empty($fnm))
    {
        $error['fnm']="Please Enter Your Username";       
    }

    if(empty($pass))
    {
        $error['pass']="Please Enter Your Password";       
    } 

    if(!empty($error))
    {
        $_SESSION['errors'] = $error;
        header("Location: login.php");
        exit();
    }
    else
    {
        include("inc/conn.php");

        $q="SELECT * FROM admin 
            WHERE (a_fnm='".mysqli_real_escape_string($conn,$fnm)."' 
            OR a_email = '".mysqli_real_escape_string($conn, $fnm)."') 
            AND a_pass='".mysqli_real_escape_string($conn,$pass)."'" ;

        $res=mysqli_query($conn,$q);

        $row=mysqli_fetch_assoc($res);

        if(empty($row))
        {
            $_SESSION['errors']['wrong'] = 'Wrong Id Or Password';
            header("Location: login.php");
            exit();
        }
        else
        {
            $_SESSION['admin']['fnm']=$row['a_fnm'];
            $_SESSION['admin']['id']=$row['a_id'];
            $_SESSION['admin']['status']=true;

            unset($_SESSION['old']);
            header("location:index.php");
            exit();
        }
    }
}
else
{
    header("location:login.php");
}
?>
