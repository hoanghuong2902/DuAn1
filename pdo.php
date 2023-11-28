<?php


/**
 * Mở kết nối đến CSDL sử dụng PDO
 * @return PDO đối tượng PDO cho kết nối CSDL
 */
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=highwaystore2;charset=utf8";
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Connection failed: " . $e->getMessage());
    }
}

$pdo = pdo_get_connection();

/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_execute($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_get_connection();

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    } catch (PDOException $e) {
        // Log the error or perform custom error handling
        die("Execution failed: " . $e->getMessage());
    }
}

/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_get_connection();

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Query failed: " . $e->getMessage());
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng chứa bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_get_connection();

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Query failed: " . $e->getMessage());
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một giá trị
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return giá trị
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_value($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_get_connection();

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    } catch (PDOException $e) {
        // Log or handle the error appropriately
        die("Query failed: " . $e->getMessage());
    }
}

/**
 * Đóng kết nối đến CSDL
 */
function pdo_close_connection() {
    global $pdo_connection;
    
    if ($pdo_connection !== null) {
        unset($pdo_connection);
    }
}

?>
