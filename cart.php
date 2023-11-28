<section id="page-header" class="about-header">
    <h2>#Hãy_nói_chuyện</h2>
    <p>ĐỂ LẠI MỘT TIN NHẮN, Chúng tôi rất vui được nghe từ bạn!</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Xóa</td>
                <td>Hình ảnh</td>
                <td>Sản phẩm</td>
                <td>Giá</td>
                <td>Số lượng</td>
                <td>Tổng cộng</td>
            </tr>
        </thead>
        <tbody>
            <?php echo displayCart(); ?>
        </tbody>
    </table>
</section>

<section id="cart-add" class="section-p1">
    <div id="coupon">
        <h3>Áp Dụng Mã Giảm Giá</h3>
        <div>
            <form method="post" action="index.php?pg=cart">
                <input type="text" name="discount_code" placeholder="Nhập Mã Giảm Giá Của Bạn">
                <button type="submit" class="normal">Áp Dụng</button>
            </form>
        </div>
    </div>

    <div id="subtotal">
        <h3>Tổng Giỏ Hàng</h3>
        <table>
            <?php foreach ($_SESSION['cart'] as $product_id => $product) : ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>    
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>Giá</td>
                <td>$  <?php echo number_format($product['price'], 2); ?></td>
            </tr>
            <tr>
                <td>Phí Vận Chuyển</td>
                <td>Miễn phí</td>
            </tr>
            <tr>
                <td><strong>Tổng Cộng</strong></td>
                <td><strong>$ <?php echo number_format(calculateTotalPrice(), 2); ?></strong></td>
            </tr>
        </table>
        <a class="normal" href="index.php?pg=checkout">Tiếp Tục Thanh Toán</a>
    </div>
</section>
