<?php
require('../../core/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem dữ liệu đã được gửi chưa
    if (isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        // Lấy dữ liệu từ form
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Thực hiện xử lý dữ liệu ở đây, ví dụ: lưu vào cơ sở dữ liệu, kiểm tra điều kiện, vv.
        $sql = "INSERT INTO `user` (`name`, `email`, `phone`, `password`, `address`) VALUES ('$name', '$email', '$phone', '$password', '')";

        // Thực hiện câu lệnh INSERT
        if ($db->getConnect()->query($sql) === TRUE) {
            // Đường dẫn sau khi thêm dữ liệu thành công
            header("Location: ../../index.php");
        } else {
            echo "Lỗi khi thêm dữ liệu: " .  $db->getConnect()->error;
        }
    } else {
        // Nếu có dữ liệu còn thiếu
        echo "Lỗi: Dữ liệu không đủ hoặc không hợp lệ.";
    }
} else {
    // Nếu không phải là phương thức POST
    echo "Lỗi: Phương thức yêu cầu không hợp lệ.";
}

// Đóng kết nối
$db->getConnect()->close();
?>
