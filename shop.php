<?php
$html_dssp_current_category = showsp($dssp);

?>

<section id="page-header">
    <h2>#stayhome</h2>
    <p>Save more with coupons & up to 70% off! </p>
</section>

<section id="product1" class="section-p1">
    <div class="pro-container">
        <div class="cat_menu_container">
            <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                <div class="cat_burger"><span></span><span></span><span></span></div>
                <div class="cat_menu_text">Categories</div>
            </div>
            <ul class="cat_menu">
                <?php
                // Hiển thị danh mục sản phẩm
                foreach ($dsdm as $dm) {
                    $activeClass = ($dm['id'] == $iddm) ? 'active' : '';
                    echo '<li class="' . $activeClass . '"><a href="index.php?pg=shop&iddm=' . $dm['id'] . '">' . htmlspecialchars($dm['ten_loai']) . '<i class="fas fa-chevron-right ml-auto"></i></a></li>';
                }
                ?>
            </ul>
        </div>

        <?= $html_dssp_current_category; ?>
    </div>
</section>

<section id="pagination" class="section-p1">
    <!-- Hiển thị phân trang nếu cần -->
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
    </div>
</section>
