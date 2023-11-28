<?php
require_once 'pdo.php';

function danhmuc_all(){
    // Xử lý thêm danh mục nếu form được gửi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
        $categoryName = $_POST['categoryName'];
        
        // Thực hiện thêm danh mục vào cơ sở dữ liệu
        $sql = "INSERT INTO danhmuc (ten_loai, stt) VALUES (:ten_loai, 0)";
        $params = [':ten_loai' => $categoryName];
        pdo_execute($sql, $params);

        // Redirect hoặc hiển thị thông báo thành công
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Truy vấn tất cả các loại sau khi thêm mới (nếu có)
    $sql = "SELECT * FROM danhmuc ORDER BY stt DESC";
    return pdo_query($sql);
}

function showdm($dsdm){
    $html_dm = '<ul>';
    foreach ($dsdm as $dm) {
        $link = 'index.php?pg=shop&iddm=' . $dm['id'];
        $html_dm .= '<li><a href="' . $link . '">' . htmlspecialchars($dm['ten_loai']) . '</a></li>';
    }
    $html_dm .= '</ul>';

    // Form thêm danh mục
    $html_dm .= '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">
                    <label for="categoryName">Tên danh mục:</label>
                    <input type="text" id="categoryName" name="categoryName" required>
                    <button type="submit">Thêm Danh Mục</button>
                 </form>';

    return $html_dm;
}

function get_name_dm($id) {
    $sql = "SELECT ten_loai FROM danhmuc WHERE id=?";
    return pdo_query_value($sql, $id);
}
?>
