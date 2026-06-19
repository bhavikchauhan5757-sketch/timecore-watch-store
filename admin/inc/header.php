<!-- <?php

session_start();

?> -->
<?php
include_once "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-black navbar-black">

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto d-flex align-items-center" style="gap: 15px;">
    <li class="nav-item">
      <span class="nav-link">Hi, <?php echo $_SESSION['admin']['fnm']; ?></span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php" role="button">
        Logout
      </a>
    </li>
  </ul>
</nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">BHAVIK CHAUHAN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

        <!-- USERS MENU -->
        <li class="nav-item has-treeview <?php if($currentPage=='user_list.php' || $currentPage=='admin_list.php') echo 'menu-open'; ?>" id="usersMenu">
            <a href="#" class="nav-link <?php if($currentPage=='user_list.php' || $currentPage=='admin_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if($currentPage=='user_list.php' || $currentPage=='admin_list.php') echo 'display:block;'; ?>">
                <li class="nav-item">
                    <a href="users_list.php" id="user_list" class="nav-link <?php if($currentPage=='user_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Users List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_list.php" id="admin_list" class="nav-link <?php if($currentPage=='admin_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin List</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- CATEGORY MENU -->
        <li class="nav-item has-treeview <?php if($currentPage=='add_category.php' || $currentPage=='category_list.php') echo 'menu-open'; ?>" id="categoryMenu">
            <a href="#" class="nav-link <?php if($currentPage=='add_category.php' || $currentPage=='category_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    Category
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if($currentPage=='add_category.php' || $currentPage=='category_list.php') echo 'display:block;'; ?>">
                <li class="nav-item">
                    <a href="add_category.php" id="add_category" class="nav-link <?php if($currentPage=='add_category.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="category_list.php" id="category_list" class="nav-link <?php if($currentPage=='category_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Category List</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- BRAND MENU -->
        <li class="nav-item has-treeview <?php if($currentPage=='add_brand.php' || $currentPage=='brand_list.php') echo 'menu-open'; ?>" id="brandMenu">
            <a href="#" class="nav-link <?php if($currentPage=='add_brand.php' || $currentPage=='brand_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                    Brand
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if($currentPage=='add_brand.php' || $currentPage=='brand_list.php') echo 'display:block;'; ?>">
                <li class="nav-item">
                    <a href="add_brand.php" id="add_brand" class="nav-link <?php if($currentPage=='add_brand.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Brand</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="brand_list.php" id="brand_list" class="nav-link <?php if($currentPage=='brand_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Brand List</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PRODUCTS MENU -->
        <li class="nav-item has-treeview <?php if($currentPage=='add_products.php' || $currentPage=='product_list.php') echo 'menu-open'; ?>" id="productsMenu">
            <a href="#" class="nav-link <?php if($currentPage=='add_products.php' || $currentPage=='product_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                    Products
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if($currentPage=='add_products.php' || $currentPage=='product_list.php') echo 'display:block;'; ?>">
                <li class="nav-item">
                    <a href="add_products.php" id="add_products" class="nav-link <?php if($currentPage=='add_products.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="product_list.php" id="product_list" class="nav-link <?php if($currentPage=='product_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product List</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SLIDER MENU -->
        <li class="nav-item has-treeview <?php if($currentPage=='add_slider.php' || $currentPage=='slider_list.php') echo 'menu-open'; ?>" id="sliderMenu">
            <a href="#" class="nav-link <?php if($currentPage=='add_slider.php' || $currentPage=='slider_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-images"></i>
                <p>
                    Slider
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="<?php if($currentPage=='add_slider.php' || $currentPage=='slider_list.php') echo 'display:block;'; ?>">
                <li class="nav-item">
                    <a href="add_slider.php" id="add_slider" class="nav-link <?php if($currentPage=='add_slider.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="slider_list.php" id="slider_list" class="nav-link <?php if($currentPage=='slider_list.php') echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Slider List</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ORDERS MENU (NO SUBMENU) -->
        <li class="nav-item">
            <a href="orders.php" class="nav-link <?php if($currentPage=='order_list.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Orders</p>
            </a>
        </li>

        

        <!-- CONTACT MESSAGES (NO SUBMENU) -->
        <li class="nav-item">
            <a href="contact_massage.php" class="nav-link <?php if($currentPage=='contact_messages.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Contact Messages</p>
            </a>
        </li>

        <!-- SITE SETTINGS (NO SUBMENU) -->
        <li class="nav-item">
            <a href="site_setting.php" class="nav-link <?php if($currentPage=='site_setting.php') echo 'active'; ?>">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Site Settings</p>
            </a>
        </li>

    </ul>
</nav>



<script>
  const pageMenuMap = {
    "add_category.php": {menuId: "categoryMenu", linkId: "add_category"},
    "category_list.php": {menuId: "categoryMenu", linkId: "category_list"},
    "add_products.php": {menuId: "productsMenu", linkId: "add_products"},
    "product_list.php": {menuId: "productsMenu", linkId: "product_list"},
  };


  const currentPage = window.location.pathname.split("/").pop();

  if (pageMenuMap[currentPage]) {
    const menuId = pageMenuMap[currentPage].menuId;
    const linkId = pageMenuMap[currentPage].linkId;


    const menu = document.getElementById(menuId);
    if (menu) {
      menu.classList.add("menu-open");
    }


    const parentLink = menu.querySelector('a.nav-link');
    if (parentLink) {
      parentLink.classList.add("active");
      parentLink.style.fontWeight = "bold";
    }

    const subLink = document.getElementById(linkId);
    if (subLink) {
      subLink.classList.add("active");
      subLink.style.fontWeight = "bold";
    }
  }
</script>
</div>
</aside>

  