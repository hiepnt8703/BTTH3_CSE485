<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra và xử lý dữ liệu gửi từ form
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Bổ sung phần kết nối CSDL
    require_once '../../config.php';

    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    try {
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Thực hiện câu lệnh SQL để thêm mới khóa học
        $sql = "INSERT INTO courses (title, description) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $result = $stmt->execute();

        if ($result) {
            // Thêm mới thành công, có thể chuyển hướng người dùng về trang nào đó hoặc thông báo thêm mới thành công
            header("Location: ../../views/dashboard.php?action=course");
                exit();
        } else {
            // Thêm mới thất bại, có thể chuyển hướng về trang trước đó hoặc thông báo lỗi
            header("Location: ../../views/dashboard.php?action=course");
                exit();
        }
    } catch (PDOException $e) {
        // Xử lý lỗi kết nối CSDL
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
} else {
    // Nếu không phải là phương thức POST, có thể xử lý theo ý của bạn
    header("Location: dashboard.php?action=course");
    exit();
}
?>
