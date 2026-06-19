<?php

include('inc/header.php');

?>



<!-- Start Hero Slider Section-->
<div class="hero-slider-section">
    <!-- Slider main container -->
    <div class="hero-slider-active swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">

            <?php
            // Fetch active sliders
            $sliderQuery = "SELECT * FROM sliders WHERE status=1 ORDER BY id DESC";
            $sliderResult = mysqli_query($conn, $sliderQuery);

            if (mysqli_num_rows($sliderResult) > 0) {
                while ($row = mysqli_fetch_assoc($sliderResult)) {
                    $image = htmlspecialchars($row['image']);
                    $title = htmlspecialchars($row['title']);
                    $subtitle = htmlspecialchars($row['subtitle']);
                    $buttonText = htmlspecialchars($row['button_text']);
                    $buttonLink = htmlspecialchars($row['button_link']);
                    ?>
                    
                    <!-- Dynamic Hero Slider Item -->
                    <div class="hero-single-slider-item swiper-slide">
                        <!-- Hero Slider Image -->
                        <div class="hero-slider-bg">
                            <img src="admin/uploads/sliders/<?php echo $image; ?>" alt="">
                        </div>

                        <!-- Hero Slider Content -->
                        <div class="hero-slider-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="hero-slider-content">
                                            <h4 class="title" style="color: white;"><?php echo $title; ?></h4>
                                            <h2 class="subtitle" style="color: white;"><?php echo $subtitle; ?></h2>
                                            <a href="<?php echo $buttonLink; ?>" 
                                               class="btn btn-lg btn-outline-golden" 
                                               style="color: white; border-color: white;">
                                                <?php echo $buttonText; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Dynamic Hero Slider Item -->

                    <?php
                }
            } else {
                echo "<p style='text-align:center; color:white;'>No active sliders found.</p>";
            }
            ?>

        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination active-color-golden"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev d-none d-lg-block"></div>
        <div class="swiper-button-next d-none d-lg-block"></div>
    </div>
</div>
    <!-- End Hero Slider Section-->



    <!-- Start Service Section -->
    <div class="service-promo-section section-top-gap-100">
        <div class="service-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                            <div class="image">
                                <img src="assets/images/icons/service-promo-1.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">FREE SHIPPING</h6>
                                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="image">
                                <img src="assets/images/icons/service-promo-2.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">30 DAYS MONEY BACK</h6>
                                <p>100% satisfaction guaranteed, or get your money back within 30 days!</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="image">
                                <img src="assets/images/icons/service-promo-3.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">SAFE PAYMENT</h6>
                                <p>Pay with the world’s most popular and secure payment methods.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="image">
                                <img src="assets/images/icons/service-promo-4.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">LOYALTY CUSTOMER</h6>
                                <p>Card for the other 30% of their purchases at a rate of 1% cash back.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Section -->

     <?php
    include('best_sellers.php');
    ?>

    <!-- Start Instagramr Section -->
    <div class="instagram-section section-top-gap-100 section-inner-bg">
        <div class="instagram-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="instagram-box">
                            <div id="instagramFeed" class="instagram-grid clearfix">
                                <a href="https://www.instagram.com/p/CCFOZKDDS6S/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-1.jpg" alt=""></a>
                                <a href="https://www.instagram.com/p/CCFOYDNjWF5/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-2.jpg" alt=""></a>
                                <a href="https://www.instagram.com/p/CCFOXH6D-zQ/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-3.jpg" alt=""></a>
                                <a href="https://www.instagram.com/p/CCFOVcrDDOo/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-4.jpg" alt=""></a>
                                <a href="https://www.instagram.com/p/CCFOUajjABP/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-5.jpg" alt=""></a>
                                <a href="https://www.instagram.com/p/CCFOS2MDmjj/" target="_blank"
                                    class="instagram-image-link float-left banner-animation"><img
                                        src="assets/images/instagram/instagram-6.jpg" alt=""></a>
                            </div>
                            <div class="instagram-link">
                                <h5><a href="https://www.instagram.com/myfurniturecom/" target="_blank"
                                        rel="noopener noreferrer">HONOTEMPLATE</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagramr Section -->

    <?php

    include('inc/footer.php');

    ?>