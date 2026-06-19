<?php

// CRITICAL: Ensure session is started before any HTML output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('inc/header.php');
include('inc/conn.php');

// Get product ID and ensure it is an integer
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$query = "SELECT p.*, 
                 c.c_nm AS category_name, 
                 b.b_name AS brand_name 
          FROM products p
          LEFT JOIN categories c ON p.category_id = c.c_id
          LEFT JOIN brands b ON p.brand_id = b.b_id
          WHERE p.id = $product_id";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p class='text-center my-5'>Product not found.</p>";
    include('inc/footer.php');
    exit;
}

$product = mysqli_fetch_assoc($result);


if (isset($_POST['submit_review'])) {
    if (isset($_SESSION['u_id'])) {
        // Validation to ensure rating is within 1-5
        $rating = (int)$_POST['rating'];
        if ($rating < 1 || $rating > 5) {
            $rating = 5; 
        }

        $user_id = $_SESSION['u_id'];
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        $insert = "INSERT INTO reviews (product_id, user_id, rating, comment, created_at) 
                   VALUES ('$product_id', '$user_id', '$rating', '$comment', NOW())";

        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('Review added successfully! The page will now refresh to show your review.'); window.location='single.php?id=$product_id';</script>";
        } else {
             echo "<script>alert('Something went wrong while adding your review. ');</script>";
        }
    } else {
        echo "<script>alert('Please login to give a review.'); window.location='login.php';</script>";
    }
}


