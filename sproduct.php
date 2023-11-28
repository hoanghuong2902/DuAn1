<?php
$dsdm = danhmuc_all();

if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
    $id = $_GET["id"];
    $iddm = get_iddm($id);
    $dssp_lienquan = get_dssp_lienquan($iddm, $id, 4);
    $spchitiet = get_sproduct($id);
}
?>

<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="layout/img/products/<?= $spchitiet['hinh']; ?>" width="100%" id="MainImg" alt="<?= $spchitiet['ten_sp']; ?>">
        <div class="small-img-group">
            <?php
            foreach ($dssp_lienquan as $sp) {
                echo '<div class="small-img-col"><img src="layout/img/products/' . $sp['hinh'] . '" width="100%" class="small-img" alt="' . $sp['ten_sp'] . '"></div>';
            }
            ?>
        </div>
    </div>

    <div class="single-pro-details">
        <h6>Home / T-Shirt</h6>
        <h4><?= $spchitiet['ten_sp']; ?></h4>
        <h2>$<?= $spchitiet['gia']; ?></h2>
        <select>
            <option>Select Size</option>
            <option>XL</option>
            <option>XXL</option>
            <option>Small</option>
            <option>Large</option>
        </select>

        <input type="number" value="1">
        <form action="index.php?pg=cart" method="post">
            <input type="hidden" name="id" value="<?= $spchitiet['id']; ?>">
            <input type="hidden" name="name" value="<?= $spchitiet['ten_sp']; ?>">
            <input type="hidden" name="img" value="<?= $spchitiet['hinh']; ?>">
            <input type="hidden" name="price" value="<?= $spchitiet['gia']; ?>">
            <input type="hidden" name="soluong" value="1">
            <button type="submit" name="cart" class="normal">Add to Cart</button>
        </form>
        <h4>Product Details</h4>
        <span><?= $spchitiet['mo_ta']; ?></span>
    </div>
</section>

<section id="form-details">
    <form action="">
        <h2>Đánh giá</h2>
        <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
        <button class="normal">Submit</button>
    </form>
    <div class="people">
        <div>
            <img src="layout/img/people/1.png" alt="">
            <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
        </div>
        <div>
            <img src="layout/img/people/2.png" alt="">
            <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
        </div>
        <div>
            <img src="layout/img/people/3.png" alt="">
            <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
        </div>
    </div>
</section>

<script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");

    for (var i = 0; i < smallimg.length; i++) {
        smallimg[i].onclick = function () {
            MainImg.src = this.src;
        }
    }
</script>
