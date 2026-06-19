<?php
include('inc/header.php');
include('inc/conn.php');

// Fetch active categories
$cat_query = "SELECT c_id, c_nm FROM categories WHERE LOWER(c_status) = 'active' ORDER BY c_nm ASC";
$cat_result = mysqli_query($conn, $cat_query);

// Get selected category from query string
$selected_cat = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Base product query with only active brands
$query = "SELECT p.*, 
                 c.c_nm AS category_name, 
                 b.b_name AS brand_name 
          FROM products p
          INNER JOIN categories c ON p.category_id = c.c_id AND LOWER(c.c_status) = 'active'
          INNER JOIN brands b ON p.brand_id = b.b_id AND b.status = 1
          WHERE LOWER(p.status) = 'active'";

// Apply category filter if selected
if ($selected_cat > 0) {
    $query .= " AND p.category_id = $selected_cat";
}

$query .= " ORDER BY p.id DESC";

$products = mysqli_query($conn, $query);
$total_products = $products ? mysqli_num_rows($products) : 0;
?>

<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-12">

                <!-- Professional Category Filter -->
                <div class="shop-sort-section mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="sort-box d-flex flex-wrap align-items-center justify-content-between">
                                <div class="sort-tablist d-flex flex-wrap align-items-center">
                                    <span class="me-2 fw-bold">Categories:</span>
                                    <ul class="nav category-filter flex-wrap" style="list-style:none; padding:0; margin:0;">
                                        <li style="margin-right:10px;">
                                            <a href="product.php" class="category-pill <?= $selected_cat == 0 ? 'active' : '' ?>">All</a>
                                        </li>
                                        <?php
                                        // Reset result pointer to loop again
                                        mysqli_data_seek($cat_result, 0);
                                        while ($cat = mysqli_fetch_assoc($cat_result)): ?>
                                            <li style="margin-right:10px;">
                                                <a href="?category=<?= $cat['c_id'] ?>" class="category-pill <?= $selected_cat == $cat['c_id'] ? 'active' : '' ?>">
                                                    <?= htmlspecialchars($cat['c_nm']) ?>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <div class="page-amount mt-2 mt-md-0">
                                    <span>Showing 1–<?= $total_products ?> of <?= $total_products ?> results</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Filter -->

                <!-- Start Product Grid -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active show sort-layout-single" id="layout-4-grid">
                                        <div class="row">
                                            <?php if ($total_products > 0): ?>
                                                <?php while ($row = mysqli_fetch_assoc($products)):
                                                    $gallery = !empty($row['gallery_images']) ? json_decode($row['gallery_images'], true) : [];
                                                    $second_image = !empty($gallery[0]) ? $gallery[0] : $row['main_image'];
                                                ?>
                                                    <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4">
                                                        <div class="product-default-single-item product-color--golden">
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
                                                                    <p class="category"><?= htmlspecialchars($row['category_name']) ?> | <?= htmlspecialchars($row['brand_name']) ?></p>
                                                                    <ul class="review-star">
                                                                        <?php
                                                                        $rating = round($row['average_rating']);
                                                                        for ($i = 1; $i <= 5; $i++) {
                                                                            echo $i <= $rating ? '<li class="fill"><i class="ion-android-star"></i></li>' : '<li class="empty"><i class="ion-android-star"></i></li>';
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <div class="content-right">
                                                                    <span class="price">₹<?= $row['price'] ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <p>No products found for this category or active brand.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Product Grid -->

            </div>
        </div>
    </div>
</div>

<!-- Category Pill Styles -->
<style>
.category-pill {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 50px;
    background-color: #f5f5f5;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-bottom: 5px;
}
.category-pill:hover {
    background-color: #d4af37; /* Golden hover */
    color: #fff;
}
.category-pill.active {
    background-color: #d4af37; /* Golden active */
    color: #fff;
    font-weight: 600;
}
</style>

<?php include('inc/footer.php'); ?>
