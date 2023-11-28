<?php
// dao/user.php
function get_all_users() {
    $sql = "SELECT * FROM user";
    return pdo_query($sql);
}
function get_user_by_id($user_id) {
    $sql = "SELECT * FROM user WHERE id = ?";
    return pdo_query_one($sql, $user_id);
}
if (!function_exists('is_user_logged_in')) {
    function is_user_logged_in() {
        return isset($_SESSION['user_id']);
    }
}

function show_user($dsuser) {
    $html_dsuser = '';
    foreach ($dsuser as $user) {
        $html_dsuser .= '<tr>';
        $html_dsuser .= '<td>' . htmlspecialchars($user['id']) . '</td>';
        $html_dsuser .= '<td>' . htmlspecialchars($user['hoten']) . '</td>';
        $html_dsuser .= '<td>' . htmlspecialchars($user['email']) . '</td>';
        $html_dsuser .= '<td>' . htmlspecialchars($user['dienthoai']) . '</td>';
        $html_dsuser .= '<td>' . ($user['role'] == 1 ? 'Admin' : 'User') . '</td>';
        $html_dsuser .= '<td><a href="admin/user_edit.php?id=' . htmlspecialchars($user['id']) . '">Sửa</a></td>';
        $html_dsuser .= '<td><a href="admin/user_changepassword.php?id=' . htmlspecialchars($user['id']) . '">Đổi mật khẩu</a></td>';
        $html_dsuser .= '</tr>';
    }
    return $html_dsuser;
}

function register_user($hoten, $email, $dienthoai, $username, $password, $role = 0) {
    // Kiểm tra mật khẩu có ít nhất 6 ký tự, bao gồm ít nhất một số, một chữ cái in hoa và một ký tự đặc biệt
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%^&*(),.?":{}|<>]{6,}$/', $password)) {
        return "Mật khẩu phải có ít nhất 6 ký tự, bao gồm ít nhất một số, một chữ cái in hoa và một ký tự đặc biệt";
    }

    // Kiểm tra tên đăng nhập có ký tự đặc biệt
    if (!preg_match('/^[0-9A-Za-z!@#$%^&*(),.?":{}|<>]+$/', $username)) {
        return "Tên đăng nhập không hợp lệ";
    }

    // Kiểm tra tên đăng nhập đã tồn tại chưa
    if (username_exists($username)) {
        return "Tên đăng nhập đã tồn tại";
    }

    // Kiểm tra email có đúng định dạng hay không
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Địa chỉ email không hợp lệ";
    }

    // Kiểm tra số điện thoại có đúng định dạng hay không
    if (!preg_match('/^[0-9]{10,11}$/', $dienthoai)) {
        return "Số điện thoại không hợp lệ";
    }

    // Hash mật khẩu
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert vào CSDL
    $sql = "INSERT INTO user (hoten, email, dienthoai, username, password, role) VALUES (?, ?, ?, ?, ?, ?)";
    try {
        pdo_execute($sql, $hoten, $email, $dienthoai, $username, $hashed_password, $role);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function login_user($username, $password) {
    $user = get_user_by_username($username);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['role'] == 1;
        session_regenerate_id(true);
        return true;
    } else {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }
        if ($_SESSION['login_attempts'] >= 3) {
            // Khoá tài khoản hoặc thực hiện các biện pháp bảo mật khác
            // ...
        }
        return false;
    }
}

function get_user_by_username($username) {
    $sql = "SELECT * FROM user WHERE username = ?";
    return pdo_query_one($sql, $username);
}

function username_exists($username) {
    $sql = "SELECT COUNT(*) FROM user WHERE username = ?";
    $count = pdo_query_value($sql, $username);
    return $count > 0;
}
?>
