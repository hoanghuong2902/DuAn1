<?php

require_once 'pdo.php';

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['cart']) && $_POST['cart'] == 'Thêm vào giỏ hàng') {
    // Lấy thông tin sản phẩm từ database
    $product_id = isset($_POST['id']) ? $_POST['id'] : 0;
    $stmt = $pdo->prepare('SELECT * FROM sanpham WHERE id = :product_id');
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Lấy thông tin sản phẩm từ form
        $product_name = $product['ten_sp'];
        $product_image = $product['hinh'];
        $product_price = $product['gia'];
        $quantity = isset($_POST['soluong']) ? $_POST['soluong'] : 1;

        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Tăng số lượng nếu sản phẩm đã tồn tại trong giỏ hàng
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng nếu chưa tồn tại
            $_SESSION['cart'][$product_id] = [
                'name' => $product_name,
                'image' => $product_image,
                'price' => $product_price,
                'quantity' => $quantity,
            ];
        }
    }
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $product_id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (isset($_SESSION['cart'][$product_id])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$product_id]);
    }

    // Redirect về trang giỏ hàng sau khi xóa sản phẩm
    header('Location: index.php?pg=cart');
    exit;
}

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng
if (isset($_POST['update_cart'])) {
    // Lấy thông tin về số lượng sản phẩm từ form
    $new_quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];

    // Cập nhật số lượng của từng sản phẩm trong giỏ hàng
    foreach ($new_quantities as $product_id => $quantity) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }

    // Redirect về trang giỏ hàng sau khi cập nhật số lượng
    header('Location: index.php?pg=cart');
    exit;
}

// Hiển thị giỏ hàng
function displayCart() {
    $html_cart = '';

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $html_cart .= '
                <tr>
                    <td><a href="index.php?pg=giohang&action=delete&id=' . $product_id . '"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="layout/img/products/' . $product['image'] . '" alt="' . $product['name'] . '"></td>
                    <td>' . $product['name'] . '</td>
                    <td>$' . $product['price'] . '</td>
                    <td>
                        <form method="post" action="index.php?pg=giohang">
                            <input type="hidden" name="update_cart" value="1">
                            <input type="hidden" name="id" value="' . $product_id . '">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" name="quantity[' . $product_id . ']" value="' . $product['quantity'] . '" min="1" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>$' . number_format($product['price'] * $product['quantity'], 2) . '</td>
                </tr>';
        }
    } else {
        $html_cart = '<tr><td colspan="6">Giỏ hàng của bạn trống.</td></tr>';
    }

    return $html_cart;
}

function calculateTotalPrice() {
    $total_price = 0;

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $total_price += $product['price'] * $product['quantity'];
        }
    }

    return $total_price;
}

// Hiển thị đơn hàng của bạn view/checkout
function DonHang() {
    $html_cart = '';

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $product) {
            // Giới hạn tên sản phẩm thành 15 ký tự
            $product_name = strlen($product['name']) > 15 ? substr($product['name'], 0, 18) . '..' : $product['name'];
            $html_cart .= '<li><a href="#">' . $product_name . ' <span class="middle">x ' . $product['quantity'] . '</span> <span class="last">$' . number_format($product['price'] * $product['quantity'], 2) . '</span></a></li>';
        }
    } else {
        $html_cart = '<li>Giỏ hàng của bạn trống.</li>';
    }

    return $html_cart;
}
?>
