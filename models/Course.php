<?php
require_once '../config.php';

class Course
{
    private $id;
    private $title;
    private $description;
    private $db;
    private $created_at;
    private $update_at;
    
    // public function __construct(){
    //     $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // }
    public function __construct(){
        
    }
		
    public static function getAll()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM courses');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('SELECT * FROM courses WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getId() {return $this->id;}

	public function getTitle() {return $this->title;}

	public function getDescription() {return $this->description;}

	public function getDb() {return $this->db;}

	public function getCreatedAt() {return $this->created_at;}

	public function getUpdateAt() {return $this->update_at;}

	public function setId( $id): void {$this->id = $id;}

	public function setTitle( $title): void {$this->title = $title;}

	public function setDescription( $description): void {$this->description = $description;}

	public function setDb( $db): void {$this->db = $db;}

	public function setCreatedAt( $created_at): void {$this->created_at = $created_at;}

	public function setUpdateAt( $update_at): void {$this->update_at = $update_at;}

}
?>
