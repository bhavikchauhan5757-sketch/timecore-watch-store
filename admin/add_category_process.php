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
  
  // echo "<pre>";
  // echo $cnm;

  // exit;
  if(empty($cnm))
  {
    $error[] = "Please Enter Category Name";
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
   $q="INSERT INTO categories
      (c_nm,c_des)
      VALUES('$cnm','$cdes')";

    mysqli_query($conn,$q);

    $_SESSION['success']['category'] = "Category added successfully!";

    header("location:add_category.php");

  }

}

else
{

    header('location:add_category.php');

}

?>