<?php
    $html_dssp_new=showsp($dssp_new);
    $html_dssp_best=showsp($dssp_best);
    $html_dssp_view=showsp($dssp_view);
    $html_luotmua = showluotmua($dssp_luotmua);
?>
<section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <button>Shop Now</button>
    </section>
    <section id="feature" class="section-p1">
        <!-- <h2>Sản phẩm được mua nhiều nhất</h2> -->
            <?=$html_luotmua;?>
    </section>

    <section id="product1" class="section-p1">
    <div class="pro-container">
            <!--sản phẩm mới -->
            
        </div>
        <h2>SẢN PHẨM MỚI</h2>
        <!-- <p>Summer Collection New Morden Design</p> -->
        <div class="pro-container">
            <!--sản phẩm mới -->
            <?=$html_dssp_new;?>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Repair Services</h4>
        <h2>Up to <span>70% Off</span> - All -Shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>

    <section id="product1" class="section-p1">
        <h2>SẢN PHẨM HOT</h2>
        <!-- <p>Summer Collection New Morden Design</p> -->
        <div class="pro-container">
        <?=$html_dssp_view;?>
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>spring/summer</h4>
            <h2>upcomming season</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring/Summer 2022</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Printe</h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about out latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

