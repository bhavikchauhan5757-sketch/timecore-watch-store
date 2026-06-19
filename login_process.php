<?php
session_start();

if(!empty($_POST))
{
    extract($_POST);

    $_SESSION['old_unm'] = $unm; // Keep entered username

    if(empty($unm))
    {
        $_SESSION['error_unm'] = "Please Enter Your Username";       
    }

    if(empty($pass))
    {
        $_SESSION['error_pass'] = "Please Enter Your Password";       
    }

    // If any field error, go back
    if(isset($_SESSION['error_unm']) || isset($_SESSION['error_pass']))
    {
        header("Location: login.php");
        exit;
    }

    include("inc/conn.php");

    $q="SELECT * FROM user 
        WHERE (u_fnm='".mysqli_real_escape_string($conn,$unm)."' 
        OR u_email = '".mysqli_real_escape_string($conn, $unm)."') 
        AND u_pass='".mysqli_real_escape_string($conn,$pass)."'";

    $res=mysqli_query($conn,$q);
    $row=mysqli_fetch_assoc($res);

    if(empty($row))
    {
        $_SESSION['error_login'] = "Wrong ID or Password";
        header("Location: login.php");
        exit;
    }
    else
    {
        unset($_SESSION['old_unm']);
        $_SESSION['client']['fnm']=$row['u_fnm'];
        $_SESSION['client']['id']=$row['u_id'];
        $_SESSION['client']['status']=true;
        $_SESSION['user_id'] = $row['u_id']; 
        $_SESSION['u_id'] = $row['u_id'];

        header("location:index.php");
        exit;
    }
}
else
{
    header("location:login.php");
    exit;
}
?>
