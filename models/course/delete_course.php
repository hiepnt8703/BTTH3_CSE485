<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../../views/login.php");
    exit();
}
require_once '../../config.php';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    try {
        // Initialize database connection
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Thực hiện truy vấn xóa
        $query = $db->prepare('DELETE FROM courses WHERE id = :id');
        $query->bindParam(':id', $courseId, PDO::PARAM_INT);
        $query->execute();

        // Chuyển hướng về trang dashboard sau khi xóa
        header("Location: ../../views/dashboard.php?action=course");
    } catch (PDOException $e) {
        echo "Error deleting course: " . $e->getMessage();
    }
} else {
    echo "Invalid course ID";
}
?>
