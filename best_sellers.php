<?php
include('inc/conn.php');

// Fetch top 8 best-selling products based on order_items
$sql = "
SELECT p.id, p.name, p.price, p.main_image, p.gallery_images, SUM(oi.quantity) AS total_sold
FROM order_items oi
JOIN products p ON oi.product_id = p.id
WHERE p.status = 'active'
GROUP BY p.id
ORDER BY total_sold DESC
LIMIT 8
";

$result = mysqli_query($conn, $sql);
?>

<div class="product-default-slider-section section-top-gap-100 section-fluid section-inner-bg">
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">BEST SELLERS</h3>
                            <p>Add our best sellers to your weekly lineup.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-1row default-slider-nav-arrow">
                        <div class="swiper-container product-default-slider-4grid-1row">
                            <div class="swiper-wrapper">
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)):
                                        $gallery = !empty($row['gallery_images']) ? json_decode($row['gallery_images'], true) : [];
                                        $second_image = !empty($gallery[0]) ? $gallery[0] : $row['main_image'];
                                    ?>
                                        <div class="product-default-single-item product-color--golden swiper-slide">
                                            <div class="image-box">
                                                <a href="single.php?id=<?= $row['id'] ?>" class="image-link">
                                                    <img src="admin/uploads/products/<?= htmlspecialchars($row['main_image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                                    <img src="admin/uploads/products/<?= htmlspecialchars($second_image) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                                </a>
                                                <div class="action-link">
                                                    <div class="action-link-left">
                                                        <a href="cart.php?action=add&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-cart-plus"></i> Add to Cart
                                                        </a>
                                                    </div>
                                                    <div class="action-link-right">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                        <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                        <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="content-left">
                                                    <h6 class="title">
                                                        <a href="single.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></a>
                                                    </h6>
                                                    <p class="category"><?= htmlspecialchars($row['total_sold']) ?> Sold</p>
                                                </div>
                                                <div class="content-right">
                                                    <span class="price">₹<?= $row['price'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No best sellers found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>