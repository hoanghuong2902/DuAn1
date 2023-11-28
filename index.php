<?php
session_start();
ob_start();

include "dao/pdo.php";
include "dao/bill.php";
include "dao/user.php";
include "dao/danhmuc.php";
include "dao/sanpham.php";
include "dao/giohang.php";

include "view/header.php";

$is_user_logged_in = is_user_logged_in();
$dssp_new = get_dssp_new(4);
$dssp_best = get_dssp_best(2);
$dssp_view = get_dssp_view(4);
$html_dssp_current_category = showsp(7);
$dssp_luotmua = get_dssp_luotmua(7);

// Gọi hàm

if (!isset($_GET['pg'])) {
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'blog':
            include "view/blog.php";
            break;
        case 'about':
            include "view/about.php";
            break;
        case 'contact':
            include "view/contact.php";
            break;
        case 'checkout':
            include "view/checkout.php";
            break;
        case 'lichsuDh':
            include "view/lichsuDh.php";
            break;
        case 'lichsuDhchitiet':
            include "view/lichsuDhchitiet.php";
            break;
        case 'cart':
            // Xử lý thêm sản phẩm vào giỏ hàng
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
                $product_id = $_POST['id'];
                $product_name = $_POST['name'];
                $product_img = $_POST['img'];
                $product_price = $_POST['price'];
                $product_quantity = $_POST['soluong'];

                // Kiểm tra đăng nhập
                if (!$is_user_logged_in) {
                    // Nếu chưa đăng nhập, hiển thị thông báo và chuyển hướng đến trang đăng nhập
                    echo '<script>alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");</script>';
                    echo '<script>window.location.href = "index.php?pg=dangnhap";</script>';
                    exit;
                }

                // Kiểm tra nếu giỏ hàng chưa được khởi tạo, thì khởi tạo nó
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng, thì tăng số lượng
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
                } else {
                    // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
                    $_SESSION['cart'][$product_id] = [
                        'name' => $product_name,
                        'image' => $product_img,
                        'price' => $product_price,
                        'quantity' => $product_quantity,
                    ];
                }
                // Redirect về trang sản phẩm sau khi thêm vào giỏ hàng
                header('Location: index.php?pg=cart');
                exit;
            }

            include "view/cart.php";
            break;
        case 'dangky':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $hoten = $_POST['hoten'];
                $email = $_POST['email'];
                $dienthoai = $_POST['dienthoai'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $register_result = register_user($hoten, $email, $dienthoai, $username, $password);
                if ($register_result === true) {
                    echo '<script>alert("Đăng ký thành công! Đăng nhập tại đây.");</script>';
                } else {
                    echo '<script>alert("Đăng ký thất bại: ' . $register_result . '");</script>';
                }
            }
            include "view/dangky.php";
            break;
        case 'dangnhap':
            if ($is_user_logged_in) {
                // Nếu đã đăng nhập, chuyển hướng về trang chủ
                header("Location: index.php");
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $login_result = login_user($username, $password);

                if ($login_result) {
                    $_SESSION['user_id'] = $login_result;
                    echo '<script>alert("Đăng nhập thành công!");</script>';
                    header("Location: index.php");
                    exit();
                } else {
                    echo '<script>alert("Đăng nhập thất bại!");</script>';
                }
            }
            include "view/dangnhap.php";
            break;
        case 'dangxuat':
            if ($is_user_logged_in) {
                // Xóa toàn bộ session nếu đang đăng nhập
                session_unset();
                session_destroy();
                // Chuyển hướng về trang chủ
                header("Location: index.php");
                exit();
            }
            break;
        case 'shop':
            $dsdm = danhmuc_all();
            $kyw = "";
            $titlepage = "";
            if (!isset($_GET['iddm'])) {
                $iddm = 0;
            } else {
                $iddm = $_GET['iddm'];
                $titlepage = get_name_dm($iddm);
            }
            if (isset($_POST["timkiem"]) && ($_POST["timkiem"])) {
                $kyw = $_POST["kyw"];
                $titlepage = "Kết quả tìm kiếm với từ khóa: <span>" . $kyw . "</span>";
            }
            $dssp = get_dssp($kyw, $iddm, 7);
            include "view/shop.php";
            break;
        case 'sproduct':
            $dsdm = danhmuc_all();
            if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
                $id = $_GET["id"];
                $iddm = get_iddm($id);
                $dssp_lienquan = get_dssp_lienquan($iddm, $id, 4);
                $spchitiet = get_sproduct($id);

                include "view/sproduct.php";
            } else {
                include "view/home.php";
            }
            break;
        default:
            include "view/home.php";
            break;
    }
}
include "view/footer.php";
?>
