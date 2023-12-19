<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:../../views/login.php");
    exit();
}
require_once '../../config.php';
if(isset($_GET['id'])){
    $lessonId = $_GET['id'];

    try{
        $db = new PDO('mysql:host='.DB_HOST .';dbname='.DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // truy van co so du lieu
        $query = $db->prepare('DELETE FROM lessons WHERE id = :id');
        $query->bindParam(':id', $lessonId, PDO::PARAM_INT);
        if($query->execute()){
            header("Location:".APP_ROOT.'views/dashboard.php?action=lesson');
        }else{
            echo "Error:". $query->errorInfo()[2];
        }
        
        

    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
}


?>