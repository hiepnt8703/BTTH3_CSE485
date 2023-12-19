<?php
require_once '../config.php';

class Lesson
{
    private $id;
    private $courseId;
    private $title;
    private $description;
    
    private $db;
    

    public function __construct()
    {
        // Initialize database connection
        
    }

    public static function getAllLessons()
    {
        $db = new PDO('mysql:host='.DB_HOST.';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM lessons');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getLessonsByCourseId($courseId)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('SELECT * FROM lessons WHERE course_id = :course_id');
        $query->bindParam(':course_id', $courseId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getLessonById($id)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('SELECT * FROM lessons WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    
}
?>

