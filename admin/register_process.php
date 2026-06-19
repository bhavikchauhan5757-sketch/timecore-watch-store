<?php
session_start();

if(!empty($_POST)) {
    extract($_POST);
    $errors = [];
    $old = [
        'fnm'=> $fnm ?? '',
        'email'=> $email ?? '',
        'mno'=> $mno ?? '',
        'terms'=> $terms ?? ''
    ];

    if(empty($fnm)) $errors['fnm'] = "Please Enter Full Name";
    if(empty($mno)) $errors['mno'] = "Please Enter Mobile Number";
    elseif(!is_numeric($mno)) $errors['mno'] = "Enter Numbers Only";
    elseif(strlen($mno) != 10) $errors['mno'] = "Please Enter Valid Mobile Number";

    if(empty($email)) $errors['email'] = "Please Enter Email";

    if(empty($pass)) $errors['pass'] = "Please Enter Password";
    if(empty($rpass)) $errors['rpass'] = "Please Retype Password";
    if(!empty($pass) && !empty($rpass) && $pass !== $rpass) $errors['rpass'] = "Passwords do not match";
    if(!empty($pass) && strlen($pass) < 6) $errors['pass'] = "Enter at least 6 characters";

    if(!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("location:register.php");
        exit();
    } else {
        include('inc/conn.php');
        $t = time();
        $sql = "INSERT INTO admin (a_fnm,a_mn,a_email,a_pass,a_time) VALUES ('".$fnm."','".$mno."','".$email."','".$pass."','".$t."')";
        mysqli_query($conn,$sql);
        header('location:index.php');
        exit();
    }
} else {
    header('location:register.php');
    exit();
}
