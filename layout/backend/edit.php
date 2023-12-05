<?php
require('../../core/database.php');

$sql = ""; // Khởi tạo biến $sql

if (isset($_GET['user'])) {
    $name = mysqli_real_escape_string($db->getConnect(), $_POST['name']);
    $email = mysqli_real_escape_string($db->getConnect(), $_POST['email']);
    $phone = mysqli_real_escape_string($db->getConnect(), $_POST['phone']);

    $user_id = $_COOKIE['user_id'];

    if (isset($_FILES['img'])) {
        $fileName = uniqid() . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "../assets/img_avatar/$fileName");
        $sql = "UPDATE `user` SET
        `phone` = '$phone',
        `name` = '$name',
        `email` = '$email',
        `img` = 'assets/img_avatar/$fileName'
        WHERE `id` = $user_id";
    } else {
        $sql = "UPDATE `user` SET
            `phone` = '$phone',
            `name` = '$name',
            `email` = '$email'
            WHERE `id` = $user_id";
    }
    $location = '../index.php?p_update';
} 

if (!empty($sql)) {
    if ($db->getConnect()->query($sql) === TRUE) {
        header("Location: " . $location);
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $db->getConnect()->error;
    }
} else {
    echo "Không có dữ liệu cập nhật.";
}

// Đóng kết nối
$db->getConnect()->close();
?>
