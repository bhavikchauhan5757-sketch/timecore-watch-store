<!DOCTYPE html>
<html lang="">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Timecore</title>

    <!-- Topbar -->
<div class="top-bar" style="background-color:#F7E7CE; padding: 10px 0;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: nowrap;">
        <!-- Left Section -->
        <div class="left-top-bar" style="white-space: nowrap;">
            Welcome to TimeCore! Enjoy your shopping experience.
        </div>
        <?php
            if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }
        ?>

        <div class="right-top-bar" style="display: flex; gap: 20px; white-space: nowrap; align-items: center;">
            <?php
                if (isset($_SESSION['client']['status'])) 
                {
                    echo '<span><i class="fa fa-user" style="margin-right: 5px;"></i>' . $_SESSION['client']['fnm'] . '</span>';
                    echo '<a href="logout.php" class="trans-04"><i class="fas fa-sign-out-alt"></i>Logout</a>';
                } 
                else 
                {
                    echo '<a href="login.php" class="trans-04"><i class="fas fa-sign-in-alt"></i> Login</a>';
                }
            ?>
        </div>
    </div>
</div>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="assets/sass/style.css"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <!-- Font Awesome 6 CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-sV3q9xGKrVVaAOd3KmKDL0d5g9qBoKXbJ2iN7NNZSLDFRmjQu2tK8gWpAE/31xxX6gL+MnxvjY7dF6pF1c4OXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">

    <!-- Your existing head content -->

    <!-- Preloader CSS Start -->
    <style>
        /* ===== Preloader Styles ===== */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000; /* background color during loading */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader {
            border: 6px solid #222;        /* outer circle color */
            border-top: 6px solid #d4af37; /* golden spinner */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
    </style>
    <!-- Preloader CSS End -->

    <!-- Your other CSS files -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <!-- Preloader Start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- Preloader End -->

    <!-- Your existing header content starts here -->

    <!-- Start Header Area -->
    <header class="header-section d-none d-xl-block" >
        <div class="header-wrapper" >
            <div class="header-bottom header-bottom-color--white section-fluid sticky-header sticky-color--white">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
<?php
include('inc/conn.php');

// Fetch site settings
$site_query = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
$site = mysqli_fetch_assoc($site_query);
?>

<!-- Start Header Logo -->
<div class="header-logo">
    <div class="logo">
        <a href="index.php">
            <img src="/timecore/assets/images/logo/<?php echo $site['website_logo']; ?>" 
                 alt="<?php echo htmlspecialchars($site['site_name']); ?>" 
                 style="max-height: 60px;">
        </a>
    </div>
</div>
<!-- End Header Logo -->




                            <!-- Start Header Main Menu -->
                            <div class="main-menu menu-color--black menu-hover-color--golden">
                                <nav>
                                    <ul>
                                        <li class="has-dropdown">
                                            <a class="active main-menu-link" href="index.php">Home</a>                              
                                        </li>
                                        <li class="has-dropdown has-megaitem">
                                            <a href="product.php">Product</a> 
                                        </li>
                                        <li>
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li>
                                            <a href="contact.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Header Main Menu Start -->

                            <!-- Start Header Action Link -->
                            <ul class="header-action-link action-color--black action-hover-color--golden">
                                <?php
                                // Make sure session and database are included
                                include('inc/conn.php');

                                $user_id = $_SESSION['user_id'] ?? 0; // Get logged-in user id
                                $cart_count = 0;

                                if ($user_id > 0) {
                                // Count total items in cart for this user
                                $sql = "SELECT SUM(quantity) as total_items FROM cart WHERE user_id = $user_id";
                                $res = mysqli_query($conn, $sql);
                                if ($res && $row = mysqli_fetch_assoc($res)) {
                                $cart_count = (int)$row['total_items'];
                                }
                                }
                                ?>
                                <li>
                                 <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                 <i class="icon-bag"></i>
                                <span class="item-count"><?= $cart_count ?></span>
                                </a>
                                </li>

                                <li>
                                    <a href="#search">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                        <i class="icon-menu"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Header Action Link -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Start Header Area -->

    <!-- Start Mobile Header -->
    <div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <!-- Start Mobile Left Side -->
                    <div class="mobile-header-left">
                        <ul class="mobile-menu-logo">
                            <li>
                                <a href="index.php">
                                    <div class="logo">
                                        <img src="assets/images/logo/logo_black.png" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Left Side -->

                    <!-- Start Mobile Right Side -->
                    <div class="mobile-right-side">
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart"></i>
                                    <span class="item-count">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span class="item-count">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Right Side -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Header -->

    <!--  Start Offcanvas Mobile Menu Section -->
    <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu  -->
            <div class="mobile-menu-bottom">
                <!-- Start Mobile Menu Nav -->
                <div class="offcanvas-menu">
                    <ul>
                        <li>
                            <a href="index.php"><span>Home</span></a>
                        </li>
                        <li>
                            <a href="#"><span>Product</span></a>
                        </li>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div> <!-- End Mobile Menu Nav -->
            </div> <!-- End Mobile Menu -->

            <!-- Start Mobile contact Info -->
            <div class="mobile-contact-info">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/logo/logo_white.png" alt=""></a>
                </div>

                <address class="address">
                    <span>Address: Your address goes here.</span>
                    <span>Call Us: 0123456789, 0123456789</span>
                    <span>Email: demo@example.com</span>
                </address>

                <ul class="social-link">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>

                <ul class="user-link">
                    <li><a href="wishlist.php">Wishlist</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
            <!-- End Mobile contact Info -->

        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
                <a href="index.php"><img src="assets/images/logo/logo_white.png" alt=""></a>
            </div>

            <address class="address">
                <span>Address: Your address goes here.</span>
                <span>Call Us: 0123456789, 0123456789</span>
                <span>Email: demo@example.com</span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Addcart Section -->
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">

    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

<?php
// Make sure user is logged in
include('inc/conn.php'); // provides $conn

$user_id = $_SESSION['user_id'] ?? 0; // get logged-in user id

$subtotal = 0;
$cart_items = [];

if ($user_id > 0) {
    // Fetch cart items from database
    $sql = "SELECT c.product_id, c.quantity, p.name, p.price, p.main_image
            FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $cart_items[] = $row;
            $subtotal += $row['price'] * $row['quantity'];
        }
    }
}
?>

