<footer class="section-p1">
    <div class="col">
        <img class="logo" src="layout/img/logo.png" alt="">
        <h4>Liên hệ</h4>
        <p><strong>Địa chỉ:</strong> 562 Đường Wellington, Phố 32, San Francisco</p>
        <p><strong>Điện thoại:</strong> +01 2222 365 /(+91) 01 2345 6789</p>
        <p><strong>Giờ làm việc:</strong> 10:00 - 18:00, Thứ Hai - Thứ Bảy</p>
        <div class="follow">
            <h4>Theo dõi chúng tôi</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest-p"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>Giới thiệu</h4>
        <a href="#">Về chúng tôi</a>
        <a href="#">Thông tin giao hàng</a>
        <a href="#">Chính sách bảo mật</a>
        <a href="#">Điều khoản và điều kiện</a>
        <a href="#">Liên hệ</a>
    </div>

    <div class="col">
        <h4>Tài khoản của tôi</h4>
        <a href="#">Đăng nhập</a>
        <a href="#">Xem giỏ hàng</a>
        <a href="#">Danh sách mong muốn của tôi</a>
        <a href="#">Theo dõi đơn hàng</a>
        <a href="#">Trợ giúp</a>
    </div>

    <div class="col install">
        <h4>Cài đặt ứng dụng</h4>
        <p>Từ App Store hoặc Google Play</p>
        <div class="row">
            <img src="layout/img/pay/app.jpg" alt="">
            <img src="layout/img/pay/play.jpg" alt="">
        </div>
        <p>Cổng thanh toán an toàn</p>
        <img src="layout/img/pay/pay.png" alt="">
    </div>

    <div class="copyright">
        <p>PHH-Dự án 1</p>
    </div>
</footer>

    <!-- end footer -->

    <!-- js -->
    <script src="layout/script.js">
        
    </script>
    <script src="layout/js/jquery-3.3.1.min.js"></script>
    <script src="layout/styles/bootstrap4/popper.js"></script>
    <script src="layout/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="layout/plugins/greensock/TweenMax.min.js"></script>
    <script src="layout/plugins/greensock/TimelineMax.min.js"></script>
    <script src="layout/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="layout/plugins/greensock/animation.gsap.min.js"></script>
    <script src="layout/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="layout/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="layout/plugins/slick-1.8.0/slick.js"></script>
    <script src="layout/plugins/easing/easing.js"></script>
    <script src="layout/js/custom.js"></script>
    <script src="layout/js1/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="layout/js1/vendor/bootstrap.min.js"></script>
    <script src="layout/js1/jquery.ajaxchimp.min.js"></script>
    <script src="layout/js1/jquery.nice-select.min.js"></script>
    <script src="layout/js1/jquery.sticky.js"></script>
    <script src="layout/js1/nouislider.min.js"></script>
    <script src="layout/js1/jquery.magnific-popup.min.js"></script>
    <script src="layout/js1/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="layout/js1/gmaps.min.js"></script>
    <script src="layout/js1/main.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const togglePassword = document.querySelector(".eye");
        const togglePasswordSlash = document.querySelector(".eye-none");

        togglePassword.addEventListener("click", function () {
            passwordInput.type = "text";
            togglePassword.style.display = "none";
            togglePasswordSlash.style.display = "block";
        });

        togglePasswordSlash.addEventListener("click", function () {
            passwordInput.type = "password";
            togglePassword.style.display = "block";
            togglePasswordSlash.style.display = "none";
        });
    });
    function showNotification(message, type) {
    var alertDiv = document.createElement("div");
    alertDiv.className = "alert " + type;
    alertDiv.innerHTML = message;

    document.body.appendChild(alertDiv);

    setTimeout(function() {
        alertDiv.style.opacity = "0";
        setTimeout(function() {
            alertDiv.remove();
        }, 500);
    }, 3000);
}
</script>
<!-- thêm sản phẩm vào giỏ hàng -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bắt sự kiện khi form thêm vào giỏ hàng được submit
        document.querySelectorAll('.add-to-cart-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Ngăn chặn sự kiện submit mặc định của form
                var formData = new FormData(this);

                // Gửi yêu cầu AJAX đến server
                fetch('index.php?pg=cart', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Xử lý phản hồi từ server
                    if (data.success) {
                        // Cập nhật giao diện mà không làm tải lại trang
                        alert('Sản phẩm đã được thêm vào giỏ hàng!');
                        // Thêm các hành động cập nhật giao diện tại đây
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    
</script>
<!-- end thêm sản phẩm vào giỏ hàng -->

</body>
</html>