$reviews_query = mysqli_query($conn, "
    SELECT r.*, u.u_fnm
    FROM reviews r
    JOIN user u ON r.user_id = u.u_id
    WHERE r.product_id = $product_id
    ORDER BY r.created_at DESC
");


$avg_result = mysqli_query($conn, "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM reviews WHERE product_id = $product_id");
$avg_data = mysqli_fetch_assoc($avg_result);
$avg_rating = round($avg_data['avg_rating']);
$total_reviews = $avg_data['total_reviews'];


$gallery_images = !empty($product['gallery_images']) ? json_decode($product['gallery_images'], true) : [];
?>

<div class="product-details-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                    <div class="product-large-image product-large-image-horaizontal swiper-container">
                        <div class="swiper-wrapper">
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="admin/uploads/products/<?= htmlspecialchars($product['main_image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            </div>
                            <?php foreach ($gallery_images as $img): ?>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="admin/uploads/products/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                        <div class="swiper-wrapper">
                            <div class="product-image-thumb-single swiper-slide">
                                <img class="img-fluid" src="admin/uploads/products/<?= htmlspecialchars($product['main_image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            </div>
                            <?php foreach ($gallery_images as $img): ?>
                                <div class="product-image-thumb-single swiper-slide">
                                    <img class="img-fluid" src="admin/uploads/products/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gallery-thumb-arrow swiper-button-next"></div>
                        <div class="gallery-thumb-arrow swiper-button-prev"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7 col-lg-6">
                <div class="product-details-content-area product-details--golden" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-text">
                        <h4 class="title"><?= htmlspecialchars($product['name']) ?></h4>

                        <div class="d-flex align-items-center">
                            <ul class="review-star">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    // These stars rely on the template's included CSS/Icons
                                    echo $i <= $avg_rating ? '<li class="fill"><i class="ion-android-star"></i></li>' : '<li class="empty"><i class="ion-android-star"></i></li>';
                                }
                                ?>
                            </ul>
                            <a href="#review" class="customer-review ml-2">(<?= $total_reviews ?> customer reviews)</a>
                        </div>

                        <div class="price">₹<?= number_format($product['price'], 2) ?></div>
                        <p><?= nl2br(htmlspecialchars($product['short_description'])) ?></p>
                    </div>

                    <div class="product-details-variable">
                        <h4 class="title">Available Options</h4>

                        <div class="variable-single-item">
                            <div class="product-stock">
                                <?php if ($product['stock'] > 0): ?>
                                    <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span>
                                    <?= $product['stock'] ?> IN STOCK
                                <?php else: ?>
                                    <span class="text-danger"><i class="ion-close-circled"></i> Out of Stock</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="variable-single-item">
                                <span>Quantity</span>
                                <div class="product-variable-quantity">
                                    <input id="product-quantity" min="1" max="<?= $product['stock'] ?>" value="1" type="number">
                                </div>
                            </div>
                            <div class="product-add-to-cart-btn">
                                <a href="cart.php?action=add&id=<?= $product['id'] ?>" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="product-details-catagory mb-2">
                        <span class="title">CATEGORIES:</span>
                        <ul>
                            <li><a href="#"><?= htmlspecialchars($product['category_name']) ?></a></li>
                            <li><a href="#"><?= htmlspecialchars($product['brand_name']) ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-details-content-tab-section section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li><a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a></li>
                        <li><a class="nav-link" data-bs-toggle="tab" href="#specification">Specification</a></li>
                        <li><a class="nav-link" data-bs-toggle="tab" href="#review">Reviews (<?= $total_reviews ?>)</a></li>
                    </ul>

                    <div class="product-details-content-tab">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="description">
                                <div class="single-tab-content-item">
                                    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                                </div>
                            </div>

                            <div class="tab-pane" id="specification">
                                <div class="single-tab-content-item">
                                    <table class="table table-bordered mb-20">
                                        <tbody>
                                            <tr><th>Category</th><td><?= htmlspecialchars($product['category_name']) ?></td></tr>
                                            <tr><th>Brand</th><td><?= htmlspecialchars($product['brand_name']) ?></td></tr>
                                            <tr><th>Price</th><td>₹<?= number_format($product['price'], 2) ?></td></tr>
                                            <tr><th>Warranty </th><td>1 year</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="review">
                                <div class="single-tab-content-item">
                                    <?php if (mysqli_num_rows($reviews_query) > 0): ?>
                                        <h5 class="mb-3">Customer Reviews</h5>
                                        <?php while ($rev = mysqli_fetch_assoc($reviews_query)): ?>
                                            <div class="border p-3 mb-3 bg-light rounded shadow-sm">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <ul class="review-star d-inline-block">
                                                        <?php
                                                        $rev_rating = (int)$rev['rating'];
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            echo $i <= $rev_rating ? '<li class="fill"><i class="ion-android-star"></i></li>' : '<li class="empty"><i class="ion-android-star"></i></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                    <small class="text-muted"><?= htmlspecialchars($rev['created_at']) ?></small>
                                                </div>
                                                <strong><?= htmlspecialchars($rev['u_fnm']) ?></strong> 
                                                <p class="mt-2 mb-0"><?= nl2br(htmlspecialchars($rev['comment'])) ?></p>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <p>No reviews yet. Be the first to review this product! ⭐</p>
                                    <?php endif; ?>

                                    <?php if (isset($_SESSION['u_id'])): ?>
                                        <div class="review-form-container border p-4 mt-5 rounded shadow-lg bg-white">
                                            <h5 class="title-review mb-4 text-center text-primary">Write Your Review</h5>

                                            <form method="post">
                                                <div class="form-group mb-4 text-center">
                                                    <label class="form-label d-block fw-bold text-dark">Your Rating</label>
                                                    <div class="rating-stars">
                                                        5<input type="radio" id="rating5" name="rating" value="5" required><label for="rating5"></label>
                                                        4<input type="radio" id="rating4" name="rating" value="4"><label for="rating4"></label>
                                                        3<input type="radio" id="rating3" name="rating" value="3"><label for="rating3"></label>
                                                        2<input type="radio" id="rating2" name="rating" value="2"><label for="rating2"></label>
                                                        1<input type="radio" id="rating1" name="rating" value="1"><label for="rating1"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="comment" class="form-label fw-bold text-dark">Your Comment</label>
                                                    <textarea name="comment" id="comment" class="form-control" rows="5" placeholder="Share your experience with this product..." required></textarea>
                                                </div>

                                                <button type="submit" name="submit_review" class="btn btn-primary w-100 py-2">Submit Review</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <p class="mt-4 text-center"><a href="login.php" class="btn btn-primary">Login to Write a Review</a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>