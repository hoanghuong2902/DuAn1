<?php
require_once 'pdo.php';
// lượt mua 
function get_dssp_LuotMua($limit){
    $sql = "SELECT *, (SELECT COUNT(*) FROM bill WHERE bill.id_product = sanpham.id) as luot_mua FROM sanpham ORDER BY luot_mua DESC, id DESC LIMIT " . $limit;
    return pdo_query($sql);
}


function get_dssp_new($limit){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC limit ".$limit;
    return pdo_query($sql);
}

function get_dssp_best($limit){
    $sql = "SELECT * FROM sanpham WHERE dac_biet = 1 ORDER BY id DESC LIMIT ".$limit;
    return pdo_query($sql);
}

function get_dssp_view($limit){
    $sql = "SELECT * FROM sanpham ORDER BY so_luot_xem DESC LIMIT ".$limit;
    return pdo_query($sql);
}

function get_dssp($keyword, $categoryId, $limit){
    $sql = "SELECT * FROM sanpham WHERE 1";
    
    if($categoryId > 0){
        $sql .=" AND id_catalog=".$categoryId;
    }
    if($keyword != ""){
        $sql .=" AND ten_sp like '%".$keyword."%'";
    }

    $sql .= " ORDER BY id DESC LIMIT ".$limit;
    return pdo_query($sql);
}

function get_sproduct($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql, $id);
}

function get_dssp_lienquan($categoryId, $id, $limit){
    $sql = "SELECT * FROM sanpham WHERE id_catalog=? AND id<>? ORDER BY id DESC LIMIT ".$limit;
    return pdo_query($sql, $categoryId, $id);
}

function get_iddm($id){
    $sql = "SELECT id_catalog FROM sanpham WHERE id=?";
    return pdo_query_value($sql, $id);
}

function searchProducts($keyword, $categoryId, $limit) {
    $sql = "SELECT * FROM sanpham WHERE (ten_sp LIKE :keyword OR mo_ta LIKE :keyword)";
    
    if ($categoryId != 0) {
        $sql .= " AND id_catalog = :categoryId";
    }

    $sql .= " LIMIT :limit";

    $params = [
        ':keyword' => '%' . $keyword . '%',
        ':limit' => $limit,
    ];

    if ($categoryId != 0) {
        $params[':categoryId'] = $categoryId;
    }

    return pdo_query($sql, $params);
}

function getPopularCategories() {
    $sql = "SELECT id, ten_loai FROM danhmuc ORDER BY stt DESC LIMIT 5";
    return pdo_query($sql);
}

function showsp($dssp) {
    $html_dssp = '';
    
    if (is_array($dssp) && count($dssp) > 0) {
        foreach ($dssp as $sp) {
            extract($sp);

            if ($dac_biet == 1) {
                $best = '<div class="best"></div>';
            } else {
                $best = '';
            }

            $html_dssp .= '<div class="pro">
                              <a href="index.php?pg=sproduct&id=' . $id . '">
                                  <img src="layout/img/products/' . $hinh . '" alt="">
                              </a>
                              <div class="des">
                                  <span>adidas</span>
                                  <h5>' . $ten_sp . '</h5>
                                  <div class="star">
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                  </div>
                                  <h4>$' . $gia . '</h4>
                              </div>
                              <form method="post" action="index.php?pg=cart">
                                <input type="hidden" name="pg" value="cart">
                                <input type="hidden" name="id" value="' . $id . '">
                                <input type="hidden" name="name" value="' . $ten_sp . '">
                                <input type="hidden" name="img" value="' . $hinh . '">
                                <input type="hidden" name="price" value="' . $gia . '">
                                <input type="hidden" name="soluong" value="1">
                                <button type="submit" name="cart" class="cart"><i class="fal fa-shopping-cart"></i></button>
                              </form>
                          </div>';
        }
    }

    return $html_dssp;
}

function showchitietsp($sp) {
    $html_chitietsp = '';
    if ($sp) {
        extract($sp);
        $html_chitietsp .= '<div class="product-details">
                              <div class="product-gallery">
                                  <div class="product-main-img">
                                      <img src="layout/img/products/' . $hinh . '" alt="">
                                  </div>
                                  <div class="product-gallery-thumbnails">
                                      <img src="layout/img/products/' . $hinh1 . '" alt="">
                                      <img src="layout/img/products/' . $hinh2 . '" alt="">
                                      <img src="layout/img/products/' . $hinh3 . '" alt="">
                                      <img src="layout/img/products/' . $hinh4 . '" alt="">
                                  </div>
                              </div>
                              <div class="product-content">
                                  <h2 class="product-title">' . $ten_sp . '</h2>
                                  <div class="product-rating">
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                      <i class="fas fa-star"></i>
                                  </div>
                                  <p class="product-price">$' . $gia . '</p>
                                  <div class="product-description">
                                      <p>' . $mo_ta . '</p>
                                  </div>
                                  <form index.php?pg=cart" method="post">
                                    <input type="hidden" name="pg" value="cart">
                                    <input type="hidden" name="id" value="' . $id . '">
                                    <input type="hidden" name="name" value="' . $ten_sp . '">
                                    <input type="hidden" name="img" value="' . $hinh . '">
                                    <input type="hidden" name="price" value="' . $gia . '">
                                    <input type="hidden" name="soluong" value="1">
                                    <button type="submit" name="cart" class="cart-btn"><i class="fal fa-shopping-cart"></i> Add to Cart</button>
                                  </form>
                              </div>
                          </div>';
    }
    return $html_chitietsp;
}


function showluotmua($dssp_luotmua) {
    $html_dssp_luotmua = '';
    if (is_array($dssp_luotmua) && count($dssp_luotmua) > 0) {
        foreach ($dssp_luotmua as $sp) {
            extract($sp);
            // Giới hạn độ dài của tên sản phẩm
            $ten_sp_gioihan = (strlen($ten_sp) > 20) ? substr($ten_sp, 0, 10)  : $ten_sp;
            $html_dssp_luotmua .= '<div class="fe-box">
                                    <a href="index.php?pg=sproduct&id=' . $id . '">
                                        <img src="layout/img/products/' . $hinh . '" alt="' . $ten_sp_gioihan . '">
                                    </a>
                                    <h6><a href="index.php?pg=sproduct&id=' . $id . '">' . $ten_sp_gioihan . '</a></h6>
                                  </div>';
        }
    }

    return $html_dssp_luotmua;
}


?>