<!-- Start Offcanvas Addcart Wrapper -->
<div class="offcanvas-add-cart-wrapper">
    <h4 class="offcanvas-title">Shopping Cart</h4>

    <ul class="offcanvas-cart">
        <?php
        if (!empty($cart_items)):
            foreach ($cart_items as $item):
                $line_total = $item['price'] * $item['quantity'];
                $imagePath = 'admin/uploads/products/' . ($item['main_image'] ?? '');
        ?>
        <li class="offcanvas-cart-item-single">
            <div class="offcanvas-cart-item-block">
                <a href="single.php?id=<?= $item['product_id'] ?>" class="offcanvas-cart-item-image-link">
                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="offcanvas-cart-image">
                </a>
                <div class="offcanvas-cart-item-content">
                    <a href="single.php?id=<?= $item['product_id'] ?>" class="offcanvas-cart-item-link"><?= htmlspecialchars($item['name']) ?></a>
                    <div class="offcanvas-cart-item-details">
                        <span class="offcanvas-cart-item-details-quantity"><?= $item['quantity'] ?> x </span>
                        <span class="offcanvas-cart-item-details-price">₹<?= number_format($item['price'],2) ?></span>
                    </div>
                </div>
            </div>
            <div class="offcanvas-cart-item-delete text-right">
                <a href="cart.php?action=remove&id=<?= $item['product_id'] ?>" class="offcanvas-cart-item-delete">
                    <i class="fa fa-trash-o"></i>
                </a>
            </div>
        </li>
        <?php
            endforeach;
        else:
        ?>
        <li class="text-center text-muted">Your cart is empty</li>
        <?php endif; ?>
    </ul>

    <div class="offcanvas-cart-total-price">
        <span class="offcanvas-cart-total-price-text">Subtotal:</span>
        <span class="offcanvas-cart-total-price-value">₹<?= number_format($subtotal,2) ?></span>
    </div>

    <ul class="offcanvas-cart-action-button">
        <li><a href="cart.php" class="btn btn-block btn-golden">View Cart</a></li>
        <li><a href="checkout.php" class="btn btn-block btn-golden mt-2">Checkout</a></li>
    </ul>

</div> <!-- End Offcanvas Addcart Wrapper -->

</div> <!-- End Offcanvas Addcart Section -->



    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h4 class="offcanvas-title">Wishlist</h4>
            <ul class="offcanvas-wishlist">
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-1/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-2/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-3/default-1.jpg" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            </ul>
            <ul class="offcanvas-wishlist-action-button">
                <li><a href="#" class="btn btn-block btn-golden">View wishlist</a></li>
            </ul>
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->

    </div> <!-- End Offcanvas Mobile Menu Section -->

    <!-- Start Offcanvas Search Bar Section -->
    <div id="search" class="search-modal">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-lg btn-golden">Search</button>
        </form>
    </div>
    <!-- End Offcanvas Search Bar Section -->

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>