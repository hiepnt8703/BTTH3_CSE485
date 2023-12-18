<?php
$courseId = isset($_POST['id']) ? $_POST['id'] : '';
if (empty($courseId)) {
    header("Location: dashboard.php?action=course");
    exit();
}

$title = isset($_POST['title']) ? $_POST['title'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

require_once '../../config.php';

$host = DB_HOST;
$dbname = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update the course in the database
    $sql = "UPDATE courses SET title = ?, description = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $description, PDO::PARAM_STR);
    $stmt->bindParam(3, $courseId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to the dashboard after successful update
    header("Location: ../../views/dashboard.php?action=course");
    exit();
    
} catch (PDOException $e) {
    // Handle database connection error or query execution error
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
