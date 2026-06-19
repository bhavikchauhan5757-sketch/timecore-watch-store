<?php

session_start();
include('inc/conn.php');

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}



if(!empty($_POST))
{

  extract($_POST);
  $error = array();
  
  
  if(empty($b_name))
  {
    $error[] = "Please Enter Brand";
  }

  if(!empty($error))
  {
    foreach($error as $er)
    {
        echo $er.'<br>';
    }
  }

  else
  {
   $q="INSERT INTO brands(b_name) VALUES('$b_name')";

    mysqli_query($conn,$q);

    $_SESSION['success']['brand']="Brand Inserted Successfully";

    header("location:add_brand.php");

  }

}

else
{

    header('location:add_brand.php');

}

?>