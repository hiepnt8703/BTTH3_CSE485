<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Lấy tên người dùng từ session
$userName = isset($_SESSION["name"]) ? $_SESSION["name"] : '';
require_once '../models/Course.php';
require_once '../models/Lesson.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Thanh ngang bên trên -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <span class="navbar-text">
            Welcome <?php echo $userName; ?>
        </span>
        <div class="ml-auto">
            <a href="../controllers/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<!-- Thanh menu -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="?action=course">Course</a></li>
                <li class="list-group-item"><a href="?action=lesson">Lesson</a></li>
                <li class="list-group-item"><a href="#">Material</a></li>
                <li class="list-group-item"><a href="#">Question</a></li>
                <li class="list-group-item"><a href="#">Quiz</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Nội dung trang dashboard -->
            <div class="col-md-9">
                <?php
                $controller = isset($_GET['controller']) ? $_GET['controller']: 'views';
                $action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

                // Kiểm tra nếu người dùng đã chọn "Course"
                if (isset($_GET['action']) && $_GET['action'] == 'course') {
                    echo '<h3>Courses</h3>';
                    // Hiển thị button "Add new Course"
                    echo '<div class="mb-3">
                            <a href="../models/course/create_course.php" class="btn btn-success">Add new Course</a>
                        </div>';
                
                    $course = new Course();
                    $courses = $course->getAll();
                    
                        // Hiển thị danh sách các khóa học
                ?>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                            <tbody>
                        <?php
                                foreach ($courses as $course) {
                        ?>
                                    <tr>
                                    <td><?=$course['id'] ?></td>
                                    <td><?=$course['title'] ?></td>
                                    <td> <?=$course['description'] ?></td>
                                    <td><?=$course['created_at'] ?></td>
                                    <td><?=$course['updated_at'] ?></td>
                                    <td><a href="<?=DOMAIN.'/models/course/edit_course.php?id='.$course['id'] ?>" class="btn btn-warning">Edit</a></td>
                                    <td><a href="<?= DOMAIN.'/models/course/delete_course.php?id='.$course['id'] ?>" class="btn btn-danger" onclick="return confirmDelete();">Delete</a></td>
                                    </tr>
                        <?php
                                }
                        ?>
                            </tbody>
                            </table>
                <?php
                }
                if (isset($_GET['action']) && $_GET['action'] == 'lesson') {
                    echo '<h3>Lessons</h3>';
                    echo '<div class="mb-3">
                            <a href="../models/lesson/create_lesson.php" class="btn btn-success">Add new Lesson</a>
                        </div>';
                        $lesson = new Lesson();
                        $lessons = $lesson->getAllLessons();
                ?>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Course_ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                        foreach($lessons as $lesson) {
                    ?>
                            <tr>
                            <td><?=$lesson['id']?></td>
                            <td><?=$lesson['course_id']?></td>
                            <td><?=$lesson['title']?></td>
                            <td><?=$lesson['description']?></td>
                            <td><?=$lesson['created_at']?></td>
                            <td><?=$lesson['updated_at']?></td>
                            <td><a href="<?=DOMAIN.'/models/lesson/edit_lesson.php?id='.$lesson['id'] ?>" class="btn btn-warning">Edit</a></td>
                            <td><a href="<?= DOMAIN.'/models/lesson/delete_lesson.php?id='.$lesson['id'] ?>" class="btn btn-danger" onclick="return confirmDelete();">Delete</a></td>
                            </tr>
                    <?php
                    }
                    ?>
                        </tbody>
                        </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

</body>
</html>
