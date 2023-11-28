<section>
  <div id="login">
    <i class="far fa-times-circle close-login"></i>
    <h3 class="login-title">Đăng ký hệ thống</h3>
    <p>Bạn đã có tài khoản? <a href="index.php?pg=dangnhap">Đăng nhập</a></p>
    <form action="index.php?pg=dangky" method="POST" id="form-login">
      <!-- Các trường nhập liệu cho đăng ký -->
      <div class="form-group-login">
        <input type="text" name="hoten" id="hoten" class="email-ip" placeholder=" " required />
        <label for="hoten">Họ tên</label>
      </div>
      <div class="form-group-login">
        <input type="email" name="email" id="email" class="email-ip" placeholder=" " required />
        <label for="email">Email</label>
      </div>
      <div class="form-group-login">
        <input type="tel" name="dienthoai" id="dienthoai" class="email-ip" placeholder=" " required />
        <label for="dienthoai">Số điện thoại</label>
      </div>
      <div class="form-group-login">
        <input type="text" name="username" id="username" class="email-ip" placeholder=" " required />
        <label for="username">Tên đăng nhập</label>
      </div>
      <div class="form-group-login">
        <input type="password" name="password" id="password" placeholder=" " required />
        <i class="far fa-eye eye"></i>
        <i class="far fa-eye-slash eye eye-none"></i>
        <label for="password">Mật khẩu</label>
      </div>
      <div class="btn-login pt-1">
        <button type="submit">Đăng ký</button>
      </div>
    </form>
  </div>
</section>
