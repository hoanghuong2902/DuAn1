<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-8">
          <h3>Nhập thông tin thanh toán</h3>
          <form class="row contact_form" action="index.php?pg=bill" method="post" novalidate="novalidate">
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" id="nguoinhan_ten" name="nguoinhan_ten" placeholder="Nhập họ và tên người nhận">
            </div>
            <div class="col-md-6 form-group p_star">
              <input type="text" class="form-control" id="nguoinhan_sdt" name="nguoinhan_sdt" placeholder="Số điện thoại người nhận">
            </div>
            <div class="col-md-12 form-group">
              <input type="text" class="form-control" id="nguoinhan_diachi" name="nguoinhan_diachi" placeholder="Địa chỉ giao hàng">
            </div>
            <div class="col-md-12 form-group">
              <textarea class="form-control" name="order_notes" id="order_notes" rows="1" placeholder="Ghi chú đơn hàng"></textarea>
            </div>

            <input type="hidden" name="payment_method" id="pt_thanhtoan" value="cod">
          </form>
        </div>
        <div class="col-lg-4">
          <div class="order_box">
            <h2>Hiển thị đơn hàng của bạn</h2>
            <ul class="list">
              <li><a href="#">Sản phẩm <span>Tổng cộng</span></a></li>
              <?php echo DonHang(); ?>
            </ul>
            <ul class="list list_2">
              <li><a href="#">Tổng cộng <span>$<?php echo number_format(calculateTotalPrice(), 2); ?></span></a></li>
              <li><a href="#">Vận chuyển <span>Phí cố định: $50.00</span></a></li>
              <li><a href="#">Tổng cộng <span>$<?php echo number_format(calculateTotalPrice() + 50, 2); ?></span></a></li>
            </ul>

            <div class="payment_item">
              <div class="radion_btn">
                <input type="radio" id="payment_cod" name="payment_method" value="cod" checked>
                <label for="payment_cod">Thanh toán khi nhận hàng</label>
                <div class="check"></div>
              </div>
            </div>
            <div class="payment_item">
              <div class="radion_btn">
                <input type="radio" id="payment_bank" name="payment_method" value="bank_transfer">
                <label for="payment_bank">Chuyển khoản</label>
                <div class="check"></div>
              </div>
            </div>

            <div class="col-md-12 form-group">
              <a class="primary-btn" href="index.php?pg=lichsuDh">Tiến hành thanh toán</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>