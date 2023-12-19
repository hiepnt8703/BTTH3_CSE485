<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../../views/login.php");
    exit();
}
$courseId = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($courseId)) {
    header("Location: dashboard.php?action=course");
    exit();
}
require_once '../../config.php';

$host = DB_HOST;
$dbname = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy thông tin về khóa học cần edit
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $courseId, PDO::PARAM_INT);
    $stmt->execute();
    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem khóa học có tồn tại không
    if (!$course) {
        // Xử lý trường hợp không tìm thấy khóa học, có thể chuyển hướng hoặc xử lý khác
        header("Location: dashboard.php?action=course");
        exit();
    }
} catch (PDOException $e) {
    // Xử lý lỗi kết nối CSDL
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Course</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="update_course.php">
                        <input type="hidden" name="id" value="<?php echo $course['id']; ?>">

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $course['title']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" required><?php echo $course['description']; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
